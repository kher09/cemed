@extends('templates.adminTemplate')
@section('contenido')

<div class="container-fluid" >
	@if(Session::has('mensaje'))
		<br>
		<div class="row">
			<div class="alert alert-info">{{ Session::get('mensaje') }}</div>
		</div>
	@endif
	@if(Session::has('alerta'))
		<br>
		<div class="row">
			<div class="alert alert-danger">{{ Session::get('alerta') }}</div>
		</div>
	@endif

	<div class="table-responsive" style="height:450px;">
		<h3 class="titul">Lista de equipos - {{$Unidad->tipo}} {{$Unidad->nombre}}</h3>
		<table class="table table-hover tabla-equipos" id="TableEquiposUnidad" style="width:1550px;">
			<thead>
				<tr>
					<td>Acciones</td>
					<td>N° de Serie</td>
					<td>Tipo</td>
					<td>Especialidad</td>
					<td>Marca</td>
					<td>Modelo</td>
					<td>Fabricante</td>
					<td>Casa Comercial</td>
					<td>Costo</td>
					<td>Fecha de Instalacion</td>
					<td>Fecha Ultimo Mant.</td>
					<td>Fecha Proximo Mant.</td>
				</tr>
			</thead>
			<tbody>
				@foreach($Equipos as $value)
					<tr>
						<td>
							<div class="btn-group">
								<button type="button" class="btn btn-warning btn-xs dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
									Acciones <span class="caret"></span>
								</button>
								<ul class="dropdown-menu" role="menu">
									<li><a href="{{ URL::to('administrador/Usuarios/Update/'. $value->id) }}">Falta programar</a></li>
									<li class="divider"></li>
									<li><a href="{{ URL::to('administrador/Usuarios/Del/'. $value->id) }}">Falta programar</a></li>
									<li><a href="{{ URL::to('administrador/Usuarios/Desactivar/'. $value->id) }}">Falta programar</a></li>
								</ul>
							</div>
						</td>
						<td>{{$value->serie}}</td>
						<?php $Especialidad=Especialidad::find($value->id_especialidad); ?>		
						@if($Especialidad->tipo==0)
							<td>Equipo Medico</td>
						@else
							<td>Eqiupo No Medico</td>
						@endif
						<td>{{$Especialidad->nombre }}</td>
						<td>{{$value->marca }}</td>
						<td>{{$value->modelo }}</td>
						<td>{{$value->fabricante }}</td>
						<td>{{$value->casacomercial }}</td>
						<td>{{$value->costo }}</td>
						<td>{{$value->fechainstalacion }}</td>
						<td>{{$value->ultimomant }}</td>
						<td>{{$value->proximomant }}</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>
@stop

@section('Scripts')
<script type="text/javascript">

</script>
@stop