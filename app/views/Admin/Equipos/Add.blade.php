@extends('templates.adminTemplate')
@section('titulo')
Adminitrador - Agregar Equipo
@stop

@section('estilo')
{{ HTML::style('css/datepicker.css') }}
@stop
@section('contenido')

<h3 class="titul divider">Agregar Equipo</h3>
	@if( $errors->has('unidad'))
		<br>
		<div class="row">
			<div class="col-sm-6 col-sm-offset-3">
				<p class="alert alert-danger" style="text-align:center;">{{ $errors->first('unidad') }}</p>
			</div>
		</div>
	@endif
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
	@if( $errors->has('ultimomant'))
		<br>
		<div class="row">
			<div class="col-sm-6 col-sm-offset-3">
				<p class="alert alert-danger" style="text-align:center;">{{ $errors->first('ultimomantenimiento') }}</p>
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
		{{ Form::open(array('url' => 'administrador/Equipos/Add', 'files' => 'true' , 'class' => 'form-horizontal')) }}
			<div class="form-group">
				{{ Form::label('tipo', 'Tipo', array('class' => 'col-sm-3 control-label')) }}
				<div class="col-sm-6">
					{{ Form::select('tipoEquipo', ['0'=>'Equipo Medico', '1'=>'Equipo No Medico'], null, ['class' => 'form-control', 'id'=>'tipoEquipo'], Input::old('tipoEquipo')) }}
				</div>
			</div>
			<div class="form-group Especialidad">
				{{ Form::label('Especialidad', 'Especialidad', array('class' => 'col-sm-3 control-label')) }}
				<div class="col-sm-6" id="SelectEspecialidad">
					{{ Form::select('EspecialidadMedica', $EspecialidadMedica, 0,  ['class' => 'form-control', 'id'=>'EspecialidadMedica'], Input::old('EspecialidadMedica')) }}
					{{ Form::select('EspecialidadNoMedica', $EspecialidadNoMedica, 0, ['class' => 'form-control', 'id'=>'EspecialidadNoMedica'], Input::old('EspecialidadNoMedica')) }}
				</div>
			</div>
			<div class="form-group Silais">
				{{ Form::label('Silais', 'Silais', array('class' => 'col-sm-3 control-label')) }}
				<div class="col-sm-6">
					{{ Form::select('silais', $SilaisAll, 0,  ['class' => 'form-control', 'id'=>'silais','onchange'=>'CargarUnidad()'], Input::old('silais')) }}
				</div>
			</div>
			<div class="form-group Unidad">
				{{ Form::label('Unidad', 'Unidad', array('class' => 'col-sm-3 control-label')) }}
				<input type="hidden" value="{{Input::old('unidad')}}" id="UnidadSelected">
				<div class="col-sm-6" id="SelectUnidad">
				</div>
			</div>
			<div class="form-group">
				{{ Form::label('serie', 'N° de serie', array('class' => 'col-sm-3 control-label')) }}
				<div class="col-sm-6">
					{{ Form::text('serie', Input::old('serie') ? Input::old(): '', array('class' => 'form-control', 'placeholder'=> 'N° de serie del equipo')) }}	
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
				{{ Form::checkbox('donacion','donacion', null, ['id' => 'donacion']) }}
				{{ Form::label('donante', 'Equipo donado', array('class' => 'col-sm-3 control-label')) }}
			</div>
			<div class="form-group" id="donantegroup">
				{{ Form::label('donandte', 'Nombre del donante', array('class' => 'col-sm-3 control-label')) }}
				<div class="col-sm-6">
					{{ Form::text('donante', Input::old('donante'), array('class' => 'form-control', 'placeholder'=> 'Nombre del donante')) }}	
				</div>
			</div>
			<div class="form-group" id="grupo-costo">				
				{{ Form::label('Costo', 'Costo', array('class' => 'col-sm-3 control-label')) }}
				<div class="col-sm-6">
					{{ Form::text('costo', Input::old('costo'), array('class' => 'form-control', 'placeholder'=> 'Costo en C$', 'id'=>'CostoMonetario','data-thousands'=>',','data-decimal'=>'.','data-prefix'=>'C$')) }}	
				</div>
			</div>
			<div class="form-group" id="casacomercial-group">
				{{ Form::label('CasaComercial', 'Casa Comercial', array('class' => 'col-sm-3 control-label')) }}
				<div class="col-sm-6">
					{{ Form::text('casacomercial', Input::old('casacomercial'), array('class' => 'form-control', 'placeholder'=> 'Casa comercial donde se compro')) }}	
				</div>
			</div>
			<div class="form-group">
				{{ Form::label('Fecha', 'Fecha de instalacion', array('class' => 'col-sm-3 control-label')) }}
				<div class="col-sm-6">
					{{ Form::text('fechainstalacion', Input::old('fechainstalacion'), array('class' => 'form-control', 'placeholder'=> 'Fecha de instalacion del equipo', 'id'=>'fechainstalacion')) }}
				</div>
			</div>
			<div class="form-group">
				{{ Form::label('Fecha', 'Fecha del Ultimo Mant.', array('class' => 'col-sm-3 control-label')) }}
				<div class="col-sm-6">
					{{ Form::text('ultimomant', Input::old('ultimomant'), array('class' => 'form-control', 'placeholder'=> 'Fecha del ultimo mantenimiento del equipo', 'id'=>'UltimoMant')) }}
				</div>
			</div>
			<div class="form-group">
				{{ Form::label('Fecha', 'Fecha del Proximo Mant.', array('class' => 'col-sm-3 control-label')) }}
				<div class="col-sm-6">
					{{ Form::text('proximomant', Input::old('proximomant'), array('class' => 'form-control', 'placeholder'=> 'Fecha del proximo mantenimiento del equipo', 'id'=>'ProximoMant')) }}
				</div>
			</div>
			<div class="form-group">
				{{ Form::label('Garantia', 'Fecha de garantia', array('class' => 'col-sm-3 control-label')) }}
				<div class="col-sm-6">
					{{ Form::text('garantia', Input::old('garantia'), array('class' => 'form-control', 'placeholder'=> 'Fecha de expiracion de la garantia', 'id'=>'Garantia')) }}
				</div>
			</div>
			<div class="form-group">
				{{ Form::label('vidautil', 'Vida util', array('class' => 'col-sm-3 control-label')) }}
				<div class="col-sm-6">
					<div class="form-inline">
						{{ Form::text('vidautil', Input::old('vidautil'), array('class' => 'form-control ', 'placeholder'=> 'Vida util del equipo', 'id'=>'vidautil')) }}
						{{ Form::select('tiempo', ['meses', 'años'], null, ['class' => 'form-control ', 'id'=>'tiempo'], Input::old('tiempo')) }}
					</div>
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

@stop

@section('Scripts')
{{ HTML::script('js/bootstrap-datepicker.js') }}
<script type="text/javascript">
    $(document).ready(function (){
    	CargarUnidad();

    	$('.Silais').css("display","block");
    	$('.Unidad').css("display","block");

    	var tipoEquipo = $('select#tipoEquipo option:selected').val();

        if(tipoEquipo==0){
             $('#EspecialidadMedica').css("display","block");
             $('#EspecialidadNoMedica').css("display","none");
        }
        else{
        	if(tipoEquipo==1){
                $('#EspecialidadMedica').css("display","none");
            	$('#EspecialidadNoMedica').css("display","block");
            }
         }
         $('#donantegroup').css("display","none");
        $( "#ProximoMant" ).datepicker({
				format: 'dd-mm-yyyy'
			});
    	$( "#UltimoMant" ).datepicker({
				format: 'dd-mm-yyyy'
			});
    	$( "#fechainstalacion" ).datepicker({
				format: 'dd-mm-yyyy'
			});
    	$( "#Garantia" ).datepicker({
				format: 'dd-mm-yyyy'
			});
    });
	
	$('#donacion').change(function() {
       if ($(this).is(':checked')) {
         	$('#grupo-costo').css("display","none");
         	$('#casacomercial-group').css("display","none");
         	$('#donantegroup').css("display","block");

         }
         else{
         	$('#grupo-costo').css("display","block");
         	$('#casacomercial-group').css("display","block");
         	$('#donantegroup').css("display","none");
         }
    });

    $("#vidautil").keydown(function(event) {
	   if(event.shiftKey)
	   {
	        event.preventDefault();
	   }

	   if (event.keyCode == 46 || event.keyCode == 8)    {
	   }
	   else {
	        if (event.keyCode < 95) {
	          if (event.keyCode < 48 || event.keyCode > 57) {
	                event.preventDefault();
	          }
	        } 
	        else {
	              if (event.keyCode < 96 || event.keyCode > 105) {
	                  event.preventDefault();
	              }
	        }
	      }
	   });

    function CargarUnidad(){

    	var silais=$('select#silais option:selected').val();
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
           success: function (data) {
	           	if($('#UnidadSelected').val()==""){
	                var dhtml="";
		          	dhtml+='<select name="unidad" id="unidad" class="form-control">';
	                for (datas in data.datos) {
		                dhtml+='      <option value="'+data.datos[datas].id+'">'+data.datos[datas].tipo+' '+data.datos[datas].nombre+'</option>';
		            };
		            dhtml+='</select>';                 
		        	$("#SelectUnidad").html(dhtml);
		        }
		        else{
		        	var dhtml="";
		          	dhtml+='<select name="unidad" id="unidad" class="form-control">';
	                for (datas in data.datos) {
	                		if($('#UnidadSelected').val()==data.datos[datas].id){
		                		dhtml+='      <option value="'+data.datos[datas].id+'" selected>'+data.datos[datas].tipo+' '+data.datos[datas].nombre+'</option>';
		                	}
		                	else{
		                		dhtml+='      <option value="'+data.datos[datas].id+'">'+data.datos[datas].tipo+' '+data.datos[datas].nombre+'</option>';
		                	}
		            };
		            dhtml+='</select>';                 
		        	$("#SelectUnidad").html(dhtml);
		        }
		    }
       });
    }
	
</script>
@stop