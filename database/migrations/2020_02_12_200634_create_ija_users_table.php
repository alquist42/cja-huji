<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateIjaUsersTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ija_users', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('name', 50);
            $table->string('email', 100);
            $table->integer('role');
            $table->text('description', 65535);
            $table->integer('status');
            $table->string('password', 100);
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('ija_users');
    }
}
