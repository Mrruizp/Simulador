
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
$(function(){

    //Aquí es donde te digo que le hablo al document, le ligo el evento, le digo que selectores y le paso lo que quiero que haga
    $( document ).on( 'click', '.foo', function(){
        var contador = document.getElementsByName("contador");
        if( $( this.id ))
        {
           var numPregunta = $(this.id);
        }
        if( $( this.name ))
        {
           var cPreg = $(this.name);
        }
            var numeroPregunta = numPregunta.selector;
            var codigo_pregunta = cPreg.selector;
        var resp = $(this).val();
       /* var val = document.getElementsByName("num2");//$('input:text[name=num2]').val();
        
        var valor = document.getElementsByName("num2")[selecto-1];
        var codPreg1 = document.getElementsByName("num1")[selecto-1];
        var codPreg2 = codPreg1.attributes[3].value;*/
        //var pregunta1 = document.getElementsByName("num2")[val-1];
        //var pregunta2 = $(pregunta1).val();
        //var pregunta3 = pregunta1.attributes[4].value;
        
      //Revisa en que status está el checkbox y controlalo según lo //desees
      if( $( this ).is( ':checked' ) ){
        //obtenerCodPregunta(pregunta3, val);
       // var codPregunta = $('input:text[name=codPreg]').val();
        guardarMiRespuesta(resp, codigo_pregunta, numeroPregunta);
      }
      else{
        resp = "falta";
        //obtenerCodPregunta(pregunta3, val);
       // var codPregunta = $('input:text[name=codPreg]').val();        
        guardarMiRespuesta(resp, codigo_pregunta, numeroPregunta);
      }
    });

});

function obtenerCodPregunta(pregunta, val) {
    $.post
            (
                    "../controller/obtenerCodigoPregunta.listar.controller.php",
                    {
                        p_pregunta: pregunta
                    }

                    ).done(function (resultado) {
                        var pregID = 0;
                        var datosJSON = resultado;

                        if (datosJSON.estado === 200) {
                            var html = "";
                            
                            $.each(datosJSON.datos, function (i, item) {
                             
                                html += '<input type="text" name="codPreg" id="codPreg" value="'+ item.pregunta_id +'">';
                                pregID = item;
                                //guardarMiRespuesta(pregunta, pregID);
                                
                            });




                        } else {
                            //swal("Mensaje del sistema", resultado , "warning");
                        }
                        
                    }).fail(function (error) {
                        var datosJSON = $.parseJSON(error.responseText);
                        //swal("Error", datosJSON.mensaje , "error"); 
                    });

                    
}

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
                            html += '<table id="tabla-listado" class="table table-responsive table-bordered">';
                            html += '<thead>';
                            html += '<tr style="background-color: #ededed; height:25px;">';
                            //html += '<th style="text-align:center">CODIGO</th>';
                            html += '<th style="text-align:center"><b>NÚMERO DE PREGUNTA<b/></th>';
                            html += '<th style="text-align:center"><b>MI RESPUESTA<b/></th>';
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
                                html += '<td align="center">' + item.numpregunta + '</td>';
                                
                                if(item.respuesta_usuario == "falta")
                                    html += '<td align="center"><p class="text-danger">Sin responder</p></td>';
                                else
                                    html += '<td align="center">' + item.respuesta_usuario + '</td>';
                                
                                html += '</tr>';
                            });

                            html += '</tbody>';
                            html += '</table>';
                            html += '</small>';

                            $("#listadoMisRespuestas").html(html);


                            $('#tabla-listadoMisRespuestas').dataTable({
                                "aaSorting": [[1, "des"]]
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
                        

                        if (datosJSON.estado === 200) {
                            var html = "";
                            var cont = 0;
                            html += '<small>';
                            html += '<table id="tabla-listado" class="table table-responsive table-bordered">';
                            html += '<thead>';
                            html += '<tr style="background-color: #ededed; height:25px;">';
                            html += '<th style="text-align:center"></th>';
                            html += '<th style="text-align:center"><h3><b><b/></h3></th>';
                            html += '<th style="text-align:center"><h3><b><b/></h3></th>';
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
                                html += '<td align="center" style="font-weight:normal">' + (cont+=1) + '</td>';
                                html += '<td align="left">' + item.nombre_pregunta + '</td>';
                                html += '<td align="left">';
                                html += '   <div class="form-group">';
                                html += '       <div class="checkbox">';
                                html += '           <label>';
                                                        if(item.alternativa1)
                                html += '               <input type="checkbox" id = "' + cont + '" name = "'+ item.pregunta_id +'" class="foo" value="' + item.alternativa1  + '">  '+ item.alternativa1 +'';                                               
                                html += '           </label>';
                                html += '       </div>';
                                html += '   </div><br/>';
                                html += '   <div class="form-group">';
                                html += '       <div class="checkbox">';
                                html += '           <label>';
                                                        if(item.alternativa2)
                                html += '               <input type="checkbox" id = "' + cont + '" name = "'+ item.pregunta_id +'" class="foo form-check-input" value="' + item.alternativa2  + '">  '+ item.alternativa2 +'';
                                html += '           </label>';
                                html += '       </div>';
                                html += '   </div><br/>';
                                html += '   <div class="form-group">';
                                html += '       <div class="checkbox">';
                                html += '           <label>';
                                                        if(item.alternativa3)
                                html += '               <input type="checkbox" id = "' + cont + '" name = "'+ item.pregunta_id +'" class="foo form-check-input" value="' + item.alternativa3  + '">  '+ item.alternativa3 +'';
                                html += '           </label>';
                                html += '       </div>';
                                html += '   </div><br/>';
                                html += '   <div class="form-group">';
                                html += '       <div class="checkbox">';
                                html += '           <label>';
                                                    if(item.alternativa4)
                                html += '               <input type="checkbox" id = "' + cont + '" name = "'+ item.pregunta_id +'" class="foo form-check-input" value="' + item.alternativa4  + '">  '+ item.alternativa4 +'';
                                html += '           </label>';
                                html += '       </div>';
                                html += '   </div>';
                                html += '   </td>'; 
                                html += '</td>';
                                html += '</tr>';
                            });

                            html += '</tbody>';
                            html += '</table>';
                            html += '</small>';

                            $("#listado").html(html);


                            $('#tabla-listado').dataTable({
                              //  "aaSorting": [[1, "des"]]
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
function guardarMiRespuesta(miRespuesta, codPregunta, numeroPregunta) {
    
     $.post(
                            "../controller/gestionarRespuestaPregunta.agregar.editar.controller.php",
                            {
                                p_respuesta: miRespuesta,
                                p_cod_pregunta: codPregunta,
                                p_numPregunta : numeroPregunta
                            }
                    ).done(function (resultado) {
                        var datosJSON = resultado;

                        if (datosJSON.estado === 200) {
                            //swal("Exito", datosJSON.mensaje, "success");
                            //$("#btncerrar").click(); //Cerrar la ventana 
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
/*
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
*/
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

