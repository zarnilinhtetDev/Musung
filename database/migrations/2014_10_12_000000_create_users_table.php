<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id('id');
            $table->string('name');
            $table->string('username')->unique();
            $table->string('password');
            $table->string('email')->nullable();
            $table->integer('role');
            $table->integer('line_id')->nullable();
            $table->tinyInteger('active_status')->nullable();
            $table->tinyInteger('is_delete')->nullable();
            $table->tinyInteger('is_assigned')->nullable();
            $table->string('remark')->nullable();
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
        Schema::dropIfExists('users');
    }
}
