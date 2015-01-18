<?php

use Illuminate\Database\Migrations\Migration;

class CreatePaidUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('paidUsers', function($table) {
			$table->increments('id');
			$table->integer('clientid');
			$table->integer('productid');
			$table->string('productType');
			$table->integer('productLength');
			$table->integer('startTime');
			$table->integer('endTime');
			$table->string('status');
			$table->text('notes');
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
		Schema::drop('paidUsers');
	}

}