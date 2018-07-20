<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateVisitasAutoresTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('visitasAutores', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('id_autor')->index('id_autor');
			$table->integer('id_visita')->index('id_visita');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('visitasAutores');
	}

}
