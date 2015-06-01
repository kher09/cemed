<?php

class UserSilais extends Eloquent {
	
	protected $guarded = array();

	public static $rules = array();

	protected $table = 'usuariossilais';


    //Relacion Invertida de Uno a Uno
	public function User()
    {
        return $this->belongsTo('User', 'id');
    }

    public function Silais()
    {
        return $this->belongsTo('Silais', 'id');
    }
}
