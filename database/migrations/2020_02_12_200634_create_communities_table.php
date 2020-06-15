<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCommunitiesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('communities', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->integer('parent_id')->nullable();
            $table->string('name', 120)->index('community_name_index');
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
        Schema::drop('communities');
    }
}
