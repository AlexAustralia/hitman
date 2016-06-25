<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('client_id')->unsigned();
            $table->integer('street_id')->unsigned()->nullable();
            $table->string('street')->nullable();
            $table->integer('suburb_id')->unsigned();
            $table->text('property_notes')->nullable();
            $table->boolean('occupant_is_client');
            $table->integer('occupant_title_id')->unsigned()->nullable();
            $table->string('occupant_name')->nullable();
            $table->string('occupant_surname')->nullable();
            $table->string('occupant_phone')->nullable();

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
        Schema::drop('properties');
    }
}
