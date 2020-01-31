<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToLabsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('labs', function(Blueprint $table)
		{
			$table->foreign('instructorID', 'FK_169')->references('instructorID')->on('instructors')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('instructorID2', 'FK_172')->references('instructorID')->on('instructors')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('courseID', 'FK_175')->references('courseID')->on('courses')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('labs', function(Blueprint $table)
		{
			$table->dropForeign('FK_169');
			$table->dropForeign('FK_172');
			$table->dropForeign('FK_175');
		});
	}

}
