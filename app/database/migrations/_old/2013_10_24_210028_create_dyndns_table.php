<?php

use Illuminate\Database\Migrations\Migration;

class CreateDyndnsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('dyn_dns', function($table) {
			$table->increments('id');
			$table->integer('uid');
			$table->string('hostname');
			$table->integer('nid');
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
		Schema::drop('dyn_dns');
	}

}