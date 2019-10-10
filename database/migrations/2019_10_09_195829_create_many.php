<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMany extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_origin', function (Blueprint $table) {
            $table->integer('item_id')->unsigned();
            $table->integer('origin_id')->unsigned();
            $table->foreign('item_id')->references('id')->on('items')
                ->onDelete('cascade');
            $table->foreign('origin_id')->references('id')->on('origins')
                ->onDelete('cascade');
        });

        Schema::create('item_subject', function (Blueprint $table) {
            $table->integer('item_id')->unsigned();
            $table->integer('subject_id')->unsigned();
            $table->foreign('item_id')->references('id')->on('items')
                ->onDelete('cascade');
            $table->foreign('subject_id')->references('id')->on('subjects')
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
        Schema::dropIfExists('item_origin');
        Schema::dropIfExists('item_subject');
    }
}
