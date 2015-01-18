<?php

use Illuminate\Database\Migrations\Migration;

class CreateFavouriteChannelsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('favourite_channels', function ($table) {
            $table->increments('id');
            $table->integer('channel_id')->unsigned();
            $table->integer('user_id')->unsigned();
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
        Schema::drop('favourite_channels');
    }

}
