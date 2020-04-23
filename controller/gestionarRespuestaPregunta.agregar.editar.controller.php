<?php

try {

    require_once '../logic/PreguntaSimulador.class.php';
    require_once '../util/functions/Helper.class.php';

    if
    (
            !isset($_POST["p_respuesta"]) ||
            empty($_POST["p_respuesta"])  ||
            
            !isset($_POST["p_cod_pregunta"]) ||
            empty($_POST["p_cod_pregunta"])||

            !isset($_POST["p_numPregunta"]) ||
            empty($_POST["p_numPregunta"]) 
    ) {
        Helper::imprimeJSON(500, "Falta completar datos", "");
        exit();
    }
     $preg_respuesta = $_POST["p_respuesta"];
     $cod_pregunta = $_POST["p_cod_pregunta"];
     $numPregunta = $_POST["p_numPregunta"];

    $objPreguntaSimulador = new PreguntaSimulador();

    
       // $objPreguntaSimulador->setNombre_curso($nombre_curso);
        $resultado = $objPreguntaSimulador->agregar($preg_respuesta, $cod_pregunta, $numPregunta);

        if ($resultado) 
        {
            Helper::imprimeJSON(200, "Agregado correctamente", "");
        }
    
} catch (Exception $exc) {
    Helper::imprimeJSON(500, $exc->getMessage(), "");
}
