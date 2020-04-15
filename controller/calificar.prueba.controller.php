<?php

try {

    require_once '../logic/Prueba.class.php';
    require_once '../util/functions/Helper.class.php';

    if
    (
            !isset($_POST["p_cod_prueba"]) ||
            empty($_POST["p_cod_prueba"]) 
    ) {
        Helper::imprimeJSON(500, "Falta completar datos", "");
        exit();
    }
     $codigoPrueba = $_POST["p_cod_prueba"];

    $objPrueba = new Prueba();

        $resultado = $objPrueba->calificarPrueba($codigoPrueba);
        if ($resultado) {
            Helper::imprimeJSON(200, "Agregado correctamente", "");
        }
    
} catch (Exception $exc) {
    Helper::imprimeJSON(500, $exc->getMessage(), "");
}
