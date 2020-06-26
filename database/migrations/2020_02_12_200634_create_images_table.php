<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateImagesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('images', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->string('date', 20)->nullable();
            $table->string('negative', 50)->nullable();
            $table->bigInteger('photographer_id')->nullable()->index('FK_ija_image_ija_photographer');
            $table->string('copyright_id', 80)->nullable();
            $table->string('batch_url')->nullable()->index('batch_url');
            $table->string('def')->nullable()->index('def');
            $table->string('original')->nullable()->index('original');
            $table->string('big')->nullable();
            $table->string('medium')->nullable()->index('medium');
            $table->string('small')->nullable();
            $table->string('nli_picname', 50)->nullable();
            $table->string('rights', 10)->nullable()->comment('from copyright');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('images');
    }
}
