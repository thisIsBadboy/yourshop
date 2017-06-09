<?php

use Illuminate\Database\Seeder;
use App\Model\Product;
use Carbon\Carbon;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::unguard();

        for($i=1;$i<=5;$i++){
	        Product::insert([
	        	['business_id'=>1, 'category_id'=>1, 'title'=>'Cloth '.$i, 'price'=>($i*5), 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()],
	        	['business_id'=>1, 'category_id'=>7, 'title'=>'Jeans '.$i, 'price'=>($i*5), 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()],
	        	['business_id'=>1, 'category_id'=>4, 'title'=>'Apple '.$i, 'price'=>($i*5), 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()],
	        	['business_id'=>1, 'category_id'=>2, 'title'=>'Orange '.$i, 'price'=>($i*5), 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()]
	        ]);
	    }

	    for($i=1;$i<=5;$i++){
	        Product::insert([
	        	['business_id'=>2, 'category_id'=>8, 'title'=>'Car '.$i, 'price'=>($i*5), 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()],
	        	['business_id'=>2, 'category_id'=>9, 'title'=>'Shoe '.$i, 'price'=>($i*5), 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()],
	        	['business_id'=>2, 'category_id'=>10, 'title'=>'Lamborgini '.$i, 'price'=>($i*5), 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()],
	        	['business_id'=>2, 'category_id'=>11, 'title'=>'Apex '.$i, 'price'=>($i*5), 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()],
	        	['business_id'=>2, 'category_id'=>12, 'title'=>'Nike '.$i, 'price'=>($i*5), 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()]
	        ]);
	    }
    }
}
