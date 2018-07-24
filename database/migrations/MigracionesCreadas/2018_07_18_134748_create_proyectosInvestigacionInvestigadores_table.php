<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProyectosInvestigacionInvestigadoresTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('proyectosInvestigacionInvestigadores', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('id_autor')->index('id_autor');
			$table->integer('id_proyecto');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('proyectosInvestigacionInvestigadores');
	}

}
