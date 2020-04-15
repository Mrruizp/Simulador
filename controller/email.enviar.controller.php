<?php

require_once '../util/functions/Helper.class.php';

/*
echo '<pre>';
echo 'Datos que llegan por POST';
print_r($_POST);
echo 'Datos que llegan por FILES';
print_r($_FILES);
echo '</pre>';
*/

for($i = 1; $i<=6; $i++)
{
   // $_POST["textNombre_curso$i"];
  $Nombre_pregunta =  $_POST["textNombre_pregunta$i"];
  $Respuesta =  $_POST["textRespuesta$i"];
  $Respuesta_usuario =  $_POST["textRespuesta_usuario$i"];
  $Estado =  $_POST["textEstado$i"];    
}



//echo $Nombre_curso;
echo $Nombre_pregunta;
echo $Respuesta;
echo $Respuesta_usuario;
echo $Estado;


