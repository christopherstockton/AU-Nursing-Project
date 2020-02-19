<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToClinicalsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('clinicals', function(Blueprint $table)
		{
			$table->foreign('instructorID', 'FK_157')->references('id')->on('people')->onUpdate('NO ACTION')->onDelete('set null');
			$table->foreign('courseID', 'FK_160')->references('id')->on('courses')->onUpdate('NO ACTION')->onDelete('set null');
			$table->foreign('siteID', 'FK_163')->references('siteID')->on('sites')->onUpdate('NO ACTION')->onDelete('set null');
			$table->foreign('instructorID2', 'FK_303')->references('id')->on('people')->onUpdate('NO ACTION')->onDelete('set null');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('clinicals', function(Blueprint $table)
		{
			$table->dropForeign('FK_157');
			$table->dropForeign('FK_160');
			$table->dropForeign('FK_163');
			$table->dropForeign('FK_303');
		});
	}

}
