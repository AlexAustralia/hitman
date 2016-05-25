<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('title_id')->unsigned()->nullable();
            $table->string('name');
            $table->string('surname');
            $table->string('spouse_name')->nullable();
            $table->string('phone');
            $table->string('work');
            $table->string('mobile');
            $table->string('email');
            $table->string('fax')->nullable();
            $table->string('client_address')->nullable();

            /**
             * type = 1 - owner, 2 - agency, 3 - occupier
             */

            $table->tinyInteger('type')->nullable();

            /**
             * date_cancel - date when the client cancelled a job on the day, null - if not
             */

            $table->date('date_cancel')->nullable();

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
        Schema::drop('clients');
    }
}
