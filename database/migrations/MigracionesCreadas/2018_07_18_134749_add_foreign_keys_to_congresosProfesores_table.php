<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToCongresosProfesoresTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('congresosProfesores', function(Blueprint $table)
		{
			$table->foreign('id_autor', 'congresosProfesores_ibfk_1')->references('id')->on('autores')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('congresosProfesores', function(Blueprint $table)
		{
			$table->dropForeign('congresosProfesores_ibfk_1');
		});
	}

}
