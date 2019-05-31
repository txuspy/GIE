<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToPublicacionesAutoresTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('publicacionesAutores', function(Blueprint $table)
		{
			$table->foreign('id_publicacion', 'publicacionesAutores_ibfk_2')->references('id')->on('publicaciones')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('id_autor', 'publicacionesAutores_ibfk_1')->references('id')->on('autores')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('publicacionesAutores', function(Blueprint $table)
		{
			$table->dropForeign('publicacionesAutores_ibfk_2');
			$table->dropForeign('publicacionesAutores_ibfk_1');
		});
	}

}
