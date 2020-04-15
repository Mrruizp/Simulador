<?php

require_once '../data/Conexion.class.php';
session_name("CampusVirtual");
session_start();
class Prueba extends Conexion {

    private $Prueba_id;
    private $Curso_id;
    private $CantPregunta;
    private $Tiempo;
    private $Puntaje;
    private $Instrucciones;

    public function getPrueba_id() {
        return $this->Prueba_id;
    }

    public function getCurso_id() {
        return $this->Curso_id;
    }

    public function getCantPregunta() {
        return $this->CantPregunta;
    }

    public function getTiempo() {
        return $this->Tiempo;
    }

    public function getPuntaje() {
        return $this->Puntaje;
    }

    public function setPrueba_id($Prueba_id) {
        $this->Prueba_id = $Prueba_id;
    }

    public function setCurso_id($Curso_id) {
        $this->Curso_id = $Curso_id;
    }

    public function setCantPregunta($CantPregunta) {
        $this->CantPregunta = $CantPregunta;
    }

    public function setTiempo($Tiempo) {
        $this->Tiempo = $Tiempo;
    }

    public function setPuntaje($Puntaje) {
        $this->Puntaje = $Puntaje;
    }

    public function listar() {
        try {
            $sql = "
                    select  
                        p.prueba_id,
                        c.nombre_curso,
                        p.cant_preguntas,
                        p.tiempo_prueba,
                        p.puntaje_aprobacion
                    from 
                        prueba p inner join curso c
                    on
                        p.curso_id = c.curso_id
                    order by 
                            2
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
            $sql = "select * from f_generar_correlativo('prueba') as nc";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->execute();

            if ($sentencia->rowCount()) {
                $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);
                $nuevoCodigo = $resultado["nc"];
                $this->setPrueba_id($nuevoCodigo);

                /* Insertar en la tabla laboratorio */
                $sql = "
                    select * from fn_registrarEditarPrueba
                                    (
                                        :p_prueba_id,
                                        :p_cant_preguntas,
                                        :p_tiempo_prueba,
                                        :p_puntaje_aprobacion,
                                        :p_curso_id
                                    );

                    ";
                $sentencia = $this->dblink->prepare($sql);
                $sentencia->bindParam(":p_prueba_id", $this->getPrueba_id());
                $sentencia->bindParam(":p_cant_preguntas", $this->getCantPregunta());
                $sentencia->bindParam(":p_tiempo_prueba", $this->getTiempo());
                $sentencia->bindParam(":p_puntaje_aprobacion", $this->getPuntaje());
                $sentencia->bindParam(":p_curso_id", $this->getCurso_id());
                $sentencia->execute();
                /* Insertar en la tabla laboratorio */

                /* Actualizar el correlativo */
                $sql = "update correlativo set numero = numero + 1 
                    where tabla='prueba'";
                $sentencia = $this->dblink->prepare($sql);
                $sentencia->execute();
                /* Actualizar el correlativo */
                $this->dblink->commit();
                return true;
            } else {
                throw new Exception("No se ha configurado el correlativo para la tabla prueba");
            }
        } catch (Exception $exc) {
            $this->dblink->rollBack();
            throw $exc;
        }

        return false;
    }

    public function leerDatos($p_codigoCurso) {
        try {
            $sql = "
                    select 
                        p.prueba_id,
                        p.cant_preguntas,
                        p.tiempo_prueba,
                        p.puntaje_aprobacion,
                        p.curso_id,
                        c.nombre_curso
                    from 
                        prueba p inner join curso c
                    on
                        c.curso_id = p.curso_id
                    where 
                        p.prueba_id = :p_prueba_id
                ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_prueba_id", $p_codigoCurso);
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
                    prueba 
                set  
                    cant_preguntas = :p_nombre_curso,
                    tiempo_prueba = :p_nombre_curso,
                    puntaje_aprobacion = :p_nombre_curso,
                    instrucciones = :p_nombre_curso
                where
                    prueba_id = :p_prueba_id
                ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_prueba_id", $this->getPrueba_id());
            $sentencia->bindParam(":p_cant_preguntas", $this->getCantPregunta());
            $sentencia->bindParam(":p_tiempo_prueba", $this->getTiempo());
            $sentencia->bindParam(":p_puntaje_aprobacion", $this->getPuntaje());
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

    public function calificarPrueba($codigoPrueba){
        $this->dblink->beginTransaction();

        try {
                $sql = "
                        select * from fn_calificarExamen
                                    (
                                        '$_SESSION[s_doc_id]',
                                        $codigoPrueba
                                    );

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
}
