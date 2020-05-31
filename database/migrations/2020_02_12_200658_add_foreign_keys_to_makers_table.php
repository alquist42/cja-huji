<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToMakersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('makers', function(Blueprint $table)
		{
			$table->foreign('maker_name_id', 'FK_ija_maker_name_profession_ija_maker_name')->references('id')->on('artists')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('maker_profession_id', 'FK_ija_maker_name_profession_ija_maker_profession')->references('id')->on('professions')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('makers', function(Blueprint $table)
		{
			$table->dropForeign('FK_ija_maker_name_profession_ija_maker_name');
			$table->dropForeign('FK_ija_maker_name_profession_ija_maker_profession');
		});
	}

}
