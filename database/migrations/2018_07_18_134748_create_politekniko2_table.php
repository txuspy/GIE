<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePolitekniko2Table extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('politekniko2', function(Blueprint $table)
		{
			$table->integer('id')->default(0)->primary();
			$table->string('apellidos', 38)->nullable();
			$table->string('nombre', 29)->nullable();
			$table->string('email', 35)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('politekniko2');
	}

}
