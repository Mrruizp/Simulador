<?php

require_once '../data/Conexion.class.php';
session_name("CampusVirtual");
session_start();
class Pregunta extends Conexion {

    private $Pregunta_id;
    private $Nombre_pregunta;
    private $Respuesta;
    private $Prueba_id;
    private $Alternativa1;
    private $Alternativa2;
    private $Alternativa3;
    private $Alternativa4;

    public function getPregunta_id() {
        return $this->Pregunta_id;
    }

    public function getNombre_pregunta() {
        return $this->Nombre_pregunta;
    }

    public function getRespuesta() {
        return $this->Respuesta;
    }

    public function getPrueba_id() {
        return $this->Prueba_id;
    }
    public function getAlternativa1() {
        return $this->Alternativa1;
    }
    public function getAlternativa2() {
        return $this->Alternativa2;
    }
    public function getAlternativa3() {
        return $this->Alternativa3;
    }
    public function getAlternativa4() {
        return $this->Alternativa4;
    }

    public function setPregunta_id($Pregunta_id) {
        $this->Pregunta_id = $Pregunta_id;
    }

    public function setNombre_pregunta($Nombre_pregunta) {
        $this->Nombre_pregunta = $Nombre_pregunta;
    }

    public function setRespuesta($Respuesta) {
        $this->Respuesta = $Respuesta;
    }

    public function setPrueba_id($Prueba_id) {
        $this->Prueba_id = $Prueba_id;
    }

    public function setAlternativa1($Alternativa1) {
        $this->Alternativa1 = $Alternativa1;
    }

    public function setAlternativa2($Alternativa2) {
        $this->Alternativa2 = $Alternativa2;
    }

    public function setAlternativa3($Alternativa3) {
        $this->Alternativa3 = $Alternativa3;
    }

    public function setAlternativa4($Alternativa4) {
        $this->Alternativa4 = $Alternativa4;
    }

    public function listar() {
        try {
            $sql = "
                    select 
                        r.nombre_pregunta,
                        r.alternativa1,
                        r.alternativa2,
                        r.alternativa3,
                        r.alternativa4,
                        r.respuesta,
                        c.nombre_curso,
                        r.pregunta_id
                    from 
                        curso c inner join prueba p
                    on
                        c.curso_id = p.curso_id inner join pregunta r
                    on
                        p.prueba_id = r.prueba_id
                    order by 
                            1
                ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }

    public function listarPreguntaDocente() {
        //session_name("CampusVirtual");
        //              session_start();
        try {
            $sql = "
                    select 
                        r.nombre_pregunta,
                        r.alternativa1,
                        r.alternativa2,
                        r.alternativa3,
                        r.alternativa4,
                        r.respuesta,
                        c.nombre_curso,
                        r.pregunta_id
                    from 
                        curso c inner join prueba p
                    on
                        c.curso_id = p.curso_id inner join pregunta r
                    on
                        p.prueba_id = r.prueba_id
                    where
                        p.prueba_id = $_SESSION[curso_id]
                    order by 
                            1
                ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }

    public function agregar() {
        $this->dblink->beginTransaction();

        try {
            $sql = "select * from f_generar_correlativo('pregunta') as nc";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->execute();

            if ($sentencia->rowCount()) {
                $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);
                $nuevoCodigo = $resultado["nc"];
                $this->setPregunta_id($nuevoCodigo);

                /* Insertar en la tabla laboratorio */
                $sql = "

                    insert into pregunta(
                                                pregunta_id,
                                                nombre_pregunta,
                                                respuesta,
                                                prueba_id,
                                                alternativa1,
                                                alternativa2,
                                                alternativa3,
                                                alternativa4
                                                )
                            values ( 
                                    :p_pregunta_id,
                                    :p_nombre_pregunta,
                                    :p_respuesta,
                                    :p_prueba_id,
                                    :p_alternativa1,
                                    :p_alternativa2,
                                    :p_alternativa3,
                                    :p_alternativa4
                                    );

                    ";
                $sentencia = $this->dblink->prepare($sql);
                $sentencia->bindParam(":p_pregunta_id", $this->getPregunta_id());
                $sentencia->bindParam(":p_nombre_pregunta", $this->getNombre_pregunta());
                $sentencia->bindParam(":p_respuesta", $this->getRespuesta());
                $sentencia->bindParam(":p_prueba_id", $this->getPrueba_id());
                $sentencia->bindParam(":p_alternativa1", $this->getAlternativa1());
                $sentencia->bindParam(":p_alternativa2", $this->getAlternativa2());
                $sentencia->bindParam(":p_alternativa3", $this->getAlternativa3());
                $sentencia->bindParam(":p_alternativa4", $this->getAlternativa4());
                $sentencia->execute();

                $sql = "
                    select * from fn_insert_log_pregunta(
                                                '$_SESSION[s_doc_id]',
                                                '$_SESSION[s_usuario]',
                                                '$_SESSION[s_apellidos]',
                                                $_SESSION[cargo_id],
                                                '$_SESSION[tipo]',
                                                :p_pregunta_id,
                                                :p_nombre_pregunta,
                                                :p_alternativa1,
                                                :p_alternativa2,
                                                :p_alternativa3,
                                                :p_alternativa4,
                                                :p_respuesta,
                                                :p_prueba_id,
                                                'Insert',
                                                '$_SERVER[REMOTE_ADDR]'
                                                );

                    ";
                $sentencia = $this->dblink->prepare($sql);
                $sentencia->bindParam(":p_pregunta_id", $this->getPregunta_id());
                $sentencia->bindParam(":p_nombre_pregunta", $this->getNombre_pregunta());
                $sentencia->bindParam(":p_respuesta", $this->getRespuesta());
                $sentencia->bindParam(":p_prueba_id", $this->getPrueba_id());
                $sentencia->bindParam(":p_alternativa1", $this->getAlternativa1());
                $sentencia->bindParam(":p_alternativa2", $this->getAlternativa2());
                $sentencia->bindParam(":p_alternativa3", $this->getAlternativa3());
                $sentencia->bindParam(":p_alternativa4", $this->getAlternativa4());
                $sentencia->execute();
                /* Insertar en la tabla laboratorio */

                /* Actualizar el correlativo */
                $sql = "update correlativo set numero = numero + 1 
                    where tabla='pregunta'";
                $sentencia = $this->dblink->prepare($sql);
                $sentencia->execute();
                /* Actualizar el correlativo */
                $this->dblink->commit();
                return true;
            } else {
                throw new Exception("No se ha configurado el correlativo para la tabla pregunta");
            }
        } catch (Exception $exc) {
            $this->dblink->rollBack();
            throw $exc;
        }

        return false;
    }

    public function leerDatos($codPregunta) {
        try {
            $sql = "
                    select                         
                            *
                    from 
                        prueba p inner join pregunta r 
                    on
                        p.prueba_id = r.prueba_id 
                    where
                        r.pregunta_id = :p_pregunta_id;
                ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_pregunta_id", $codPregunta);
            $sentencia->execute();
            $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }

    public function editar() {
        try {
            $sql = "

                    update 
                        pregunta
                    set 
                        nombre_pregunta = :p_nombre_pregunta,
                        respuesta = :p_respuesta,
                        prueba_id = :p_prueba_id,
                        alternativa1 = :p_alternativa1,
                        alternativa2 = :p_alternativa2,
                        alternativa3 = :p_alternativa3,
                        alternativa4 = :p_alternativa4
                    where
                        pregunta_id = :p_pregunta_id;

                ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_pregunta_id", $this->getPregunta_id());
            $sentencia->bindParam(":p_nombre_pregunta", $this->getNombre_pregunta());
            $sentencia->bindParam(":p_respuesta", $this->getRespuesta());
            $sentencia->bindParam(":p_prueba_id", $this->getPrueba_id());
            $sentencia->bindParam(":p_alternativa1", $this->getAlternativa1());
            $sentencia->bindParam(":p_alternativa2", $this->getAlternativa2());
            $sentencia->bindParam(":p_alternativa3", $this->getAlternativa3());
            $sentencia->bindParam(":p_alternativa4", $this->getAlternativa4());
            $sentencia->execute();

            $sql = "
                select * from fn_insert_log_pregunta(
                                                '$_SESSION[s_doc_id]',
                                                '$_SESSION[s_usuario]',
                                                '$_SESSION[s_apellidos]',
                                                $_SESSION[cargo_id],
                                                '$_SESSION[tipo]',
                                                :p_pregunta_id,
                                                :p_nombre_pregunta,
                                                :p_alternativa1,
                                                :p_alternativa2,
                                                :p_alternativa3,
                                                :p_alternativa4,
                                                :p_respuesta,
                                                :p_prueba_id,
                                                'Update',
                                                '$_SERVER[REMOTE_ADDR]'
                                                );

                    ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_pregunta_id", $this->getPregunta_id());
            $sentencia->bindParam(":p_nombre_pregunta", $this->getNombre_pregunta());
            $sentencia->bindParam(":p_respuesta", $this->getRespuesta());
            $sentencia->bindParam(":p_prueba_id", $this->getPrueba_id());
            $sentencia->bindParam(":p_alternativa1", $this->getAlternativa1());
            $sentencia->bindParam(":p_alternativa2", $this->getAlternativa2());
            $sentencia->bindParam(":p_alternativa3", $this->getAlternativa3());
            $sentencia->bindParam(":p_alternativa4", $this->getAlternativa4());
            $sentencia->execute();
            return true;
        } catch (Exception $exc) {
            throw $exc;
        }
        return false;
    }

    public function eliminar() {
        try {
            $sql = "
                delete from 
                    pregunta 
                where
                    pregunta_id = :p_pregunta_id
                ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_pregunta_id", $this->getPregunta_id());
            $sentencia->execute();

            $sql = "
                select * from fn_insert_log_pregunta(
                                                '$_SESSION[s_doc_id]',
                                                '$_SESSION[s_usuario]',
                                                '$_SESSION[s_apellidos]',
                                                $_SESSION[cargo_id],
                                                '$_SESSION[tipo]',
                                                :p_pregunta_id,
                                                null,
                                                null,
                                                null,
                                                null,
                                                null,
                                                null,
                                                null,
                                                'Delete',
                                                '$_SERVER[REMOTE_ADDR]'
                                                );
                ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_pregunta_id", $this->getPregunta_id());
            $sentencia->execute();
            return true;
        } catch (Exception $exc) {
            throw $exc;
        }
        return false;
    }

}
