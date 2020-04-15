<?php

require_once '../logic/RespuestaSimulador.class.php';
require_once '../util/functions/Helper.class.php';


try {     
    $objRespuestaSimulador = new RespuestaSimulador();
    $resultado = $objRespuestaSimulador->listar();
    
    Helper::imprimeJSON(200, "", $resultado);
    
} catch (Exception $exc) {
    Helper::imprimeJSON(500, $exc->getMessage(), "");
}

