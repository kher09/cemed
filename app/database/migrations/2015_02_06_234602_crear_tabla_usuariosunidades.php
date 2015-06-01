<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaUsuariosunidades extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('usuariounidades', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('id_usuario')->unsigned();
			$table->integer('id_unidad')->unsigned();
			$table->foreign('id_usuario')->references('id')->on('usuarios')->onDelete('cascade')->onUpdate('cascade');
			$table->foreign('id_unidad')->references('id')->on('unidades')->onDelete('cascade')->onUpdate('cascade');
			$table->string('nombre',150);
			$table->string('telefono',50)->nullable();
			$table->string('cargo',60)->nullable();	
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
		Schema::drop('usuariounidades');
	}

}
