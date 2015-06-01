<?php

class AdminController extends \BaseController {

	public function ShowUsers(){
		$admins=User::where('role_id','=','0')->get();
		$Usercemed=User::where('role_id','=','1')->get();
		$Usersilais=User::where('role_id','=','2')->get();
		$Userunidad=User::where('role_id','=','3')->get();

		$Silais=Silais::all();

		return View::make('Admin.Usuarios.General',array('admins'=>$admins, 'Usercemed'=>$Usercemed, 'Usersilais'=>$Usersilais, 'Userunidad'=>$Userunidad, 'Silais'=>$Silais));
	}
	public function AddUser(){
		$pass=$this->generapass(20);

		return View::make('Admin.Usuarios.add',array('pass' => $pass ));
	}

	/* SILAIS */
	public function ShowSilais(){
		$silais=Silais::all();
		$unidad=Unidad::all();

		return View::make('Admin.Silais.show', array('silais'=>$silais, 'unidad'=>$unidad));
	}

	public function AddSilais(){
		$rules = array(
			'nombre'=>'required'
		);

		$validator = Validator::make(Input::all(), $rules);
		if ($validator->fails())
	    {
	    	Session::flash('alerta', 'Error al registrar silais');
	        return Redirect::back()->withErrors($validator);
	    }
	    else{
	    	$silais= new Silais();
			$silais->nombre=Input::get('nombre');
			$silais->departamento=Input::get('depto');
			if($silais->save()){
				Session::flash('mensaje', $silais->nombre.' agregado correctamente');
				return Redirect::back();
			}
	    }
	}


	/* UNIDAD */
	public function AddUnidad(){
		$rules = array(
			'nombre'=>'required',
			'direccion'=>'required',
			'telefono'=>'required'
		);

		$validator = Validator::make(Input::all(), $rules);
		if ($validator->fails())
	    {
	    	Session::flash('alerta', 'Error al registrar unidad');
	        return Redirect::back()->withErrors($validator);
	    }
	    else{
	    	$unidad= new Unidad();
			$unidad->id_silais=Input::get('silais');
			$unidad->nombre=Input::get('nombre');
			$unidad->tipo=Input::get('tipo');
			$unidad->direccion=Input::get('direccion');
			$unidad->telefono=Input::get('telefono');
			if($unidad->save()){
				Session::flash('mensaje', $unidad->tipo.' '.$unidad->nombre.' agregado correctamente');
				return Redirect::back();
			}
	    }
	}

	public function CargarUnidades(){
		$unidades =Input::get('silais');
		$datos=Unidad::where('id_silais',$unidades)->get();
	
		return Response::json( array(
			'datos' => $datos,
			));
	}

	public function EditUnidad($Nombre, $id){
		$Unidad = Unidad::find($id);

		$silais = Silais::all();

		if($Unidad->nombre==$Nombre){
			return View::make('Admin.Silais.edit',array('Unidad'=>$Unidad, 'silais'=>$silais));
		}
		else{
			return Redirect::to('/administrador/Silais');
		}
	}

	public function UpdateUnidad($id){
		$Unidad = Unidad::find($id);

		$rules = array(
			'nombre'=>'required',
			'direccion'=>'required',
			'telefono'=>'required'
		);

		$validator = Validator::make(Input::all(), $rules);
		if ($validator->fails())
	    {
	    	Session::flash('alerta', 'Error al actualizar la unidad');
	        return Redirect::back()->withErrors($validator);
	    }
	    else{

	    	$Unidad->id_silais=Input::get('silais');
	    	$Unidad->tipo=Input::get('tipo');
	    	$Unidad->nombre=Input::get('nombre');
	    	$Unidad->direccion=Input::get('direccion');
	    	$Unidad->telefono=Input::get('telefono');
	    	if($Unidad->save()){
	    		Session::flash('mensaje', 'Informacion de la unidad '.$Unidad->tipo.' '.$Unidad->nombre.' actualizada correctamente');
	    		return Redirect::to('/administrador/Silais');
	    	}
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
