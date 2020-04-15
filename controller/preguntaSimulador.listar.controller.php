<?php

require_once '../logic/PreguntaSimulador.class.php';
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
try {     
    $objPreguntaSimulador = new PreguntaSimulador();
    $resultado = $objPreguntaSimulador->listar($codPrueba);
    
    Helper::imprimeJSON(200, "", $resultado);
    
} catch (Exception $exc) {
    Helper::imprimeJSON(500, $exc->getMessage(), "");
}

