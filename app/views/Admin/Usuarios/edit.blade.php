@extends('templates.adminTemplate')
@section('contenido')
<div class="container-fluid">
	<h2 class="titul">Editar Usuario</h2>
	@if(Session::has('mensaje'))
		<div class="row">
			<div class="alert alert-info">{{ Session::get('mensaje') }}</div>
		</div>
	@endif
	<div class="row">
		{{ Form::open(array('url' => 'administrador/Usuarios/Update/'.$Usuario->id, 'class' => 'form-horizontal')) }}
			<div class="form-group">
				{{ Form::label('rol', 'Rol de usuario', array('class' => 'col-sm-3 control-label')) }}
				<div class="col-sm-6">
					<select name="rol" id="rol" class="form-control" data-select="{{$Usuario->role_id}}">
						<option value="0">Administrador</option>
						<option value="1">CEMED</option>
						<option value="2">Silais</option>
						<option value="3">Unidad</option>
					</select>
				</div>
			</div>
			@if($Usuario->role_id==0)
				<div class="form-group Silais">
					{{ Form::label('Silais', 'Silais', array('class' => 'col-sm-3 control-label')) }}
					<div class="col-sm-6">
						<select name="silais" id="silais" class="form-control" onchange="CargarUnidad($('select#silais option:selected').val()); return false;">
							@foreach($AllSilais as $key)
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

			@elseif($Usuario->role_id==2)
				<div class="form-group Silais">
					{{ Form::label('Silais', 'Silais', array('class' => 'col-sm-3 control-label')) }}
					<div class="col-sm-6">
						<select name="silais" id="silais" class="form-control" onchange="CargarUnidad($('select#silais option:selected').val()); return false;" data-select="{{$datos->id_silais}}">
							@foreach($AllSilais as $key)
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

			@elseif($Usuario->role_id==3)
				<?php $unidad=DB::table('unidades')->where('id',$datos->id_unidad)->first();  $silais=DB::table('silais')->where('id',$unidad->id_silais)->first(); ?>
				<div class="form-group Silais">
					{{ Form::label('Silais', 'Silais', array('class' => 'col-sm-3 control-label')) }}
					<div class="col-sm-6">
						<select name="silais" id="silais" class="form-control" onchange="CargarUnidad($('select#silais option:selected').val()); return false;" data-select="{{$silais->id}}">
							@foreach($AllSilais as $key)
							<option value="{{$key->id}}">{{$key->nombre}}</option>
							@endforeach
						</select>
					</div>
				</div>

				<?php $UnidadesUsers=DB::table('unidades')->where('id_silais',$silais->id)->get(); ?>
				<div class="form-group Unidad">
					{{ Form::label('Unidad', 'Unidad', array('class' => 'col-sm-3 control-label')) }}
					<div class="col-sm-6" id="SelectUnidad">
						<select name="unidad" id="unidad" class="form-control" data-select="{{$unidad->id}}">
							@foreach($UnidadesUsers as $key)
							<option value="{{$key->id}}">{{$key->tipo}} {{$key->nombre}}</option>
							@endforeach
						</select>
					</div>
				</div>

			@endif

			<div class="form-group">
				{{ Form::label('username', 'ID del usuario', array('class' => 'col-sm-3 control-label')) }}
				<div class="col-sm-6">
					{{ Form::text('username', Input::old('username') ? Input::old():$Usuario->username, array('class' => 'form-control', 'placeholder'=> 'ID de usuario')) }}	
				</div>
			</div>
			<div class="form-group">
				{{ Form::label('nombre', 'Nombre del usuario', array('class' => 'col-sm-3 control-label')) }}
				<div class="col-sm-6">
					{{ Form::text('nombre', Input::old('nombre') ? Input::old():$datos->nombre, array('class' => 'form-control', 'placeholder'=> 'Nombre del usuario')) }}	
				</div>
			</div>
			<div class="form-group">
				{{ Form::label('Correo', 'Correo', array('class' => 'col-sm-3 control-label')) }}
				<div class="col-sm-6">
					{{ Form::text('correo', Input::old('correo') ? Input::old():$Usuario->correo, array('class' => 'form-control', 'placeholder'=> 'ejemplo@hotmail.com')) }}	
				</div>
			</div>
			<div class="form-group">
				{{ Form::label('Telefono', 'Telefono', array('class' => 'col-sm-3 control-label')) }}
				<div class="col-sm-6">
					{{ Form::text('telefono', Input::old('telefono') ? Input::old():$datos->telefono, array('class' => 'form-control', 'placeholder'=> '8888-8888', 'id'=>'telefono')) }}	
				</div>
			</div>
			<div class="form-group">
				{{ Form::label('Cargo', 'Cargo', array('class' => 'col-sm-3 control-label')) }}
				<div class="col-sm-6">
					{{ Form::text('cargo', Input::old('cargo') ? Input::old():$datos->cargo, array('class' => 'form-control', 'placeholder'=> 'Puesto de trabajo')) }}	
				</div>
			</div>
			<div class="form-group">				
				<div class="col-sm-offset-3 col-sm-9">
					{{ Form::submit('Actualizar usuario' , array('class'=> 'btn btn-primary')) }}
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