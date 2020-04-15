<?php

try {

    require_once '../logic/Prueba.class.php';
    require_once '../util/functions/Helper.class.php';

    if
    (
            !isset($_POST["p_curso_id"]) ||
            empty($_POST["p_curso_id"]) ||

            !isset($_POST["p_cantPregunta"]) ||
            empty($_POST["p_cantPregunta"]) ||

            !isset($_POST["p_tiempo"]) ||
            empty($_POST["p_tiempo"]) ||

            !isset($_POST["p_puntaje"]) ||
            empty($_POST["p_puntaje"]) 

    ) {
        Helper::imprimeJSON(500, "Falta completar datos", "");
        exit();
    }
    $Curso_id      = $_POST["p_curso_id"];
    $CantPregunta  = $_POST["p_cantPregunta"];
    $Tiempo        = $_POST["p_tiempo"];
    $Puntaje       = $_POST["p_puntaje"];
    
    $objPrueba = new Prueba();

        $objPrueba->setCurso_id($Curso_id);
        $objPrueba->setCantPregunta($CantPregunta);
        $objPrueba->setTiempo($Tiempo);
        $objPrueba->setPuntaje($Puntaje);
        $resultado = $objPrueba->agregar();
        if ($resultado) 
        {
            Helper::imprimeJSON(200, "Agregado correctamente", "");
        }
    
} catch (Exception $exc) {
    Helper::imprimeJSON(500, $exc->getMessage(), "");
}
