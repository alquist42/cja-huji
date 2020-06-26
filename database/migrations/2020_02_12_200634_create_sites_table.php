<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSitesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sites', function (Blueprint $table) {
            $table->integer('id')->default(0)->primary();
            $table->integer('parent_id')->nullable();
            $table->string('name', 300);
            $table->integer('ordering')->nullable();
            $table->string('subproject_tags', 200)->nullable();
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
        Schema::drop('sites');
    }
}
