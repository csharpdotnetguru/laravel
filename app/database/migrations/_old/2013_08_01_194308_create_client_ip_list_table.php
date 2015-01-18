<?php

use Illuminate\Database\Migrations\Migration;

class CreateClientIpListTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('client_ip_list', function($table)
		{
			$table->increments('id');
			$table->integer('user_id');
            $table->string('client_ip');
            $table->string('ip_label');
            $table->boolean('ip_status');
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
		Schema::drop('client_ip_list');
	}

}