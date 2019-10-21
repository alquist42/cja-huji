<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImagePeriod extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('image_period', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('image_id')->unsigned();
            $table->integer('period_id')->unsigned();

            $table->string('details', 300)->nullable();

            $table->foreign('image_id')
                ->references('id')
                ->on('images')
                ->onDelete('cascade');

            $table->foreign('period_id')
                ->references('id')
                ->on('periods')
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
        Schema::dropIfExists('image_period');
    }
}
