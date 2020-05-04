$(document).ready(function () {



    listarLog_inicioseseion();
    listarLog_usuario();
    //listar();
    //listar();
    //listar();
});

function listarLog_inicioseseion() {
    $.post
            (
                    "../controller/log_inicioseseion.listar.controller.php"

                    ).done(function (resultado) {
        var datosJSON = resultado;

        if (datosJSON.estado === 200) {
            var html = "";

            html += '<small>';
            html += '<table id="tabla-listadoLog_inicioseseion" class="table table-bordered table-striped">';
            html += '<thead>';
            html += '<tr style="background-color: #ededed; height:25px;">';
            html += '<th style="text-align:center">DNI</th>';
            html += '<th style="text-align:center">NOMBRES</th>';
            html += '<th style="text-align:center">APELLIDOS</th>';
            html += '<th style="text-align:center">CARGO</th>';
            html += '<th style="text-align:center">TIPO DE USUARIO</th>';
            html += '<th style="text-align:center">FECHA DE OPERACIÓN</th>';
            html += '<th style="text-align:center">HORA DE OPERACION</th>';
            html += '<th style="text-align:center">DIRECCIÓN IP</th>';
            html += '</tr>';
            html += '</thead>';
            html += '<tbody>';
            $.each(datosJSON.datos, function (i, item) {
                html += '<tr>';
                html += '<td align="center" style="font-weight:normal">' + item.doc_id +    '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.nombres +   '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.apellidos + '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.cargo +     '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.tipo +      '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.fecha +     '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.tiempo +    '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.ip +        '</td>';
                html += '</tr>';
            });

            html += '</tbody>';
            html += '</table>';
            html += '</small>';

            $("#listadoLog_inicioseseion").html(html);


            $('#tabla-listadoLog_inicioseseion').dataTable({
                "aaSorting": [[1, "asc"]],
                "scrollX": true
            });



        } else {
            //swal("Mensaje del sistema", resultado , "warning");
        }

    }).fail(function (error) {
        var datosJSON = $.parseJSON(error.responseText);
        //swal("Error", datosJSON.mensaje , "error"); 
    });
}

function listarLog_usuario() {
    $.post
            (
                    "../controller/log_usuario.listar.controller.php"

                    ).done(function (resultado) {
        var datosJSON = resultado;

        if (datosJSON.estado === 200) {
            var html = "";

            html += '<small>';
            html += '<table id="tabla-listadoLog_usuario" class="table table-bordered table-striped">';
            html += '<thead>';
            html += '<tr style="background-color: #ededed; height:25px;">';
            html += '<th style="text-align:center; background-color: #25c3ff;">DNI</th>';
            html += '<th style="text-align:center; background-color: #25c3ff;">NOMBRES</th>';
            html += '<th style="text-align:center; background-color: #25c3ff;">APELLIDOS</th>';
            html += '<th style="text-align:center; background-color: #25c3ff;">CARGO</th>';
            html += '<th style="text-align:center; background-color: #25c3ff;">TIPO</th>';
            html += '<th style="text-align:center; background-color: #25c3ff;">FECHA</th>';
            html += '<th style="text-align:center; background-color: #25c3ff;">HORA</th>';
            html += '<th style="text-align:center; background-color: #25c3ff;">IP</th>';
            html += '<th style="text-align:center; background-color: #7df2ae;">DNI</th>';
            html += '<th style="text-align:center; background-color: #7df2ae;">NOMBRES</th>';
            html += '<th style="text-align:center; background-color: #7df2ae;">APELLIDOS</th>';
            html += '<th style="text-align:center; background-color: #7df2ae;">DIRECCIÓN</th>';
            html += '<th style="text-align:center; background-color: #7df2ae;">TELEFONO</th>';
            html += '<th style="text-align:center; background-color: #7df2ae;">EMAIL</th>';
            html += '<th style="text-align:center; background-color: #7df2ae;">CARGO_ID</th>';
            html += '<th style="text-align:center; background-color: #7df2ae;">CURSO</th>';
            html += '<th style="text-align:center; background-color: #86fff6;">CLAVE</th>';
            html += '<th style="text-align:center; background-color: #86fff6;">TIPO</th>';
            html += '<th style="text-align:center; background-color: #86fff6;">ESTADO</th>';            
            html += '<th style="text-align:center;">OPERACION</th>';
            html += '</tr>';
            html += '</thead>';
            html += '<tbody>';
            $.each(datosJSON.datos, function (i, item) {
                html += '<tr>';
                html += '<td align="center" style="font-weight:normal">' + item.usuarioqueregistra_doc_id +         '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.usuarioqueregistra_nombres +        '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.usuarioqueregistra_apellidos +      '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.usuarioqueregistra_cargo_id +          '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.usuarioqueregistra_tipo +           '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.fecha +          '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.tiempo +         '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.ip +             '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.doc_id +         '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.nombres +        '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.apellidos +      '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.direccion +      '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.telefono +       '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.email +          '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.cargo_id +       '</td>';                
                html += '<td align="center" style="font-weight:normal">' + item.nombre_curso +   '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.clave +          '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.tipo +           '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.estado +         '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.tipo_operacion + '</td>';
                html += '</tr>';
            });

            html += '</tbody>';
            html += '</table>';
            html += '</small>';

            $("#listadoLog_usuario").html(html);


            $('#tabla-listadoLog_usuario').dataTable({
                "aaSorting": [[1, "asc"]],
                "scrollX": true
            });



        } else {
            //swal("Mensaje del sistema", resultado , "warning");
        }

    }).fail(function (error) {
        var datosJSON = $.parseJSON(error.responseText);
        //swal("Error", datosJSON.mensaje , "error"); 
    });
}



