<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToCourseAssignmentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('courseAssignments', function(Blueprint $table)
		{
			$table->foreign('studentID', 'FK_001')->references('id')->on('people')->onUpdate('NO ACTION')->onDelete('cascade');
			$table->foreign('courseID', 'FK_002')->references('id')->on('courses')->onUpdate('NO ACTION')->onDelete('cascade');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('courseAssignments', function(Blueprint $table)
		{
			$table->dropForeign('FK_001');
			$table->dropForeign('FK_002');
		});
	}

}
