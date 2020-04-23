function listar() {
    $.post
            (
                    "../controller/gestionarCurso.listar.controller.php"

                    ).done(function (resultado) {
        var datosJSON = resultado;

        if (datosJSON.estado === 200) {
            var html = "";

            html += '<small>';
            html += '<table id="tabla-listado" class="table table-bordered table-striped">';
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
                html += '<button type="button" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#myModal" onclick="leerDatos(' + item.curso_id + ')"><i class="fa fa-pencil"></i></button>';
                html += '&nbsp;&nbsp;';
                html += '<button type="button" class="btn btn-danger btn-xs" onclick="eliminar(' + item.curso_id + ')"><i class="fa fa-close"></i></button>';
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
                                location.href = "../view/pruebaSimulador.view.php";
                                swal("Iniciando Sesión", "", "success");
                                    
                                break;
                            }
                        //}

                    }).fail(function (error) {
                        var datosJSON = $.parseJSON(error.responseText);
                        swal("Error", datosJSON.mensaje, "error");
                    });

                
           

});

