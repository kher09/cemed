<?php

class SilaisController extends \BaseController {

	public function EquiposSilais(){

		$EspecialidadMedica=Especialidad::where('tipo','0')->get();

		$EspecialidadNoMedica=Especialidad::where('tipo','1')->get();

		return View::make('Silais.Equipos.General', array('EspecialidadMedica'=>$EspecialidadMedica, 'EspecialidadNoMedica'=>$EspecialidadNoMedica));
	}

	public function ShowUnidades(){
		$usuario = User::find(Auth::user()->id)->UserSilais()->first();

		$Unidades=Unidad::where('id_silais',$usuario->id_silais)->get();

		return View::make('Silais.Unidades.show', array('Unidades'=>$Unidades));
	}

	public function AddUnidad(){

		return View::make('Silais.Unidades.add');
	}

	public function AddEquipo(){
		$usuario = User::find(Auth::user()->id)->UserSilais()->first();

		$Unidades=Unidad::where('id_silais',$usuario->id_silais)->get();

		$EspecialidadMedica=Especialidad::where('tipo','0')->get();

		$EspecialidadNoMedica=Especialidad::where('tipo','1')->get();

		return View::make('Silais.Equipos.Add', array('Unidades'=>$Unidades, 'EspecialidadMedica'=>$EspecialidadMedica,'EspecialidadNoMedica'=>$EspecialidadNoMedica));
	}

	public function NewEquipo(){
		
	}

}
