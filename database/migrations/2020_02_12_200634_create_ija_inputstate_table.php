<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateIjaInputstateTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ija_inputstate', function(Blueprint $table)
		{
			$table->bigInteger('id', true);
			$table->string('batch', 6);
			$table->integer('num');
			$table->integer('state');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('ija_inputstate');
	}

}
