<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'wes',
            'email' => 'wes@test.com',
            'password' => bcrypt('testPassword1'),
        ]);
    }
}
