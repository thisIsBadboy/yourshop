<?php

use Illuminate\Database\Seeder;
use App\Model\Business;
use App\Model\Account;
use App\Model\AccountConfiguration;

class BusinessTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$n = 10;
        for($i=0;$i<$n;$i++){
        	$business = Business::create([
        		"name" => "Business ".($i+1),
        		"description" => "This is business ".($i+1)." for testing.",
                "user_id" => ($i < 5) ? 1 : 2
        	]);

            $account_name = ["Cash Account", "Receivable Account", "Revenue Account"];
            $account_type_id = [33, 36, 13]; //Order: Cash, Account Receivable, Sales of Goods
            $account_code = ["1001", "1002", "1003"];

            $account_ids = [];
            for($j=0;$j<count($account_name);$j++){
                $account_ids[] = Account::insertGetId(
                    ['business_id'=>$business->id, 'name'=>$account_name[$j], 'type'=>$account_type_id[$j],'code'=>$account_code[$j]]
                );
            }

            AccountConfiguration::insert([
                ['business_id'=>$business->id, 'transaction_type'=>'sale', 'attribute'=>'cash', 'entry_type'=>'dr', 'account_id'=>$account_ids[0]],
                ['business_id'=>$business->id, 'transaction_type'=>'sale', 'attribute'=>'cash', 'entry_type'=>'cr', 'account_id'=>$account_ids[2]],
                ['business_id'=>$business->id, 'transaction_type'=>'sale', 'attribute'=>'due', 'entry_type'=>'dr', 'account_id'=>$account_ids[1]],
                ['business_id'=>$business->id, 'transaction_type'=>'sale', 'attribute'=>'due', 'entry_type'=>'cr', 'account_id'=>$account_ids[2]]
            ]);
        }
    }
}
