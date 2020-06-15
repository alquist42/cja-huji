<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateItemsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->string('ija_id', 12);
            $table->bigInteger('set_id')->nullable()->index('item_id');
            $table->integer('ordering');
            $table->boolean('publish_state')->index('publish_state');
            $table->string('publish_state_reason', 60)->nullable();
            $table->string('category', 10)->nullable()->index('FK_items_categories');
            $table->string('ntl', 200)->nullable()->comment('&&&^^&&&');
            $table->bigInteger('date')->nullable()->index('FK_ija_item_ija_date');
            $table->bigInteger('reconstruction_dates')->nullable()->index('FK_ija_item_ija_date_2');
            $table->bigInteger('activity_dates')->nullable()->index('FK_ija_item_ija_date_3');
            $table->bigInteger('copyright_id')->nullable()->index('FK_ija_item_ija_copyright');
            $table->string('remarks', 50)->nullable();
            $table->text('description')->comment('&&&^^&&&');
            $table->text('addenda', 65535);
            $table->string('export_state', 100)->nullable();
            $table->float('geo_lat', 10, 6)->nullable();
            $table->float('geo_lng', 10, 6)->nullable();
            $table->string('geo_options', 300)->nullable();
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('items');
    }
}
