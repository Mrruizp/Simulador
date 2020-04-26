<?php

require_once '../data/Conexion.class.php';
session_name("CampusVirtual");
session_start();

class PreguntaSimulador extends Conexion {
    private $Cod_resp_usuario;

    public function getCod_resp_usuario() {
        return $this->Cod_resp_usuario;
    }

    public function setCod_resp_usuario($Cod_resp_usuario) {
        $this->Cod_resp_usuario = $Cod_resp_usuario;
    }
    public function listar($codPrueba) {
        try {
            $sql = "
                        SELECT *
                        FROM (SELECT DISTINCT pr.pregunta_id,
                                                        pr.nombre_pregunta,
                                                        pr.respuesta,
                                                        pr.prueba_id,
                                                        pr.alternativa1,
                                                        pr.alternativa2,
                                                        pr.alternativa3,
                                                        pr.alternativa4
                              from 
                                    pregunta pr left join respuesta_pregunta_usuario r
                                on
                                    pr.pregunta_id = r.pregunta_id
                                where
                                    prueba_id = 1
                             ) t
                        ORDER BY random()
                        LIMIT 7;
                        ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }

    public function listarMisRespuestas($codPrueba) {
        try {
            $sql = "select
                       r.numpregunta,
                       r.respuesta_usuario
                    from 
                        pregunta pr right join respuesta_pregunta_usuario r
                    on
                        pr.pregunta_id = r.pregunta_id
                    where
                        r.doc_id = '$_SESSION[s_doc_id]'
                    order by r.numpregunta is null;";

            $sentencia = $this->dblink->prepare($sql);
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }

    public function listarObtenerCodPregunta($pregunta) {
        try {
            $sql = "select pregunta_id from pregunta where pregunta_id ~ '$pregunta';";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->execute();
            $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }

    public function leerDatosRespuestaPregunta($codPregunta) {
        //$dni = $_SESSION["s_doc_id"];
        try {
            $sql = "select 
                        respuesta_usuario,
                        pregunta_id

                    from 
                        respuesta_pregunta_usuario
                    where
                        pregunta_id = $codPregunta
                    and
                        doc_id = '$_SESSION[s_doc_id]';";

            $sentencia = $this->dblink->prepare($sql);
            $sentencia->execute();
            $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }

    public function agregar($preg_respuesta, $cod_pregunta, $numPregunta) {
        $this->dblink->beginTransaction();

        try {
                $sql = "
                        select * from fn_RegistrarRespuestaUsuario
                                    (
                                        '$preg_respuesta',
                                        $cod_pregunta,
                                        '$numPregunta',
                                        '$_SESSION[s_doc_id]'
                                    )

                    ";
                $sentencia = $this->dblink->prepare($sql);
                $sentencia->execute();
              
                $this->dblink->commit();
                return true;
            
        } catch (Exception $exc) {
            $this->dblink->rollBack();
            throw $exc;
        }

        return false;
    }

    public function eliminarRespuestas() {
        try {
            $sql = "
                delete from 
                    prueba 
                where
                    prueba_id = :p_prueba_id
                ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_prueba_id", $this->getPrueba_id());
            $sentencia->execute();
            return true;
        } catch (Exception $exc) {
            throw $exc;
        }
        return false;
    }
}
