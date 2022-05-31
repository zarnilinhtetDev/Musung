<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class LineEntryHistory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('line_entry_history', function (Blueprint $table) {
            $table->id('id');
            $table->string('time_id');
            $table->integer('l_id')->nullable();
            $table->integer('p_id')->nullable();
            $table->string('actual_target')->nullable();
            $table->string('assign_date')->nullable();
            $table->string('status');
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
