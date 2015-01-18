<?php

use Illuminate\Database\Migrations\Migration;

class CreateUserTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tblclients', function($table)
		{
            $table->increments('id');
			$table->string('firstname');
			$table->text('lastname');
			//$table->text('companyname');
			$table->string('email')->unique();
			//$table->text('address1');
			//$table->text('address2');
			//$table->text('city');
			//$table->text('state');
			//$table->text('postcode');
			//$table->text('country');
			//$table->text('phonenumber');
			$table->text('password');
			//$table->integer('currency');
			//$table->text('defaultgateway');
			//$table->decimal('credit');
			//$table->text('taxexempt');
			//$table->text('latefeeoveride');
			//$table->text('overideduenotices');
			//$table->text('separateinvoices');
			//$table->text('disableautocc');
			//$table->date('datecreated');
			//$table->text('notes');
			//$table->integer('billingcid');
			//$table->integer('securityqid');
			//$table->text('securityqans');
			//$table->integer('groupid');
			//$table->string('cardtype');
			//$table->text('cardlastfour');
			//$table->binary('cardnum');
			//$table->binary('startdate');
			//$table->binary('expdate');
			//$table->binary('issuenumber');
			//$table->text('bankname');
			//$table->text('banktype');
			//$table->binary('bankcode');
			//$table->binary('bankacct');
			//$table->text('gatewayid');
			//$table->date('lastlogin');
			//$table->text('ip');
			//$table->text('host');
			//$table->enum('status', array('active', 'inactive'));
			//$table->text('language');
			//$table->text('pwresetkey');
			//$table->integer('pwresetexpiry');
			//$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tblclients');
	}

}