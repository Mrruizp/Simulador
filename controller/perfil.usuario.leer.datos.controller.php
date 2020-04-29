<?php

require_once '../util/functions/Helper.class.php';
require_once '../logic/Usuario.class.php';


//Haciendo lectura de la variable $_POST["dniUsuarioSesion"] que viene del archivo perfil.usuario.view.php
//$dni = $_POST["dniUsuarioSesion"];
$dni = $_POST["s_usuario"];

try {
    $objUsuario = new Usuario();
    $objUsuario2 = new Usuario();
    $objUsuario3 = new Usuario();
    $objUsuario4 = new Usuario();
    $objUsuario5 = new Usuario();
    $objUsuario6 = new Usuario();

    $resultado = $objUsuario->leerDatos($dni);

    $resultado2 = $objUsuario2->numInicioSesion();
    $resultado3 = $objUsuario3->numNoInicioSesion();

    $resultado4 = $objUsuario4->numUtilizadoExamen();
    //$resultado5 = $objUsuario5->numNoInicioSesion();

    //$resultado6 = $objUsuario6->numInicioSesion();
/*
    echo '<pre>';
    print_r($resultado2);
    echo '</pre>';
*/
    
} catch (Exception $exc) {
    Helper::mensaje($exc->getMessage(), "e");
}

