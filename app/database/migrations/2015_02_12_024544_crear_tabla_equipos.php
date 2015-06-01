<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaEquipos extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('equipos', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('serie');
			$table->integer('id_especialidad')->unsigned();
			$table->integer('id_unidad')->unsigned();
			$table->foreign('id_especialidad')->references('id')->on('especialidades')->onDelete('cascade')->onUpdate('cascade');
			$table->foreign('id_unidad')->references('id')->on('unidades')->onDelete('cascade')->onUpdate('cascade');
			$table->string('marca',150);
			$table->string('modelo',50);
			$table->boolean('donacion');
			$table->string('costo',60);
			$table->string('donante',250)->nullable();
			$table->string('fabricante',100)->nullable();
			$table->string('casacomercial',100)->nullable();
			$table->date('fechainstalacion');
			$table->date('ultimomantenimiento')->nullable();
			$table->date('proximomantenimiento');
			$table->date('vidautil');
			$table->date('garantia');
			$table->string('estado');
			$table->string('manual')->nullable();
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
		//
	}

}
