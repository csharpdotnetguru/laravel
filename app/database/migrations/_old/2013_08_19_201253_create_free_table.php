<?php

use Illuminate\Database\Migrations\Migration;

class CreateFreeTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('free', function($table) {
			$table->increments('id');
			$table->integer('userid');
			$table->integer('regTime');
			$table->string('trialLength');
			$table->integer('endTime');
			$table->integer('status');
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
		Schema::drop('free');
	}

}