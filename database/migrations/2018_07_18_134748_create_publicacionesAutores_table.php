<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePublicacionesAutoresTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('publicacionesAutores', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('id_autor')->index('id_autor_2');
			$table->integer('id_publicacion')->index('id_publicacion');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('publicacionesAutores');
	}

}
