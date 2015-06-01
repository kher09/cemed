@extends('templates.SilaisTemplate')
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
	<style>
	table.dataTable tbody tr.selected {
	  background-color: #b0bed9;
	}

	</style>
	
	<div class="table-responsive">
		<h2 class="titul">Unidades del <?php $usuario = User::find(Auth::user()->id)->UserSilais()->first(); $Silais=Silais::find($usuario->id_silais); ?>{{$Silais->nombre}}</h2>
			<table class="table table-hover" id="SilaisTablaUnidad">
				<thead>
					<tr>
						<th>Accion</th>
						<th>Tipo</th>
						<th>Nombre</th>
						<th>Direccion</th>
						<th>Telefono</th>
					</tr>
				</thead>
				<tfoot>
					<tr>
						<th></th>
						<th>Tipo</th>
						<th>Nombre</th>
						<th>Direccion</th>
						<th>Telefono</th>
					</tr>
				</tfoot>
				<tbody>
					@foreach($Unidades as $value)
							<tr>
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
	
</div>
@stop
@section('Scripts')
{{ HTML::script('media/ZeroClipboard/ZeroClipboard.js') }}
<script type="text/javascript">
$(document).ready(function() {
    //Inicio Tabla Mostrar Unidades Silais
    $('#SilaisTablaUnidad tfoot th').each( function () {

        if( $('#SilaisTablaUnidad thead th').eq( $(this).index() ).text()!="Accion"){
            var title = $('#SilaisTablaUnidad thead th').eq( $(this).index() ).text();
            $(this).html( '<input type="text" class="form-control" placeholder="Buscar por '+ title +'" />' );  
        }
        
    } );

    // DataTable
    var table = $('#SilaisTablaUnidad').DataTable({
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
                    "mColumns": [1, 2, 3]
                },
                {
                    "sExtends": "xls",
                    "sButtonText": "Excel",
                    "bSelectedOnly": true,
                    "mColumns": [1, 2, 3],
                    "oSelectorOpts": {
                        page: 'current'
                    }
                }
            ]
        },
        "ordering": false, 
    });

    $('#SilaisTablaUnidad_filter').css("display","none");
    // Aplicar Busqueda
     table.columns().eq( 0 ).each( function ( colIdx ) {
        $( 'input', table.column( colIdx ).footer() ).on( 'keyup change', function () {
            table
                .column( colIdx )
                .search( this.value )
                .draw();
        } );
    } );
});

    
</script>
@stop