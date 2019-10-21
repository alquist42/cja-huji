<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemOrigin extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_origin', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('item_id')->unsigned();
            $table->integer('origin_id')->unsigned();

            $table->string('details', 300)->nullable();

            $table->foreign('item_id')
                ->references('id')
                ->on('items')
                ->onDelete('cascade');

            $table->foreign('origin_id')
                ->references('id')
                ->on('origins')
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
    }
}
