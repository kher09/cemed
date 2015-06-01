<?php

class UserUnidad extends Eloquent {
	
	protected $guarded = array();

	public static $rules = array();

	protected $table = 'usuariounidades';


    //Relacion Invertida de Uno a Uno
	public function User()
    {
        return $this->belongsTo('User', 'id');
    }

    public function Unidad()
    {
        return $this->belongsTo('Unidad', 'id');
    }
}
