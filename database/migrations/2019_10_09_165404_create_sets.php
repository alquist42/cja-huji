<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Kalnoy\Nestedset\NestedSet;

class CreateSets extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sets', function (Blueprint $table) {
            $table->increments('id');

            $table->text('name');
            $table->text('description')->nullable();
            $table->text('short_description')->nullable();
            $table->text('addenda')->nullable();

            $table->string('category', 30)->nullable();

            $table->float('lat')->nullable();
            $table->float('lon')->nullable();
            $table->string('geo_options', 50);

            $table->integer('order')->nullable();

            $table->integer('publish_state');
            $table->string('publish_state_reason', 50);

            $table->integer('artifact_at_risk');
            $table->string('parental_state', 50);

            $table->text('ntl');
            $table->string('ntl_localname', 50);

            $table->text('remarks')->nullable();

            $table->integer('image_id')->unsigned();

            NestedSet::columns($table);
            $table->timestamps();

            $table->foreign('image_id')->references('id')->on('images');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sets');
    }
}
