<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToClinicalassignmentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('clinicalassignments', function(Blueprint $table)
		{
			$table->foreign('clinicalID', 'FK_178')->references('clinicalID')->on('clinicals')->onUpdate('NO ACTION')->onDelete('cascade');
			$table->foreign('studentID', 'FK_181')->references('studentID')->on('students')->onUpdate('NO ACTION')->onDelete('cascade');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('clinicalassignments', function(Blueprint $table)
		{
			$table->dropForeign('FK_178');
			$table->dropForeign('FK_181');
		});
	}

}
