<?php
require_once 'validar.datos.sesion.view.php';
//      $dniSesion= $_SESSION["s_doc_id"] ;
//require_once '../logic/Sesion.class.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="icon" href="../images/IPEV.jpg">
        <title>Simulador</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <?php include_once 'estilos.view.php'; ?>
</head>
    <style>
        #myModal{
            padding: 30px 0 0 0; 
            width: 100% !important;
            position: absolute;
            
        }
        #modalPrueba{
            padding: 30px 0 0 0; 
            width: 100% !important;
            position: absolute;
        }
        #myModalPreguntaForm{
            padding: 30px 0 0 0; 
            width: 100% !important;
            position: absolute;
        }

    </style>
    <body class="hold-transition skin-purple-light sidebar-mini">
        <!-- Site wrapper -->
        <div class="wrapper">

            <?php include_once './menu-arriba.admin.view.php'; ?>

            <!-- =============================================== -->

            <!-- Left side column. contains the sidebar -->
            <?php include_once './menu-izquierda.admin.view.php'; ?>

            <!-- =============================================== -->

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper"><br/>
               <!-- /.col -->
                <div class="col-md-12 box box-primary">
                  <div class="nav-tabs-custom tab-primary">
                    <ul class="nav nav-tabs">
                      <p>
                          <li class="active"><a href="#activity" data-toggle="tab">CURSOS</a></li>
                          <li><a href="#timeline" data-toggle="tab">PRUEBAS</a></li>
                          <li><a href="#settings" data-toggle="tab">PREGUNTAS</a></li>
                      </p>
                    </ul>
                    <div class="tab-content">
                      <div class="active tab-pane" id="activity">
                        <!-- Post -->
                        <div class="post">
                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal" id="btnagregar"><i class="fa fa-plus"> Agregar nuevo curso </i></button>
                          <!-- /.user-block -->
                              <div class="box-body">
                                <div id="listado"></div>
                            </div>
                        </div>
                        <!-- /.post -->
                      </div>
                      <!-- /.tab-pane -->
                      <div class="tab-pane" id="timeline">
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModalPrueba" id="btnagregarPrueba"><i class="fa fa-plus"> Agregar nueva Prueba </i></button>
                        <div class="box-body">
                            <div id="listadoPrueba"></div>
                        </div>
                      </div>
                      <div class="tab-pane" id="settings">
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModalPregunta" id="btnagregarPregunta"><i class="fa fa-plus"> Agregar nueva pregunta </i></button>
                        <div class="box-body">
                            <div id="listadoPregunta"></div>
                        </div>
                      </div>
                      <!-- /.tab-pane -->
                    </div>
                    <!-- /.tab-content -->
                  </div>
                  <!-- /.nav-tabs-custom -->
                </div>
                <!-- INICIO del formulario modal -->
                    <small>
                        <form id="frmgrabar">
                            <div class="modal fade" id="myModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-sm">
                                    <div class="modal-content">
                                        <div class="modal-header bg-primary">
                                            <!--<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>-->
                                            <h4 class="modal-title" id="titulomodal">Registrar curso</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-xs-4">
                                                    <p>
                                                        <input type="hidden" value="" id="txtTipoOperacion" name="txtTipoOperacion">
                                                        Código <input type="text" 
                                                                      name="txtCodigo" 
                                                                      id="txtCodigo" 
                                                                      class="form-control input-sm" 
                                                                      readonly="true">
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xs-12">
                                                    <p>
                                                        Nombre del curso<input type="text" 
                                                                                name="txtCurso" 
                                                                                id="txtCurso" 
                                                                                required=""
                                                                                class="form-control input-sm">
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-warning" aria-hidden="true"><i class="fa fa-save"></i> Grabar</button>
                                            <button type="button" class="btn btn-danger" data-dismiss="modal" id="btncerrar"><i class="fa fa-close"></i> Cerrar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </small>
                    <!-- INICIO del formulario modal -->
                    <small>
                        <form id="frmgrabarPrueba">
                            <div class="modal fade" id="myModalPrueba" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-md">
                                    <div class="modal-content">
                                        <div class="modal-header bg-primary">
                                            <h4 class="modal-title" id="titulomodalPrueba">Registrar prueba</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-xs-4">
                                                    <p>
                                                        <input type="hidden" value="" id="txtTipoOperacionPrueba" name="txtTipoOperacionPrueba">
                                                        Código <input type="text" 
                                                                      name="txtPrueba_id" 
                                                                      id="txtPrueba_id" 
                                                                      class="form-control input-sm"
                                                                      readonly="true">
                                                    </p>
                                                </div>
                                                <div class="col-xs-8">
                                                    <p>
                                                        Curso
                                                        <select size="1" style="font-weight:normal;" id="textCursoId" name="textCursoId" class="form-control has-feedback-left" required>
                                                            <option>-</option>
                                                            <option value="1">Agile Coach</option>
                                                            <option value="2">Innovation Management</option>
                                                            <option value="3">Kanban</option>
                                                            <option value="4">Scrum Master</option>
                                                            <option value="5">Scrum Foundation</option>
                                                            <option value="6">Scrum Developer</option>
                                                            <option value="7">Scrum Advanced</option>
                                                            <option value="8">Scrum Product Owner</option>
                                                            <option value="9">Iso 27001 Auditor</option>
                                                            <option value="0">Iso 27001 Lead Auditor</option>
                                                            <option value="11">Iso 27001 Foundation</option>
                                                            <option value="12">Iso 22301 Auditor</option>
                                                            <option value="13">Iso 22301 Lead Auditor</option>
                                                            <option value="14">Iso 22301 Foundation</option>
                                                            <option value="15">Iso 20000 Auditor</option>
                                                            <option value="16">Iso 20000 Lead Auditor</option>
                                                            <option value="17">Iso 20000 Foundation</option>
                                                            <option value="18">Cybersecurity</option>
                                                            <option value="19">Six Sigma</option>
                                                            <option value="20">DevOps Essentials</option>
                                                            <option value="21">DevOps Culture</option>
                                                            <option value="22">Marketing Digital</option>
                                                            <option value="23">Big Data</option>
                                                            <option value="24">Design Thinking</option>
                                                            <option value="25">Service Desk</option>
                                                            <option value="26">Agile Business Owner</option>

                                                        </select>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xs-4">
                                                    <p>
                                                        #Preguntas
                                                        <select size="1" style="font-weight:normal;" id="textCant_preguntas" name="textCant_preguntas" class="form-control has-feedback-left" required>
                                                            <option>-</option>
                                                            <option value="10">10</option>
                                                            <option value="15">15</option>
                                                            <option value="20">20</option>
                                                            <option value="25">25</option>
                                                            <option value="30">30</option>
                                                            <option value="35">35</option>
                                                            <option value="40">40</option>
                                                            <option value="45">45</option>
                                                            <option value="50">50</option>

                                                        </select>
                                                    </p>
                                                </div>
                                                <div class="col-xs-4">
                                                    <p>
                                                        Tiempo
                                                        <select size="1" style="font-weight:normal;" id="textTiempo" name="textTiempo" class="form-control has-feedback-left" required>
                                                            <option>-</option>
                                                            <option value="10">10 minutos</option>
                                                            <option value="15">15 minutos</option>
                                                            <option value="20">20 minutos</option>
                                                            <option value="25">25 minutos</option>
                                                            <option value="30">30 minutos</option>
                                                            <option value="35">35 minutos</option>
                                                            <option value="40">40 minutos</option>
                                                            <option value="45">45 minutos</option>
                                                            <option value="50">50 minutos</option>
                                                            <option value="55">55 minutos</option>
                                                            <option value="60">60 minutos</option>

                                                        </select>
                                                    </p>
                                                </div>
                                                <div class="col-xs-4">
                                                    <p>
                                                        Mínimo de Aprobación
                                                        <select size="1" style="font-weight:normal;" id="txtPuntaje" name="txtPuntaje" class="form-control has-feedback-left" required>
                                                            <option>-</option>
                                                            <option value="10">10%</option>
                                                            <option value="15">15%</option>
                                                            <option value="20">20%</option>
                                                            <option value="25">25%</option>
                                                            <option value="30">30%</option>
                                                            <option value="35">35%</option>
                                                            <option value="40">40%</option>
                                                            <option value="45">45%</option>
                                                            <option value="50">50%</option>
                                                            <option value="55">55%</option>
                                                            <option value="60">60%</option>

                                                        </select>
                                                    </p>
                                                </div>
                                            </div>
                                            <!--<div class="row">
                                                <div class="col-xs-12">
                                                    <p>
                                                        Instrucciones (*)
                                                        <textarea type="text" class="form-control" id="txtInstrucciones" style="font-weight:normal; " name="txtInstrucciones" required="" rows="6">

                                                        </textarea>
                                                    </p>
                                                </div>
                                            </div>-->
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-warning" aria-hidden="true"><i class="fa fa-save"></i> Grabar</button>
                                            <button type="button" class="btn btn-danger" data-dismiss="modal" id="btncerrarP"><i class="fa fa-close"></i> Cerrar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </small>
                    <!-- INICIO del formulario modal -->
                    <small>
                        <form id="frmgrabarPregunta">
                            <div class="modal fade" id="myModalPregunta" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header bg-primary">
                                            <h4 class="modal-title" id="titulomodalPregunta">Registrar pregunta</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-xs-3">
                                                    <p>
                                                        <input type="hidden" value="" id="txtTipoOperacionPregunta" name="txtTipoOperacionPregunta">
                                                        Código <input type="text" 
                                                                      name="txtPregunta_id" 
                                                                      id="txtPregunta_id" 
                                                                      class="form-control input-sm" 
                                                                      readonly="">
                                                    </p>
                                                </div>
                                                <div class="col-xs-4">
                                                    <p>
                                                        <label class="control-label">Prueba</label>
                                                        <select size="1" style="font-weight:normal;" id="textPrueba_id" name="textPrueba_id" class="form-control has-feedback-left" required>
                                                            <option>-</option>
                                                            <option value="1">Agile Coach</option>
                                                            <option value="2">Innovation Management</option>
                                                            <option value="3">Kanban</option>
                                                            <option value="4">Scrum Master</option>
                                                            <option value="5">Scrum Foundation</option>
                                                            <option value="6">Scrum Developer</option>
                                                            <option value="7">Scrum Advanced</option>
                                                            <option value="8">Scrum Product Owner</option>
                                                            <option value="9">Iso 27001 Auditor</option>
                                                            <option value="0">Iso 27001 Lead Auditor</option>
                                                            <option value="11">Iso 27001 Foundation</option>
                                                            <option value="12">Iso 22301 Auditor</option>
                                                            <option value="13">Iso 22301 Lead Auditor</option>
                                                            <option value="14">Iso 22301 Foundation</option>
                                                            <option value="15">Iso 20000 Auditor</option>
                                                            <option value="16">Iso 20000 Lead Auditor</option>
                                                            <option value="17">Iso 20000 Foundation</option>
                                                            <option value="18">Cybersecurity</option>
                                                            <option value="19">Six Sigma</option>
                                                            <option value="20">DevOps Essentials</option>
                                                            <option value="21">DevOps Culture</option>
                                                            <option value="22">Marketing Digital</option>
                                                            <option value="23">Big Data</option>
                                                            <option value="24">Design Thinking</option>
                                                            <option value="25">Service Desk</option>
                                                            <option value="26">Agile Business Owner</option>
                                                        </select>
                                                    </p>
                                                </div>
                                                <div class="col-xs-3">
                                                    <p>
                                                        <label class="control-label">Número de alternativas</label>
                                                        <select style="font-weight:normal;" class="form-control has-feedback-left" id="status" name="status" onChange="mostrar(this.value);">
                                                            <option value="0" SELECTED>Seleccionar una opción </option>
                                                            <option value="alternativa1">1</option>
                                                            <option value="alternativa2">2</option>
                                                            <option value="alternativa3">3</option>
                                                            <option value="alternativa4">4</option>
                                                        </select>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xs-12">
                                                    
                                                        <!-- /.box-header -->
                                                        <div class="box-body pad">
                                                            <p>
                                                                <label class="control-label">Pregunta</label>
                                                                <textarea id="editor1" 
                                                                          name="editor1" 
                                                                          class = "ckeditor" cols="10">

                                                                </textarea>
                                                            </label>
                                                        </div>
                                                </div>
                                            </div>
                                            
                                            <div class="row">
                                                <div class="col-xs-12" id="alternativa1" style="display: none;">
                                                    <p>
                                                        Alternativa 1
                                                        <input type="text" 
                                                                      name="textAlternativa1" 
                                                                      id="textAlternativa1" 
                                                                      class="form-control input-md">
                                                    </p>
                                                </div>  
                                                <div class="col-xs-12" id="alternativa2" style="display: none;">
                                                    <p>
                                                        Alternativa 2
                                                        <input type="text" 
                                                                      name="textAlternativa2" 
                                                                      id="textAlternativa2" 
                                                                      class="form-control input-md">
                                                    </p>
                                                </div>                                     
                                            </div>
                                            <div class="row">
                                                <div class="col-xs-12" id="alternativa3" style="display: none;">
                                                    <p>
                                                        Alternativa 3
                                                        <input type="text" 
                                                                      name="textAlternativa3" 
                                                                      id="textAlternativa3" 
                                                                      class="form-control input-md">
                                                    </p>
                                                </div>  
                                                <div class="col-xs-12" id="alternativa4" style="display: none;">
                                                    <p>
                                                        Alternativa 4
                                                        <input type="text" 
                                                                      name="textAlternativa4" 
                                                                      id="textAlternativa4" 
                                                                      class="form-control input-md">
                                                    </p>
                                                </div>                                     
                                            </div>
                                            <div class="row">
                                                <div class="col-xs-12">
                                                    <p>
                                                        Respuesta
                                                        <input type="text" 
                                                                      name="txtRespuesta" 
                                                                      id="txtRespuesta" 
                                                                      class="form-control input-md">
                                                    </p>
                                                </div>                                     
                                            </div>
                                            <!--<div class="row">
                                                <div class="col-xs-3">
                                                    <p>
                                                        Respuesta
                                                        <select size="1" style="font-weight:normal;" id="txtRespuesta" name="txtRespuesta" class="form-control has-feedback-left" required>
                                                            <option>-</option>
                                                            <option value="a">a</option>
                                                            <option value="b">b</option>
                                                            <option value="c">c</option>
                                                            <option value="d">d</option>

                                                        </select>
                                                    </p>
                                                </div>                                      
                                            </div>-->
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-warning" aria-hidden="true"><i class="fa fa-save"></i> Grabar</button>
                                            <button type="button" class="btn btn-danger" data-dismiss="modal" id="btncerrarPregunta"><i class="fa fa-close"></i> Cerrar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </small>
            </div>
            <!-- /.content-wrapper -->

            <?php include_once 'pie.view.php'; ?>

            <!-- Control Sidebar -->
            <?php include_once 'opciones-derecha.view.php'; ?>
            <!-- /.control-sidebar -->
            <div class="control-sidebar-bg"></div>
        </div>
        <!-- ./wrapper -->
        <?php include_once 'scripts.view.php'; ?>
        <script>
            $(function () {

                // We can attach the `fileselect` event to all file inputs on the page
                $(document).on('change', ':file', function () {
                    var input = $(this),
                            numFiles = input.get(0).files ? input.get(0).files.length : 1,
                            label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
                    input.trigger('fileselect', [numFiles, label]);
                });

                // We can watch for our custom `fileselect` event like this
                $(document).ready(function () {
                    $(':file').on('fileselect', function (event, numFiles, label) {

                        var input = $(this).parents('.input-group').find(':text'),
                                log = numFiles > 1 ? numFiles + ' files selected' : label;

                        if (input.length) {
                            input.val(log);
                        } else {
                            if (log)
                                alert(log);
                        }

                    });
                });

            });
        </script>   
       <script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.7.2/angular.min.js"></script> 
       <script src="js/gestionarCurso.js" type="text/javascript"></script>
       <script src="js/cbCodigo.js" type="text/javascript"></script>
       <!--
        <script src="js/cbCodigo.js" type="text/javascript"></script>
        <script src="js/convocatoria.js" type="text/javascript"></script>
        <script src="js/puesto.js" type="text/javascript"></script>
        

    -->
    </body>
</html>