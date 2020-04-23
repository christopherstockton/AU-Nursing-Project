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
			$table->integer('id', true);
			$table->boolean('section')->nullable();
			$table->integer('courseID')->nullable()->index('fkIdx_160');
			$table->integer('siteID')->nullable()->index('fkIdx_163');
			$table->integer('instructorID')->nullable()->index('fkIdx_157');
			$table->integer('instructorID2')->nullable()->index('fkIdx_303');
			$table->date('startDate');
			$table->date('endDate');
			$table->time('startTime');
			$table->time('endTime');
			$table->string('days', 45);
			$table->boolean('capacity');
			$table->integer('enrolled');
			// Flag: 0 = Clinical, 1 = Lab
			$table->boolean('flag');
			$table->integer('roomNumber')->nullable();
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
