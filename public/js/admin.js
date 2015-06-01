$(document).ready(main);

function main(){
    $('#admins').dataTable({
        "language": {
            "url": "http://cdn.datatables.net/plug-ins/3cfcc339e89/i18n/Spanish.json"
        }
    });
    $('#Cemed').dataTable({
        "language": {
            "url": "http://cdn.datatables.net/plug-ins/3cfcc339e89/i18n/Spanish.json"
        }
    }); 
    $('#Silais').dataTable({
        "language": {
            "url": "http://cdn.datatables.net/plug-ins/3cfcc339e89/i18n/Spanish.json"
        }
    }); 
    $('#UsuariosUnidades').dataTable({
        "language": {
            "url": "http://cdn.datatables.net/plug-ins/3cfcc339e89/i18n/Spanish.json"
        }
    });
    $('#TableEquiposUnidad').dataTable({
        "language": {
            "url": "http://cdn.datatables.net/plug-ins/3cfcc339e89/i18n/Spanish.json"
        }
    });


    $('#TableEspecialidad').dataTable({
        "language": {
            "url": "http://cdn.datatables.net/plug-ins/3cfcc339e89/i18n/Spanish.json"
        }

    });

    $("#CostoMonetario").maskMoney();

    $('select#rol').on('change',function(){
        var rol = $(this).val();
         if(rol==0 || rol==1){
             $('.Silais').css("display","none");
             $('.Unidad').css("display","none");
        }
        if(rol==2){
        	 $('.Silais').css("display","block");
             $('.Unidad').css("display","none");
        }
        if(rol==3){
        	 $('.Silais').css("display","block");
        	 $('.Unidad').css("display","block");

             CargarUnidad($('select#silais option:selected').val());
        }
    });

    $('select#tipoEquipo').on('change',function(){
        var tipoEquipo = $(this).val();
         if(tipoEquipo==0){
             $('#EspecialidadMedica').css("display","block");
             $('#EspecialidadNoMedica').css("display","none");
        }
        if(tipoEquipo==1){
             $('#EspecialidadMedica').css("display","none");
             $('#EspecialidadNoMedica').css("display","block");
        }
    });

    $('#telefono').mask('0000-0000');

    $( "select#rol option" ).each(function(){
        if($('#rol').data('select') == $(this).val()){
            $(this).attr('selected', 'selected');

            if($('#rol').data('select') == 0 || $('#rol').data('select')== 1){
                $('.Silais').css("display","none");
                $('.Unidad').css("display","none");
            }

            if($('#rol').data('select') == 2){
                $('.Silais').css("display","block");
                $('.Unidad').css("display","none");
                
                $( "select#silais option" ).each(function(){
                    if($('#silais').data('select') == $(this).val()){
                        $(this).attr('selected', 'selected');
                    }
                });
            }

            if($('#rol').data('select') == 3){
                $('.Silais').css("display","block");
                $('.Unidad').css("display","block");

                $( "select#silais option" ).each(function(){
                    if($('#silais').data('select') == $(this).val()){
                        $(this).attr('selected', 'selected');
                    }
                });

                $( "select#unidad option" ).each(function(){
                    if($('#unidad').data('select') == $(this).val()){
                        $(this).attr('selected', 'selected');
                    }
                });
            }
        }
    });
}