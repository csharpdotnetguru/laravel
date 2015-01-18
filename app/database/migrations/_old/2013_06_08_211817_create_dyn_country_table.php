<?php

use Illuminate\Database\Migrations\Migration;

class CreateDynCountryTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('dyn_country', function($table)
		{
			$table->increments('id');
			$table->string('code')->unique();
            $table->string('name')->unique();
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
	   Schema::drop('dyn_country');
	}

}