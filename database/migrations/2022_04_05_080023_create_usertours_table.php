<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsertoursTable   extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usertours', function (Blueprint $table) {
            $table->id();
            $table->foreignId('userbids_id')->references('id')->on('userbids')->onDelete('cascade');

            $table->date('date_of_travel');
            $table->date('end_date');
            $table->string('number_of_passenger');
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
        //
    }
}
