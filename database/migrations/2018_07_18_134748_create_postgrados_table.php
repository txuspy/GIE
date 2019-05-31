<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePostgradosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('postgrados', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('user_id')->index('user_id');
			$table->string('tipo');
			$table->integer('departamento');
			$table->text('titulo_eu', 65535);
			$table->text('titulo_es', 65535);
			$table->text('curso_eu', 65535);
			$table->text('curso_es', 65535);
			$table->string('duracion');
			$table->text('lugar', 65535);
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
		Schema::drop('postgrados');
	}

}
