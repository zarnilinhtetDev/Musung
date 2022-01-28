<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Assign extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('line_assign', function (Blueprint $table) {
            $table->id('assign_id');
            $table->integer('user_id');
            $table->integer('l_id');
            $table->integer('main_target');
            $table->string('s_time');
            $table->string('e_time');
            $table->string('lunch_s_time');
            $table->string('lunch_e_time');
            $table->integer('work_min');
            $table->string('work_hr');
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
        Schema::dropIfExists('line_assign');
    }
}
