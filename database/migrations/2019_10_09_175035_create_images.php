<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('images', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('item_id')->unsigned();

            $table->text('name')->nullable();
            $table->text('description')->nullable();
            $table->string('category', 100);

            $table->text('addenda')->nullable();
            $table->text('remarks')->nullable();
            $table->text('visual_regions')->nullable();

            $table->string('original', 300)->nullable();
            $table->string('big', 300)->nullable();
            $table->string('medium', 300)->nullable();
            $table->string('small', 300)->nullable();

            $table->integer('publish_state');
            $table->string('publish_state_reason', 50);

            $table->string('nli_pickname', 50);

            $table->integer('copyright_id')->unsigned()->nullable();
            $table->integer('photographer_id')->unsigned()->nullable();

            $table->string('negative_number', 50);

            $table->integer('order');

            $table->timestamps();

            $table->foreign('item_id')->references('id')->on('items');
            $table->foreign('copyright_id')->references('id')->on('copyright');
            $table->foreign('photographer_id')->references('id')->on('photographers');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('images');
    }
}
