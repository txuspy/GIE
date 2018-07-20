<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToGrupoInvestigacionResponsablesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('GrupoInvestigacionResponsables', function(Blueprint $table)
		{
			$table->foreign('id_autor', 'GrupoInvestigacionResponsables_ibfk_1')->references('id')->on('autores')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('GrupoInvestigacionResponsables', function(Blueprint $table)
		{
			$table->dropForeign('GrupoInvestigacionResponsables_ibfk_1');
		});
	}

}
