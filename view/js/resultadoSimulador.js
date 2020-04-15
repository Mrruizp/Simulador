
function getParameterByName(name) { // extraer el id por get
    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
    results = regex.exec(location.search);
    return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}
$(document).ready(function () {

    //listarResultadoSimulador();
    //listarResultadoSimulador_detalle(getParameterByName('id'));
    calificarNull(getParameterByName('id'));
});



function calificarNull(codPrueba) {
    $.post
            (
                    "../controller/calificarNull.agregar.controller.php",
                    {
                        p_codigo_curso: codPrueba
                    }

                    ).done(function (resultado) {
                        var datosJSON = resultado;

                        if (datosJSON.estado === 200) {
                           
                            listarResultadoSimulador();
                            listarResultadoSimulador_detalle(getParameterByName('id'));

                        } 

                    }).fail(function (error) {
                        var datosJSON = $.parseJSON(error.responseText);
                        //swal("Error", datosJSON.mensaje , "error"); 
        });

                    
}

function listarResultadoSimulador() {
    $.post
            (
                    "../controller/respuestaSimulador.listar.controller.php"

                    ).done(function (resultado) {
        var datosJSON = resultado;

        if (datosJSON.estado === 200) {
            var html = "";

            html += '<small>';
            html += '<table id="" class="table table-responsive table-bordered">';
            html += '<thead>';
            html += '<tr style="background-color: #394394; height:25px;">';
            html += '<th style="text-align:center; color:#ffffff"><b>PORCENTAJE</b></th>';
            html += '<th style="text-align:center; color:#ffffff"><b>ESTADO</b></th>';
            html += '</tr>';
            html += '</thead>';
            html += '<tbody>';
            $.each(datosJSON.datos, function (i, item) {
                
                html += '<tr>';
                html += '<td align="center"><h4><b>' + item.porcentaje + '%</b></h4></td>';
                html += '<td align="center"><h4><b>' + item.descripcion + '</b></h4></td>';
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

function listarResultadoSimulador_detalle(codPrueba) {
    $.post
            (
                    "../controller/resultado.detalle.listar.controller.php",
                    {
                        p_codigo_curso: codPrueba
                    }

                    ).done(function (resultado) {
        var datosJSON = resultado;

        if (datosJSON.estado === 200) {
            var html = "";
            html += '<small>';
            html += '<table id="tabla-listado" class="table table-bordered ">';
            html += '<thead>';
            html += '<tr style="background-color: #394394; height:25px;">';
            html += '<th style="text-align:center; color:#ffffff">PREGUNTA</th>';
            html += '<th style="text-align:center; color:#ffffff">RESPUESTA</th>';
            html += '<th style="text-align: center; color:#ffffff">MI RESPUESTA</th>';
            html += '<th style="text-align: center; color:#ffffff">ESTADO</th>';
            html += '</tr>';
            html += '</thead>';
            html += '<tbody>';
            $.each(datosJSON.datos, function (i, item) {
                
                html += '<tr>';
                html += '<td align="left" style="font-weight:normal">' + item.nombre_pregunta + '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.respuesta + '</td>';
                if(!item.respuesta_usuario)
                    html += '<td align="center" style="font-weight:normal">sin respuesta</td>';
                else
                    html += '<td align="center" style="font-weight:normal">' + item.respuesta_usuario + '</td>';
                
                if(item.estado === 'Incorrecto' || !item.estado)
                    html += '<td align="center"><i class="fa fa-close"></i></td>';
                else
                    html += '<td align="center"><i class="fa fa-check"></i></td>';
                html += '</tr>';
            });

            html += '</tbody>';
            html += '</table>';
            html += '</small>';
            $("#listarResultadosDetalle").html(html);


            $('#tabla-listarResultadosDetalle').dataTable({
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