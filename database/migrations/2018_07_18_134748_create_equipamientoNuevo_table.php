<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEquipamientoNuevoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('equipamientoNuevo', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('user_id');
			$table->integer('departamento');
			$table->text('equipo_eu', 65535);
			$table->text('equipo_es', 65535);
			$table->string('institucion');
			$table->string('importe');
			$table->date('data')->nullable();
			$table->timestamps();
			$table->date('deleted_at')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('equipamientoNuevo');
	}

}
