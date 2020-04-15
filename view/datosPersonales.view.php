<?php
    require_once 'validar.datos.sesion.view.php';
?>
<?php

    //Creando y asignando un valor a la variable $_POST["dniUsuarioSesion"];
    $_POST["s_usuario"] = $dniSesion;
    
    require_once '../controller/perfil.usuario.leer.datos.controller.php';
    
    
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="icon" href="../images/IPEV.jpg">
        <title> Campus Virtual | Gestionar Datos Personales</title>
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
  <?php include_once './menu-izquierda.admin.view.php';?>

  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
      <section class="content-header">
            <h3>Datos Personales</h3>
            <ol class="breadcrumb">
                <li><a href="menu.principal.view.php"><i class="fa fa-dashboard"></i> Inicio</a></li>
                <li class="active">Datos Personales</li>
              <!--<li class="active">User profile</li>-->
            </ol>
            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal" id="btnagregar"><i class="fa fa fa-pencil"> ACTUALIZAR</i></button>
        </section>  
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-6">
                <div class="box box-primary">
                    <div class="box-header with-border">
                      <h3 class="box-title">Datos del usuario</h3>
                    </div>
                    <form role="form" enctype="multipart/form-data" action="../controller/perfil.usuario.actualizar.datos.controller.php" method="post">
                    <div class="modal fade" id="myModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                      <div class="modal-dialog" id="modal">
                        <div class="modal-content">
                          <div class="modal-header bg-primary">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title" id="titulomodal">ACTUALIZAR DATOS PERSONALES</h4>
                          </div>
                          <div class="modal-body">
                                            <div class="row">
                                                <div class="col-xs-3">
                                                    <p>
                                                        <input type="hidden" value="" id="txtTipoOperacion" name="txtTipoOperacion">
                                                        Código<input type="text" 
                                                                      name="txtCodigo" 
                                                                      id="txtCodigo" 
                                                                      class="form-control input-sm"
                                                                      readonly="true">
                                                    </p>
                                                </div>
                                                <div class="col-xs-3">
                                                    <p>
                                                        Documento (*) <input type="text" class="form-control has-feedback-left" style="font-weight:normal;"
                                                                       id="txtDoc_identidad" name="txtDoc_identidad" 
                                                                       required="" autofocus="" 
                                                                       maxlength="8" value="<?php echo $resultado["doc_id"];  ?>"
                                                                       onkeypress="ValidaSoloNumeros();" readonly ="true">
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xs-6">
                                                    <p>
                                                        Nombres (*)
                                                        <input type="text" class="form-control" id="txtNombre" style="font-weight:normal; " name="txtNombre" required="" autofocus="" value="<?php echo $resultado["nombres"];  ?>">
                                                    </p>
                                                </div>
                                                <div class="col-xs-6">
                                                    <p>
                                                        Apellidos (*)
                                                        <input type="text" style="font-weight:normal;" class="form-control" id="txtApellidos" name="txtApellidos" required=""
                                                        value="<?php echo $resultado["apellidos"];  ?>">
                                                    </p>
                                                </div>
                                                <div class="col-xs-6">
                                                    <p>
                                                        Dirección (*)
                                                        <input type="text" style="font-weight:normal;" class="form-control" id="txtDireccion" name="txtDireccion" required=""
                                                        value="<?php echo $resultado["direccion"];  ?>" >
                                                    </p>
                                                </div>
                                                <div class="col-xs-3">
                                                    <p>
                                                        Teléfono (*)
                                                        <input type="text" style="font-weight:normal;" id="txtTelefono" class="form-control" name="txtTelefono" required="" maxlength="20" onkeypress="ValidaSoloNumeros();" value="<?php echo $resultado["telefono"];  ?>">
                                                    </p>
                                                </div>
                                                <div class="col-xs-3">
                                                    <p>
                                                        Sexo (*)
                                                        <select size="1" style="font-weight:normal;" id="sexo" name="sexo" class="form-control has-feedback-left" required=""> 
                                                            
                                                            <?php

                                                                if($resultado["sexo"] === "H") 
                                                                  echo  '<option value="H">Hombre</option>';
                                                                else
                                                                  echo  '<option value="M">Mujer</option>';

                                                            ?>
                                                        </select>
                                                    </p>
                                                </div>
                                                <div class="col-xs-2">
                                                    <p>
                                                        Edad (*)
                                                        <select size="1" style="font-weight:normal;" id="txtEdad" name="txtEdad" class="form-control has-feedback-left" required> 
                                                            <option value="<?php echo $resultado["edad"];  ?>"><?php echo $resultado["edad"];  ?></option>
                                                            <option>--------------------------------------------------------</option>
                                                            <option value="18">18</option>
                                                            <option value="19">19</option>
                                                            <option value="20">20</option>
                                                            <option value="21">21</option>
                                                            <option value="22">22</option>
                                                            <option value="23">23</option>
                                                            <option value="24">24</option>
                                                            <option value="25">25</option>
                                                            <option value="26">26</option>
                                                            <option value="27">27</option>
                                                            <option value="28">28</option>
                                                            <option value="29">29</option>
                                                            <option value="30">30</option>
                                                            <option value="31">31</option>
                                                            <option value="32">32</option>
                                                            <option value="33">33</option>
                                                            <option value="34">34</option>
                                                            <option value="35">35</option>
                                                            <option value="36">36</option>
                                                            <option value="37">37</option>
                                                            <option value="38">38</option>
                                                            <option value="39">39</option>
                                                            <option value="40">40</option>
                                                            <option value="41">41</option>
                                                            <option value="42">42</option>
                                                            <option value="43">43</option>
                                                            <option value="44">44</option>
                                                            <option value="45">45</option>
                                                            <option value="46">46</option>
                                                            <option value="47">47</option>
                                                            <option value="48">48</option>
                                                            <option value="49">49</option>
                                                            <option value="50">50</option>
                                                            <option value="51">51</option>
                                                            <option value="52">52</option>
                                                            <option value="53">53</option>
                                                            <option value="54">54</option>
                                                            <option value="55">55</option>
                                                            <option value="56">56</option>
                                                            <option value="57">57</option>
                                                            <option value="58">58</option>
                                                            <option value="59">59</option>
                                                            <option value="60">60</option>
                                                        </select>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                      <div class="modal-footer">
                                          <button type="submit" class="btn btn-primary" aria-hidden="true"><i class="fa fa-save"></i> Grabar</button>
                                          <button type="button" class="btn btn-danger" data-dismiss="modal" id="btncerrar"><i class="fa fa-close"></i> Cerrar</button>
                                      </div>
                        </div>
                      </div>
                    </div>
                </form>
                    <!-- /.box-header -->
                    <!-- form start enctype="multipart/form-data" -->
                    <form role="form" enctype="multipart/form-data" action="../controller/perfil.usuario.actualizar.foto.datos.controller.php" method="post">
                        <div class="box-body col-md-offset-1">
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Doc ID</label>
                                        <input type="text" class="form-control" name="txtDNI" id="txtDNI" value="<?php echo $resultado["doc_id"];  ?>" readonly="">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Nombres</label>
                                        <input type="text" class="form-control" id="txtNombres" name="txtNombres" placeholder="Nombres" value="<?php echo $resultado["nombres"];  ?>" readonly="">
                                    </div>
                                </div>
                                <div class="col-md-6">    
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Apellidos</label>
                                        <input type="text" class="form-control" id="txtApellidos" name="txtApellidos" placeholder="Apellidos" value="<?php echo $resultado["apellidos"];  ?>" readonly="">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Dirección</label>
                                        <input type="text" class="form-control" id="txtDireccion" name="txtDireccion" placeholder="Enter direccion" value="<?php echo $resultado["direccion"];  ?>" readonly="">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Edad</label>
                                        <select size="1" class="form-control" name="txtEdad" readonly=""> 
                                            <option value="<?php echo $resultado["edad"];  ?>"><?php echo $resultado["edad"];  ?></option>
                                            <option>--------------------------------------------------------</option>
                                            <option value="18">18</option>
                                            <option value="19">19</option>
                                            <option value="20">20</option>
                                            <option value="21">21</option>
                                            <option value="22">22</option>
                                            <option value="23">23</option>
                                            <option value="24">24</option>
                                            <option value="25">25</option>
                                            <option value="26">26</option>
                                            <option value="27">27</option>
                                            <option value="28">28</option>
                                            <option value="29">29</option>
                                            <option value="30">30</option>
                                            <option value="31">31</option>
                                            <option value="32">32</option>
                                            <option value="33">33</option>
                                            <option value="34">34</option>
                                            <option value="35">35</option>
                                            <option value="36">36</option>
                                            <option value="37">37</option>
                                            <option value="38">38</option>
                                            <option value="39">39</option>
                                            <option value="40">40</option>
                                            <option value="41">41</option>
                                            <option value="42">42</option>
                                            <option value="43">43</option>
                                            <option value="44">44</option>
                                            <option value="45">45</option>
                                            <option value="46">46</option>
                                            <option value="47">47</option>
                                            <option value="48">48</option>
                                            <option value="49">49</option>
                                            <option value="50">50</option>
                                            <option value="51">51</option>
                                            <option value="52">52</option>
                                            <option value="53">53</option>
                                            <option value="54">54</option>
                                            <option value="55">55</option>
                                            <option value="56">56</option>
                                            <option value="57">57</option>
                                            <option value="58">58</option>
                                            <option value="59">59</option>
                                            <option value="60">60</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Sexo</label>
                                        <select size="1" class="form-control" name="txtSexo" readonly=""> 
                                            <?php

                                                if($resultado["sexo"] === "H") 
                                                  echo  '<option value="H">Hombre</option>';
                                                else
                                                  echo  '<option value="M">Mujer</option>';

                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Teléfono</label>
                                        <input type="text" class="form-control" id="txtTelefono" name="txtTelefono" placeholder="Enter telefono" value="<?php echo $resultado["telefono"];  ?>" readonly="">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Correo electónico</label>
                                        <input type="email" class="form-control" id="txtEmail" name="txtEmail" placeholder="Enter email" value="<?php echo $resultado["email"];  ?>" readonly="">
                                    </div>
                                </div>
                                
                            </div>
<!--                            <div class="form-group">
                              <label for="exampleInputFile">Cambiar la foto</label>
                              <input type="file" accept="image/png,image/jpeg" id="fotoUsuario" name="fotoUsuario">
                            </div>-->
                        </div>
                      <!-- /.box-body -->
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
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
        $(function() {

      // We can attach the `fileselect` event to all file inputs on the page
      $(document).on('change', ':file', function() {
        var input = $(this),
            numFiles = input.get(0).files ? input.get(0).files.length : 1,
            label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
        input.trigger('fileselect', [numFiles, label]);
      });

      // We can watch for our custom `fileselect` event like this
      $(document).ready( function() {
          $(':file').on('fileselect', function(event, numFiles, label) {

              var input = $(this).parents('.input-group').find(':text'),
                  log = numFiles > 1 ? numFiles + ' files selected' : label;

              if( input.length ) {
                  input.val(log);
              } else {
                  if( log ) alert(log);
              }

          });
      });

    });
    </script>    
    <!--<script src="js/laboratorio.js" type="text/javascript"></script>-->
</body>
</html>