<?php

try {
    require_once '../logic/PreguntaSimulador.class.php';
    require_once '../util/functions/Helper.class.php';
    
    if 
        (
            !isset($_POST["p_codigo_pregunta"]) ||
            empty($_POST["p_codigo_pregunta"])
            
        )
    {
            Helper::imprimeJSON(500, "Falta completar datos", "");
            exit();
    }
    
    $codPregunta = $_POST["p_codigo_pregunta"];
    
    $objPreguntaSimulador = new PreguntaSimulador();
    $resultado = $objPreguntaSimulador->leerDatosRespuestaPregunta($codPregunta);
    
    Helper::imprimeJSON(200, "", $resultado);
    
} catch (Exception $exc) {
    Helper::imprimeJSON(500, $exc->getMessage(), "");
}


