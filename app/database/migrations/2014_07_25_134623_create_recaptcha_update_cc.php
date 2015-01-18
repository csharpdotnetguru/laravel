<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecaptchaUpdateCc extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('recaptcha_update_cc', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('uid');
			$table->string('ip');
			$table->timestamps();
		});	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('recaptcha_update_cc');
	}

}
