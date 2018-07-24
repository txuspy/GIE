<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToTesisDoctoralesDirectorTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('tesisDoctoralesDirector', function(Blueprint $table)
		{
			$table->foreign('id_autor', 'tesisDoctoralesDirector_ibfk_1')->references('id')->on('autores')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('tesisDoctoralesDirector', function(Blueprint $table)
		{
			$table->dropForeign('tesisDoctoralesDirector_ibfk_1');
		});
	}

}
