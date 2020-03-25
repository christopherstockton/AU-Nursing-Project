<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCourseAssignmentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('courseAssignments', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('studentID')->index('fkIdx_001');
			$table->integer('courseID')->index('fkIdx_002');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('courseAssignments');
	}

}
