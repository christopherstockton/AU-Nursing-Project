<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToLabassignmentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('labassignments', function(Blueprint $table)
		{
			$table->foreign('labID', 'FK_184')->references('labID')->on('labs')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('studentID', 'FK_187')->references('studentID')->on('students')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('labassignments', function(Blueprint $table)
		{
			$table->dropForeign('FK_184');
			$table->dropForeign('FK_187');
		});
	}

}
