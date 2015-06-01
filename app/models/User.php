<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'usuarios';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');

	//Relacion de Uno a Uno
	public function UserAdmin()
    {
        return $this->hasOne('UserAdmin','id_usuario');
    }

    public function UserSilais()
    {
        return $this->hasOne('UserSilais','id_usuario');
    }

    public function UserUnidad()
    {
        return $this->hasOne('UserUnidad','id_usuario');
    }
}
