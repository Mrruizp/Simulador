function getParameterByName(name) { // extraer el id por get
    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
    results = regex.exec(location.search);
    return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}

$(document).ready(function () {

    //var cursoId = getParameterByName('id');
    eliminarRespuestas(getParameterByName('id'));
    listarMisRespuestas(getParameterByName('id'));
    //listarPregunta(getParameterByName('id'));
    //listarPregunta();
});

function eliminarRespuestas(codPrueba) {
    $.post
            (
                    "../controller/eliminarRespuestas.eliminar.controller.php",
                    {
                        p_codigo_curso: codPrueba
                    }

                    ).done(function (resultado) {
                        var datosJSON = resultado;

                        if (datosJSON.estado === 200) {
                           
                            listarPregunta(getParameterByName('id'));

                        } 

                    }).fail(function (error) {
                        var datosJSON = $.parseJSON(error.responseText);
                        //swal("Error", datosJSON.mensaje , "error"); 
        });

                    
}

function listarMisRespuestas(codPrueba) {
    $.post
            (
                    "../controller/misRespuestas.listar.controller.php",
                    {
                        p_codigo_curso: codPrueba
                    }

                    ).done(function (resultado) {
                        var datosJSON = resultado;

                        if (datosJSON.estado === 200) {
                            var html = "";

                            html += '<small>';
                            html += '<table id="" class="table table-responsive table-bordered">';
                            html += '<thead>';
                            html += '<tr style="background-color: #ededed; height:25px;">';
                            //html += '<th style="text-align:center">CODIGO</th>';
                            html += '<th style="text-align:center"><b>PREGUNTA ID<b/></th>';
                            html += '<th style="text-align:center"><b>MIS RESPUESTA<b/></th>';
                            //html += '<th style="text-align:center">RESPONDI</th>';
                            html += '</tr>';
                            html += '</thead>';
                            html += '<tbody>';
                            $.each(datosJSON.datos, function (i, item) {
                                $('.timer').timer({
                                    duration: '60m',
                                    countdown: true,
                                    callback: function () {
                                        location.href = "../view/resultadoSimulador.view.php?id="+ item.prueba_id +"";
                                    }
                                });
                                html += '<tr>';
                                html += '<td align="center">' + item.pregunta_id + '</td>';
                                html += '<td align="center">' + item.respuesta_usuario + '</td>';
                                html += '</tr>';
                            });

                            html += '</tbody>';
                            html += '</table>';
                            html += '</small>';

                            $("#listadoMisRespuestas").html(html);


                            $('#tabla-listadoMisRespuestas').dataTable({
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

function listarPregunta(codigo_curso) {
    $.post
            (
                    "../controller/preguntaSimulador.listar.controller.php",
                            {
                                p_codigo_curso: codigo_curso
                            }

                    ).done(function (resultado) {
                        var datosJSON = resultado;
                        var cont = 0;

                        if (datosJSON.estado === 200) {
                            var html = "";

                            html += '<small>';
                            html += '<table id="tabla-listado" class="table table-responsive table-bordered">';
                            html += '<thead>';
                            html += '<tr style="background-color: #ededed; height:25px;">';
                            html += '<th style="text-align:center">ID</th>';
                            html += '<th style="text-align:center"><h3><b>PREGUNTA<b/></h3></th>';
                            html += '<th style="text-align:center"><h3><b>GRABAR<b/></h3></th>';
                            //html += '<th style="text-align:center">RESPONDI</th>';
                            html += '</tr>';
                            html += '</thead>';
                            html += '<tbody>';
                            $.each(datosJSON.datos, function (i, item) {
                                $('.timer').timer({
                                    duration: '60m',
                                    countdown: true,
                                    callback: function () {
                                        //location.href = "../view/resultadoSimulador.view.php?id="+$('#txtCodPrueba').val()+"";
                                        location.href = "../view/resultadoSimulador.view.php?id="+ item.prueba_id +"";
                                    }
                                });
                                html += '<tr>';
                                html += '<td align="left" style="font-weight:normal">' + item.pregunta_id + '</td>';
                                html += '<td align="left">' + item.nombre_pregunta + '</td>';
                                html += '<td align="center">';
                                html += '<button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModal" onclick="leerDatos(' + item.pregunta_id + ')"><i class="fa fa-save"></i></button>';
                                html += '</td>';
                               /* if( item.respuesta_usuario  != null )
                                    html += '<td align="center">' + item.respuesta_usuario + '</td>';
                                else
                                    html += '<td align="center"></td>';
                                if(item.respuesta_usuario === null && item.doc_id !== $_SESSION["s_doc_id"])
                                    html += '<td align="center">-</td>';
                                else
                                    html += '<td align="center" style="color:blue";>Respondido</td>';
                                */
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

function leerDatos(codPregunta) {
    $.post
            (
                    "../controller/preguntaSimulador.leer.datos.controller.php",
                    {
                        p_codigo_pregunta: codPregunta
                    }
            ).done(function (resultado) {
        var jsonResultado = resultado;
        if (jsonResultado.estado === 200) 
        {
            //$("#txtTipoOperacion").val("editar");
            $("#txtResp").val(jsonResultado.datos.respuesta_usuario);
            $("#txtCodPregunta").val(jsonResultado.datos.pregunta_id);
            $("#titulomodal").html("Agregar o Modificar Respuesta");

            if(!jsonResultado.datos.pregunta_id) 
                $("#txtCodPregunta").val(codPregunta);
        }
    }).fail(function (error) {
        var datosJSON = $.parseJSON(error.responseText);
        swal("Error", datosJSON.mensaje, "error");
    });
}

$("#frmgrabar").submit(function (event) {
    event.preventDefault();

    swal({
        title: "Confirme",
        text: "¿Esta seguro de grabar los datos ingresados?",
        showCancelButton: true,
        confirmButtonColor: '#3d9205',
        confirmButtonText: 'Si',
        cancelButtonText: "No",
        closeOnConfirm: false,
        closeOnCancel: true,
        imageUrl: "../images/pregunta.png"
    },
            function (isConfirm) {

                if (isConfirm) { 
                    $.post(
                            "../controller/gestionarRespuestaPregunta.agregar.editar.controller.php",
                            {
                                p_cod_pregunta: $("#txtCodPregunta").val(),
                                p_respuesta: $("#txtResp").val()
                            }
                    ).done(function (resultado) {
                        var datosJSON = resultado;

                        if (datosJSON.estado === 200) {
                            swal("Exito", datosJSON.mensaje, "success");
                            $("#btncerrar").click(); //Cerrar la ventana 
                            //listarPregunta(getParameterByName('id')); //actualizar la lista
                            listarMisRespuestas(getParameterByName('id'));
                        } else {
                            swal("Mensaje del sistema", resultado, "warning");
                        }

                    }).fail(function (error) {
                        var datosJSON = $.parseJSON(error.responseText);
                        swal("Error", datosJSON.mensaje, "error");
                    });

                }
            });

});


$("#btnagregar").click(function () {
    
$("#titulomodal").html("Agregar nuevo Respuesta");
});


$("#myModal").on("shown.bs.modal", function () {
    $("#txtPuesto").focus();
});

$("#frmGrabarCalificarPrueba").submit(function (event) {
    event.preventDefault();

    swal({
        title: "Confirme",
        text: "¿Esta seguro que desea finalizar el examen?",
        showCancelButton: true,
        confirmButtonColor: '#3d9205',
        confirmButtonText: 'Si',
        cancelButtonText: "No",
        closeOnConfirm: false,
        closeOnCancel: true,
        imageUrl: "../images/pregunta.png"
    },
            function (isConfirm) {

                if (isConfirm) { 

                   location.href = "../view/resultadoSimulador.view.php?id="+$('#txtCodPrueba').val()+"";

                }
            });

});

