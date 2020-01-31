<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateInstructorsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('instructors', function(Blueprint $table)
		{
			$table->integer('instructorID', true);
			$table->string('firstName', 45)->nullable();
			$table->string('lastName', 45)->nullable();
			$table->string('phoneNumber', 20)->nullable();
			$table->string('emailAddress', 45)->nullable();
			$table->text('notes', 65535)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('instructors');
	}

}
