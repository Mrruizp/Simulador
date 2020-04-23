<?php
require_once 'validar.datos.sesion.view.php';

   $codigo_curso = $_GET["id"];

    //require_once '../controller/puestoSeleccionado.leer.datos.controller.php';

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="icon" href="../images/IPEV.jpg">
        <title> Simulador</title>
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
                        <li><a href="menu.principal.view.php"><i class="fa fa-certificate"></i> Certificados</a></li>
                        <li class="active">Inicio del Simulador</li>
                        <!--<li class="active">User profile</li>-->
                    </ol>

<!--<button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#myModal" id="btnagregar"><img src="../images/actualizar_2.png"> AGREGAR </button>-->
                </section>  
                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-md-9">
                            <div class="box box-primary">
                                
                                <div class="box-body">
                                    <div>
                                        <div id="simulador">
                                            <div class="row">
                                                <div class="col-md-8 text-left">
                                                   
                                                    <h1 class="text-bold">Simulador
                                                    <!--<h1>Simulador <button type="submit" class="btn btn-primary" aria-hidden="true"><i class="fa fa-laptop"></i> Entrar</button></h1>-->
                                                </div>
                                            </div>
                                            <br/><br/>
                                            <div class="text-center">
                                                <div class="">
                                                    <div style="background-color: #F7BE81">
                                                        <h1 class="title text-primary"><i class="icon fa fa-laptop"><b> Introducción</b></i></h1><br/>
                                                    </div>
                                                    <div class="text-justify alert alert-warning">
                                                        <h4>
                                                            <i class="icon fa fa-check-square-o">
                                                                La fecha del examen de certificación está próxima y necesitas ganar agilidad para afrontar el examen.
                                                             </i>   
                                                        </h4>
                                                        <h4>
                                                            <i class="icon fa fa-check-square-o">
                                                                Este simulador es gratuito con el fin de tener más herramientas y mantenerte preparado.
                                                            </i>
                                                        </h4>
                                                        <h4>
                                                            <i class="icon fa fa-check-square-o">
                                                                Por favor lea detenidamente cada una de las preguntas y marque  una sola opción para que tu respuesta sea válida.
                                                            </i>
                                                        </h4>
                                                    </div>
                                                  </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="box box-solid">
                                                        <div class="box-header with-border">
                                                          <h3 class="box-title text-primary"><b>Número de preguntas:</b> 40</h3><br/><br/>
                                                          <h3 class="box-title text-primary"><b>Tiempo de examen:</b> 60 minutos</h3><br/><br/>
                                                          <h3 class="box-title text-primary"><b>Porcentaje de aprobación:</b> 60%</h3><br/><br/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="text-center">
                                                            <div class="col-md-12">
                                                                      <a href="preguntasSimulador.view.php?id=<?php echo $codigo_curso; ?>"><button type="submit" class="btn btn-primary btn-lg" aria-hidden="true">Entrar</button></a>
                                                            </div>
                                                         </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--<div class="col-md-3">
                            <div class="box box-primary">
                                
                                <div class="box-body">
                                    <br/><br/>
                                    <div class="row text-center">
                                        <div class="col-lg-12">
                                                <label>
                                                    <img src="../images/simulador.png" class="img-thumbnail" alt="Responsive image">
                                                </label>
                                        </div>
                                        <input type="button" value="Simulador" class="btn btn-default" onclick="mostrarS()" >
                                    </div>
                                </div>
                            </div>
                        </div> -->
                    </div>
                        
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
       <!--<script src="js/cursoContenidoSimulador.js" type="text/javascript"></script>-->
       <script src="js/cbCodigo.js" type="text/javascript"></script>
       <!--<script src="js/preguntasSimulador.js" type="text/javascript"></script>-->
       <!--
        <script src="js/cbCodigo.js" type="text/javascript"></script>
        <script src="js/convocatoria.js" type="text/javascript"></script>
        <script src="js/puesto.js" type="text/javascript"></script>
        

    -->
    </body>
</html>