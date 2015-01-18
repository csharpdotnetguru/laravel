<?php

use Illuminate\Database\Migrations\Migration;

class CreateChannelAssociation extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('dyn_channel_assoc', function($table)
		{
			$table->increments('id');
			$table->integer('channel_id');
            $table->integer('country_id');
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
        Schema::drop('dyn_channel_assoc');
	}

}