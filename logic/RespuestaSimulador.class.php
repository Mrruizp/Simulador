<?php

require_once '../data/Conexion.class.php';
session_name("CampusVirtual");
session_start();

class RespuestaSimulador extends Conexion {
    
    public function listar() {
        try {
            $sql = "
                    select distinct * from promedio where doc_id = '$_SESSION[s_doc_id]';
                ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }    

    public function eliminarResultados($codPrueba) {
        try {
            $sql = "
                select * from fn_eliminarRespuestaPromedio
                                            (
                                            '$_SESSION[s_doc_id]',
                                            $codPrueba
                                            )
                ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->execute();
            return true;
        } catch (Exception $exc) {
            throw $exc;
        }
        return false;
    }

    public function listarDetalleResultados($codPruebaCurso) {
        try {
            $sql = "
                    select 
                        c.nombre_curso,
                        e.nombre_pregunta,
                        e.respuesta,
                        r.respuesta_usuario,
                        r.estado
                    from 
                        curso c inner join pregunta e 
                    on
                        c.curso_id = e.prueba_id left join respuesta_pregunta_usuario r 
                    on
                        e.pregunta_id = r.pregunta_id left join promedio p
                    on 
                        r.promedio_id = p.promedio_id
                    where
                        r.doc_id = '$_SESSION[s_doc_id]'
                        and e.prueba_id = $codPruebaCurso or r.respuesta_usuario is null;
                ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    } 
}
