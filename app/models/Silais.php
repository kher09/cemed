<?php

class Silais extends Eloquent {
	
	protected $guarded = array();

	public static $rules = array();

	protected $table = 'silais';

    //Relacion de Uno a Muchos
	public function Unidad()
    {
        return $this->hasMany('Unidad','id_unidad');
    }

    public function UserSilais()
    {
        return $this->hasMany('UserSilais','id_silais');
    }
}
