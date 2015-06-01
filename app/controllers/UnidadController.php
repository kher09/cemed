<?php

class UnidadController extends \BaseController {

	public function Equipos(){
		$usuario = User::find(Auth::user()->id)->UserUnidad()->first();

		$Equipos=Equipo::where('id_unidad',$usuario->id_unidad)->get();

		return View::make('Unidades.Equipos.General',array('Equipos'=>$Equipos));
	}


}
