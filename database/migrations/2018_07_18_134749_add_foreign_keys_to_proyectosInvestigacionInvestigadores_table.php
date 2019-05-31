<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToProyectosInvestigacionInvestigadoresTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('proyectosInvestigacionInvestigadores', function(Blueprint $table)
		{
			$table->foreign('id_autor', 'proyectosInvestigacionInvestigadores_ibfk_1')->references('id')->on('autores')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('proyectosInvestigacionInvestigadores', function(Blueprint $table)
		{
			$table->dropForeign('proyectosInvestigacionInvestigadores_ibfk_1');
		});
	}

}
