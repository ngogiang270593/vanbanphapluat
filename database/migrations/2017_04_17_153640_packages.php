<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Packages extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
			Schema::create('packages', function($table)
		{
			$table->increments('id');
			$table->string('title');
			$table->string('link');
			$table->string('bidder');	
			$table->string('cate_id');
			$table->foreign('cate_id')->references('cate_id')->on('category')->onDelete('cascade'); 	
			$table->integer('hided');		
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
