@extends('templates.adminTemplate')
@section('contenido')
<div class="container-fluid">
	
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
	<div class="table-responsive">
		<h3 class="titul">Categorias de equipos</h3>
		<table class="table table-hover" id="TableEspecialidad">
			<thead>
				<tr>
					<td>Acciones</td>
					<td>Tipo</td>
					<td>Nombre</td>
				</tr>
			</thead>
			<tbody>
				@foreach($Especialidad as $value)
				<tr>
					<td>
						<div class="btn-group">
							<button type="button" class="btn btn-warning btn-xs dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
								Acciones <span class="caret"></span>
							</button>
							<ul class="dropdown-menu" role="menu">
								<li><a href="{{ URL::to('administrador/Equipos/Categorias/Update/'. $value->id) }}">Modificar Categoria</a></li>
								<li class="divider"></li>
								<li><a href="{{ URL::to('administrador/Equipos/Categorias/Del/'. $value->id) }}">Borrar Categoria</a></li>
							</ul>
						</div>
					</td>
					@if($value->tipo==0)
						<td>Equipo Medico</td>
					@else
						<td>Equipo No Medico</td>
					@endif
					<td>{{$value->nombre }}</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>

	<div class="col-sm-12"><hr></div>
	<h3 class="titul divider">Agregar Categoria</h3>
	@if( $errors->has('nombre'))
		<br>
		<div class="row">
			<p class="alert alert-danger">{{ $errors->first('nombre') }}</p>
		</div>
	@endif
	<div class="row">
		{{ Form::open(array('url' => 'administrador/Equipos/Categorias/Add', 'class' => 'form-horizontal')) }}
			<div class="form-group">
				{{ Form::label('tipo', 'Tipo', array('class' => 'col-sm-3 control-label')) }}
				<div class="col-sm-6">
					<select name="tipoEquipo" id="tipoEquipo" class="form-control">
						<option value="0">Equipo Medico</option>
						<option value="1">Equipo No Medico</option>
					</select>
				</div>
			</div>
			<div class="form-group">
				{{ Form::label('nombre', 'Nombre Categoria', array('class' => 'col-sm-3 control-label')) }}
				<div class="col-sm-6">
					{{ Form::text('nombre', Input::old('nombre'), array('class' => 'form-control', 'placeholder'=> 'Nombre de la categoria')) }}	
				</div>
			</div>
			<div class="form-group">				
				<div class="col-sm-offset-3 col-sm-9">
					{{ Form::submit('Agregar categoria' , array('class'=> 'btn btn-primary')) }}
				</div>	
			</div>
		{{ Form::close() }}
	</div>

</div>
@stop

