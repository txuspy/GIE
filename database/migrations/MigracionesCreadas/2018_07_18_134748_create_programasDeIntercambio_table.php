<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProgramasDeIntercambioTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('programasDeIntercambio', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('user_id');
			$table->string('tipo');
			$table->string('lugar');
			$table->text('actividad_eu', 65535);
			$table->text('actividad_es', 65535);
			$table->date('desde');
			$table->date('hasta');
			$table->timestamps();
			$table->softDeletes();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('programasDeIntercambio');
	}

}
