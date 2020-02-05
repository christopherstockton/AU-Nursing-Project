<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClinicalassignmentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('clinicalassignments', function(Blueprint $table)
		{
			$table->integer('ID', true);
			$table->integer('clinicalID')->index('fkIdx_178');
			$table->integer('studentID')->index('fkIdx_181');
			$table->boolean('status');
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('clinicalassignments');
	}

}
