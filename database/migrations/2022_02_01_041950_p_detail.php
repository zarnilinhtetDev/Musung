<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('p_detail', function (Blueprint $table) {
            $table->id('p_detail_id');
            $table->integer('assign_id');
            $table->integer('l_id');
            $table->integer('p_cat_id');
            $table->string('p_name');
            $table->integer('quantity');
            $table->integer('p_actual_target')->nullable();
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
        Schema::dropIfExists('p_detail');
    }
}
