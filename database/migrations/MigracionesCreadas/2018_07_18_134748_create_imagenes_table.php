<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateImagenesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('imagenes', function(Blueprint $table)
		{
			$table->integer('id_imagenes', true);
			$table->string('alt_imagenes', 191)->default('');
			$table->string('title_imagenes', 191)->default('');
			$table->string('nom_imagenes', 191)->default('');
			$table->string('tamano_imagenes', 250)->default('');
			$table->string('orden_imagenes', 191)->default('');
			$table->string('posicion_imagenes', 191)->default('');
			$table->dateTime('fecha_imagenes')->nullable();
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('imagenes');
	}

}
