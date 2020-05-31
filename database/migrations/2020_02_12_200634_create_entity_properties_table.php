<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEntityPropertiesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('entity_properties', function(Blueprint $table)
		{
			$table->bigInteger('id', true);
			$table->bigInteger('property_id')->nullable()->index('prop_meta_id');
			$table->text('value', 65535)->nullable();
			$table->bigInteger('entity_id')->index('entity_id');
			$table->string('entity_type', 10)->index('entity_type');
			$table->boolean('prop_flags');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('entity_properties');
	}

}
