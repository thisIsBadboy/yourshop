<?php

use Illuminate\Database\Seeder;
use App\Model\Business;

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
        	Business::create([
        		"name" => "Business ".($i+1),
        		"description" => "This is business ".($i+1)." for testing.",
                "user_id" => ($i < 5) ? 1 : 2
        	]);
        }
    }
}
