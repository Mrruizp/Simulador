<?php

require_once '../data/Conexion.class.php';

class Log extends Conexion {

    public function listarLog_iniciosesion() {
        try {
            $sql = "
                   select 
                        doc_id,
                        nombres,
                        apellidos,
                        cargo,
                        tipo,
                        fecha,
                        tiempo,
                        ip
                    from 
                        log_inicioseseion;
                ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }

    public function listarLog_usuario() {
        try {
            $sql = "
                   select 
                        usuarioqueregistra_doc_id,
                        usuarioqueregistra_nombres,
                        usuarioqueregistra_apellidos,
                        usuarioqueregistra_cargo_id,
                        usuarioqueregistra_tipo,
                        fecha,
                        tiempo,
                        ip,
                        u.doc_id,
                        u.nombres,
                        u.apellidos,
                        u.direccion,
                        u.telefono,
                        u.email,
                        u.cargo_id,
                        u.tipo_operacion,
                        c.clave,
                        c.tipo,
                        c.estado,
                        r.nombre_curso  
                        
                    from 
                        log_usuario u inner join log_credenciales_acceso c
                    on
                        u.doc_id = c.doc_id inner join log_detalle_docente_profesor d
                    on
                        u.doc_id = d.doc_id inner join curso r
                    on
                        d.curso_id = r.curso_id;
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
