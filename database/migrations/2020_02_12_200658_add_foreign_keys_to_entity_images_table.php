<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToEntityImagesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('entity_images', function (Blueprint $table) {
            $table->foreign('image_id', 'FK_ija_image_x_entity_ija_image')->references('id')->on('images')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('entity_images', function (Blueprint $table) {
            $table->dropForeign('FK_ija_image_x_entity_ija_image');
        });
    }
}
