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
            $table->string('style_no')->nullable();
            $table->integer('quantity');
            $table->integer('order_quantity')->nullable();
            $table->integer('div_quantity')->nullable();
            $table->integer('sewing_input')->nullable();
            $table->integer('h_over_input')->nullable();
            $table->integer('h_balance')->nullable();
            $table->integer('p_actual_target')->nullable();
            $table->integer('cat_actual_target')->nullable();
            $table->integer('inline')->nullable();
            $table->float('cmp')->nullable();
            $table->integer('ot_status')->nullable();
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
