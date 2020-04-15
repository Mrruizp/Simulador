<?php
require_once 'validar.datos.sesion.view.php';

   $codigo_curso = $_GET["id"];
  // $codigo_pregunta = $_GET["pId"];

    //require_once '../controller/puestoSeleccionado.leer.datos.controller.php';

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="icon" href="../images/IPEV.jpg">
        <title> Campus Virtual | Simulador - Preguntas</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <?php include_once 'estilos.view.php'; ?>
</head>
    <body class="hold-transition skin-purple-light sidebar-mini">
        <!-- Site wrapper -->
        <div class="wrapper">

            <?php include_once './menu-arriba.admin.view.php'; ?>

            <!-- =============================================== -->

            <!-- Left side column. contains the sidebar -->
            <?php include_once './menu-izquierda.admin.view.php'; ?>

            <!-- =============================================== -->

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h3></h3>
                    <ol class="breadcrumb">
                        <li><a href="cursoContenidoSimulador.View.php?<?php echo $codigo_curso;?>"><i class="fa fa-dashboard"></i> Inicio del Simulador</a></li>
                        <li class="active">Preguntas del Simulador</li>
                        <!--<li class="active">User profile</li>-->
                    </ol>

<!--<button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#myModal" id="btnagregar"><img src="../images/actualizar_2.png"> AGREGAR </button>-->
                </section>  
                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-md-10">
                            <div class="box box-primary">
                                
                                <div class="box-body">
                                    <div>
                                        <div>
                                            
                                            <div class="">    
                                                <div class="text-center" style="background-color: #F7BE81">                                        
                                                    <h1 class="title text-primary"><i class="icon fa fa-pencil-square-o"></i><b> INSTRUCCIONES</b></h1><br/>
                                                </div>
                                                <div class="text-justify alert alert-warning">
                                                        <h5>
                                                            <i class="icon fa fa-check-square-o">
                                                                A continuación, se muestran las 40 preguntas del examen en 4 partes de 10 preguntas, en dónde podrá agregar; o actualizar su respuesta dándole click al botón " <i class="fa fa-save"></i> ", luego seleccione la opción de su respuesta <br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;y finalmente dandole click en el botón grabar.
                                                             </i>   
                                                        </h5>
                                                        <h5>
                                                            <i class="icon fa fa-check-square-o">
                                                                Recuerde que el examen tiene una duración de <b>60 minutos</b>.
                                                            </i>
                                                        </h5>
                                                    </div>
                                            </div><br/>
                                            <div class="box box-default"><br/>
                                                <div id="listado"></div>
                                            </div>
                                        </div>
                                        <div id="simulador" style="display:none;">
                                            <form id="formMostrarPreguntas">
                                                <div class="col-md-8 text-left">
                                                    <input type="hidden" name="textCursoID" id="textCursoID" value="<?php echo $codigo_curso ?>">
                                                    <h1>Simulador <button type="submit" class="btn btn-primary" aria-hidden="true"><i class="fa fa-laptop"></i> Entrar</button></h1>
                                                </div>
                                            </form>
                                            <br/><br/>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="box box-solid">
                                                        <div class="box-header with-border">
                                                          <h3 class="box-title">Número de preguntas: 40</h3><br/><br/>
                                                          <h3 class="box-title">Tiempo de respuesta: 60 minutos</h3><br/><br/>
                                                          <h3 class="box-title">Puntuación de aprobación: 65%</h3><br/><br/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="box box-primary">
                                
                                <div class="box-body">
                                    
                                    <div class="row text-center">
                                        <div class="col-md-12">
                                            <!--<input type="text" name="codigo_idS" id="codigo_idS" value="<?php echo $codigo_curso; ?>">-->
                                            <br/>
                                            <h1> <div 
                                                   name="timer" style="text-align:center; font-size: 30pt" 
                                                   id="timer" 
                                                   class="timer"
                                                   placeholder=""
                                                   readonly=""></div><br/>
                                            </h1>
                                            <small>
                                                <form id="frmGrabarCalificarPrueba">
                                                    <div class="row center">
                                                        <div class="col-xs-12">
                                                            
                                                                <input type="hidden" 
                                                                              name="txtCodPrueba" 
                                                                              id="txtCodPrueba"
                                                                              style="text-align:center;"
                                                                              value="<?php echo $codigo_curso; ?>" 
                                                                              required=""
                                                                              class="form-control input-sm text-bold"
                                                                              >
                                                            
                                                        </div>
                                                    </div>
                                                    <button type="submit" class="btn btn-danger" aria-hidden="true"><i class="fa fa-save"></i> Finalizar</button>
                                                </form>
                                            </small>
                                            <br/><br/>   
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="box box-primary">
                                
                                <div class="box-body">
                                    
                                    <div class="row text-center">
                                        <div class="col-md-12">
                                            <!--<input type="text" name="codigo_idS" id="codigo_idS" value="<?php echo $codigo_curso; ?>">-->
                                            <br/>
                                            <h2 class="text-yellow"> 
                                                MIS RESPUESTAS
                                            </h2><br/>
                                            <div id=listadoMisRespuestas></div>
                                          
                                               
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <small>
                        <form id="frmgrabar">
                            <div class="modal fade" id="myModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="titulomodal">Registrar Respuesta</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-xs-3">
                                                    <p>
                                                        Código Pregunta<input type="text" 
                                                                                name="txtCodPregunta" 
                                                                                id="txtCodPregunta" 
                                                                                required=""
                                                                                class="form-control input-sm" readonly="true">
                                                    </p>
                                                </div>
                                                <div class="col-xs-3">
                                                    <p>
                                                        Respuesta<input type="text" 
                                                                                name="txtResp" 
                                                                                id="txtResp" 
                                                                                required=""
                                                                                placeholder="ejemplo: a" 
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
                </section>
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
       <script src="js/preguntasSimulador.js" type="text/javascript"></script>
       <script src="js/cbCodigo.js" type="text/javascript"></script>
       <!--
        <script src="js/cbCodigo.js" type="text/javascript"></script>
        <script src="js/convocatoria.js" type="text/javascript"></script>
        <script src="js/puesto.js" type="text/javascript"></script>
        

    -->
    </body>
</html>