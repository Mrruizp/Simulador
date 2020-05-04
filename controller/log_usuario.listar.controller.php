<?php

require_once '../logic/Log.class.php';
require_once '../util/functions/Helper.class.php';

try {
    $objLog = new Log();
    $resultado = $objLog->listarLog_usuario();
    Helper::imprimeJSON(200, "", $resultado);
} catch (Exception $exc) {
    Helper::imprimeJSON(500, $exc->getMessage(), "");
}

