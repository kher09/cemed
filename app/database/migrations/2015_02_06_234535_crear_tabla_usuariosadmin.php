<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaUsuariosadmin extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('usuariosadmin', function(Blueprint $admin)
		{
			$admin->increments('id');
			$admin->integer('id_usuario')->unsigned();
			$admin->string('nombre',150);
			$admin->string('telefono',50)->nullable();
			$admin->string('cargo',60)->nullable();
			$admin->foreign('id_usuario')->references('id')->on('usuarios')->onDelete('cascade')->onUpdate('cascade');	
			$admin->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('usuariosadmin');
	}

}
