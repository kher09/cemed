<?php

class Unidad extends Eloquent {
	
	protected $guarded = array();

	public static $rules = array();

	protected $table = 'unidades';


    //Relacion de Uno a Uno
	public function UserUnidad()
    {
        return $this->hasMany('UserUnidad','id_usuario');
    }

    //Relacion invertida de Uno a Muchos
    public function Silais()
    {
        return $this->belongsTo('Silais','id');
    }
}
