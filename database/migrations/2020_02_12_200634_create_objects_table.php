<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateObjectsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('objects', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->integer('parent_id')->nullable();
            $table->string('name', 200);
            $table->integer('ordering')->nullable();
            $table->integer('_lft')->unsigned()->default(0)->index('_lft');
            $table->integer('_rgt')->unsigned()->default(0)->index('_rgt');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('objects');
    }
}
