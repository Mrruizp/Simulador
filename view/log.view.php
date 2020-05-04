<?php
require_once 'validar.datos.sesion.view.php';
$_POST["s_usuario"] = $dniSesion;


require_once '../controller/perfil.usuario.leer.datos.controller.php';


?>
<!DOCTYPE html>
<html>
    <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="icon" href="../images/IPEV.jpg">
        <title>Simulador</title>
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
            <?php include_once 'menu-izquierda.admin.view.php'; ?>

            <!-- =============================================== -->

            <!-- Content Wrapper. Contains page content -->
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                            <!-- Main content -->
                            <section class="invoice">
                                <div class="row">
                                    <div class="col-xs-12">
                                      <h2 class="page-header text-primary text-bold">
                                        <i class="fa fa-sign-in"></i> Inicios de sesión
                                        <!--<small class="pull-right">Fecha: <?php echo date('d/m/yy'); ?></small>-->
                                      </h2>
                                    </div>
                              </div>
                              <div class="row">
                                <div class="col-md-12">
                                    <div id="listadoLog_inicioseseion">
                                    </div>
                                  </div>
                                </div><br/><br/>
                            <div class="row">
                                    <div class="col-xs-12">
                                      <h2 class="page-header text-primary text-bold">
                                        <i class="fa fa-user"></i> Usuarios
                                        <!--<small class="pull-right">Fecha: <?php echo date('d/m/yy'); ?></small>-->
                                      </h2>
                                    </div>
                              </div>
                            <div class="row">
                                    <div class="col-xs-12">
                                      <div id="listadoLog_usuario">
                                      </div>
                                    </div>
                              </div>
                              <div class="row">
                                    <div class="col-xs-4">
                                      <div class="box-footer no-padding">
                                      <ul class="nav nav-pills nav-stacked">
                                        <li class="">
                                            <a><h5>Usuarios que registrarón movimientos
                                              <span class="pull-right text-default text-bold" style="background-color: #25c3ff;">
                                                <i class="">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</i> 
                                                    
                                                </span></h5>
                                            </a>
                                        </li>
                                        <li class="">
                                            <a><h5>Usuarios que fueron creados
                                              <span class="pull-right text-default text-bold" style="background-color: #7df2ae;">
                                                <i class="">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</i> 
                                                    
                                                </span></h5>
                                            </a>
                                        </li>
                                        <li class="">
                                            <a><h5>Credenciales que fuerón creadas
                                              <span class="pull-right text-default text-bold" style="background-color: #86fff6;">
                                                <i class="">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</i> 
                                                    
                                                </span></h5>
                                            </a>
                                        </li>
                                      </ul>
                                    </div>
                                    </div>
                              </div><br/><br/>
                              <div class="row">
                                    <div class="col-xs-12">
                                      <h2 class="page-header text-primary text-bold">
                                        <i class="fa fa-book"></i> Cursos
                                        <!--<small class="pull-right">Fecha: <?php echo date('d/m/yy'); ?></small>-->
                                      </h2>
                                    </div>
                              </div>
                            <div class="row">
                                    <div class="col-xs-12">
                                      <div id="listadoLog_curso">
                                      </div>
                                    </div>
                              </div>
                        
                            
                    </section>
                            
                </div>
            </div>
            <!-- /.row -->
        </section>
            </div>
            <!-- /.content-wrapper -->
            <!-- /.content-wrapper -->

            <?php include_once 'pie.view.php'; ?>

            <!-- Control Sidebar -->
            <?php // include_once 'opciones-derecha.view.php'; ?>
            <!-- /.control-sidebar -->
            <div class="control-sidebar-bg"></div>
        </div>  
        <!-- ./wrapper -->
        <?php include_once 'scripts.view.php'; ?>

        <script src="js/log.js" type="text/javascript"></script>
        
        <!-- Page script -->

    </body>
</html>