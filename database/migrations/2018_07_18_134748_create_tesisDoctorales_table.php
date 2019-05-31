<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTesisDoctoralesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tesisDoctorales', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('user_id');
			$table->string('tipo');
			$table->text('titulo_es', 65535);
			$table->text('titulo_eu', 65535);
			$table->integer('departamento');
			$table->date('fechaLectura');
			$table->date('curso')->nullable();
			$table->boolean('euskera');
			$table->boolean('internacional');
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
		Schema::drop('tesisDoctorales');
	}

}
