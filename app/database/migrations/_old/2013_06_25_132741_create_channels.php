<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChannels extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('channels', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('image_url');
            $table->string('channel_url');
            $table->text('description');
            $table->string('type');
            $table->smallInteger('display');
            $table->string('competitor');
            $table->string('premium');
            $table->string('gold');
            $table->integer('display_order');
            $table->integer('column_diplay');
            $table->string('name');
            $table->text('comment');
            $table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('channels');
	}

}
