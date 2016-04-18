<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNeighbouringSuburbsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('neighbouring_suburbs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('suburb_id')->unsigned();
            $table->integer('neighbour_suburb_id')->unsigned();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('neighbouring_suburbs');
    }
}
