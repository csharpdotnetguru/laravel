<?php

use Illuminate\Database\Migrations\Migration;

class CreateApiLoginAttemptsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('api_login_attempts', function($table) 
		{
			$table->increments('id');
			$table->string('ip_address');
			$table->unique('ip_address');
			$table->index('ip_address');
			$table->integer('raw_attempts');
			$table->integer('wrong_attempts');
			$table->boolean('block');
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
		Schema::drop('api_login_attempts');
	}

}