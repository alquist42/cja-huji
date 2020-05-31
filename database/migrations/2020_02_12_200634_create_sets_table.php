<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSetsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sets', function(Blueprint $table)
		{
			$table->bigInteger('id', true);
			$table->integer('parent_id')->nullable()->index('parent_id');
			$table->text('name', 65535);
			$table->integer('publish_state');
			$table->string('publish_state_reason', 60)->nullable();
			$table->string('category', 10)->nullable()->index('FK_sets_categories');
			$table->text('ntl', 65535);
			$table->bigInteger('date')->nullable()->index('FK_ija_set_ija_date');
			$table->bigInteger('reconstruction_dates')->nullable()->index('FK_ija_set_ija_date_2');
			$table->bigInteger('activity_dates')->nullable()->index('FK_ija_set_ija_date_3');
			$table->bigInteger('copyright_id')->nullable()->index('FK_ija_set_ija_copyright');
			$table->string('remarks', 200)->nullable();
			$table->text('description');
			$table->text('addenda', 65535)->index('addenda');
			$table->integer('artifact_at_risk');
			$table->float('geo_lat', 10, 6)->nullable();
			$table->float('geo_lng', 10, 6)->nullable();
			$table->string('geo_options', 300)->nullable();
			$table->integer('_lft')->unsigned()->default(0)->index('_lft');
			$table->integer('_rgt')->unsigned()->default(0)->index('_rgt');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('sets');
	}

}
