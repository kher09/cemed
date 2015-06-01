<?php

class EquiposController extends \BaseController {

	public function AddView(){
		$Equipos=Equipo::all();

		$EspecialidadMedica=Especialidad::where('tipo','0')->lists('nombre','id');

		$EspecialidadNoMedica=Especialidad::where('tipo','1')->lists('nombre','id');

		$SilaisAll=Silais::lists('nombre','id');

		return View::make('Admin.Equipos.Add', array('Equipos'=>$Equipos, 'SilaisAll'=>$SilaisAll,
						'EspecialidadMedica'=>$EspecialidadMedica, 'EspecialidadNoMedica'=>$EspecialidadNoMedica));
	}

	public function AddEquipos(){
		$rules = array(
			'unidad'=>'required',
			'serie'=>'unique:equipos,serie',
			'marca'=>'required|min:3|max:150',
			'modelo'=>'required|min:3|max:50',
			'costo'=>'max:60',
			'fabricante'=>'min:3|max:100',
			'casacomercial'=>'min:3|max:100',
			'fechainstalacion'=>'required|before:proximomant|before:garantia',
			'ultimomant'=>'before:proximomant',
			'proximomant'=>'required',
			'garantia'=>'required',
			'vidautil'=>'required',
			'archivo'=>'mimes:pdf|max:5000'
			);

		$errores = array(
			'required'=>'El campo :attribute no puede estar vacio',
			'unique'=>'El campo :attribute ya existe, revise el numero de serie del equipo',
			'min'=>'El campo :attribute no puede tener menos de :min caracteres',
			'max'=>'El campo :attribute no puede tener mas de :max caracteres',
			'archivo.max'=>'El campo :attribute no puede tener mas de :max Kb',
			'mimes'=>'El archivo tiene que estar en formato PDF',
			'before'=>'La fecha de instalacion del equipo no puede ser despues del proximo o ultimo mantenimiento'
			);

	    $validator = Validator::make(Input::all(), $rules, $errores);

	    if ($validator->fails())
	    {	Session::flash('alerta','Error al registrar el equipo');
	        return Redirect::back()->withErrors($validator)->withInput();
	    }
	    else{
	    	if(Input::hasFile('archivo')) {
	    		$codigo1=$this->codigo(10);
	    		$codigo2=$this->codigo(10);
			    Input::file('archivo')->move('manuales/'.date('j-n-y').'-'.$codigo1.'-'.$codigo2.'-'.Input::file("archivo")->getClientOriginalName());
			    $file = date('j-n-y').'-'.$codigo1.'-'.$codigo2.'-'.Input::file("archivo")->getClientOriginalName();
		     }
		     else{
		     	$file="vacio";
		     }
	    	$NewEquipo=new Equipo();
	    	$NewEquipo->serie=Input::get('serie');
	    	if(Input::get('tipoEquipo')==0){
	    		$NewEquipo->id_especialidad=Input::get('EspecialidadMedica');
	    	}
	    	else{
	    		$NewEquipo->id_especialidad=Input::get('EspecialidadNoMedica');
	    	}
	    	$NewEquipo->id_unidad=Input::get('unidad');
	    	$NewEquipo->marca=Input::get('marca');
	    	$NewEquipo->modelo=Input::get('modelo');
	    	if(Input::get('donacion')==false){
	    		$NewEquipo->costo=Input::get('costo');
	    		$NewEquipo->fabricante=Input::get('fabricante');
	    		$NewEquipo->donacion=false;
	    	}
	    	else{
	    		$NewEquipo->costo="Equipo donado";
	    		$NewEquipo->donacion=true;
	    		$NewEquipo->donante=Input::get('donante');
	    	}
	    	$NewEquipo->casacomercial=Input::get('casacomercial');
	    	$NewEquipo->fechainstalacion=date('Y/m/d', strtotime(Input::get('fechainstalacion')));
	    	if(Input::get('ultimomant')!=""){
	    		$NewEquipo->ultimomantenimiento=date('Y/m/d', strtotime(Input::get('ultimomant')));
	    	}
	    	$NewEquipo->proximomantenimiento=date('Y/m/d', strtotime(Input::get('proximomant')));
	    	$NewEquipo->garantia=date('Y/m/d', strtotime(Input::get('garantia')));
	    	
	    	$fechains=date('Y/m/d', strtotime(Input::get('fechainstalacion')));
	    	if(Input::get('tiempo')==0){
	    		$fechautilidad = strtotime ( '+'.Input::get('vidautil').' month' , strtotime ( $fechains ) ) ;
	    		$NewEquipo->vidautil=date('Y/m/d', $fechautilidad);
	    	}
	    	else{
	    		$fechautilidad = strtotime ( '+'.Input::get('vidautil').' year' , strtotime ($fechains ) ) ;
	    		$NewEquipo->vidautil=date('Y/m/d', $fechautilidad);
	    	}
	    	$NewEquipo->estado=Input::get('EstadoEquipo');
	    	$NewEquipo->manual=$file;
	    	if($NewEquipo->save()){
	    		Session::flash('mensaje','Equipo '.$NewEquipo->modelo.' - '.$NewEquipo->marca.' se registro correctamente');
	        	return Redirect::to('/administrador/Equipos/Show');
	    	}
	    }

	}

	public function AddEquiposSilais(){
		$rules = array(
			'serie'=>'unique:equipos,serie',
			'marca'=>'required|min:3|max:150',
			'modelo'=>'required|min:3|max:50',
			'costo'=>'required|max:60',
			'fabricante'=>'required|min:3|max:100',
			'casacomercial'=>'required|min:3|max:100',
			'fechainstalacion'=>'required',
			'proximomant'=>'required',
			'archivo'=>'mimes:pdf|max:5000'
			);

		$errores = array(
			'required'=>'El campo :attribute no puede estar vacio',
			'unique'=>'El campo :attribute ya existe, revise el numero de serie del equipo',
			'min'=>'El campo :attribute no puede tener menos de :min caracteres',
			'max'=>'El campo :attribute no puede tener mas de :max caracteres',
			'archivo.max'=>'El campo :attribute no puede tener mas de :max Kb',
			'mimes'=>'El archivo tiene que estar en formato PDF'
			);

	    $validator = Validator::make(Input::all(), $rules, $errores);

	    if ($validator->fails())
	    {	Session::flash('alerta','Error al registrar el equipo');
	        return Redirect::back()->withErrors($validator)->withInput();
	    }
	    else{
	    	if(Input::hasFile('archivo')) {
	    		$codigo1=$this->codigo(10);
	    		$codigo2=$this->codigo(10);
			    Input::file('archivo')->move('manuales/'.date('j-n-y').'-'.$codigo1.'-'.$codigo2.'-'.Input::file("archivo")->getClientOriginalName());
			    $file = date('j-n-y').'-'.$codigo1.'-'.$codigo2.'-'.Input::file("archivo")->getClientOriginalName();
		     }
		     else{
		     	$file="vacio";
		     }
	    	$NewEquipo=new Equipo();
	    	$NewEquipo->serie=Input::get('serie');
	    	$NewEquipo->id_especialidad=Input::get('especialidad');
	    	$NewEquipo->id_unidad=Input::get('unidad');
	    	$NewEquipo->marca=Input::get('marca');
	    	$NewEquipo->modelo=Input::get('modelo');
	    	$NewEquipo->costo=Input::get('costo');
	    	$NewEquipo->fabricante=Input::get('fabricante');
	    	$NewEquipo->casacomercial=Input::get('casacomercial');
	    	$NewEquipo->fechainstalacion=Input::get('fechainstalacion');
	    	$NewEquipo->proximomantenimiento=Input::get('proximomant');
	    	$NewEquipo->estado=Input::get('EstadoEquipo');
	    	$NewEquipo->manual=$file;
	    	if($NewEquipo->save()){
	    		Session::flash('mensaje','Equipo '.$NewEquipo->modelo.' - '.$NewEquipo->marca.' se registro correctamente');
	        	return Redirect::back();
	    	}
	    }

	}

	public function AddEquiposUnidad(){
		$rules = array(
			'serie'=>'unique:equipos,serie',
			'marca'=>'required|min:3|max:150',
			'modelo'=>'required|min:3|max:50',
			'costo'=>'required|max:60',
			'fabricante'=>'required|min:3|max:100',
			'casacomercial'=>'required|min:3|max:100',
			'fechainstalacion'=>'required',
			'proximomant'=>'required',
			'archivo'=>'mimes:pdf|max:5000'
			);

		$errores = array(
			'required'=>'El campo :attribute no puede estar vacio',
			'unique'=>'El campo :attribute ya existe, revise el numero de serie del equipo',
			'min'=>'El campo :attribute no puede tener menos de :min caracteres',
			'max'=>'El campo :attribute no puede tener mas de :max caracteres',
			'archivo.max'=>'El campo :attribute no puede tener mas de :max Kb',
			'mimes'=>'El archivo tiene que estar en formato PDF'
			);

	    $validator = Validator::make(Input::all(), $rules, $errores);

	    if ($validator->fails())
	    {	Session::flash('alerta','Error al registrar el equipo');
	        return Redirect::back()->withErrors($validator)->withInput();
	    }
	    else{
	    	if(Input::hasFile('archivo')) {
	    		$codigo1=$this->codigo(10);
	    		$codigo2=$this->codigo(10);
			    Input::file('archivo')->move('manuales/'.date('j-n-y').'-'.$codigo1.'-'.$codigo2.'-'.Input::file("archivo")->getClientOriginalName());
			    $file = date('j-n-y').'-'.$codigo1.'-'.$codigo2.'-'.Input::file("archivo")->getClientOriginalName();
		     }
		     else{
		     	$file="vacio";
		     }

		    $usuario = User::find(Auth::user()->id)->UserUnidad()->first();
	    	$NewEquipo=new Equipo();
	    	$NewEquipo->serie=Input::get('serie');
	    	$NewEquipo->id_especialidad=Input::get('especialidad');
	    	$NewEquipo->id_unidad=$usuario->id_unidad;
	    	$NewEquipo->marca=Input::get('marca');
	    	$NewEquipo->modelo=Input::get('modelo');
	    	$NewEquipo->costo=Input::get('costo');
	    	$NewEquipo->fabricante=Input::get('fabricante');
	    	$NewEquipo->casacomercial=Input::get('casacomercial');
	    	$NewEquipo->fechainstalacion=Input::get('fechainstalacion');
	    	$NewEquipo->proximomantenimiento=Input::get('proximomant');
	    	$NewEquipo->estado=Input::get('EstadoEquipo');
	    	$NewEquipo->manual=$file;
	    	if($NewEquipo->save()){
	    		Session::flash('mensaje','Equipo '.$NewEquipo->modelo.' - '.$NewEquipo->marca.' se registro correctamente');
	        	return Redirect::to('/Unidad/Equipos/Show');
	    	}
	    }

	}

	public function ShowCategorias(){

		$Especialidad=Especialidad::all();

		return View::make('Admin.Equipos.Especialidad', array('Especialidad'=>$Especialidad));

	}

	public function AddCategorias(){

		$rules = array(
			'nombre'=>'required|min:5|max:150');

		$errores = array(
			'required'=>'El campo :attribute no puede estar vacio',
			'min'=>'El campo :attribute no puede tener menos de :min caracteres',
			'max'=>'El campo :attribute no puede tener mas de :max caracteres');

	    $validator = Validator::make(Input::all(), $rules, $errores);

	    if ($validator->fails())
	    {	Session::flash('alerta','Error al registrar la categoria');
	        return Redirect::back()->withErrors($validator);
	    }
	    else{
	    	$NewEspecialidad=new Especialidad();
	    	$NewEspecialidad->tipo=Input::get('tipoEquipo');
	    	$NewEspecialidad->nombre=Input::get('nombre');
	    	if($NewEspecialidad->save()){
	    		Session::flash('mensaje','Categoria '.$NewEspecialidad->nombre.' registrada correctamente');
	        	return Redirect::back();
	    	}
	    }
	}

	public function EquiposSilais($nombre, $id){
		$Silais=Silais::find($id);
		if($Silais->nombre==$nombre){

			$Unidades=Unidad::where('id_silais',$Silais->id)->get();

			return View::make('Admin.Silais.equipos', array('Unidades'=>$Unidades, 'Silais'=>$Silais));
		}
		else{
			Session::flash('alerta','Error, Seleccione un silais de la lista');
	        return Redirect::to('/administrador/Silais');
		}

	}

	public function EquiposUnidad($Nombre, $id){
		$Unidad = Unidad::find($id);

		if($Unidad->nombre==$Nombre){

			$Equipos=Equipo::where('id_unidad',$id)->get();

			return View::make('Admin.Silais.equiposUnidades', array('Equipos'=>$Equipos, 'Unidad'=>$Unidad));
		}
		else{
			Session::flash('alerta','Error, Seleccione una unidad de la lista');
			return Redirect::to('/administrador/Silais');
		}
	}

	private function codigo($length){
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
