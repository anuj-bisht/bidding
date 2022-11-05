<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsertransportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usertransports', function (Blueprint $table) {
            $table->id();
            // $table->unsignedBigInteger('userbids_id');
            $table->foreignId('userbids_id')->references('id')->on('userbids')->onDelete('cascade');

            $table->string('vehicle_size_id');
            $table->string('weight');
            $table->string('vehicle_bodytype');
            $table->tinyInteger('loading_and_unloading');

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
        Schema::dropIfExists('usertransports');
    }
}
