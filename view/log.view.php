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
                                        <i class="fa fa-pie-chart"></i> Inicio de Sesión
                                        <!--<small class="pull-right">Fecha: <?php echo date('d/m/yy'); ?></small>-->
                                      </h2>
                                    </div>
                              </div>
                              <div class="row">
                                <div class="col-md-12">
                                    <div id="listadoLog_inicioseseion">
                                    </div>
                                  </div>
                                </div>
                    <?php
                        if($_SESSION["cargo_id"] != 5)
                        {


                    ?>
                            <div class="row">
                                    <div class="col-xs-12">
                                      <h2 class="page-header text-primary text-bold">
                                        <i class="fa fa-pie-chart"></i> Docente
                                        <!--<small class="pull-right">Fecha: <?php echo date('d/m/yy'); ?></small>-->
                                      </h2>
                                    </div>
                              </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="box-header with-border">
                                      <h1 class="box-title">Ingresos al Sistema</h1>

                                    </div>
                                    <!-- /.box-header -->
                                    <div class="box-body">
                                      <div class="row">
                                        <div class="col-md-12">
                                          <div class="chart-responsive">
                                            <canvas id="pieChart3" height="250"></canvas>
                                          </div>
                                          <!-- ./chart-responsive -->
                                        </div>
                                      </div>
                                      <!-- /.row -->
                                    </div>
                                    <!-- /.box-body -->
                                    <div class="box-footer no-padding">
                                      <ul class="nav nav-pills nav-stacked">
                                        <li class="">
                                            <a href="#"><h5>Número de veces que iniciarón sesión
                                              <span class="pull-right text-green text-bold">
                                                <i class="fa fa-angle-down"></i> 
                                                    <input type="hidden" id="textNumSesionDoc" name="textNumSesionDoc" value="<?php echo $resultado7["numsesiondoc"];  ?>"><?php echo $resultado7["numsesiondoc"]; ?>
                                                </span></h5>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#"><h5>Docente(s) sin iniciar sesión 
                                                <span class="pull-right text-yellow text-bold">
                                                    <i class="fa fa-angle-up">
                                                        
                                                    </i>
                                                    <input type="hidden" id="textNumNoSesionDoc" name="textNumNoSesionDoc" value="<?php echo $resultado8["numnosesiondoc"];  ?>"><?php echo $resultado8["numnosesiondoc"]; ?>
                                                </span></h5>
                                            </a>
                                        </li>
                                      </ul>
                                    </div>
                                    <!-- /.footer -->
                                  </div>
                                  <div class="col-md-6">
                                    <div class="box-header with-border">
                                      <h2 class="box-title">Examen</h2>

                                    </div>
                                    <!-- /.box-header -->
                                    <div class="box-body">
                                      <div class="row">
                                        <div class="col-md-12">
                                          <div class="chart-responsive">
                                            <canvas id="pieChart4" height="250"></canvas>
                                          </div>
                                          <!-- ./chart-responsive -->
                                        </div>
                                      </div>
                                      <!-- /.row -->
                                    </div>
                                    <!-- /.box-body -->
                                    <div class="box-footer no-padding">
                                      <ul class="nav nav-pills nav-stacked">
                                        <li class="">
                                            <a href="#"><h5>Número de veces que dierón examen
                                              <span class="pull-right text-gray text-bold">
                                                <i class="fa fa-angle-down"></i> 
                                                    <input type="hidden" id="textNumexcaliDoc" name="textNumexcaliDoc" value="<?php echo $resultado9["numexcalidoc"];  ?>"><?php echo $resultado9["numexcalidoc"]; ?>
                                                    <!--<input type="hidden" id="numSesion" name="numSesion" value="10"><?php echo $resul["numsesion"];  ?>-->
                                                </span></h5>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#"><h5>Docente(s) sin dar examen
                                                <span class="pull-right text-yellow text-bold">
                                                    <i class="fa fa-angle-up">
                                                        
                                                    </i>
                                                    <input type="hidden" id="textNumexNocaliDoc" name="textNumexNocaliDoc" value="<?php echo $resultado10["numnoexcalidoc"];  ?>"><?php echo $resultado10["numnoexcalidoc"]; ?>
                                                </span></h5>
                                            </a>
                                        </li>
                                      </ul>
                                    </div>
                                    <!-- /.footer -->
                                  </div>
                                </div><br/><br/>
                        <?php
                        }
                        ?>
                            
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
        <script src="../util/lte/js/pages/dashboard3.js"></script>

        <script src="../util/plugins/chartjs/Chart.js"></script>

        <!-- FLOT CHARTS -->
        <script src="../util/plugins/flot/jquery.flot.js"></script>
        <!-- FLOT RESIZE PLUGIN - allows the chart to redraw when the window is resized -->
        <script src="../util/plugins/flot/jquery.flot.resize.js"></script>
        <!-- FLOT PIE PLUGIN - also used to draw donut charts -->
        <script src="../util/plugins/flot/jquery.flot.pie.js"></script>
        <!-- FLOT CATEGORIES PLUGIN - Used to draw bar charts -->
        <script src="../util/plugins/flot/jquery.flot.categories.js"></script>
        <!-- Page script -->
    </body>
</html>