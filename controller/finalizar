<?php

require_once '../logic/CalificarNull.class.php';
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
   
    $codPruebaCurso = $_POST["p_codigo_curso"];

try {     
    $CalificarNull = new CalificarNull();
    $resultado = $CalificarNull->ejecutar($codPruebaCurso);
    
    Helper::imprimeJSON(200, "", $resultado);
    
} catch (Exception $exc) {
    Helper::imprimeJSON(500, $exc->getMessage(), "");
}

