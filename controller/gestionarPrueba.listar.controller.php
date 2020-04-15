<?php

require_once '../logic/Prueba.class.php';
require_once '../util/functions/Helper.class.php';

try {
    $objPrueba = new Prueba();
    $resultado = $objPrueba->listar();
    Helper::imprimeJSON(200, "", $resultado);
} catch (Exception $exc) {
    Helper::imprimeJSON(500, $exc->getMessage(), "");
}

