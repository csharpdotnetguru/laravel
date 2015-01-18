<?php

use Illuminate\Database\Migrations\Migration;

class CreateDynChannelTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('dyn_channel', function($table)
		{
			$table->increments('id');
			$table->string('channel')->unique();
            $table->string('name');
            $table->string('subtitle');
            $table->string('icon_path');
            $table->string('description');
            $table->integer('display_order');
            $table->boolean('display');
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
	   Schema::drop('dyn_channel');
	}

}