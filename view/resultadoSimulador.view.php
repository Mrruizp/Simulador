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
        <title> Campus Virtual | Gestionar Anuncios</title>
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
                <div class="col-md-10 box box-primary">
                  <div class="nav-tabs-custom tab-primary">
                    <ul class="nav nav-tabs">
                      <p>
                          <li class="active"><a href="#activity" data-toggle="tab">RESUMEN</a></li>
                          <li><a href="#timeline" data-toggle="tab">DETALLE</a></li>
                      </p>
                    </ul>
                    <div class="tab-content">
                      <div class="active tab-pane" id="activity">
                        <!-- Post -->
                        <div class="post">
                          <!-- /.user-block -->
                              <div class="box-body">
                                <div id="listado" class="container"></div>
                            </div>
                        </div>
                        <!-- /.post -->
                      </div>
                      <!-- /.tab-pane -->
                      <div class="tab-pane" id="timeline">
                        <div class="box-body">
                            <div id="listarResultadosDetalle" class="col-md-10"></div>
                        </div>
                      </div>
                      <!-- /.tab-pane -->
                    </div>
                    <!-- /.tab-content -->
                  </div>
                  <!-- /.nav-tabs-custom -->
                </div>
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
    <!--
        <script type="text/javascript"> // permite bloquear el button atrás del navegador
            window.location.hash="no-back-button";
            window.location.hash="Again-No-back-button";//esta linea es necesaria para chrome
            window.onhashchange=function(){window.location.hash="no-back-button";}
        </script>   
    -->
       <script src="js/resultadoSimulador.js" type="text/javascript"></script>
    </body>
</html>