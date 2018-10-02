<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Category extends Migration {
public function up()
	{
			Schema::create('category', function($table)
		{
			$table->increments('id');
			$table->string('cate_id');
			$table->string('cate_name');							
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
