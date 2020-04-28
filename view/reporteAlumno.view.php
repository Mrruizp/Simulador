<?php
require_once 'validar.datos.sesion.view.php';
$_POST["s_usuario"] = $dniSesion;


require_once '../controller/perfil.usuario.leer.datos.controller.php';


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
                        <div class="col-md-8">
                            <!-- Main content -->
                            <section class="invoice">
                                <div class="row">
                                    <div class="col-xs-12">
                                      <h2 class="page-header text-primary text-bold">
                                        <i class="fa fa-pie-chart"></i> Alumno
                                        <!--<small class="pull-right">Fecha: <?php echo date('d/m/yy'); ?></small>-->
                                      </h2>
                                    </div>
                              </div>
                              <div class="row">
                                        <div class="col-md-6">
                                            <div class="box-header with-border">
                                              <h3 class="box-title">Uso del Simulador</h3>

                                            </div>
                                            <!-- /.box-header -->
                                            <div class="box-body">
                                              <div class="row">
                                                <div class="col-md-8">
                                                  <div class="chart-responsive">
                                                    <canvas id="pieChart" height="150"></canvas>
                                                  </div>
                                                  <!-- ./chart-responsive -->
                                                </div>
                                                <!-- /.col -->
                                                <div class="col-md-4">
                                                  <ul class="chart-legend clearfix">
                                                    <li><i class="fa fa-circle-o text-red"></i> Chrome</li>
                                                    <li><i class="fa fa-circle-o text-green"></i> IE</li>
                                                    <li><i class="fa fa-circle-o text-yellow"></i> FireFox</li>
                                                    <li><i class="fa fa-circle-o text-aqua"></i> Safari</li>
                                                    <li><i class="fa fa-circle-o text-light-blue"></i> Opera</li>
                                                    <li><i class="fa fa-circle-o text-gray"></i> Navigator</li>
                                                  </ul>
                                                </div>
                                                <!-- /.col -->
                                              </div>
                                              <!-- /.row -->
                                            </div>
                                            <!-- /.box-body -->
                                            <div class="box-footer no-padding">
                                              <ul class="nav nav-pills nav-stacked">
                                                <li class=""><a href="#">Iniciarón Sesión
                                                  <span class="pull-right text-red"><i class="fa fa-angle-down"></i> 12%</span></a></li>
                                                <li><a href="#">Sin Iniciar Sesión <span class="pull-right text-green"><i class="fa fa-angle-up"></i> 4%</span></a>
                                                </li>
                                              </ul>
                                            </div>
                                            <!-- /.footer -->
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
    <!--
        <script src="js/convocatoriaVigente.js" type="text/javascript"></script>
        <script src="js/convocatoriaConcluida.js" type="text/javascript"></script>
        <script src="js/reporte.resultadoCurriculo.js" type="text/javascript"></script>
        <script src="js/reporte.resultadoPruebas.js" type="text/javascript"></script>
        <script src="js/reporte.resultadoFinal.js" type="text/javascript"></script>
    -->
    </body>
</html>