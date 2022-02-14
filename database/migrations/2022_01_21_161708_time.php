<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Time extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('time', function (Blueprint $table) {
            $table->id('time_id');
            $table->string('time_name');
            $table->integer('status')->nullable();
            $table->integer('line_id');
            $table->integer('assign_id');
            $table->integer('div_target');
            $table->integer('div_actual_target')->nullable();
            $table->integer('div_actual_percent')->nullable();
            $table->integer('actual_target_entry');
            $table->string('assign_date');
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
        Schema::dropIfExists('time');
    }
}
