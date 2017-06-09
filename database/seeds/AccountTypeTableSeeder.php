<?php

use Illuminate\Database\Seeder;
use App\Model\AccountType;
use Carbon\Carbon;

class AccountTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AccountType::unguard();

        $now = Carbon::now();

        AccountType::insert([
        	['name'=>'Assets', 'parent'=>0, 'level'=>1, 'created_at'=>$now, 'updated_at'=>$now],
        	['name'=>'Liabilities', 'parent'=>0, 'level'=>1, 'created_at'=>$now, 'updated_at'=>$now],
        	['name'=>'Equity', 'parent'=>0, 'level'=>1, 'created_at'=>$now, 'updated_at'=>$now],
        	['name'=>'Revenues', 'parent'=>0, 'level'=>1, 'created_at'=>$now, 'updated_at'=>$now],
        	['name'=>'Expenses', 'parent'=>0, 'level'=>1, 'created_at'=>$now, 'updated_at'=>$now]
        ]);

        AccountType::insert([
        	['name'=>'Long Term Assets', 'parent'=>1, 'level'=>2, 'created_at'=>$now, 'updated_at'=>$now],
        	['name'=>'Current Assets', 'parent'=>1, 'level'=>2, 'created_at'=>$now, 'updated_at'=>$now]
        ]);

        AccountType::insert([
        	['name'=>'Current Liability', 'parent'=>2, 'level'=>2, 'created_at'=>$now, 'updated_at'=>$now],
        	['name'=>'Long Term Liability', 'parent'=>2, 'level'=>2, 'created_at'=>$now, 'updated_at'=>$now]
        ]);

        AccountType::insert([
        	['name'=>'Owner\'s Equity', 'parent'=>3, 'level'=>2, 'created_at'=>$now, 'updated_at'=>$now],
        	['name'=>'Stockholder\'s Equity', 'parent'=>3, 'level'=>2, 'created_at'=>$now, 'updated_at'=>$now]
        ]);


        AccountType::insert([
        	['name'=>'Sales of Long Term Assets', 'parent'=>4, 'level'=>2, 'created_at'=>$now, 'updated_at'=>$now],
        	['name'=>'Sales of Goods', 'parent'=>4, 'level'=>2, 'created_at'=>$now, 'updated_at'=>$now],
        	['name'=>'Sales of Service', 'parent'=>4, 'level'=>2, 'created_at'=>$now, 'updated_at'=>$now],
        	['name'=>'Other Income', 'parent'=>4, 'level'=>2, 'created_at'=>$now, 'updated_at'=>$now]
        ]);

        AccountType::insert([
        	['name'=>'Cost of Goods Sold', 'parent'=>5, 'level'=>2, 'created_at'=>$now, 'updated_at'=>$now],
        	['name'=>'Administrative Cost', 'parent'=>5, 'level'=>2, 'created_at'=>$now, 'updated_at'=>$now],
        	['name'=>'Personal Cost', 'parent'=>5, 'level'=>2, 'created_at'=>$now, 'updated_at'=>$now],
        	['name'=>'Operating Cost', 'parent'=>5, 'level'=>2, 'created_at'=>$now, 'updated_at'=>$now],
        	['name'=>'Interest', 'parent'=>5, 'level'=>2, 'created_at'=>$now, 'updated_at'=>$now],
        	['name'=>'Depreciation Expense', 'parent'=>5, 'level'=>2, 'created_at'=>$now, 'updated_at'=>$now],
        	['name'=>'Supply Expense', 'parent'=>5, 'level'=>2, 'created_at'=>$now, 'updated_at'=>$now],
        	['name'=>'Loss on Sale', 'parent'=>5, 'level'=>2, 'created_at'=>$now, 'updated_at'=>$now],
        	['name'=>'Delivery', 'parent'=>5, 'level'=>2, 'created_at'=>$now, 'updated_at'=>$now]
        ]);

        AccountType::insert([
        	['name'=>'Accumulated Depreciation', 'parent'=>6, 'level'=>3, 'created_at'=>$now, 'updated_at'=>$now],
        	['name'=>'Land', 'parent'=>6, 'level'=>3, 'created_at'=>$now, 'updated_at'=>$now],
        	['name'=>'Building', 'parent'=>6, 'level'=>3, 'created_at'=>$now, 'updated_at'=>$now],
        	['name'=>'Furniture & Fixtures', 'parent'=>6, 'level'=>3, 'created_at'=>$now, 'updated_at'=>$now],
        	['name'=>'Machinary', 'parent'=>6, 'level'=>3, 'created_at'=>$now, 'updated_at'=>$now],
        	['name'=>'Equipment', 'parent'=>6, 'level'=>3, 'created_at'=>$now, 'updated_at'=>$now],
        	['name'=>'Vehicles', 'parent'=>6, 'level'=>3, 'created_at'=>$now, 'updated_at'=>$now],
        	['name'=>'Intangible Assets', 'parent'=>6, 'level'=>3, 'created_at'=>$now, 'updated_at'=>$now]
        ]);

        AccountType::insert([
        	['name'=>'Cash', 'parent'=>7, 'level'=>3, 'created_at'=>$now, 'updated_at'=>$now],
        	['name'=>'Bank Account', 'parent'=>7, 'level'=>3, 'created_at'=>$now, 'updated_at'=>$now],
        	['name'=>'Check', 'parent'=>7, 'level'=>3, 'created_at'=>$now, 'updated_at'=>$now],
        	['name'=>'Account Receivable', 'parent'=>7, 'level'=>3, 'created_at'=>$now, 'updated_at'=>$now],
        	['name'=>'Inventory', 'parent'=>7, 'level'=>3, 'created_at'=>$now, 'updated_at'=>$now],
        	['name'=>'Supplies', 'parent'=>7, 'level'=>3, 'created_at'=>$now, 'updated_at'=>$now],
        	['name'=>'Good Issued not Invoiced', 'parent'=>7, 'level'=>3, 'created_at'=>$now, 'updated_at'=>$now],
        	['name'=>'Prepaid Expenses', 'parent'=>7, 'level'=>3, 'created_at'=>$now, 'updated_at'=>$now],
        	['name'=>'Deffered Tax Asset', 'parent'=>7, 'level'=>3, 'created_at'=>$now, 'updated_at'=>$now]
        ]);

        AccountType::insert([
        	['name'=>'Accounts Payable', 'parent'=>8, 'level'=>3, 'created_at'=>$now, 'updated_at'=>$now],
        	['name'=>'Wages Payable', 'parent'=>8, 'level'=>3, 'created_at'=>$now, 'updated_at'=>$now],
        	['name'=>'Interest Payable', 'parent'=>8, 'level'=>3, 'created_at'=>$now, 'updated_at'=>$now],
        	['name'=>'Sales Tax Payable', 'parent'=>8, 'level'=>3, 'created_at'=>$now, 'updated_at'=>$now],
        	['name'=>'Income Tax Payable', 'parent'=>8, 'level'=>3, 'created_at'=>$now, 'updated_at'=>$now],
        	['name'=>'Payroll Tax Payable', 'parent'=>8, 'level'=>3, 'created_at'=>$now, 'updated_at'=>$now],
        	['name'=>'Notes Payable (< a year)', 'parent'=>8, 'level'=>3, 'created_at'=>$now, 'updated_at'=>$now],
        	['name'=>'Loans Payable', 'parent'=>8, 'level'=>3, 'created_at'=>$now, 'updated_at'=>$now],
        	['name'=>'Unsecured Loan Payable', 'parent'=>8, 'level'=>3, 'created_at'=>$now, 'updated_at'=>$now],
        	['name'=>'Accrued Expenses', 'parent'=>8, 'level'=>3, 'created_at'=>$now, 'updated_at'=>$now],
        	['name'=>'Unearned Revenues', 'parent'=>8, 'level'=>3, 'created_at'=>$now, 'updated_at'=>$now]
        ]);

        AccountType::insert([
        	['name'=>'Reserve & Surpluses', 'parent'=>9, 'level'=>3, 'created_at'=>$now, 'updated_at'=>$now],
        	['name'=>'Share Capital', 'parent'=>9, 'level'=>3, 'created_at'=>$now, 'updated_at'=>$now],
        	['name'=>'Deferred Tax Liability', 'parent'=>9, 'level'=>3, 'created_at'=>$now, 'updated_at'=>$now],
        	['name'=>'Bonds Payable', 'parent'=>9, 'level'=>3, 'created_at'=>$now, 'updated_at'=>$now],
        	['name'=>'Notes Payable (> a year)', 'parent'=>9, 'level'=>3, 'created_at'=>$now, 'updated_at'=>$now]
        ]);

        AccountType::insert([
        	['name'=>'Owner\'s Contribution', 'parent'=>10, 'level'=>3, 'created_at'=>$now, 'updated_at'=>$now],
        	['name'=>'Owner\'s Capital', 'parent'=>10, 'level'=>3, 'created_at'=>$now, 'updated_at'=>$now],
        	['name'=>'Drawings', 'parent'=>10, 'level'=>3, 'created_at'=>$now, 'updated_at'=>$now],
        	['name'=>'Retained Earnings', 'parent'=>10, 'level'=>3, 'created_at'=>$now, 'updated_at'=>$now],
        	['name'=>'Deferred Tax Liability', 'parent'=>10, 'level'=>3, 'created_at'=>$now, 'updated_at'=>$now],
        	['name'=>'Capital Contributions', 'parent'=>10, 'level'=>3, 'created_at'=>$now, 'updated_at'=>$now]
        ]);

        AccountType::insert([
        	['name'=>'Common Stock', 'parent'=>11, 'level'=>3, 'created_at'=>$now, 'updated_at'=>$now],
        	['name'=>'Treasury Stock', 'parent'=>11, 'level'=>3, 'created_at'=>$now, 'updated_at'=>$now],
        	['name'=>'Preferred Stock', 'parent'=>11, 'level'=>3, 'created_at'=>$now, 'updated_at'=>$now],
        	['name'=>'Retained Earnings', 'parent'=>11, 'level'=>3, 'created_at'=>$now, 'updated_at'=>$now],
        	['name'=>'Deferred Tax Liability', 'parent'=>11, 'level'=>3, 'created_at'=>$now, 'updated_at'=>$now],
        	['name'=>'Capital in Excess of Par', 'parent'=>11, 'level'=>3, 'created_at'=>$now, 'updated_at'=>$now]
        ]);

        AccountType::insert([
        	['name'=>'Goodwill', 'parent'=>32, 'level'=>4, 'created_at'=>$now, 'updated_at'=>$now],
        	['name'=>'Trade Names', 'parent'=>32, 'level'=>4, 'created_at'=>$now, 'updated_at'=>$now]
        ]);
    }
}
