<?php

require_once '../data/Conexion.class.php';

class Pregunta extends Conexion {

    private $Pregunta_id;
    private $Nombre_pregunta;
    private $Respuesta;
    private $Prueba_id;

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

    public function listar() {
        try {
            $sql = "
                    select 
                        r.pregunta_id,
                        r.nombre_pregunta,
                        r.respuesta,
                        p.prueba_id,
                        c.nombre_curso
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
                                                prueba_id
                                                )
                            values ( 
                                    :p_pregunta_id,
                                    :p_nombre_pregunta,
                                    :p_respuesta,
                                    :p_prueba_id
                                    );

                    ";
                $sentencia = $this->dblink->prepare($sql);
                $sentencia->bindParam(":p_pregunta_id", $this->getPregunta_id());
                $sentencia->bindParam(":p_nombre_pregunta", $this->getNombre_pregunta());
                $sentencia->bindParam(":p_respuesta", $this->getRespuesta());
                $sentencia->bindParam(":p_prueba_id", $this->getPrueba_id());
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
                        prueba_id = :p_prueba_id
                    where
                        pregunta_id = :p_pregunta_id;

                ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_pregunta_id", $this->getPregunta_id());
            $sentencia->bindParam(":p_nombre_pregunta", $this->getNombre_pregunta());
            $sentencia->bindParam(":p_respuesta", $this->getRespuesta());
            $sentencia->bindParam(":p_prueba_id", $this->getPrueba_id());
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
            return true;
        } catch (Exception $exc) {
            throw $exc;
        }
        return false;
    }

}
