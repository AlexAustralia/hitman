<?php

use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Role::create([
            'name' => 'Administrator',
        ]);

        \App\Role::create([
            'name' => 'Telemarketer',
        ]);

        \App\Role::create([
            'name' => 'Franchisee',
        ]);

        \App\Role::create([
            'name' => 'Technician',
        ]);
    }
}
