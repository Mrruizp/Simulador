<?php

require_once '../util/functions/Helper.class.php';
require_once '../logic/RespuestaSimulador.class.php';

if 
        (
            !isset($_POST["p_codigo_curso"]) ||
            empty($_POST["p_codigo_curso"])
            
        )
    {
            Helper::imprimeJSON(500, "Falta completar datos", "");
            exit();
    }
   
    $codPruebaCurso = $_POST["p_codigo_curso"];

try {     
    $objRespuestaSimulador = new RespuestaSimulador();
    $resultado = $objRespuestaSimulador->listarDetalleResultados($codPruebaCurso);
    
    Helper::imprimeJSON(200, "", $resultado);
    
} catch (Exception $exc) {
    Helper::imprimeJSON(500, $exc->getMessage(), "");
}
