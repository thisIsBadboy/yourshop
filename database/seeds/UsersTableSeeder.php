<?php

use Illuminate\Database\Seeder;
use App\Model\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
        	'fname'=>'Rasel',
        	'email'=>'rasel@gmail.com',
        	'password'=>bcrypt('1234')
        ]);

        User::create([
            'fname'=>'Shaon',
            'email'=>'rasel@ymail.com',
            'password'=>bcrypt('1234')
        ]);
    }
}
