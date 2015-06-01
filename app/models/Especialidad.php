<?php

class Especialidad extends Eloquent {
	
	protected $guarded = array();

	public static $rules = array();

	protected $table = 'especialidades';


    //Relacion de Uno a Muchos
	public function Equipo()
    {
        return $this->hasMany('Equipo','id_especialidad');
    }

}
