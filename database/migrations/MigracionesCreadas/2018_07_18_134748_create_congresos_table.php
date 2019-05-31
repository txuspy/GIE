<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCongresosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('congresos', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('user_id');
			$table->text('congreso_eu', 65535);
			$table->text('congreso_es', 65535);
			$table->integer('ekarpena');
			$table->string('ekarpena_eu');
			$table->string('ekarpena_es');
			$table->string('conferenciaPoster');
			$table->string('lugar');
			$table->date('desde');
			$table->date('hasta');
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
		Schema::drop('congresos');
	}

}
