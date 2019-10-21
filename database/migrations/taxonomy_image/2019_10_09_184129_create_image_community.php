<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImageCommunity extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('image_community', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('image_id')->unsigned();
            $table->integer('community_id')->unsigned();

            $table->string('details', 300)->nullable();

            $table->foreign('image_id')
                ->references('id')
                ->on('images')
                ->onDelete('cascade');

            $table->foreign('community_id')
                ->references('id')
                ->on('communities')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('image_community');
    }
}
