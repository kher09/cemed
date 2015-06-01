<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaUnidades extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('unidades', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('id_silais')->unsigned();
			$table->foreign('id_silais')->references('id')->on('silais')->onDelete('cascade')->onUpdate('cascade');
			$table->string('tipo',60);
			$table->string('nombre',150);
			$table->string('direccion',500)->nullable();
			$table->string('telefono',50)->nullable();
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
		Schema::drop('unidades');
	}

}
