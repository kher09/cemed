@extends('templates.SilaisTemplate')
@section('contenido')

<div class="container-fluid" >
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
	<div class="col-sm-12"><hr></div>
	<h3 class="titul divider">Agregar Equipo</h3>
	@if( $errors->has('serie'))
		<br>
		<div class="row">
			<div class="col-sm-6 col-sm-offset-3">
				<p class="alert alert-danger" style="text-align:center;">{{ $errors->first('serie') }}</p>
			</div>
		</div>
	@endif
	@if( $errors->has('marca'))
		<br>
		<div class="row">
			<div class="col-sm-6 col-sm-offset-3">
				<p class="alert alert-danger" style="text-align:center;">{{ $errors->first('marca') }}</p>
			</div>
		</div>
	@endif
	@if( $errors->has('modelo'))
		<br>
		<div class="row">
			<div class="col-sm-6 col-sm-offset-3">
				<p class="alert alert-danger" style="text-align:center;">{{ $errors->first('modelo') }}</p>
			</div>
		</div>
	@endif
	@if( $errors->has('fabricante'))
		<br>
		<div class="row">
			<div class="col-sm-6 col-sm-offset-3">
				<p class="alert alert-danger" style="text-align:center;">{{ $errors->first('fabricante') }}</p>
			</div>
		</div>
	@endif
	@if( $errors->has('casacomercial'))
		<br>
		<div class="row">
			<div class="col-sm-6 col-sm-offset-3">
				<p class="alert alert-danger" style="text-align:center;">{{ $errors->first('casacomercial') }}</p>
			</div>
		</div>
	@endif
	@if( $errors->has('costo'))
		<br>
		<div class="row">
			<div class="col-sm-6 col-sm-offset-3">
				<p class="alert alert-danger" style="text-align:center;">{{ $errors->first('costo') }}</p>
			</div>
		</div>
	@endif
	@if( $errors->has('fechainstalacion'))
		<br>
		<div class="row">
			<div class="col-sm-6 col-sm-offset-3">
				<p class="alert alert-danger" style="text-align:center;">{{ $errors->first('fechainstalacion') }}</p>
			</div>
		</div>
	@endif
	@if( $errors->has('proximomant'))
		<br>
		<div class="row">
			<div class="col-sm-6 col-sm-offset-3">
				<p class="alert alert-danger" style="text-align:center;">{{ $errors->first('proximomant') }}</p>
			</div>
		</div>
	@endif
	@if( $errors->has('archivo'))
		<br>
		<div class="row">
			<div class="col-sm-6 col-sm-offset-3">
				<p class="alert alert-danger" style="text-align:center;">{{ $errors->first('archivo') }}</p>
			</div>
		</div>
	@endif
	<div class="row">
		{{ Form::open(array('url' => 'Silais/Equipos/Add', 'files' => 'true' , 'class' => 'form-horizontal')) }}
			<div class="form-group">
				{{ Form::label('tipo', 'Tipo', array('class' => 'col-sm-3 control-label')) }}
				<div class="col-sm-6">
					<select name="tipoEquipo" id="tipoEquipo" class="form-control">
						<option value="0">Equipo Medico</option>
						<option value="1">Equipo No Medico</option>
					</select>
				</div>
			</div>
			<div class="form-group Especialidad">
				{{ Form::label('Especialidad', 'Especialidad', array('class' => 'col-sm-3 control-label')) }}
				<div class="col-sm-6" id="SelectEspecialidad">
					<select name="especialidad" id="EspecialidadMedica" class="form-control">
						@foreach($EspecialidadMedica as $key)
							<option value="{{$key->id}}">{{$key->nombre}}</option>
						@endforeach
					</select>
					<select name="especialidad" id="EspecialidadNoMedica" class="form-control">
						@foreach($EspecialidadNoMedica as $key)
							<option value="{{$key->id}}">{{$key->nombre}}</option>
						@endforeach
					</select>
				</div>
			</div>
			<div class="form-group Unidad">
				{{ Form::label('Unidad', 'Unidad', array('class' => 'col-sm-3 control-label')) }}
				<div class="col-sm-6" id="SelectUnidad">
					<select name="unidad" id="unidad" class="form-control">
						@foreach($Unidades as $key)
							<option value="{{$key->id}}">{{$key->tipo}} {{$key->nombre}}</option>
						@endforeach
					</select>
				</div>
			</div>
			<div class="form-group">
				{{ Form::label('serie', 'N° de serie', array('class' => 'col-sm-3 control-label')) }}
				<div class="col-sm-6">
					{{ Form::text('serie', Input::old('serie'), array('class' => 'form-control', 'placeholder'=> 'N° de serie del equipo')) }}	
				</div>
			</div>
			<div class="form-group">
				{{ Form::label('marca', 'Marca del equipo', array('class' => 'col-sm-3 control-label')) }}
				<div class="col-sm-6">
					{{ Form::text('marca', Input::old('marca'), array('class' => 'form-control', 'placeholder'=> 'Marca del equipo')) }}	
				</div>
			</div>
			<div class="form-group">
				{{ Form::label('Modelo', 'Modelo del equipo', array('class' => 'col-sm-3 control-label')) }}
				<div class="col-sm-6">
					{{ Form::text('modelo', Input::old('modelo'), array('class' => 'form-control', 'placeholder'=> 'Modelo del equipo')) }}	
				</div>
			</div>
			<div class="form-group">
				{{ Form::label('Fabricante', 'Fabricante', array('class' => 'col-sm-3 control-label')) }}
				<div class="col-sm-6">
					{{ Form::text('fabricante', Input::old('fabricante'), array('class' => 'form-control', 'placeholder'=> 'Fabricante')) }}	
				</div>
			</div>
			<div class="form-group">
				{{ Form::label('CasaComercial', 'Casa Comercial', array('class' => 'col-sm-3 control-label')) }}
				<div class="col-sm-6">
					{{ Form::text('casacomercial', Input::old('casacomercial'), array('class' => 'form-control', 'placeholder'=> 'Casa comercial donde se compro')) }}	
				</div>
			</div>
			<div class="form-group">
				{{ Form::label('Costo', 'Costo', array('class' => 'col-sm-3 control-label')) }}
				<div class="col-sm-6">
					{{ Form::text('costo', Input::old('costo'), array('class' => 'form-control', 'placeholder'=> 'Costo en C$', 'id'=>'CostoMonetario','data-thousands'=>',','data-decimal'=>'.','data-prefix'=>'C$')) }}	
				</div>
			</div>
			<div class="form-group">
				{{ Form::label('Fecha', 'Fecha de instalacion', array('class' => 'col-sm-3 control-label')) }}
				<div class="col-sm-6">
					{{ Form::text('fechainstalacion', Input::old('fechainstalacion'), array('class' => 'form-control', 'placeholder'=> 'Fecha de instalacion del equipo', 'data-role'=>'date')) }}
				</div>
			</div>
			<div class="form-group">
				{{ Form::label('Fecha', 'Fecha del Proximo Mant.', array('class' => 'col-sm-3 control-label')) }}
				<div class="col-sm-6">
					{{ Form::text('proximomant', Input::old('proximomant'), array('class' => 'form-control', 'placeholder'=> 'Fecha del proximo mantenimiento del equipo', 'id'=>'ProximoMant')) }}
				</div>
			</div>
			<div class="form-group">
				{{ Form::label('Estado', 'Estado tecnico', array('class' => 'col-sm-3 control-label')) }}
				<div class="col-sm-6">
					<select name="EstadoEquipo" id="EstadoEquipo" class="form-control">
						<option value="Bueno">Bueno</option>
						<option value="Afectado">Afectado</option>
						<option value="Malo">Malo</option>
					</select>
				</div>
			</div>
			<div class="form-group">
				{{ Form::label('manual', 'Seleccionar manual de soluciones', array('class' => 'col-sm-3 control-label')) }}
				<div class="col-sm-6">
					{{ Form::file('archivo') }}
				</div>
			</div>
			<div class="form-group">				
				<div class="col-sm-offset-3 col-sm-9">
					{{ Form::submit('Agregar equipo' , array('class'=> 'btn btn-primary')) }}
				</div>	
			</div>
		{{ Form::close() }}
	</div>

</div>
@stop

@section('Scripts')
<script type="text/javascript">
	$('.Silais').css("display","block");
    $('.Unidad').css("display","block");
    $('#EspecialidadNoMedica').css("display","none");

</script>
@stop