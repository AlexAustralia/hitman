<?php

use Illuminate\Database\Seeder;

class ApplicationSetTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\ApplicationSet::create([
            'name' => 'Confirmed Job',
            'value' => ''
        ]);

        \App\ApplicationSet::create([
            'name' => 'Unconfirmed Job',
            'value' => ''
        ]);

        \App\ApplicationSet::create([
            'name' => 'Moved Job',
            'value' => ''
        ]);

        \App\ApplicationSet::create([
            'name' => 'Unchecked Job',
            'value' => ''
        ]);

        \App\ApplicationSet::create([
            'name' => 'Completed Job',
            'value' => ''
        ]);

        \App\ApplicationSet::create([
            'name' => 'Dragged Job',
            'value' => ''
        ]);

        \App\ApplicationSet::create([
            'name' => 'Schedule Background',
            'value' => ''
        ]);
    }
}
