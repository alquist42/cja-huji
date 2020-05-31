<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateIjaGeneralTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ija_general', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('name', 50);
			$table->text('description', 65535);
			$table->string('pass', 100);
			$table->string('SID', 1000);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('ija_general');
	}

}
