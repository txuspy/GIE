<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGrupoInvestigacionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('GrupoInvestigacion', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('user_id');
			$table->text('grupo_eu', 65535);
			$table->text('grupo_es', 65535);
			$table->text('lineasInv_es', 65535);
			$table->text('lineasInv_eu', 65535);
			$table->date('desde')->nullable();
			$table->date('hasta')->nullable();
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
		Schema::drop('GrupoInvestigacion');
	}

}
