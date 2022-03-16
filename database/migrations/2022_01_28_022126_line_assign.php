<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class LineAssign extends Migration
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
            $table->integer('m_power');
            $table->integer('actual_m_power');
            $table->integer('hp');
            $table->integer('actual_hp');
            $table->string('s_time');
            $table->string('e_time');
            $table->string('lunch_s_time');
            $table->string('lunch_e_time');
            $table->integer('cal_work_min');
            $table->string('t_work_hr');
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
        Schema::dropIfExists('line_assign');
    }
}
