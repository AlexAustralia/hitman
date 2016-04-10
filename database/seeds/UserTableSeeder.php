<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Seed Administrator account
     *
     * @return void
     */
    public function run()
    {
        \App\User::create([
            'name' => 'Administrator',
            'email' => 'admin@hitman.com.au',
            'password' => bcrypt('admin'),
            'role_id' => '1'
        ]);
    }
}
