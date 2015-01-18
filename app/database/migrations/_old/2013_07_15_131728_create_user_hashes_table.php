<?php

use Illuminate\Database\Migrations\Migration;

class CreateUserHashesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('client_hash', function($table){
			$table->increments('id');
			$table->integer('user_id')->unique();
			$table->string('user_hash');
			$table->integer('api_calls');
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
		Schema::drop('client_hash');
	}

}