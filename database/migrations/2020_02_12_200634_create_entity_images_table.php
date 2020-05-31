<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEntityImagesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('entity_images', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->bigInteger('image_id')->nullable()->index('FK_ija_image_x_entity_ija_image');
			$table->bigInteger('entity_id')->nullable()->index('entity_id');
			$table->enum('entity_type', array('set','item'))->nullable()->index('entity_type');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('entity_images');
	}

}
