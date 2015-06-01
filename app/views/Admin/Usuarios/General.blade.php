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
	<!--div role="tabpanel">
		<ul class="nav nav-tabs" role="tablist">
    		<li role="presentation" class="active"><a href="#Administradores" aria-controls="Administradores" role="tab" data-toggle="tab">Administradores</a></li>
    	</ul>

    	<div class="tab-content">
    		<div role="tabpanel" class="tab-pane active" id="Administradores">
    			
    		</div>
    	</div>
	</div-->
	<div class="table-responsive">
		<h3 class="titul">Usuarios Administradores</h3>
			<table class="table table-hover table-striped table-bordered " id="admins">
				<thead>
					<tr>
						<td>Acciones</td>
						<td>Estado</td>
						<td>Username</td>
						<td>Nombre</td>
						<td>Email</td>
						<td>Telefono</td>
						<td>Cargo</td>
					</tr>
				</thead>
				<tbody>
					@foreach($admins as $value)
							<?php $datos = User::find($value->id)->UserAdmin()->first(); ?>	
							@if($value->id!=1 & $value->id!=Auth::user()->id)		
								@if($value->enable==1)
								<tr>
									<td>
										<div class="btn-group">
											<button type="button" class="btn btn-warning btn-xs dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
												Acciones <span class="caret"></span>
											</button>
											<ul class="dropdown-menu" role="menu">
												<li><a href="{{ URL::to('administrador/Usuarios/Update/'. $value->id) }}">Modificar Usuario</a></li>
												<li class="divider"></li>
												<li><a href="{{ URL::to('administrador/Usuarios/Del/'. $value->id) }}">Borrar Usuario</a></li>
												<li><a href="{{ URL::to('administrador/Usuarios/Desactivar/'. $value->id) }}">Deshabilitar Usuario</a></li>
											</ul>
										</div>
									</td>
									<td>Habilitado</td>
									<td>{{$value->username}}</td>
									<td>{{$datos->nombre}}</td>				
									<td>{{$value->correo}}</td>			
									<td>{{$datos->telefono }}</td>
									<td>{{$datos->cargo }}</td>
								</tr>
								@else
								<tr style="color: red;">
									<td>
										<div class="btn-group">
											<button type="button" class="btn btn-warning btn-xs dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
												Acciones <span class="caret"></span>
											</button>
											<ul class="dropdown-menu" role="menu">
												<li><a href="{{ URL::to('administrador/Usuarios/Update/'. $value->id) }}">Modificar Usuario</a></li>
												<li class="divider"></li>
												<li><a href="{{ URL::to('administrador/Usuarios/Del/'. $value->id) }}">Borrar Usuario</a></li>
												<li><a href="{{ URL::to('administrador/Usuarios/Activar/'. $value->id) }}">Habilitar Usuario</a></li>
											</ul>
										</div>
									</td>
									<td>Deshabilitado</td>
									<td>{{$value->username}}</td>
									<td>{{$datos->nombre}}</td>				
									<td>{{$value->correo}}</td>			
									<td>{{$datos->telefono }}</td>
									<td>{{$datos->cargo }}</td>
								</tr>
								@endif		
							@endif
					@endforeach
				</tbody>
			</table>
	</div>

	<div class="col-sm-12"><hr></div>
	<div class="table-responsive">
		<h3 class="titul">Usuarios CEMED</h3>
			<table class="table table-hover table-striped table-bordered" id="Cemed">
				<thead>
					<tr>
						<td>Acciones</td>
						<td>Estado</td>
						<td>Username</td>
						<td>Nombre</td>
						<td>Email</td>
						<td>Telefono</td>
						<td>Cargo</td>
					</tr>
				</thead>
				<tbody>
					@foreach($Usercemed as $value)
							<?php $datos = User::find($value->id)->UserAdmin()->first(); ?>			
								@if($value->enable==1)
								<tr>
									<td>
										<div class="btn-group">
											<button type="button" class="btn btn-warning btn-xs dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
												Acciones <span class="caret"></span>
											</button>
											<ul class="dropdown-menu" role="menu">
												<li><a href="{{ URL::to('administrador/Usuarios/Update/'. $value->id) }}">Modificar Usuario</a></li>
												<li class="divider"></li>
												<li><a href="{{ URL::to('administrador/Usuarios/Del/'. $value->id) }}">Borrar Usuario</a></li>
												<li><a href="{{ URL::to('administrador/Usuarios/Desactivar/'. $value->id) }}">Deshabilitar Usuario</a></li>
											</ul>										</div>
									</td>
									<td>Habilitado</td>
									<td>{{$value->username}}</td>
									<td>{{$datos->nombre}}</td>				
									<td>{{$value->correo}}</td>			
									<td>{{$datos->telefono }}</td>
									<td>{{$datos->cargo }}</td>
								@else
								<tr style="color:red;">
									<td>
										<div class="btn-group">
											<button type="button" class="btn btn-warning btn-xs dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
												Acciones <span class="caret"></span>
											</button>
											<ul class="dropdown-menu" role="menu">
												<li><a href="{{ URL::to('administrador/Usuarios/Update/'. $value->id) }}">Modificar Usuario</a></li>
												<li class="divider"></li>
												<li><a href="{{ URL::to('administrador/Usuarios/Del/'. $value->id) }}">Borrar Usuario</a></li>
												<li><a href="{{ URL::to('administrador/Usuarios/Activar/'. $value->id) }}">Habilitar Usuario</a></li>
											</ul>
										</div>
									</td>
									<td>Deshabilitado</td>
									<td>{{$value->username}}</td>
									<td>{{$datos->nombre}}</td>				
									<td>{{$value->correo}}</td>			
									<td>{{$datos->telefono }}</td>
									<td>{{$datos->cargo }}</td>
								@endif
							</tr>
					@endforeach
				</tbody>
			</table>
	</div>

	<div class="col-sm-12"><hr></div>
	<div class="table-responsive">
		<h3 class="titul">Usuarios Silais</h3>
			<table class="table table-hover table-striped table-bordered" id="Silais">
				<thead>
					<tr>
						<td>Acciones</td>
						<td>Estado</td>
						<td>Silais</td>
						<td>Username</td>
						<td>Nombre</td>
						<td>Email</td>
						<td>Telefono</td>
						<td>Cargo</td>
					</tr>
				</thead>
				<tbody>
					@foreach($Usersilais as $value)
							<?php $datos = User::find($value->id)->UserSilais()->first(); $silaisname=Silais::find($datos->id_silais);?>			
								@if($value->enable==1)
								<tr>
									<td>
										<div class="btn-group">
											<button type="button" class="btn btn-warning btn-xs dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
												Acciones <span class="caret"></span>
											</button>
											<ul class="dropdown-menu" role="menu">
												<li><a href="{{ URL::to('administrador/Usuarios/Update/'. $value->id) }}">Modificar Usuario</a></li>
												<li class="divider"></li>
												<li><a href="{{ URL::to('administrador/Usuarios/Del/'. $value->id) }}">Borrar Usuario</a></li>
												<li><a href="{{ URL::to('administrador/Usuarios/Desactivar/'. $value->id) }}">Deshabilitar Usuario</a></li>
											</ul>
										</div>
									</td>
									<td>Habilitado</td>
									<td>{{$silaisname->nombre}}</td>
									<td>{{$value->username}}</td>
									<td>{{$datos->nombre}}</td>				
									<td>{{$value->correo}}</td>			
									<td>{{$datos->telefono }}</td>
									<td>{{$datos->cargo }}</td>
								@else
								<tr style="color:red;">
									<td>
										<div class="btn-group">
											<button type="button" class="btn btn-warning btn-xs dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
												Acciones <span class="caret"></span>
											</button>
											<ul class="dropdown-menu" role="menu">
												<li><a href="{{ URL::to('administrador/Usuarios/Update/'. $value->id) }}">Modificar Usuario</a></li>
												<li class="divider"></li>
												<li><a href="{{ URL::to('administrador/Usuarios/Del/'. $value->id) }}">Borrar Usuario</a></li>
												<li><a href="{{ URL::to('administrador/Usuarios/Activar/'. $value->id) }}">Habilitar Usuario</a></li>
											</ul>
										</div>
									</td>
									<td>Deshabilitado</td>
									<td>{{$silaisname->nombre}}</td>
									<td>{{$value->username}}</td>
									<td>{{$datos->nombre}}</td>				
									<td>{{$value->correo}}</td>			
									<td>{{$datos->telefono }}</td>
									<td>{{$datos->cargo }}</td>
								@endif
							</tr>
					@endforeach
				</tbody>
			</table>
	</div>

	<div class="col-sm-12"><hr></div>
	<div class="table-responsive">
		<h3 class="titul">Usuarios Unidades</h3>
			<table class="table table-hover table-striped table-bordered compact" id="UsuariosUnidades">
				<thead>
					<tr>
						<td>Acciones</td>
						<td>Estado</td>
						<td>Silais</td>
						<td>Unidad</td>
						<td>Username</td>
						<td>Nombre</td>
						<td>Email</td>
						<td>Telefono</td>
						<td>Cargo</td>
					</tr>
				</thead>
				<tbody>
					@foreach($Userunidad as $value)
							<?php $datos = User::find($value->id)->UserUnidad()->first();?>
							<?php 

								$nombreunidad=Unidad::find($datos->id_unidad);

								$silaisname=Silais::find($nombreunidad->id_silais);

							?>
							@if($value->enable==1)
							<tr>
								<td>
									<div class="btn-group">
										<button type="button" class="btn btn-warning btn-xs dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
											Acciones <span class="caret"></span>
										</button>
										<ul class="dropdown-menu" role="menu">
											<li><a href="{{ URL::to('administrador/Usuarios/Update/'. $value->id) }}">Modificar Usuario</a></li>
											<li class="divider"></li>
											<li><a href="{{ URL::to('administrador/Usuarios/Del/'. $value->id) }}">Borrar Usuario</a></li>
											@if($value->enable==1)
												<li><a href="{{ URL::to('administrador/Usuarios/Desactivar/'. $value->id) }}">Deshabilitar Usuario</a></li>
											@else
												<li><a href="{{ URL::to('administrador/Usuarios/Activar/'. $value->id) }}">Habilitar Usuario</a></li>
											@endif
										</ul>
									</div>
								</td>
								<td>Habilitado</td>
								<td>{{$silaisname->nombre}}</td>
								<td>{{$nombreunidad->tipo}} {{$nombreunidad->nombre}}</td>
								<td>{{$value->username}}</td>
								<td>{{$datos->nombre}}</td>				
								<td>{{$value->correo}}</td>			
								<td>{{$datos->telefono }}</td>
								<td>{{$datos->cargo }}</td>
							</tr>
							@else
							<tr style="color:red;">
								<td>
									<div class="btn-group">
										<button type="button" class="btn btn-warning btn-xs dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
											Acciones <span class="caret"></span>
										</button>
										<ul class="dropdown-menu" role="menu">
											<li><a href="{{ URL::to('administrador/Usuarios/Update/'. $value->id) }}">Modificar Usuario</a></li>
											<li class="divider"></li>
											<li><a href="{{ URL::to('administrador/Usuarios/Del/'. $value->id) }}">Borrar Usuario</a></li>
											@if($value->enable==1)
												<li><a href="{{ URL::to('administrador/Usuarios/Desactivar/'. $value->id) }}">Deshabilitar Usuario</a></li>
											@else
												<li><a href="{{ URL::to('administrador/Usuarios/Activar/'. $value->id) }}">Habilitar Usuario</a></li>
											@endif
										</ul>
									</div>
								</td>
								<td>Deshabilitado</td>
								<td>{{$silaisname->nombre}}</td>
								<td>{{$nombreunidad->tipo}} {{$nombreunidad->nombre}}</td>
								<td>{{$value->username}}</td>
								<td>{{$datos->nombre}}</td>				
								<td>{{$value->correo}}</td>			
								<td>{{$datos->telefono }}</td>
								<td>{{$datos->cargo }}</td>
							</tr>
							@endif
					@endforeach
				
				</tbody>
			</table>
	</div>


	<div class="col-sm-12"><hr></div>
	<h3 class="titul divider">Agregar Usuario</h3>
	<div class="row">
		@if( $errors->has('username'))
			<div class="row">
				<div class="col-sm-6 col-sm-offset-3">
					<p class="alert alert-danger" style="text-align:center;">{{ $errors->first('username') }}</p>
				</div>
			</div>
		@endif
		@if( $errors->has('nombre'))
			<div class="row">
				<div class="col-sm-6 col-sm-offset-3">
					<p class="alert alert-danger" style="text-align:center;">{{ $errors->first('nombre') }}</p>
				</div>
			</div>
		@endif
		@if( $errors->has('correo'))
			<div class="row">
				<div class="col-sm-6 col-sm-offset-3">
					<p class="alert alert-danger" style="text-align:center;">{{ $errors->first('correo') }}</p>
				</div>
			</div>
		@endif
		@if( $errors->has('cargo'))
			<div class="row">
				<div class="col-sm-6 col-sm-offset-3">
					<p class="alert alert-danger" style="text-align:center;">{{ $errors->first('cargo') }}</p>
				</div>
			</div>
		@endif
		{{ Form::open(array('url' => 'administrador/Usuarios/Add', 'class' => 'form-horizontal')) }}
			<div class="form-group">
				{{ Form::label('rol', 'Rol de usuario', array('class' => 'col-sm-3 control-label')) }}
				<div class="col-sm-6">
					<select name="rol" id="rol" class="form-control">
						<option value="0">Administrador</option>
						<option value="1">CEMED</option>
						<option value="2">Silais</option>
						<option value="3">Unidad</option>
					</select>
				</div>
			</div>
			<div class="form-group Silais">
				{{ Form::label('Silais', 'Silais', array('class' => 'col-sm-3 control-label')) }}
				<div class="col-sm-6">
					<select name="silais" id="silais" class="form-control" onchange="CargarUnidad($('select#silais option:selected').val()); return false;">
						@foreach($Silais as $key)
						<option value="{{$key->id}}">{{$key->nombre}}</option>
						@endforeach
					</select>
				</div>
			</div>
			<div class="form-group Unidad">
				{{ Form::label('Unidad', 'Unidad', array('class' => 'col-sm-3 control-label')) }}
				<div class="col-sm-6" id="SelectUnidad">
				</div>
			</div>
			<div class="form-group">
				{{ Form::label('username', 'ID del usuario', array('class' => 'col-sm-3 control-label')) }}
				<div class="col-sm-6">
					{{ Form::text('username', Input::old('username'), array('class' => 'form-control', 'placeholder'=> 'ID de usuario')) }}	
				</div>
			</div>
			<div class="form-group">
				{{ Form::label('nombre', 'Nombre del usuario', array('class' => 'col-sm-3 control-label')) }}
				<div class="col-sm-6">
					{{ Form::text('nombre', Input::old('nombre'), array('class' => 'form-control', 'placeholder'=> 'Nombre del usuario')) }}	
				</div>
			</div>
			<div class="form-group">
				{{ Form::label('Correo', 'Correo', array('class' => 'col-sm-3 control-label')) }}
				<div class="col-sm-6">
					{{ Form::text('correo', Input::old('correo'), array('class' => 'form-control', 'placeholder'=> 'ejemplo@hotmail.com')) }}	
				</div>
			</div>
			<div class="form-group">
				{{ Form::label('Telefono', 'Telefono', array('class' => 'col-sm-3 control-label')) }}
				<div class="col-sm-6">
					{{ Form::text('telefono', Input::old('telefono'), array('class' => 'form-control', 'placeholder'=> '8888-8888', 'id'=>'telefono')) }}	
				</div>
			</div>
			<div class="form-group">
				{{ Form::label('Cargo', 'Cargo', array('class' => 'col-sm-3 control-label')) }}
				<div class="col-sm-6">
					{{ Form::text('cargo', Input::old('cargo'), array('class' => 'form-control', 'placeholder'=> 'Puesto de trabajo')) }}	
				</div>
			</div>
			<div class="form-group">				
				<div class="col-sm-offset-3 col-sm-9">
					{{ Form::submit('Agregar usuario' , array('class'=> 'btn btn-primary')) }}
				</div>	
			</div>
		{{ Form::close() }}
	</div>
</div>
@stop
@section('Scripts')
<script type="text/javascript">	
    function CargarUnidad(silais){
    	var rol = +$('select#rol option:selected').val();
	    if(rol==3){

	         var parametro ={
	         	"silais":silais,
	         };

	         $.ajax({
	                data:  parametro,
	                url:   '{{ URL::to('/administrador/Usuarios/Silais/Unidad') }}',
	                type:  'post',
	                beforeSend: function () {
	                        $("#SelectUnidad").html("Procesando, espere por favor...");
	                },
	                success:  function (data) {

	                    var dhtml="";
	                    	dhtml+='<select name="unidad" id="unidad" class="form-control">';
	                        for (datas in data.datos) {
	                          dhtml+='      <option value="'+data.datos[datas].id+'">'+data.datos[datas].tipo+' '+data.datos[datas].nombre+'</option>';
	                        };
	                        dhtml+='</select>';
	                    
	                    $("#SelectUnidad").html(dhtml);
	                }
	            });
	    }
    }
	
</script>
@stop