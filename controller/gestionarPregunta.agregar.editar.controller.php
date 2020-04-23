<?php

try {

    require_once '../logic/Pregunta.class.php';
    require_once '../util/functions/Helper.class.php';

    if
    (
            
            !isset($_POST["p_prueba_id"]) ||
            empty($_POST["p_prueba_id"]) ||

            !isset($_POST["p_descripcion"]) ||
            empty($_POST["p_descripcion"]) ||

            !isset($_POST["p_respuesta"]) ||
            empty($_POST["p_respuesta"]) || 

            !isset($_POST["p_alternativa1"]) ||
            empty($_POST["p_alternativa1"]) ||

            !isset($_POST["p_alternativa2"]) ||
            empty($_POST["p_alternativa2"]) ||

            !isset($_POST["p_alternativa3"]) ||
            empty($_POST["p_alternativa3"]) ||

            !isset($_POST["p_alternativa4"]) ||
            empty($_POST["p_alternativa4"]) ||           
            
            !isset($_POST["p_tipo_ope"]) ||
            empty($_POST["p_tipo_ope"])
    ) {
        //Helper::imprimeJSON(500, "Falta completar datos", "");
        //exit();
    }
    // $Pregunta_id       = $_POST["p_pregunta_id"];
     $Prueba_id       = $_POST["p_prueba_id"];
     $Nombre_pregunta = $_POST["p_descripcion"];
     $Respuesta       = $_POST["p_respuesta"];   

     $Alternativa1    = $_POST["p_alternativa1"]; 
     $Alternativa2    = $_POST["p_alternativa2"]; 
     $Alternativa3    = $_POST["p_alternativa3"]; 
     $Alternativa4    = $_POST["p_alternativa4"];       
     
     $tipoOperacion = $_POST["p_tipo_ope"];

    $objPregunta = new Pregunta();

    if ($tipoOperacion == "agregar") {
        $objPregunta->setPrueba_id($Prueba_id);
        $objPregunta->setNombre_pregunta($Nombre_pregunta);
        $objPregunta->setRespuesta($Respuesta);

        $objPregunta->setAlternativa1($Alternativa1);
        $objPregunta->setAlternativa2($Alternativa2);
        $objPregunta->setAlternativa3($Alternativa3);
        $objPregunta->setAlternativa4($Alternativa4);
        //$objPregunta->setPregunta_id($Pregunta_id);
        $resultado = $objPregunta->agregar();
        if ($resultado) {
            Helper::imprimeJSON(200, "Agregado correctamente", "");
        }
    } else { //Editar
        if (
                !isset($_POST["p_codigo_pregunta"]) ||
                empty($_POST["p_codigo_pregunta"])
        ) {
            Helper::imprimeJSON(500, "Falta completar datos para editar", "");
            exit();
        }

        $codigo = $_POST["p_codigo_pregunta"];
        $objPregunta->setPregunta_id($codigo);
        
        $objPregunta->setNombre_pregunta($Nombre_pregunta);
        $objPregunta->setRespuesta($Respuesta);
        $objPregunta->setPrueba_id($Prueba_id);

        $objPregunta->setAlternativa1($Alternativa1);
        $objPregunta->setAlternativa2($Alternativa2);
        $objPregunta->setAlternativa3($Alternativa3);
        $objPregunta->setAlternativa4($Alternativa4);

        $resultado = $objPregunta->editar();
        if ($resultado) {
            Helper::imprimeJSON(200, "Agregado correctamente", "");
        }
    }
} catch (Exception $exc) {
    Helper::imprimeJSON(500, $exc->getMessage(), "");
}
