<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Kalnoy\Nestedset\NestedSet;

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
            $table->string('item_id', 50)->nullable();
            $table->string('original', 100)->nullable();
            $table->string('big', 100)->nullable();
            $table->string('medium', 100)->nullable();
            $table->string('small', 100)->nullable();
            $table->string('name', 100)->nullable();
            $table->string('description', 100)->nullable();
            $table->string('category', 100)->nullable();
            $table->string('copyright', 100);
            $table->integer('order');
            $table->integer('publish_state');
            NestedSet::columns($table);
            $table->timestamps();
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
