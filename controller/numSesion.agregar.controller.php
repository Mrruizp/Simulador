<?php

try {

    require_once '../logic/Sesion.class.php';
    require_once '../util/functions/Helper.class.php';

    

    $objSesion = new Sesion();

        $resultado = $objSesion->numInicioSsion();
        if ($resultado) {
            Helper::imprimeJSON(200, "Agregado correctamente", "");
        }
    
} catch (Exception $exc) {
    Helper::imprimeJSON(500, $exc->getMessage(), "");
}
