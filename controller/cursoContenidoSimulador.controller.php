<?php

require_once '../logic/ConteniedoSimulador.class.class.php';
require_once '../util/functions/Helper.class.php';

try {
    $objCurso = new ConteniedoSimulador();
    $resultado = $objCurso->listar();
    Helper::imprimeJSON(200, "", $resultado);
} catch (Exception $exc) {
    Helper::imprimeJSON(500, $exc->getMessage(), "");
}

