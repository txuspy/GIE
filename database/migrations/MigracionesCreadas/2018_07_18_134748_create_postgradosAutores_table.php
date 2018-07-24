<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePostgradosAutoresTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('postgradosAutores', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('id_autor')->index('id_autor_3');
			$table->integer('id_postgrado')->index('id_postgrado_2');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('postgradosAutores');
	}

}
