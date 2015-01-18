<?php

use Illuminate\Database\Migrations\Migration;

class CreateNetworksTable extends Migration {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('client_ip_list', function($table) {
			$table->increments('id');
			$table->integer('user_id');
			$table->boolean('ip_status');
			$table->string('client_ip');
			$table->string('ip_label');
			$table->timestamps();
		});
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('client_ip_list');
	}

}