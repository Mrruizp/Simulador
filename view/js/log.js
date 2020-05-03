$(document).ready(function () {
    listarLog_inicioseseion();
    //listarLog_usuario();
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


$("#frmgrabar1").submit(function (event) {
    event.preventDefault();


              

                    //listar();

                    $.post(
                            "../controller/sesion.validar.controller.php",
                            {
                                p_email: $("#txtEmail").val(),
                                p_clave: $("#txtClave").val()
                            }
                    ).done(function (resultado) {
                     //   var datosJSON = resultado;

                       // if (datosJSON.datos === "SI") {
                        //    location.href = "../view/resultadoSimulador.view.php?id";
                       // } else {
                            switch (resultado.datos) 
                            {
                                case "CI":
                                    swal("Contraseña incorrecta", "vuelva a ingresar contraseña", "error");
                                    break;

                                case "IN":
                                    swal("Usuario inactivo incorrecta", "Consulte con su administrador", "error");
                                    break;

                                case "NE":
                                    swal("Usuario no existe", "vuelva a ingresar usuario", "error");
                                    break;

                                default: //SI
                                numSesion();
                                
                                break;
                            }
                        //}

                    }).fail(function (error) {
                        var datosJSON = $.parseJSON(error.responseText);
                        swal("Error", datosJSON.mensaje, "error");
                    });

                
           

});

function numSesion()
{

    $.post
            (
                    "../controller/numSesion.agregar.controller.php"

                    ).done(function (resultado) {
        var datosJSON = resultado;

        if (datosJSON.estado === 200) {
            location.href = "../view/reporteEstadistico.view.php";
                                swal("Iniciando Sesión", "", "success");
                


        } else {
            //swal("Mensaje del sistema", resultado , "warning");
        }

    }).fail(function (error) {
        var datosJSON = $.parseJSON(error.responseText);
        //swal("Error", datosJSON.mensaje , "error"); 
    });
}

