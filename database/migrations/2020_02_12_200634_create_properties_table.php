<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePropertiesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->string('verbose_name', 400);
            $table->string('categ_name', 250);
            $table->string('prop_name', 250);
            $table->string('appliance', 10)->default('both');
            $table->string('type', 10)->default('text');
            $table->text('allowed_vals', 65535)->nullable();
            $table->boolean('user_clearable')->default(0);
            $table->string('content_type', 10)->default('plain');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('properties');
    }
}
