<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePolitekniko1Table extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('politekniko1', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('user', 20)->nullable();
			$table->string('apellidos', 37)->nullable();
			$table->string('nombre', 29)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('politekniko1');
	}

}
