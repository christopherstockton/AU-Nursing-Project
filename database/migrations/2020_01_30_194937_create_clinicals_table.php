<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClinicalsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('clinicals', function(Blueprint $table)
		{
			$table->integer('clinicalID', true);
			$table->integer('courseID')->index('fkIdx_160');
			$table->integer('siteID')->index('fkIdx_163');
			$table->integer('instructorID')->index('fkIdx_157');
			$table->date('startDate');
			$table->date('endDate');
			$table->integer('startTime');
			$table->integer('endTime');
			$table->string('days', 45);
			$table->boolean('capacity');
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
		Schema::drop('clinicals');
	}

}
