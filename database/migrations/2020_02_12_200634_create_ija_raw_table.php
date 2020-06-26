<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateIjaRawTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ija_raw', function (Blueprint $table) {
            $table->bigInteger('id', true)->unsigned();
            $table->string('ija_id', 8);
            $table->bigInteger('obj_id')->nullable();
            $table->string('subj');
            $table->text('ntl', 65535);
            $table->string('obj');
            $table->string('maker_name');
            $table->string('maker');
            $table->string('date', 20);
            $table->string('period');
            $table->string('origin');
            $table->string('school');
            $table->string('community');
            $table->string('col_name');
            $table->text('col_detail', 65535);
            $table->string('location');
            $table->string('site');
            $table->string('copyright');
            $table->text('photographer', 65535);
            $table->string('photo_date', 20);
            $table->text('photo_preview', 65535);
            $table->text('descr');
            $table->text('addenda');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('ija_raw');
    }
}
