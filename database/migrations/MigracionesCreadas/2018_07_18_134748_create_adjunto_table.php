<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAdjuntoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('adjunto', function(Blueprint $table)
		{
			$table->integer('id_adjunto', true);
			$table->string('nom_adjunto')->default('');
			$table->string('title_adjunto')->nullable();
			$table->string('orden_adjunto')->nullable()->default('');
			$table->dateTime('fecha_adjunto')->nullable();
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
		Schema::drop('adjunto');
	}

}
