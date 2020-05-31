<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToEntityPropertiesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('entity_properties', function(Blueprint $table)
		{
			$table->foreign('property_id', 'entity_properties_ibfk_1')->references('id')->on('properties')->onUpdate('CASCADE')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('entity_properties', function(Blueprint $table)
		{
			$table->dropForeign('entity_properties_ibfk_1');
		});
	}

}
