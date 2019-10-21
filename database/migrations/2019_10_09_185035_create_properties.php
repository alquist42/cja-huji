<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Kalnoy\Nestedset\NestedSet;

class CreateProperties extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name', 100);
            $table->string('display', 100);
            $table->string('category', 100);
            $table->string('appliance', 100);

            $table->string('allowed_values', 100);

            $table->boolean('user_clearable');
            $table->boolean('enabled')->default('1');

            $table->string('type', 10)->default('both');
            $table->string('content_type', 10)->default('plain');

            $table->integer('field_number')->default('0');

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
        Schema::dropIfExists('properties');
    }
}
