<?php

require_once '../data/Conexion.class.php';
session_name("CampusVirtual");
session_start();
class CalificarNull extends Conexion {


    public function ejecutar($p_codigoCurso) {
        $this->dblink->beginTransaction();

        try {
           

                /* Insertar en la tabla laboratorio */
                $sql = "
                        select * from fn_calificarExamenNull
                                                            (
                                                                '$_SESSION[s_doc_id]', 
                                                                $p_codigoCurso
                                                            );

                    ";
                $sentencia = $this->dblink->prepare($sql);
                $sentencia->execute();
                /* Actualizar el correlativo */
                $this->dblink->commit();
                return true;
           
        } catch (Exception $exc) {
            $this->dblink->rollBack();
            throw $exc;
        }

        return false;
    }

}
