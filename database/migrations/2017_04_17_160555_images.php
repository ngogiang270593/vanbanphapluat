<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Images extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('images', function( $table)
		{
			$table->increments('id');			
			$table->string('src');	
			$table->string('user_id');
			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); 						
			$table->timestamps();
		});
	}
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
