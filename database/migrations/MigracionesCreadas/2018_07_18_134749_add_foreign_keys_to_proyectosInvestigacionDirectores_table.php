<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToProyectosInvestigacionDirectoresTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('proyectosInvestigacionDirectores', function(Blueprint $table)
		{
			$table->foreign('id_autor', 'proyectosInvestigacionDirectores_ibfk_1')->references('id')->on('autores')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('proyectosInvestigacionDirectores', function(Blueprint $table)
		{
			$table->dropForeign('proyectosInvestigacionDirectores_ibfk_1');
		});
	}

}
