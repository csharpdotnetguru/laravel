<?php

use Illuminate\Database\Migrations\Migration;

class CreateDynPrefTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('dyn_pref', function($table)
		{
			$table->increments('id');
			$table->integer('user_id');
			$table->integer('country_id');
			$table->integer('channel_id');
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
        Schema::drop('dyn_pref');
	}


}