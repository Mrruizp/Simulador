<?php

try {
    require_once '../logic/RespuestaSimulador.class.php';
    require_once '../util/functions/Helper.class.php';
    
    if 
        (
            !isset($_POST["p_codigo_curso"]) ||
            empty($_POST["p_codigo_curso"])
            
        )
    {
            Helper::imprimeJSON(500, "Falta completar datos", "");
            exit();
    }
    
    $codPrueba = $_POST["p_codigo_curso"];
    
    $objRespuestaSimulador= new RespuestaSimulador();
    $resultado = $objRespuestaSimulador->eliminarResultados($codPrueba);
    
    if ($resultado){
        Helper::imprimeJSON(200, "Se eliminó correctamente", "");
    }
    
    
} catch (Exception $exc) {
    Helper::imprimeJSON(500, $exc->getMessage(), "");
}


