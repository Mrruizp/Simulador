<?php

require_once '../logic/PreguntaSimulador.class.php';
require_once '../util/functions/Helper.class.php';

if 
        (
            !isset($_POST["p_pregunta"]) ||
            empty($_POST["p_pregunta"])
            
        )
    {
            Helper::imprimeJSON(500, "Falta completar datos", "");
            exit();
    }
   
    $pregunta = $_POST["p_pregunta"];
try {     
    $objPreguntaSimulador = new PreguntaSimulador();
    $resultado = $objPreguntaSimulador->listarObtenerCodPregunta($pregunta);
    
    Helper::imprimeJSON(200, "", $resultado);
    
} catch (Exception $exc) {
    Helper::imprimeJSON(500, $exc->getMessage(), "");
}

