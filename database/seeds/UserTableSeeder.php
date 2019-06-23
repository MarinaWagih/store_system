<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\User::create([
            'name'      =>  'admin',
            'email'     =>  'admin@sw.com',
            'password'  =>  bcrypt('123456'),
            'type'      =>  'admin',
            'phone'     =>  ''
        ]);
    }
}
