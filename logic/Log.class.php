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

}
