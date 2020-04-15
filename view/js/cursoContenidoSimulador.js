/*$(document).ready(function () {
    listarContenidoSimulador();
});
*/

function listarContenidoSimulador(codigo_curso) {
    $.post
            (
                    "../controller/cursoContenidoSimulador.controller.php",
                            {
                                p_codigo_curso: p_codigo_curso
                            }

                    ).done(function (resultado) {
        var datosJSON = resultado;

        if (datosJSON.estado === 200) {
            var html = "";

            html += '<small>';
            html += '<table id="tabla-listadoC" class="table table-bordered table-striped">';
            html += '<thead>';
            html += '<tr style="background-color: #ededed; height:25px;">';
            html += '<th style="text-align:center">CODIGO</th>';
            html += '<th style="text-align:center">CURSO</th>';
            html += '<th style="text-align: center">OPCIONES</th>';
            html += '</tr>';
            html += '</thead>';
            html += '<tbody>';
            $.each(datosJSON.datos, function (i, item) {
                html += '<tr>';
                html += '<td align="center" style="font-weight:normal">' + item.curso_id + '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.nombre_curso + '</td>';
                html += '<td align="center">';
                html += '<button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#myModal" onclick="leerDatos(' + item.curso_id + ')"><i class="fa fa-pencil"></i></button>';
                html += '&nbsp;&nbsp;';
                html += '<button type="button" class="btn btn-default btn-xs" onclick="eliminar(' + item.curso_id + ')"><i class="fa fa-close"></i></button>';
                html += '</td>';
                html += '</td>';
                html += '</tr>';
            });

            html += '</tbody>';
            html += '</table>';
            html += '</small>';

            $("#listado").html(html);


            $('#tabla-listado').dataTable({
                "aaSorting": [[1, "asc"]]
            });



        } else {
            //swal("Mensaje del sistema", resultado , "warning");
        }

    }).fail(function (error) {
        var datosJSON = $.parseJSON(error.responseText);
        //swal("Error", datosJSON.mensaje , "error"); 
    });
}



$("#frmListarContenido").submit(function (event) {
    event.preventDefault();
          
                 
                            p_codigo_curso = "#codigo_idC";
                            listarContenidoSimulador(p_codigo_curso);                     
                  


});

$("#frmListarSimulador").submit(function (event) {
    event.preventDefault();
          
                if (isConfirm) {
                    $.post(
                            p_codigo_curso = "#codigo_idS"
                            listarContenidoSimulador(p_codigo_curso)
                    ).done(function (resultado) {
                        var datosJSON = resultado;
                        if (datosJSON.estado === 200) { //ok
                            listar();
                            swal("Exito", datosJSON.mensaje, "success");
                        }

                    }).fail(function (error) {
                        var datosJSON = $.parseJSON(error.responseText);
                        swal("Error", datosJSON.mensaje, "error");
                    });

                }
                                
                  


});
