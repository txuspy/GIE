<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToPostgradosAutoresTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('postgradosAutores', function(Blueprint $table)
		{
			$table->foreign('id_postgrado', 'postgradosAutores_ibfk_2')->references('id')->on('postgrados')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('id_autor', 'postgradosAutores_ibfk_1')->references('id')->on('autores')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('postgradosAutores', function(Blueprint $table)
		{
			$table->dropForeign('postgradosAutores_ibfk_2');
			$table->dropForeign('postgradosAutores_ibfk_1');
		});
	}

}
