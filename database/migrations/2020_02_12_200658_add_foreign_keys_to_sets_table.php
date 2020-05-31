<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToSetsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('sets', function(Blueprint $table)
		{
			$table->foreign('copyright_id', 'FK_ija_set_ija_copyright')->references('id')->on('copyright')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('date', 'FK_ija_set_ija_date')->references('id')->on('dates')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('reconstruction_dates', 'FK_ija_set_ija_date_2')->references('id')->on('dates')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('activity_dates', 'FK_ija_set_ija_date_3')->references('id')->on('dates')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('category', 'FK_sets_categories')->references('slug')->on('categories')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('sets', function(Blueprint $table)
		{
			$table->dropForeign('FK_ija_set_ija_copyright');
			$table->dropForeign('FK_ija_set_ija_date');
			$table->dropForeign('FK_ija_set_ija_date_2');
			$table->dropForeign('FK_ija_set_ija_date_3');
			$table->dropForeign('FK_sets_categories');
		});
	}

}
