<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOriginsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('origins', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->integer('parent_id')->nullable()->index('parent_id');
            $table->string('name', 120);
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
        Schema::drop('origins');
    }
}
