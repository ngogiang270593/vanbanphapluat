<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Keywords extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
			Schema::create('keywords', function( $table)
		{
			$table->increments('id');
			$table->string('user_id');
			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); 	
			$table->string('keyword');								
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
		//
	}

}
