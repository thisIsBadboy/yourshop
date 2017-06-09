<?php

use Illuminate\Database\Seeder;
use App\Model\Category;
use Carbon\Carbon;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        Category::unguard();

        Category::insert([
            ['name'=>'Cloth', 'business_id'=>1, 'parent'=>0, 'level'=>1, 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()],
            ['name'=>'Fruit', 'business_id'=>1, 'parent'=>0, 'level'=>1, 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()],
            ['name'=>'Shirt', 'business_id'=>1, 'parent'=>1, 'level'=>2, 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()],
            ['name'=>'Apple', 'business_id'=>1, 'parent'=>2, 'level'=>2, 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()],
            ['name'=>'Orange', 'business_id'=>1, 'parent'=>2, 'level'=>2, 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()],
            ['name'=>'Pant', 'business_id'=>1, 'parent'=>1, 'level'=>2, 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()],
            ['name'=>'Jeans', 'business_id'=>1, 'parent'=>6, 'level'=>3, 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()]
        ]);

        Category::insert([
            ['name'=>'Car', 'business_id'=>2, 'parent'=>0, 'level'=>1, 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()],
            ['name'=>'Shoe', 'business_id'=>2, 'parent'=>0, 'level'=>1, 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()],
            ['name'=>'Lamborgini', 'business_id'=>2, 'parent'=>8, 'level'=>2, 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()],
            ['name'=>'Apex', 'business_id'=>2, 'parent'=>9, 'level'=>2, 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()],
            ['name'=>'Nike', 'business_id'=>2, 'parent'=>9, 'level'=>2, 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()],
            ['name'=>'Marcedes', 'business_id'=>2, 'parent'=>8, 'level'=>2, 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()],
            ['name'=>'Bata', 'business_id'=>2, 'parent'=>9, 'level'=>2, 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()]
        ]);
    }
}
