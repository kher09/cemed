<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaUsuarios extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('usuarios', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('username',50)->unique();
			$table->string('password');
			$table->string('correo',150);
			$table->integer('role_id');
			$table->boolean('enable');
			$table->boolean('firstlog');
			$table->boolean('forgetpass');
			$table->string('remember_pass');
			$table->string('remember_token');	
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
		Schema::drop('usuarios');
	}

}
