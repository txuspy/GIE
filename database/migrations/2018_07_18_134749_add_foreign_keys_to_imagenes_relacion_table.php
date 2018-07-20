<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToImagenesRelacionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('imagenes_relacion', function(Blueprint $table)
		{
			$table->foreign('id_imagenes', 'imagenes_relacion_ibfk_1')->references('id_imagenes')->on('imagenes')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('imagenes_relacion', function(Blueprint $table)
		{
			$table->dropForeign('imagenes_relacion_ibfk_1');
		});
	}

}
