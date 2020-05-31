<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTaxomonyDetailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('taxomony_details', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('taxonomy_type', 50)->nullable();
			$table->bigInteger('entity_id')->nullable()->index('entity_id');
			$table->enum('entity_type', array('set','item','image'))->nullable();
			$table->text('details', 65535)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('taxomony_details');
	}

}
