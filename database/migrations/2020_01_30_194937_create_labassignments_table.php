<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLabassignmentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('labassignments', function(Blueprint $table)
		{
			$table->integer('ID', true);
			$table->integer('labID')->index('fkIdx_184');
			$table->integer('studentID')->index('fkIdx_187');
			$table->boolean('status');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('labassignments');
	}

}
