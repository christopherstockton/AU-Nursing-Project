<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLabsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('labs', function(Blueprint $table)
		{
			$table->integer('labID', true);
			$table->integer('courseID')->index('fkIdx_175');
			$table->integer('startTime');
			$table->integer('endTime');
			$table->string('days', 45);
			$table->boolean('capacity');
			$table->string('roomNumber', 20);
			$table->integer('instructorID')->index('fkIdx_169');
			$table->integer('instructorID2')->nullable()->index('fkIdx_172');
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
		Schema::drop('labs');
	}

}
