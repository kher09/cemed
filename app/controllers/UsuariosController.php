<?php

class UsuariosController extends \BaseController {

	public function viewLogin(){
		return View::make('usuarios.login');
	}

	public function validateLogin(){
		if($this->validateFormsLogin(Input::all()) === true){
			$userdata = array(
				'username' =>Input::get('username'),
				'password' =>Input::get('password')
				);

			if(Auth::attempt($userdata)){
				if(Auth::user()->enable == 1){
						if(Auth::user()->firstlog == 0){
							if(Auth::user()->forgetpass == 0){
									//Determinando roles
									if(Auth::user()->role_id == 0){
										return Redirect::to('administrador');
									}
									elseif(Auth::user()->role_id == 2){
										return Redirect::to('Silais');
									}
									elseif(Auth::user()->role_id == 3){
										return Redirect::to('Unidad');
									}
								}
							else{
								Session::flash('alerta', 'Error 101 en el usuario "'.Auth::user()->username.'", contacte a un administrador');
								return Redirect::to('login');
							}
						}
						else{
							Session::flash('alerta', 'Error 11X en el usuario "'.Auth::user()->username.'", contacte a un administrador');
							return Redirect::to('login');
						}
				}
				elseif(Auth::user()->enable == 0){
					Session::flash('alerta', 'El usuario "'.Auth::user()->username.'" esta deshabilitado, contacte a un administrador');
					return Redirect::to('login');
				}
				
			}else{
				Session::flash('message', 'Error al iniciar session');
				return Redirect::to('login');
			}
		}else{
			return Redirect::to('login')->withErrors($this->validateFormsLogin(Input::all()))->withInput();		
		}				
	}

	public function getLogout(){
		Auth::logout();
		return Redirect::to('/');
	}

	public function RegistrarUser(){

		$rol=Input::get('rol');

		$rules = array(				
			'username' => 'unique:usuarios,username',
			'correo'=>'required|email',
			'nombre'=>'required',
			'cargo'=>'required'
		);

		$validator = Validator::make(Input::all(), $rules);
		if ($validator->fails())
	    {
	    	Session::flash('alerta', 'Error al registrar usuario');
	        return Redirect::back()->withErrors($validator);
	    }
	    else{
	    		if($rol==0){

					$NewUser= new User();
					$NewUser->username= Input::get('username');
					$NewUser->password=$this->generapass(20);
					$NewUser->correo=Input::get('correo');
					$NewUser->role_id=$rol;
					$NewUser->enable=1;
					$NewUser->firstlog=1;
					$NewUser->forgetpass=0;
					if($NewUser->save()){
						$NewAdmin= new UserAdmin();
						$NewAdmin->id_usuario=$NewUser->id;
						$NewAdmin->nombre=Input::get('nombre');
						$NewAdmin->telefono=Input::get('telefono');
						$NewAdmin->cargo=Input::get('cargo');
						if($NewAdmin->save()){

							$data = array(
							'codigo'=>$this->generapass(25),
							'id' => $NewUser->id,
							'pass' => $NewUser->password,
							'nombre' => $NewAdmin->nombre,
							'username' => $NewUser->username,
							'telefono' => $NewAdmin->telefono,
							'cargo' => $NewAdmin->cargo,
							);

							Mail::send('emails.template', $data, function($message) use ($NewUser){
						    	$message->to($NewUser->correo, 'CEMED')->subject('CEMED - Registro de Usuarios');
							});
							Session::flash('mensaje', 'El Usuario '.$NewAdmin->nombre.' se registro correctamente');
							return Redirect::back();
						}
					}
				}
				elseif($rol==2){
					$NewUser= new User();
					$NewUser->username= Input::get('username');
					$NewUser->password=$this->generapass(20);
					$NewUser->correo=Input::get('correo');
					$NewUser->role_id=$rol;
					$NewUser->enable=1;
					$NewUser->firstlog=1;
					$NewUser->forgetpass=0;
					if($NewUser->save()){
						$NewAdmin= new UserSilais();
						$NewAdmin->id_usuario=$NewUser->id;
						$NewAdmin->id_silais=Input::get('silais');
						$NewAdmin->nombre=Input::get('nombre');
						$NewAdmin->telefono=Input::get('telefono');
						$NewAdmin->cargo=Input::get('cargo');
						if($NewAdmin->save()){

							$data = array(
							'codigo'=>$this->generapass(25),
							'id' => $NewUser->id,
							'pass' => $NewUser->password,
							'nombre' => $NewAdmin->nombre,
							'username' => $NewUser->username,
							'telefono' => $NewAdmin->telefono,
							'cargo' => $NewAdmin->cargo,
							);

							Mail::send('emails.template', $data, function($message) use ($NewUser){
						    	$message->to($NewUser->correo, 'CEMED')->subject('CEMED - Registro de Usuarios');
							});
							Session::flash('mensaje', 'El Usuario '.$NewAdmin->nombre.' se registro correctamente');
							return Redirect::back();
						}
					}
				}
				elseif($rol==3){
					$NewUser= new User();
					$NewUser->username= Input::get('username');
					$NewUser->password=$this->generapass(20);
					$NewUser->correo=Input::get('correo');
					$NewUser->role_id=$rol;
					$NewUser->enable=1;
					$NewUser->firstlog=1;
					$NewUser->forgetpass=0;
					if($NewUser->save()){
						$NewAdmin= new UserUnidad();
						$NewAdmin->id_usuario=$NewUser->id;
						$NewAdmin->id_unidad=Input::get('unidad');
						$NewAdmin->nombre=Input::get('nombre');
						$NewAdmin->telefono=Input::get('telefono');
						$NewAdmin->cargo=Input::get('cargo');
						if($NewAdmin->save()){

							$data = array(
							'codigo'=>$this->generapass(25),
							'id' => $NewUser->id,
							'pass' => $NewUser->password,
							'nombre' => $NewAdmin->nombre,
							'username' => $NewUser->username,
							'telefono' => $NewAdmin->telefono,
							'cargo' => $NewAdmin->cargo,
							);

							Mail::send('emails.template', $data, function($message) use ($NewUser){
						    	$message->to($NewUser->correo, 'CEMED')->subject('CEMED - Registro de Usuarios');
							});
							Session::flash('mensaje', 'El Usuario '.$NewAdmin->nombre.' se registro correctamente');
							return Redirect::back();
						}
					}
				}
	    }		
	}

	public function FirstLogin($numero, $id, $pass){
		$usuario=User::find($id);
		$num=$this->generapass(50);
		$numer=$this->generapass(50);
		if($usuario->password==$pass & $usuario->firstlog==1){
			Session::flash('message', 'Debe registrar una nueva contraseña para iniciar sesion');
			return View::make('usuarios.fisrtlog', array('id' => $id, 'num'=>$num,'numer'=>$numer));
		}
		else{
			Session::flash('message', 'Error en login');
			return Redirect::to('login');
		}
	}
	public function NewPass($numero, $id, $pass){
		$usuario=User::find($id);
		if($usuario->firstlog==1){
			if(Input::get('password')==Input::get('repitpassword')){
				$usuario->firstlog=0;
				$usuario->password=Hash::make(Input::get('password'));
				if($usuario->save()){

					$data = array(
						'pass' => Input::get('password'),
						'username' => $usuario->username,
						);

						Mail::send('emails.newpass', $data, function($message) use ($usuario){
					    	$message->to($usuario->correo, 'CEMED')->subject('CEMED - Contraseña actualizada');
						});
					Session::flash('message', 'Su contraseña ha sido actualizada correctamente, revise su correo para mas informacion');
					return Redirect::to('login');
				}
			}
			else{
				Session::flash('alerta', 'Las Contraseñas deben ser iguales');
				return Redirect::back();
			}
		}
		else{
			Session::flash('message', 'Error en login');
			return Redirect::to('/login');
		}
	}

	public function EditUser($id){

		$AllSilais=Silais::all();

		$Usuario=User::find($id);

		if($Usuario->role_id==0){

			$datos=User::find($id)->UserAdmin()->first();
			return View::make('Admin.Usuarios.edit', array('AllSilais'=>$AllSilais, 'Usuario'=>$Usuario, 'datos'=>$datos));

		}
		if($Usuario->role_id==2){

			$datos=User::find($id)->UserSilais()->first();
			return View::make('Admin.Usuarios.edit', array('AllSilais'=>$AllSilais, 'Usuario'=>$Usuario, 'datos'=>$datos));

		}
		if($Usuario->role_id==3){

			$datos=User::find($id)->UserUnidad()->first();
			return View::make('Admin.Usuarios.edit', array('AllSilais'=>$AllSilais, 'Usuario'=>$Usuario, 'datos'=>$datos));

		}

	}

	public function UpdateUser($id){
		$usuario=User::find($id);
		$NewRol=Input::get('rol');
		if($usuario->role_id==$NewRol){
			if($usuario->role_id==0){
				$usuario->username=Input::get('username');
				$usuario->correo=Input::get('correo');
				if($usuario->save()){
					$Datos=UserAdmin::where('id_usuario',$id)->first();
					$Datos->nombre=Input::get('nombre');
					$Datos->telefono=Input::get('telefono');
					$Datos->cargo=Input::get('cargo');

					if($Datos->save()){
						Session::flash('mensaje', 'Datos del usuario '.$usuario->username.' actualizados correctamente');
						return Redirect::to('administrador/Usuarios');
					}
				}
			}

			if($usuario->role_id==2){
				$usuario->username=Input::get('username');
				$usuario->correo=Input::get('correo');
				if($usuario->save()){
					$Datos=UserSilais::where('id_usuario',$id)->first();
					$Datos->id_silais=Input::get('silais');
					$Datos->nombre=Input::get('nombre');
					$Datos->telefono=Input::get('telefono');
					$Datos->cargo=Input::get('cargo');

					if($Datos->save()){
						Session::flash('mensaje', 'Datos del usuario '.$usuario->username.' actualizados correctamente');
						return Redirect::to('administrador/Usuarios');
					}
				}
			}

			if($usuario->role_id==3){
				$usuario->username=Input::get('username');
				$usuario->correo=Input::get('correo');
				if($usuario->save()){
					$Datos=UserUnidad::where('id_usuario',$id)->first();
					$Datos->id_unidad=Input::get('unidad');
					$Datos->nombre=Input::get('nombre');
					$Datos->telefono=Input::get('telefono');
					$Datos->cargo=Input::get('cargo');

					if($Datos->save()){
						Session::flash('mensaje', 'Datos del usuario '.$usuario->username.' actualizados correctamente');
						return Redirect::to('administrador/Usuarios');
					}
				}
			}
		}
	}

	public function DeleteUser($id){
		$usuario=User::find($id);
		if($usuario->delete()){
			Session::flash('mensaje', 'Usuario eliminado');
			return Redirect::back();
		}
		else{
			Session::flash('alerta', 'Error al eliminar usuario');
			return Redirect::back();
		}
	}

	public function DesactivarUser($id){
		$usuario=User::find($id);
		$usuario->enable=0;
		if($usuario->save()){
			Session::flash('mensaje', 'Usuario deshabilitado');
			return Redirect::back();
		}
		else{
			Session::flash('alerta', 'Error al deshabilitar usuario');
			return Redirect::back();
		}
	}

	public function ActivarUser($id){
		$usuario=User::find($id);
		$usuario->enable=1;
		if($usuario->save()){
			Session::flash('mensaje', 'Usuario habilitado');
			return Redirect::back();
		}
		else{
			Session::flash('alerta', 'Error al habilitar usuario');
			return Redirect::back();
		}
	}

	/**
	 * obtiene los inputs 
	 * @param  array  $inputs
	 * @return [type]
	 */
	private function getInputs($inputs = array()){
		foreach ($inputs as $key => $value) {
			$inputs[$key] = $value;
		}
		return $inputs;
	}
	

	private function validateForms($inputs = array()){
		$rules = array(
			'nombre' => 'required|min:2',
			'username' => 'unique:usuarios|required|min:4',			
			'password' => 'confirmed|required',
			'password_confirmation' => 'required'
			);
		$message = array(
			'required' => 'El campo :attribute es requerido',
			'unique' => 'El :attribute ya esta en uso'
			);
		$validate = Validator::make($inputs, $rules, $message);

		if($validate->fails()){
			return $validate;
		}else{
			return true;
		}
	}

	private function validateFormsLogin($inputs = array()){
		$rules = array(			
			'username' => 'required',			
			'password' => 'required',			
			);
		$message = array(
			'required' => 'El campo :attribute es requerido',			
			);
		$validate = Validator::make($inputs, $rules, $message);

		if($validate->fails()){
			return $validate;
		}else{
			return true;
		}
	}

	private function generapass($length){
		$key = "";
		$caracteres = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
		//aquí podemos incluir incluso caracteres especiales pero cuidado con las ‘ y “ y algunos otros
		$max = strlen($caracteres) - 1;
		for ($i=0;$i<$length;$i++)
		{
			$key .= substr($caracteres, rand(0, $max), 1);
		}
		return $key;
	}


}
