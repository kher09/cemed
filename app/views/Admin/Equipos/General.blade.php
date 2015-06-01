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

	<div class="table-responsive">
		<h3 class="titul">Lista de equipos</h3>
		<table class="table table-hover table-striped table-bordered" id="TableEquipos" style="width:2850px;">
			<thead>
				<tr>
					<th>Acciones</th>
					<th>Silais</th>
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
					<th>Fecha Garantia</th>
					<th>Fecha Vida util</th>
				</tr>
			</thead>
			<tfoot>
				<tr>
					<th>Acciones</th>
					<th>Silais</th>
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
					<th>Fecha Garantia</th>
					<th>Fecha Vida util</th>
				</tr>
			</tfoot>

			<tbody>
				@foreach($Equipos as $value)
					<?php
						$Unidad = Unidad::find($value->id_unidad);
						$Silais=Silais::find($Unidad->id_silais);
						$Especialidad=Especialidad::find($value->id_especialidad);
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
					<td>{{$Silais->nombre}}</td>
					<td>{{$Unidad->tipo}} {{$Unidad->nombre}}</td>
					<td>{{$value->serie}}</td>				
					@if($value->tipo==0)
						<td>Equipo Medico</td>
					@else
						<td>Eqiupo No Medico</td>
					@endif
					<td>{{$Especialidad->nombre }}</td>
					<td>{{$value->marca }}</td>
					<td>{{$value->modelo }}</td>
					<td>{{$value->fabricante }}</td>
					@if($value->donacion==true)
					<td>{{$value->casacomercial }}</td>
					<td>Equipo donado por {{$value->donante }}</td>
					@else
					<td>{{$value->casacomercial }}</td>
					<td>{{$value->costo }}</td>
					@endif
					<td>{{date('d-F-Y', strtotime($value->fechainstalacion))}}</td>
					@if($value->ultimomantenimiento=="")
						<td>No se ha realizado mant.</td>
					@else
						<td>{{date('d/F/Y', strtotime($value->ultimomantenimiento))}}</td>
					@endif
					<td>{{date('d-F-Y', strtotime($value->proximomantenimiento)) }}</td>
					<td>{{date('d-F-Y', strtotime($value->garantia))}}</td>
					<td>{{date('d-F-Y', strtotime($value->vidautil))}}</td>
				</tr>
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
    $('#TableEquipos tfoot th').each( function () {

        if( $('#TableEquipos thead th').eq( $(this).index() ).text()!="Acciones"){
            var title = $('#TableEquipos thead th').eq( $(this).index() ).text();
            $(this).html( '<input type="text" class="form-control" placeholder="Buscar por '+ title +'" />' );  
        }
    } );

    // DataTable
    var table = $('#TableEquipos').DataTable({
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

    $('#TableEquipos_filter').css("display","none");
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