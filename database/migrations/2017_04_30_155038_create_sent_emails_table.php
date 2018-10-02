<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSentEmailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sent_emails', function($table)
		{
			$table->increments('id');
			$table->string('user_id');
			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); 
			$table->string('packages_id');
			$table->foreign('packages_id')->references('id')->on('packages')->onDelete('cascade'); 
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
		Schema::drop('sent_emails');
	}

}
