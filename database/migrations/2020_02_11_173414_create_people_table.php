<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePeopleTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('people', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('firstName', 45)->nullable();
			$table->string('lastName', 45)->nullable();
			$table->string('phoneNumber', 20)->nullable();
			$table->string('emailAddress', 45)->nullable();
			$table->text('notes', 65535)->nullable();
			$table->boolean('flag');
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
		Schema::drop('people');
	}

}
