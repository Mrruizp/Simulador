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
        <title> Campus Virtual | Simulador</title>
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
                        <div class="col-md-9">
                            <!-- Main content -->
                            <section class="invoice">
                              <!-- title row -->
                              <div class="row">
                                <div class="col-xs-12">
                                  <h2 class="page-header text-primary text-bold">
                                    <i class="fa fa-certificate"></i> Certificados
                                    <!--<small class="pull-right">Fecha: <?php echo date('d/m/yy'); ?></small>-->
                                  </h2>
                                </div>
                                <!-- /.col -->
                              </div>
                              <div class="row">
                                        <div class="col-lg-12">
                                            <div class="x_title">
                                               
                                                <?php
                                                    $total_imagenes = count(glob('fotos/anuncios/{*.jpg}',GLOB_BRACE));
                                                    //echo 'total_imagenes = '.$total_imagenes;
                                                    //$url;
                                                       for($i = 1; $i <= $total_imagenes; $i ++) 
                                                       {
                                                            $e = $i;
                                                            $url = "fotos/anuncios/$i.jpg";                            
                                                ?>

                                                    <div class="row">
                                                        <div class="text-center col-xs-6">
                                                            
                                                                <!--<input type="text" name="id" value="<?php echo $i; ?>">-->
                                                                <label><img src="<?php echo $url; ?>" align="center" class="img-thumbnail" alt="Responsive image"></label>
                                                                <a href="cursoContenidoSimulador.View.php?id=<?php echo $i; ?>"><button type="button" class="btn btn-primary btn-md">Entrar</button>
                                                                <br/><br/>
                                                            </form>
                                                        </div>    

                                                    <?php

                                                     $e += 1;
                                                     if($e < $total_imagenes)
                                                     {
                                                        $url = "fotos/anuncios/$e.jpg";
                                                    ?>

                                                        <div class="text-center col-xs-6">
                                                            
                                                                <!--<input type="text" name="id" value="<?php echo $e; ?>">-->
                                                                <label><img src="<?php echo $url; ?>" align="center" class="img-thumbnail" alt="Responsive image"></label>
                                                                <a href="cursoContenidoSimulador.View.php?id=<?php echo $e; ?>"><button type="button" class="btn btn-primary btn-md">Entrar</button>
                                                                <br/><br/>
                                                            </form>
                                                        </div>
                                                    </div>

                                                <?php
                                                        $i++;
                                                        }
                                                       }
                                                ?>   
                                               
                                                <br/>
                                                <section class="text-center"> 
                                                    <header>
                                                        <span class="section">

                                                        </span>
                                                    </header>
                                                </section>    
                                            </div>
                                        </div>
                                    </div>

                            </section>
                            <!-- /.content -->
                        </div>  
                        <!--<div class="col-md-3">
                            <div class="row">
                                <div class="col-md-12 col-xs-12">
                                    <div class="x_title">
                                        <header class="text-center">      
                                            <label>
                                                <?php
                                                    if($_SESSION["cargo_id"] >= 1 && $_SESSION["cargo_id"] <= 4)
                                                        echo '<img src="../images/bienvenido_admin.png" class="img-thumbnail">';
                                                    if($_SESSION["cargo_id"] == 5)
                                                        echo '<img src="../images/bienvenido_docente.png" class="img-thumbnail">';
                                                    if($_SESSION["cargo_id"] == 6)
                                                        echo '<img src="../images/bienvenido_estudiante.png" class="img-thumbnail">';
                                                ?>
                                            </label>
                                        </header>
                                        <br/>
                                        <section class="text-center"> 
                                            <header>
                                                <span class="section">

                                                </span>
                                            </header>
                                        </section>    
                                    </div>
                                </div>
                            </div>
                        </div>  -->
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