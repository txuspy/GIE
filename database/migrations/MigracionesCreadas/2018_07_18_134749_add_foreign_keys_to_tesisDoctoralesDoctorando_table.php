<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToTesisDoctoralesDoctorandoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('tesisDoctoralesDoctorando', function(Blueprint $table)
		{
			$table->foreign('id_autor', 'tesisDoctoralesDoctorando_ibfk_1')->references('id')->on('autores')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('tesisDoctoralesDoctorando', function(Blueprint $table)
		{
			$table->dropForeign('tesisDoctoralesDoctorando_ibfk_1');
		});
	}

}
