<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToVisitasAutoresTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('visitasAutores', function(Blueprint $table)
		{
			$table->foreign('id_visita', 'visitasAutores_ibfk_2')->references('id')->on('visitasAutores')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('id_autor', 'visitasAutores_ibfk_1')->references('id')->on('autores')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('visitasAutores', function(Blueprint $table)
		{
			$table->dropForeign('visitasAutores_ibfk_2');
			$table->dropForeign('visitasAutores_ibfk_1');
		});
	}

}
