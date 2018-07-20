<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAdjuntoRelacionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('adjunto_relacion', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('id_adjunto')->default(0);
			$table->string('id_objeto')->default('0');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('adjunto_relacion');
	}

}
