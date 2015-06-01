<?php

class Equipo extends Eloquent {
	
	protected $guarded = array();

	public static $rules = array();

	protected $table = 'equipos';


    //Relacion invertida de Uno a Muchos
    public function Unidad()
    {
        return $this->belongsTo('Unidad','id');
    }

    public function Especialidad()
    {
        return $this->belongsTo('Especialidad','id');
    }
}
