<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToAssignmentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('assignments', function(Blueprint $table)
		{
			$table->foreign('studentID', 'FK_298')->references('instructorID')->on('people')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('clinicalID', 'FK_306')->references('clinicalID')->on('clinicals')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('assignments', function(Blueprint $table)
		{
			$table->dropForeign('FK_298');
			$table->dropForeign('FK_306');
		});
	}

}
