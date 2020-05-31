<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMakersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('makers', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->bigInteger('maker_name_id')->nullable();
			$table->bigInteger('maker_profession_id')->nullable()->index('FK_ija_maker_name_profession_ija_maker_profession');
			$table->unique(['maker_name_id','maker_profession_id'], 'maker_name_id_maker_profession_id');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('makers');
	}

}
