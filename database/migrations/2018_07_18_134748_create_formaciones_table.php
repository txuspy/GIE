<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFormacionesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('formaciones', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('user_id');
			$table->string('tipo');
			$table->string('modo');
			$table->text('titulo_eu', 65535);
			$table->text('titulo_es', 65535);
			$table->string('organizador_eu');
			$table->string('organizador_es');
			$table->string('lugar');
			$table->string('duracion');
			$table->date('fecha');
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
		Schema::drop('formaciones');
	}

}
