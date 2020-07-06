<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ConvertGeoFieldsToDecimal extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sets', function (Blueprint $table) {
            $table->decimal('geo_lat', 10, 6)->change();
            $table->decimal('geo_lng', 10, 6)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sets', function (Blueprint $table) {
            $table->float('geo_lat', 10, 6)->change();
            $table->float('geo_lng', 10, 6)->change();
        });
    }
}
