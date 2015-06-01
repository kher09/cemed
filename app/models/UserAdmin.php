<?php

class UserAdmin extends Eloquent {
	
	protected $guarded = array();

	public static $rules = array();

	protected $table = 'usuariosadmin';

	public function User()
    {
        return $this->belongsTo('User', 'id');
    }
}