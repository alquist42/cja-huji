<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateIjaOverpoweredTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ija_overpowered', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->bigInteger('entity_id')->default(0)->index('entity_id');
			$table->enum('entity_type', array('set','item','image'))->index('entity_type');
			$table->string('field', 50)->index('field');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('ija_overpowered');
	}

}
