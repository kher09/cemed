@extends('templates.adminTemplate')
@section('contenido')
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
		
		{{ Form::open(array('url' => 'administrador/Silais/Unidad/Update/'.$Unidad->id, 'class' => 'form-horizontal')) }}
			<div class="form-group">
				{{ Form::label('Silais', 'Silais', array('class' => 'col-sm-3 control-label')) }}
				<div class="col-sm-6">
					<select name="silais" id="silais" class="form-control">
						@foreach($silais as $valor)
							@if($valor->id==$Unidad->id_silais)
								<option value="{{$valor->id}}" selected="">{{$valor->nombre}}</option>
							@else
								<option value="{{$valor->id}}">{{$valor->nombre}}</option>
							@endif
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
						<option value="Casa Materna">Casa Materna</option>
						<option value="Clinica Provicional">Clinica Provicional</option>					
					</select>
				</div>
			</div>
		
			<div class="form-group">
				{{ Form::label('nombre', 'Nombre de la Unidad', array('class' => 'col-sm-3 control-label')) }}
				<div class="col-sm-6">
					{{ Form::text('nombre', Input::old('nombre')?Input::old():$Unidad->nombre, array('class' => 'form-control', 'placeholder'=> 'Nombre de la Unidad')) }}	
				</div>
			</div>
		
			<div class="form-group">
				{{ Form::label('Direccion', 'Direccion de la Unidad', array('class' => 'col-sm-3 control-label')) }}
				<div class="col-sm-6">
					{{ Form::text('direccion', Input::old('direccion')?Input::old():$Unidad->direccion, array('class' => 'form-control', 'placeholder'=> 'Direccion de la Unidad')) }}	
				</div>
			</div>
		
			<div class="form-group">
				{{ Form::label('Telefono', 'Telefono', array('class' => 'col-sm-3 control-label')) }}
				<div class="col-sm-6">
					{{ Form::text('telefono', Input::old('telefono')?Input::old():$Unidad->telefono, array('class' => 'form-control', 'placeholder'=> '2233-4455')) }}	
				</div>
			</div>
		
			<div class="form-group">				
				<div class="col-sm-offset-3 col-sm-9">
					{{ Form::submit('Actualizar Unidad' , array('class'=> 'btn btn-primary')) }}
				</div>	
			</div>
		{{ Form::close() }}
	</div>
</div>
@stop

@section('Scripts')

@stop