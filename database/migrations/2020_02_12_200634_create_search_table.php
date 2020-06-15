<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSearchTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('search', function (Blueprint $table) {
            $table->integer('id');
            $table->integer('set_id')->nullable()->index('set_id');
            $table->string('type', 5);
            $table->string('category', 10)->nullable()->index('category_k');
            $table->string('title')->nullable()->index('title');
            $table->boolean('publish_state');
            $table->string('projects')->default('');
            $table->text('text', 65535)->nullable()->index('text');
            $table->text('subject', 65535)->nullable()->index('subject');
            $table->text('object', 65535)->nullable()->index('object');
            $table->text('artist', 65535)->nullable()->index('maker');
            $table->text('period', 65535)->nullable()->index('period');
            $table->text('origin', 65535)->nullable()->index('origin');
            $table->text('historical_origin', 65535)->nullable()->index('historical_origin');
            $table->text('school', 65535)->nullable()->index('school');
            $table->text('community', 65535)->nullable()->index('community');
            $table->text('collection', 65535)->nullable()->index('collection');
            $table->text('site', 65535)->nullable()->index('site');
            $table->text('location', 65535)->nullable()->index('location');
            $table->boolean('image')->nullable()->index('image');
            $table->primary(['id','type']);
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('search');
    }
}
