@extends('templates.adminTemplate')
@section('contenido')
<style>
	.table-responsive{
		min-height: 500px;
	}
	@media (min-width:900px){
		.table-responsive{
			width:100% !important;
			overflow-x:auto;
			}
		}
	@media (min-width:1300px){
		.table-responsive{
			width:100% !important;
			overflow-x:auto;
			}
		}
</style>

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

	<div class="table-responsive">
		<h3 class="titul">Lista de equipos - {{$Silais->nombre}}</h3>
		<table class="table table-hover table-striped table-bordered" id="TableEquiposSilais" style="width:1650px;">
			<thead>
				<tr>
					<th>Acciones</th>
					<th>Unidad</th>
					<th>N° de Serie</th>
					<th>Tipo</th>
					<th>Especialidad</th>
					<th>Marca</th>
					<th>Modelo</th>
					<th>Fabricante</th>
					<th>Casa Comercial</th>
					<th>Costo</th>
					<th>Fecha de Instalacion</th>
					<th>Fecha Ultimo Mant.</th>
					<th>Fecha Proximo Mant.</th>
				</tr>
			</thead>
			<tfoot>
				<tr>
					<th>Acciones</th>
					<th>Unidad</th>
					<th>N° de Serie</th>
					<th>Tipo</th>
					<th>Especialidad</th>
					<th>Marca</th>
					<th>Modelo</th>
					<th>Fabricante</th>
					<th>Casa Comercial</th>
					<th>Costo</th>
					<th>Fecha de Instalacion</th>
					<th>Fecha Ultimo Mant.</th>
					<th>Fecha Proximo Mant.</th>
				</tr>
			</tfoot>
			<tbody>
				@foreach($Unidades as $value)
					<?php
						$Equipos = Equipo::where('id_unidad',$value->id)->get();
					?>
					@foreach($Equipos as $key)
						<?php 
							$Especialidad=Especialidad::find($key->id_especialidad);
						?>
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
							<td>{{$value->tipo}} {{$value->nombre}}</td>
							<td>{{$key->serie}}</td>				
							@if($key->tipo==0)
								<td>Equipo Medico</td>
							@else
								<td>Eqiupo No Medico</td>
							@endif
							<td>{{$Especialidad->nombre }}</td>
							<td>{{$key->marca }}</td>
							<td>{{$key->modelo }}</td>
							<td>{{$key->fabricante }}</td>
							<td>{{$key->casacomercial }}</td>
							<td>{{$key->costo }}</td>
							<td>{{$key->fechainstalacion }}</td>
							<td>{{$key->ultimomant }}</td>
							<td>{{$key->proximomant }}</td>
						</tr>
					@endforeach
				@endforeach
			</tbody>
		</table>
	</div>
</div>
@stop

@section('Scripts')

<script>
	
$(document).ready(function() {
    //Inicio Tabla Mostrar Equipos Silais
    $('#TableEquiposSilais tfoot th').each( function () {

        if( $('#TableEquiposSilais thead th').eq( $(this).index() ).text()!="Acciones"){
            var title = $('#TableEquiposSilais thead th').eq( $(this).index() ).text();
            $(this).html( '<input type="text" class="form-control" placeholder="Buscar por '+ title +'" />' );  
        }
    } );

    // DataTable
    var table = $('#TableEquiposSilais').DataTable({
        "language":{
                    "emptyTable":     "No hay registros disponibles para esta tabla",
                    "info":           "Mostrando _START_ de _END_ de _TOTAL_ registros totales",
                    "infoEmpty":      "Showing 0 to 0 of 0 entries",
                    "infoFiltered":   "(Filtrado de _MAX_ total de registros)",
                    "infoPostFix":    "",
                    "thousands":      ",",
                    "lengthMenu":     "Mostrar _MENU_ registros",
                    "loadingRecords": "Cargando...",
                    "processing":     "Procesando...",
                    "search":         "Buscar:",
                    "zeroRecords":    "No hay coincidencias",
                    "paginate": {
                        "first":      "Primero",
                        "last":       "Ultimo",
                        "next":       "Siguiente",
                        "previous":   "Anterior"
                    },
                    "aria": {
                        "sortAscending":  ": Activar para ordenar la columna en forma ascendente",
                        "sortDescending": ": Activar para ordenar la columna en forma descendente"
                    }
                },
        dom: 'T<"clear">lfrtip',
        tableTools: {
            "sSwfPath": "//cdn.datatables.net/tabletools/2.2.0/swf/copy_csv_xls_pdf.swf",
            "sRowSelect": "multi",
            "aButtons": [
                {
                    "sExtends": "select_all",
                    "sButtonText": "Seleccionar todo",
                },
                {
                    "sExtends": "select_none",
                    "sButtonText": "Deseleccionar todo",
                },
                {
                    "sExtends": "pdf",
                    "sButtonText": "PDF",
                    "sPdfOrientation": "landscape",
                    "sPdfMessage": "Filtrado de datos",
                    "bSelectedOnly": true,
                     "oSelectorOpts": { filter: 'applied', order: 'current' },
                    "mColumns": [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]
                },
                {
                    "sExtends": "xls",
                    "sButtonText": "Excel",
                    "bSelectedOnly": true,
                    "mColumns": [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12],
                    "oSelectorOpts": {
                        page: 'current'
                    }
                }
            ]
        },
        "ordering": false,        
    });

    $('#TableEquiposSilais_filter').css("display","none");
    // Aplicar Busqueda
     table.columns().eq( 0 ).each( function ( colIdx ) {
        $( 'input', table.column( colIdx ).footer() ).on( 'keyup change', function () {
            table
                .column( colIdx )
                .search( this.value )
                .draw();
        } );
    } );
} );

</script>

@stop

