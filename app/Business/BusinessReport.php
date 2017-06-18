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

	public function getAccountTypeInfo(){
		$account_types = AccountType::select('id', 'name', 'parent')->get()->toArray();

		$types = [];
		$total_account_type = count($account_types);
		for($i=0;$i<$total_account_type;$i++){
			$types[$account_types[$i]['id']]['parent'] = $account_types[$i]['parent'];
			$types[$account_types[$i]['id']]['name'] = $account_types[$i]['name'];
		}

		for($i=0;$i<$total_account_type;$i++){
			$this->rootAccountType($types, $account_types[$i]['id']);
		}

		return $types;
	}

	private function rootAccountType(&$types, $account_type_id){
		$ancestor = "";
		$id = $account_type_id;

		try{
			while($types[$id]['parent'] != 0){
				$ancestor = $types[$id]['name'] . (trim($ancestor) != "" ? " > " : "") . $ancestor;
				$id = $types[$id]['parent'];
			}

			$ancestor = $types[$id]['name'] . (trim($ancestor) != "" ? " > " : "") . $ancestor;
		}catch(Exception $e){

		}

		$types[$account_type_id]['root_type_id'] = $id;
		$types[$account_type_id]['ancestor'] = $ancestor;
	}

	public function getJournalEntries(Business $business){
		$journal_entries = DB::table('journal_entries')
                            ->select(
                                'journal_entries.id',
                                'journal_entries.created_at',
                                'journal_entries.updated_at',
                                DB::raw("IFNULL(SUM(CASE WHEN journal_items.entry_type = 'dr' THEN journal_items.amount END), 0) AS debit_amount"),
                                DB::raw("IFNULL(SUM(CASE WHEN journal_items.entry_type = 'cr' THEN journal_items.amount END), 0) AS credit_amount")
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

                            DB::raw("IFNULL(SUM(CASE WHEN journal_items.entry_type = 'dr' THEN journal_items.amount END), 0.0) debit_amount"),

                            DB::raw("IFNULL(SUM(CASE WHEN journal_items.entry_type = 'cr' THEN journal_items.amount END), 0.0) AS credit_amount"),

                            DB::raw("IFNULL(SUM(CASE WHEN journal_items.entry_type = 'dr' THEN journal_items.amount END), 0.0) - IFNULL(SUM(CASE WHEN journal_items.entry_type = 'cr' THEN journal_items.amount END), 0) AS account_balance")
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
		$accounts = DB::table('journal_entries')
                        ->select(
                        	'accounts.id AS account_id',
                            'accounts.name AS account_name',
                            'accounts.type AS account_type',
                            DB::raw("IFNULL(SUM(CASE WHEN journal_items.entry_type = 'dr' THEN journal_items.amount END), 0) - IFNULL(SUM(CASE WHEN journal_items.entry_type = 'cr' THEN journal_items.amount END), 0) AS account_balance")
                        )
                        ->join('journal_items', function($join) use ($business){
                            $join->on('journal_entries.id', '=', 'journal_items.journal_entry_id')
                            ->where(['journal_entries.business_id' => $business->id]);
                        })
                        ->join('accounts', 'journal_items.account_id', '=', 'accounts.id')
                        ->groupBy('accounts.id')
                        ->get();

        return $accounts;
	}
}