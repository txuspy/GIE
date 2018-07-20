<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTesisDoctoralesDoctorandoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tesisDoctoralesDoctorando', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('id_autor')->index('id_autor');
			$table->integer('id_tesisDoctoral');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tesisDoctoralesDoctorando');
	}

}
