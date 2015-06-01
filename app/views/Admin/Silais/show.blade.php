@extends('templates.adminTemplate')
@section('contenido')
<style>
	
</style>
<div class="container-fluid">
	@if(Session::has('mensaje'))
		<br>
		<div class="row">
			<div class="col-sm-6 col-sm-offset-3">
				<p class="alert alert-info" style="text-align:center;">{{ Session::get('mensaje') }}</p>
			</div>
		</div>
	@endif
	@if(Session::has('alerta'))
		<br>
		<div class="row">
			<div class="col-sm-6 col-sm-offset-3">
				<p class="alert alert-danger" style="text-align:center;">{{ Session::get('alerta') }}</p>
			</div>
		</div>
	@endif
	<style>

	</style>
	<div class="table-responsive">
		<h2 class="titul">Silais</h2>
			<table class="table table-hover table-striped table-bordered" id="TableSilais">
				<thead>
					<tr>
						<th>Nombre</th>
						<th>Departamento</th>
						<th>Acciones</th>															
					</tr>
				</thead>
				<tbody>
					@foreach($silais as $value)
								<td>{{$value->nombre}}</td>				
								<td>{{$value->departamento}}</td>
								<td>
									
									<div class="btn-group">
										<button type="button" class="btn btn-warning btn-xs dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
											Acciones <span class="caret"></span>
										</button>
										<ul class="dropdown-menu" role="menu">
											<li><a href="{{ URL::to('administrador/Silais/Update/'.$value->nombre.'/'. $value->id) }}">Modificar Silais</a></li>
											<li class="divider"></li>
											<li><a href="{{ URL::to('administrador/Silais/Delete/'.$value->nombre.'/'. $value->id) }}">Borrar Silais</a></li>
											<li><a href="{{ URL::to('administrador/Silais/Equipos/'.$value->nombre.'/'. $value->id) }}">Equipos del Silais</a></li>
										</ul>
									</div>

								</td>
							</tr>
					@endforeach
				</tbody>
			</table>
	</div>
	<br>
	<div class="table-responsive" style="min-height:350px;">
		<h2 class="titul">Unidades</h2>
			<table class="table table-hover table-striped table-bordered" id="TableUnidad">
				<thead>
					<tr>
						<td>Accion</td>
						<td>Silais</td>
						<td>Tipo</td>
						<td>Nombre</td>
						<td>Direccion</td>
						<td>Telefono</td>
					</tr>
				</thead>
				<tbody>
					@foreach($unidad as $value)
								<td>
									<div class="btn-group">
										<button type="button" class="btn btn-warning btn-xs dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
											Acciones <span class="caret"></span>
										</button>
										<ul class="dropdown-menu" role="menu">
											<li><a href="{{ URL::to('administrador/Silais/Unidad/Update/'.$value->nombre.'/'. $value->id) }}">Modificar Unidad</a></li>
											<li class="divider"></li>
											<li><a href="{{ URL::to('administrador/Silais/Unidad/Delete/'.$value->nombre.'/'. $value->id) }}">Borrar Unidad</a></li>
											<li class="divider"></li>
											<li><a href="{{ URL::to('administrador/Silais/Unidad/Usuarios/'.$value->nombre.'/'. $value->id) }}">Usuarios</a></li>
											<li><a href="{{ URL::to('administrador/Silais/Unidad/Equipos/'.$value->nombre.'/'. $value->id) }}">Equipos</a></li>
											<li><a href="{{ URL::to('administrador/Silais/Unidad/Mantenimiento'.$value->nombre.'/'. $value->id) }}">Orden Mantenimiento</a></li>
										</ul>
									</div>

								</td>
								<?php $nombreSilais=Silais::find($value->id_silais); ?>
								<td>{{$nombreSilais->nombre}}</td>				
								<td>{{$value->tipo}}</td>
								<td>{{$value->nombre}}</td>
								<td>{{$value->direccion}}</td>
								<td>{{$value->telefono}}</td>
							</tr>
					@endforeach
				</tbody>
			</table>
	</div>
	<br>
	<div role="tabpanel">
		<ul class="nav nav-tabs" role="tablist">
		    <li role="presentation" class="active"><a href="#FormSilais" aria-controls="FormSilais" role="tab" data-toggle="tab">Agregar Silais</a></li>
		    <li role="presentation"><a href="#FormUnidad" aria-controls="FormUnidad" role="tab" data-toggle="tab">Agregar Unidad</a></li>
		</ul>
		
		<div class="tab-content">
    		<div role="tabpanel" class="tab-pane fade in active" id="FormSilais">
    			<div class="row">
    				@if( $errors->has('nombre'))
						<div class="row">
							<br>
							<div class="col-sm-6 col-sm-offset-3">
								<p class="alert alert-danger" style="text-align:center;">{{ $errors->first('nombre') }}</p>
							</div>
						</div>
					@endif
    				<br>
					{{ Form::open(array('url' => 'administrador/Silais/Add', 'class' => 'form-horizontal')) }}
						<div class="form-group">
							{{ Form::label('Departamento', 'Departamento', array('class' => 'col-sm-3 control-label')) }}
							<div class="col-sm-6">
								<select name="depto" id="depto" class="form-control">
									<option value="Boaco">Boaco</option>
									<option value="Carazo">Carazo</option>
									<option value="Chinandega">Chinandega</option>
									<option value="Chontales">Chontales</option>
									<option value="Esteli">Esteli</option>
									<option value="Granada">Granada</option>
									<option value="Jinotega">Jinotega</option>
									<option value="Leon">Leon</option>
									<option value="Madriz">Madriz</option>
									<option value="Managua">Managua</option>
									<option value="Masaya">Masaya</option>
									<option value="Matagalpa">Matagalpa</option>
									<option value="Nueva Segovia">Nueva Segovia</option>
									<option value="Rivas">Rivas</option>
									<option value="Rio San Juan">Rio San Juan</option>
									<option value="RAAN">RAAN</option>
									<option value="RAAS">RAAS</option>						
								</select>
							</div>
						</div>
						<div class="form-group">
							{{ Form::label('nombre', 'Nombre del Silais', array('class' => 'col-sm-3 control-label')) }}
							<div class="col-sm-6">
								{{ Form::text('nombre', Input::old('nombre'), array('class' => 'form-control', 'placeholder'=> 'Nombre del Silais')) }}	
							</div>
						</div>
						<div class="form-group">				
							<div class="col-sm-offset-3 col-sm-9">
								{{ Form::submit('Agregar Silais' , array('class'=> 'btn btn-primary')) }}
							</div>	
						</div>
					{{ Form::close() }}
				</div>
    		</div>

    		<div role="tabpanel" class="tab-pane fade active" id="FormUnidad">
    			<div class="row">
    				@if( $errors->has('nombre'))
						<div class="row">
							<br>
							<div class="col-sm-6 col-sm-offset-3">
								<p class="alert alert-danger" style="text-align:center;">{{ $errors->first('nombre') }}</p>
							</div>
						</div>
					@endif
					@if( $errors->has('direccion'))
						<div class="row">
							<br>
							<div class="col-sm-6 col-sm-offset-3">
								<p class="alert alert-danger" style="text-align:center;">{{ $errors->first('direccion') }}</p>
							</div>
						</div>
					@endif
					@if( $errors->has('telefono'))
						<div class="row">
							<br>
							<div class="col-sm-6 col-sm-offset-3">
								<p class="alert alert-danger" style="text-align:center;">{{ $errors->first('telefono') }}</p>
							</div>
						</div>
					@endif
    				<br>
					{{ Form::open(array('url' => 'administrador/Silais/Unidad/Add', 'class' => 'form-horizontal')) }}
						<div class="form-group">
							{{ Form::label('Silais', 'Silais', array('class' => 'col-sm-3 control-label')) }}
							<div class="col-sm-6">
								<select name="silais" id="silais" class="form-control">
									@foreach($silais as $valor)
										<option value="{{$valor->id}}">{{$valor->nombre}}</option>
									@endforeach					
								</select>
							</div>
						</div>
						<div class="form-group">
							{{ Form::label('tipo', 'Tipo de Unidad', array('class' => 'col-sm-3 control-label')) }}
							<div class="col-sm-6">
								<select name="tipo" id="tipo" class="form-control">
									<option value="Hospital de 1er Nivel">Hospital de 1er Nivel</option>
									<option value="Hospital de 2do Nivel">Hospital de 2do Nivel</option>
									<option value="Hospital de Referencia Nacional">Hospital de Refencia Nacional</option>
									<option value="Centro de Salud">Centro de Salud</option>
									<option value="Policlinico">Policlinico</option>
									<option value="Puesto de Salud">Puesto de Salud</option>
									<option value="Casa Materna">Casa Materna</option>
									<option value="Clinica Provicional">Clinica Provicional</option>					
								</select>
							</div>
						</div>
						<div class="form-group">
							{{ Form::label('nombre', 'Nombre de la Unidad', array('class' => 'col-sm-3 control-label')) }}
							<div class="col-sm-6">
								{{ Form::text('nombre', Input::old('nombre'), array('class' => 'form-control', 'placeholder'=> 'Nombre de la Unidad')) }}	
							</div>
						</div>
						<div class="form-group">
							{{ Form::label('Direccion', 'Direccion de la Unidad', array('class' => 'col-sm-3 control-label')) }}
							<div class="col-sm-6">
								{{ Form::text('direccion', Input::old('direccion'), array('class' => 'form-control', 'placeholder'=> 'Direccion de la Unidad')) }}	
							</div>
						</div>
						<div class="form-group">
							{{ Form::label('Telefono', 'Telefono', array('class' => 'col-sm-3 control-label')) }}
							<div class="col-sm-6">
								{{ Form::text('telefono', Input::old('telefono'), array('class' => 'form-control', 'placeholder'=> '2233-4455', 'id'=>'telefono')) }}	
							</div>
						</div>
						<div class="form-group">				
							<div class="col-sm-offset-3 col-sm-9">
								{{ Form::submit('Agregar Unidad' , array('class'=> 'btn btn-primary')) }}
							</div>	
						</div>
					{{ Form::close() }}
				</div>
    		</div>
   		</div>
	</div>
	
</div>
@stop
@section('Scripts')
{{ HTML::script('media/ZeroClipboard/ZeroClipboard.js') }}
<script type="text/javascript">

	var Tabla = $('#TableSilais').dataTable({
    	"language": {
            "url": "http://cdn.datatables.net/plug-ins/3cfcc339e89/i18n/Spanish.json"
        },
    });
    
    $('#TableUnidad').dataTable({
    	"language": {
            "url": "http://cdn.datatables.net/plug-ins/3cfcc339e89/i18n/Spanish.json"
        }
    });	
</script>
@stop