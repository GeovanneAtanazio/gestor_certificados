<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Admin',
            'email'=> 'admin@blog.com',
            'password'  =>  bcrypt('123456789'),
        ]);

    }
}
