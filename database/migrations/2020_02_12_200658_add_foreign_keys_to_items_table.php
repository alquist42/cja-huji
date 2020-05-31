<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToItemsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('items', function(Blueprint $table)
		{
			$table->foreign('copyright_id', 'FK_ija_item_ija_copyright')->references('id')->on('copyright')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('date', 'FK_ija_item_ija_date')->references('id')->on('dates')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('reconstruction_dates', 'FK_ija_item_ija_date_2')->references('id')->on('dates')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('activity_dates', 'FK_ija_item_ija_date_3')->references('id')->on('dates')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('set_id', 'FK_ija_item_ija_set')->references('id')->on('sets')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('category', 'FK_items_categories')->references('slug')->on('categories')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('items', function(Blueprint $table)
		{
			$table->dropForeign('FK_ija_item_ija_copyright');
			$table->dropForeign('FK_ija_item_ija_date');
			$table->dropForeign('FK_ija_item_ija_date_2');
			$table->dropForeign('FK_ija_item_ija_date_3');
			$table->dropForeign('FK_ija_item_ija_set');
			$table->dropForeign('FK_items_categories');
		});
	}

}
