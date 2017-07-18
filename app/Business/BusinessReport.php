<?php

namespace App\Business;

use DB;
use App\Model\Business;
use App\Model\AccountType, App\Model\Account;
use App\Model\JournalEntry, App\Model\JournaItem;

class BusinessReport {

	protected $account_types = [];

	public function __construct(){
		$this->account_types = $this->getAccountTypeInfo();
	}

	private function getAccountTypeInfo(){
		$account_types = AccountType::select('id', 'name', 'parent', 'level')->get()->toArray();

		$types = [];
		$total_account_type = count($account_types);
		for($i=0;$i<$total_account_type;$i++){
			$types[$account_types[$i]['id']]['parent'] = $account_types[$i]['parent'];
			$types[$account_types[$i]['id']]['name'] = $account_types[$i]['name'];
			$types[$account_types[$i]['id']]['level'] = $account_types[$i]['level'];
		}

		for($i=0;$i<$total_account_type;$i++){
			$this->rootAccountType($types, $account_types[$i]['id']);
		}

		return $types;
	}

	private function rootAccountType(&$types, $account_type_id){
		
		$ancestor = "";
		$id = $account_type_id;
		$expected_level = 2;
		$next_root_type = -1;

		try{
			while($types[$id]['parent'] != 0){
				$ancestor = $types[$id]['name'] . (trim($ancestor) != "" ? " > " : "") . $ancestor;

				if($types[$id]['level'] == $expected_level){
					$next_root_type = $id;
				}

				$id = $types[$id]['parent'];
			}

			$ancestor = $types[$id]['name'] . (trim($ancestor) != "" ? " > " : "") . $ancestor;
		}catch(Exception $e){

		}

		$types[$account_type_id]['root_type'] = $id;
		$types[$account_type_id]['next_root_type'] = $next_root_type;
		$types[$account_type_id]['ancestor'] = $ancestor;
	}

	public function getJournalEntries(Business $business){
		$journal_entries = DB::table('journal_entries')
                            ->select(
                                'journal_entries.id',
                                'journal_entries.created_at',
                                'journal_entries.updated_at',
                                DB::raw("COALESCE(SUM(CASE WHEN journal_items.entry_type = 'dr' THEN journal_items.amount END), 0) AS debit_amount"),
                                DB::raw("COALESCE(SUM(CASE WHEN journal_items.entry_type = 'cr' THEN journal_items.amount END), 0) AS credit_amount")
                            )
                            ->join('journal_items', function($join) use ($business){
                                $join->on('journal_entries.id', '=', 'journal_items.journal_entry_id')
                                ->where('journal_entries.business_id', '=', $business->id);
                            })
                            ->groupBy('journal_entries.id')
                            ->orderBy('journal_entries.created_at', 'desc')
                            ->get();

        return $journal_entries;
	}

	public function getJournalItems(Business $business){
		$journal_items = DB::table('journal_entries')
                        ->select(
                            'journal_entries.*', 
                            'journal_items.entry_type',
                            'journal_items.amount',
                            'accounts.id AS account_id',
                            'accounts.name AS account_name',
                            'accounts.type AS account_type'
                        )
                        ->join('journal_items', function($join) use ($business){
                            $join->on('journal_entries.id', '=', 'journal_items.journal_entry_id')
                            ->where(['journal_entries.business_id' => $business->id]);
                        })
                        ->join('accounts', 'journal_items.account_id', '=', 'accounts.id')
                        ->get();

        return $journal_items;
	}

	public function getTrialBalance(Business $business){
		$accounts = DB::table('journal_entries')
                        ->select(
                        	'accounts.id AS account_id',
                            'accounts.name AS account_name',
                            'accounts.code AS account_code',
                            'accounts.type AS account_type',

                            DB::raw("COALESCE(SUM(CASE WHEN journal_items.entry_type = 'dr' THEN journal_items.amount END), 0) debit_amount"),

                            DB::raw("COALESCE(SUM(CASE WHEN journal_items.entry_type = 'cr' THEN journal_items.amount END), 0) AS credit_amount")
                        )
                        ->join('journal_items', function($join) use ($business){
                            $join->on('journal_entries.id', '=', 'journal_items.journal_entry_id')
                            ->where(['journal_entries.business_id' => $business->id]);
                        })
                        ->join('accounts', 'journal_items.account_id', '=', 'accounts.id')
                        ->groupBy('accounts.id')
                        ->get();

        $total_debit = $total_credit = 0;

        for($i=0;$i<count($accounts);$i++){
        	$accounts[$i]->ancestor = $this->account_types[$accounts[$i]->account_type]['ancestor'];

        	$total_debit += $accounts[$i]->debit_amount;
        	$total_credit += $accounts[$i]->credit_amount;
        }

        $bundle = ['accounts'=>$accounts, 'total_debit'=>$total_debit, 'total_credit'=>$total_credit];

        return $bundle;
	}
	
	public function getBalanceSheet(Business $business){
		$balance_sheet_bundle = [];

		try{
			$accounts = DB::table('journal_entries')
	                        ->select(
	                        	'accounts.id AS account_id',
	                            'accounts.name AS account_name',
	                            'accounts.code AS account_code',
	                            'accounts.type AS account_type',

	                            DB::raw("COALESCE(SUM(CASE WHEN journal_items.entry_type = 'dr' THEN journal_items.amount END), 0) debit_amount"),

	                            DB::raw("COALESCE(SUM(CASE WHEN journal_items.entry_type = 'cr' THEN journal_items.amount END), 0) AS credit_amount"),

	                            DB::raw("COALESCE(SUM(CASE WHEN journal_items.entry_type = 'dr' THEN journal_items.amount END), 0) - COALESCE(SUM(CASE WHEN journal_items.entry_type = 'cr' THEN journal_items.amount END), 0) AS account_balance")
	                        )
	                        ->join('journal_items', function($join) use ($business){
	                            $join->on('journal_entries.id', '=', 'journal_items.journal_entry_id')
	                            ->where(['journal_entries.business_id' => $business->id]);
	                        })
	                        ->join('accounts', 'journal_items.account_id', '=', 'accounts.id')
	                        ->groupBy('accounts.id')
	                        ->get();

	        $bundle = [];

	        foreach($accounts as $account){
	        	$root_type = $this->account_types[$account->account_type]['root_type'];
	        	$account->ancestor = $this->account_types[$account->account_type]['ancestor'];

	        	if($root_type >=2 && $root_type <= 4){ //Liability, Equity, Revenue
	        		$account->account_balance = (-1) * $account->account_balance;
	        	}

	        	if(! array_key_exists($root_type, $bundle)){
	        		$bundle[$root_type]['info'] = [
	        			'name' => $this->account_types[$root_type]['name'],
	        			'ancestor' => $this->account_types[$root_type]['ancestor'],
	        			'total'=>0
	        		];
	        		$bundle[$root_type]['group'] = [];
	        	}

	        	if($root_type >= 1 && $root_type <= 3){ //Asset, Liabilty, Equity
	        		$next_root_type = $this->account_types[$account->account_type]['next_root_type'];

	        		if(! array_key_exists($next_root_type, $bundle[$root_type]['group'])){
	        			$bundle[$root_type]['group'][$next_root_type]['info'] = [
		        			'name' => $this->account_types[$next_root_type]['name'],
		        			'ancestor' => $this->account_types[$next_root_type]['ancestor'],
		        			'total'=>0
		        		];
	        			$bundle[$root_type]['group'][$next_root_type]['group'] = [];
	        		}

	        		$bundle[$root_type]['group'][$next_root_type]['group'][] = $account;
	        		$bundle[$root_type]['group'][$next_root_type]['info']['total'] += $account->account_balance;
		        	$bundle[$root_type]['info']['total'] += $account->account_balance;
	        	}else{ //Revenue, Expense
		        	$bundle[$root_type]['group'][] = $account;
		        	$bundle[$root_type]['info']['total'] += $account->account_balance;
		        }
	        }  

	        $balance_sheet_bundle['left'] = $balance_sheet_bundle['right'] = [
	        	'info' => [
        			'total' => 0
        		],
        		'group' => []
	        ];

	        //$balance_sheet_bundle['left']['info'] = $balance_sheet_bundle['right']['info'] = ['total' => 0];
	        //$balance_sheet_bundle['left']['group'] = $balance_sheet_bundle['right']['group'] = [];

	        foreach($bundle as $key=>$group){
	        	if($key == 1){ //Asset
	        		/*if(! array_key_exists('left', $balance_sheet_bundle)){
	        			$balance_sheet_bundle['left']['info'] = [
	        				'total' => 0
	        			];
	        			$balance_sheet_bundle['left']['group'] = [];
	        		}*/

	        		$balance_sheet_bundle['left']['group'][$key] = $group;
	        		$balance_sheet_bundle['left']['info']['total'] += $group['info']['total'];
	        	}elseif($key >= 2 && $key <= 5){ //Liability, Equity, Revenue, Expense
	        		/*if(! array_key_exists('right', $balance_sheet_bundle)){
	        			$balance_sheet_bundle['right']['info'] = [
	        				'total' => 0
	        			];
	        			$balance_sheet_bundle['right']['group'] = [];
	        		}*/

	        		$balance_sheet_bundle['right']['group'][$key] = $group;
	        		$balance_sheet_bundle['right']['info']['total'] += $group['info']['total'];
	        	}
	        } 

	        /*$account_group = [];
	        for($i=0;$i<count($accounts);$i++){
	        	$accounts[$i]->ancestor = $this->account_types[$accounts[$i]->account_type]['ancestor'];

	        	$root_type = $this->account_types[$accounts[$i]->account_type]['root_type'];
	        	if(! array_key_exists($root_type, $account_group)){
	        		$account_group[$root_type] = [];
	        	}

	        	$account_group[$root_type][] = $accounts[$i];
	        }
	        
	        foreach($account_group as $key=>$group){
	        	$bundle[$key]['detail'] = [
	        		'name' => $this->account_types[$key]['name'],
	        		'ancestor' => $this->account_types[$key]['ancestor'],
	        		'total'=>0
	        	];

	        	$bundle[$key]['group'] = [];

	        	foreach($group as $account){
	        		$root_type = $this->account_types[$account->account_type]['root_type'];

	        		if($root_type >= 1 && $root_type <= 3){ // 1) Assets 2) Liabilty 3) Equity

		        		$next_root_type = $this->account_types[$account->account_type]['next_root_type'];

		        		if(! array_key_exists($next_root_type, $bundle[$key]['group'])){
		        			$bundle[$key]['group'][$next_root_type]['detail'] = [
		        				'name' => $this->account_types[$next_root_type]['name'],
		        				'ancestor' => $this->account_types[$next_root_type]['ancestor'],
		        				'total'=>0
		        			];
		        			$bundle[$key]['group'][$next_root_type]['group'] = [];
		        		}

		        		$bundle[$key]['group'][$next_root_type]['group'][] = $account;
		        		$bundle[$key]['group'][$next_root_type]['detail']['total'] += $account->account_balance;
		        		$bundle[$key]['detail']['total'] += $account->account_balance;
		        	}else{ // 4) Revenue 5) Expense
		        		$bundle[$key]['group'][] = $account;
		        		$bundle[$key]['detail']['total'] += $account->account_balance;
		        	}
	        	}
	        }*/
	    }catch(Exception $e){

	    }

        return $balance_sheet_bundle;
	}

	public function getProfitLoss(Business $business){
		$profit_loss_bundle = [];

		try{
			$accounts = DB::table('journal_entries')
	                        ->select(
	                        	'accounts.id AS account_id',
	                            'accounts.name AS account_name',
	                            'accounts.code AS account_code',
	                            'accounts.type AS account_type',

	                            DB::raw("COALESCE(SUM(CASE WHEN journal_items.entry_type = 'dr' THEN journal_items.amount END), 0) debit_amount"),

	                            DB::raw("COALESCE(SUM(CASE WHEN journal_items.entry_type = 'cr' THEN journal_items.amount END), 0) AS credit_amount"),

	                            DB::raw("COALESCE(SUM(CASE WHEN journal_items.entry_type = 'dr' THEN journal_items.amount END), 0) - COALESCE(SUM(CASE WHEN journal_items.entry_type = 'cr' THEN journal_items.amount END), 0) AS account_balance")
	                        )
	                        ->join('journal_items', function($join) use ($business){
	                            $join->on('journal_entries.id', '=', 'journal_items.journal_entry_id')
	                            ->where(['journal_entries.business_id' => $business->id]);
	                        })
	                        ->join('accounts', 'journal_items.account_id', '=', 'accounts.id')
	                        ->groupBy('accounts.id')
	                        ->get();

	        $bundle = [];

	        foreach($accounts as $account){
	        	$root_type = $this->account_types[$account->account_type]['root_type'];
	        	$account->ancestor = $this->account_types[$account->account_type]['ancestor'];

	        	if($root_type == 4){ //Revenue
	        		$account->account_balance = (-1) * $account->account_balance;
	        	}

	        	if($root_type >= 4 && $root_type <= 5){ //Revenue, Expense

	        		if(! array_key_exists($root_type, $bundle)){
		        		$bundle[$root_type]['info'] = [
		        			'name' => $this->account_types[$root_type]['name'],
		        			'ancestor' => $this->account_types[$root_type]['ancestor'],
		        			'total'=>0
		        		];
		        		$bundle[$root_type]['group'] = [];
		        	}

		        	$bundle[$root_type]['group'][] = $account;
		        	$bundle[$root_type]['info']['total'] += $account->account_balance;
		        }
	        }  

	        $profit_loss_bundle['profit_loss'] = [
	        	'info' => [
	        		'total' => 0
	        	],
	        	'group' => []
	        ];

	        foreach($bundle as $key=>$group){
	        	if($key >= 4 && $key <= 5){ //Revenue, Expense
	        		/*if(! array_key_exists('profit_loss', $profit_loss_bundle)){
	        			$profit_loss_bundle['profit_loss']['info'] = [
	        				'total' => 0
	        			];
	        			$profit_loss_bundle['profit_loss']['group'] = [];
	        		}*/

	        		$profit_loss_bundle['profit_loss']['group'][$key] = $group;
	        		$profit_loss_bundle['profit_loss']['info']['total'] += $group['info']['total'];
	        	}
	        }
	    }catch(Exception $e){

	    }

	    return $profit_loss_bundle; 
	}
}