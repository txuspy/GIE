<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToProgramasDeIntercambiosProfesoresTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('programasDeIntercambiosProfesores', function(Blueprint $table)
		{
			$table->foreign('id_autor', 'programasDeIntercambiosProfesores_ibfk_1')->references('id')->on('autores')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('programasDeIntercambiosProfesores', function(Blueprint $table)
		{
			$table->dropForeign('programasDeIntercambiosProfesores_ibfk_1');
		});
	}

}
