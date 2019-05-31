<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('ldap');
			$table->string('name')->nullable();
			$table->string('lname')->nullable();
			$table->string('email')->unique();
			$table->string('password');
			$table->boolean('estado')->default(1);
			$table->integer('id_autor')->index('id_autor');
			$table->string('lng', 2)->default('es');
			$table->string('remember_token', 100)->nullable();
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
		Schema::drop('users');
	}

}
