<?php
require_once '../util/functions/Helper.class.php';
$dni        = $_POST["txtDoc_identidad"];
$nombre     = $_POST['txtNombre'];
$apellidos  = $_POST['txtApellidos'];
$direccion  = $_POST['txtDireccion'];
$telefono   = $_POST['txtTelefono'];
$sexo       = $_POST['sexo'];
$edad       = $_POST['txtEdad'];
$dbconn = pg_connect("host=localhost port=5432 dbname=campusVirtual_bd user=postgres password=123")
        or die('NO HAY CONEXION: ' . pg_last_error());
$query = "update 
            usuario
          set
            nombres   = '$nombre',
            apellidos = '$apellidos',
            direccion = '$direccion',
            telefono  = '$telefono',
            sexo      = '$sexo',
            edad      = '$edad'
          where
            doc_id = '$dni'";


$result = pg_query($dbconn, $query) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());

$cmdtuples = pg_affected_rows($result);
Helper::mensaje("Se ha actualizado los datos", "s", "../view/datosPersonales.view.php", 4);


// Free resultset liberar los datos
pg_free_result($result);

// Closing connection cerrar la conexión
pg_close($dbconn);


/*
if ($_FILES["fotoUsuario"]["name"] != "") {
    $tipo_archivo = $_FILES["fotoUsuario"]["type"];
    $direccion_subida = "../view/fotos/";

    $nombre_archivo_subir = $direccion_subida . $dni . ".png";


    $resultado_subida = move_uploaded_file($_FILES["fotoUsuario"]["tmp_name"], $nombre_archivo_subir);
    //$resultado_subida = true o false
    if ($resultado_subida) { //true
        Helper::mensaje("Se ha actualizado la foto del usuario", "s", "../view/principalAdmin.view.php", 5);
    }

    //if ($tipo_archivo)
} else {
    Helper::mensaje("No ha seleccionado la foto", "i");
}
        
*/