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
            ['name'=>'Cloth', 'parent'=>0, 'level'=>1, 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()],
            ['name'=>'Fruit', 'parent'=>0, 'level'=>1, 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()],
            ['name'=>'Shirt', 'parent'=>1, 'level'=>2, 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()],
            ['name'=>'Apple', 'parent'=>2, 'level'=>2, 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()],
            ['name'=>'Orange', 'parent'=>2, 'level'=>2, 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()],
            ['name'=>'Pant', 'parent'=>1, 'level'=>2, 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()],
            ['name'=>'Jeans', 'parent'=>6, 'level'=>3, 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()]
        ]);

        Category::insert([
            ['name'=>'Car', 'parent'=>0, 'level'=>1, 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()],
            ['name'=>'Shoe', 'parent'=>0, 'level'=>1, 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()],
            ['name'=>'Lamborgini', 'parent'=>8, 'level'=>2, 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()],
            ['name'=>'Apex', 'parent'=>9, 'level'=>2, 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()],
            ['name'=>'Nike', 'parent'=>9, 'level'=>2, 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()],
            ['name'=>'Marcedes', 'parent'=>8, 'level'=>2, 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()],
            ['name'=>'Bata', 'parent'=>9, 'level'=>2, 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()]
        ]);
    }
}
