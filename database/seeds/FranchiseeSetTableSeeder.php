<?php

use Illuminate\Database\Seeder;

class FranchiseeSetTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Seed initial Franchisee Settings Data
     *
     * @return void
     */
    public function run()
    {
        \App\FranchiseeSet::create([
            'name' => 'New Client Fee',
            'value' => 0.00
        ]);

        \App\FranchiseeSet::create([
            'name' => 'Existing Client Fee',
            'value' => 0.00
        ]);

        \App\FranchiseeSet::create([
            'name' => 'Franchisee Client Fee',
            'value' => 0.00
        ]);

        \App\FranchiseeSet::create([
            'name' => 'Rebooking Fee',
            'value' => 0.00
        ]);

        \App\FranchiseeSet::create([
            'name' => 'Franchisee Invoice Fee',
            'value' => 0.00
        ]);

        \App\FranchiseeSet::create([
            'name' => 'New Franchisee Fee',
            'value' => 0.00
        ]);

        \App\FranchiseeSet::create([
            'name' => 'Termite Quote Commission',
            'value' => 0.00
        ]);

        \App\FranchiseeSet::create([
            'name' => 'Termite Work Commission',
            'value' => 0.00
        ]);

        \App\FranchiseeSet::create([
            'name' => 'Termite Franchisor Commission',
            'value' => 0.00
        ]);
    }
}
