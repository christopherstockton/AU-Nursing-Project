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
			$table->foreign('personID', 'FK_157')->references('personID')->on('people')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('courseID', 'FK_160')->references('courseID')->on('courses')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('siteID', 'FK_163')->references('siteID')->on('sites')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('personID2', 'FK_303')->references('personID')->on('people')->onUpdate('NO ACTION')->onDelete('NO ACTION');
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
