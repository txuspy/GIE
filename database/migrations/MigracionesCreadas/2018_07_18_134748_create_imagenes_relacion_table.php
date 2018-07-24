<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateImagenesRelacionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('imagenes_relacion', function(Blueprint $table)
		{
			$table->integer('id_img_rel', true);
			$table->integer('id_imagenes')->nullable()->default(0)->index('id_imagenes');
			$table->string('id_objeto', 191)->default('0');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('imagenes_relacion');
	}

}
