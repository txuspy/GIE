<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToGrupoInvestigacionParticipantesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('GrupoInvestigacionParticipantes', function(Blueprint $table)
		{
			$table->foreign('id_autor', 'GrupoInvestigacionParticipantes_ibfk_1')->references('id')->on('autores')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('GrupoInvestigacionParticipantes', function(Blueprint $table)
		{
			$table->dropForeign('GrupoInvestigacionParticipantes_ibfk_1');
		});
	}

}
