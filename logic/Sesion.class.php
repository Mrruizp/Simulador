<?php

require_once '../data/Conexion.class.php';

class Sesion extends Conexion {

    private $email;
    private $clave;
    private $Numiniciosesion;

    public function getEmail() {
        return $this->email;
    }

    public function getClave() {
        return $this->clave;
    }

    public function getNuminiciosesion() {
        return $Numiniciosesion->Numiniciosesion;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setClave($clave) {
        $this->clave = $clave;
    }

    public function setNuminiciosesion($Numiniciosesion) {
        $this->Numiniciosesion = $Numiniciosesion;
    }

    public function iniciarSesion() {
        try {
            $sql = "
                    select 
                            u.doc_id,
                            u.nombres,
                            u.apellidos,
                            u.direccion,
                            u.telefono,
                            r.clave,                            
                            r.estado,
                            r.codigo_usuario,                           
                            c.descripcion as cargo,
                            c.cargo_id,
                            r.tipo,
                            d.curso_id,
                            u.numiniciosesion
                    from
                            cargo c inner join usuario u 
                    on 
                            (c.cargo_id = u.cargo_id) inner join credenciales_acceso r
                    on
                            (r.doc_id = u.doc_id) left join detalle_docente_profesor d
                    on 
                            u.doc_id = d.doc_id
                    where
                            u.email = :p_email 
                ";

            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_email", $this->getEmail());
            $sentencia->execute();



            if ($sentencia->rowCount()) {//Le pregunto si ha devuelto registros
                //El usuario si existe
                $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);
                if ($resultado["clave"] === md5($this->getClave())) {
                    if ($resultado["estado"] === "I") {
                        return "IN"; //Usuario Inactivo
                    } else {
                        session_name("CampusVirtual");
                        session_start();

//                        $_SESSION["s_usuario"]  = $resultado["nombre"] . ' ' . $resultado["apellidos"];
                        $_SESSION["s_usuario"] = $resultado["nombres"];
                        $_SESSION["s_apellidos"] = $resultado["apellidos"];
                        $_SESSION["s_email"] = $this->getEmail();
                        $_SESSION["s_doc_id"] = $resultado["doc_id"];
                        $_SESSION["codigo_usuario"] = $resultado["codigo_usuario"];
                        $_SESSION["cargo_id"] = $resultado["cargo_id"];
                        $_SESSION["cargo"] = $resultado["cargo"]; // descripción del cargo
                        $_SESSION["tipo"] = $resultado["tipo"]; // tipo de usuario rol
                        $_SESSION["curso_id"] = $resultado["curso_id"]; // tipo de usuario rol
                        $_SESSION["numiniciosesion"] = $resultado["numiniciosesion"]; // tipo de usuario rol
                        
                        /*Registramos el movimiento del inicio de sesión*/
                       // $p_ip = getRealIP();
                        $sql2 = "select * from fn_insert_log_inicioseseion(
                                                                        :p_email, 
                                                                        '$_SESSION[cargo]',
                                                                        '$_SESSION[tipo]', 
                                                                        '$_SERVER[REMOTE_ADDR]'
                                                                    );";
                        $sentencia2 = $this->dblink->prepare($sql2);
                        $sentencia2->bindParam(":p_email", $this->getEmail());
                        $sentencia2->execute();
                        return "SI"; //Si ingresa
                        //numInicioSsion($_SESSION["s_doc_id"]);
                    }
                } else { //la contraseña no es igual
                    return "CI"; //Contraseña incorrecta
                }
            } else { //No se encontró registros (El usuario no existe)
                return "NE"; //No Existe
            }
        } catch (Exception $exc) {
            throw $exc;
        }
    }
/*
    public function getRealIP() {

        if (!empty($_SERVER["HTTP_CLIENT_IP"]))
            return $_SERVER["HTTP_CLIENT_IP"];
           
        if (!empty($_SERVER["HTTP_X_FORWARDED_FOR"]))
            return $_SERVER["HTTP_X_FORWARDED_FOR"];
       
        return $_SERVER["REMOTE_ADDR"];
}
*/
    public function numInicioSsion()
    {
        session_name("CampusVirtual");
                        session_start();
        $this->dblink->beginTransaction();
        
        
        try {
                /* Insertar en la tabla laboratorio */
                $sql = "
                        select * from fn_numSesion
                                            (
                                                '$_SESSION[s_doc_id]'
                                            );
                    ";
                $sentencia = $this->dblink->prepare($sql);
               // $sentencia->bindParam(":p_numiniciosesion", $this->getNuminiciosesion());
                $sentencia->execute();
                
                $this->dblink->commit();
                return true;
          
        } catch (Exception $exc) {
            $this->dblink->rollBack();
            throw $exc;
        }

        return false;
    }
    public function obtenerOpcionesMenu($codigoCargo) {
        try {
            $sql = "
                select
                        distinct 
                        m.codigo_menu,
                        m.nombre
                from
                        menu m
                        inner join menu_item_accesos a on ( m.codigo_menu = a.codigo_menu )
                where
                        a.cargo_id = :p_cargo_id
                        and a.acceso = '1'
                order by
                        1
                ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_cargo_id", $codigoCargo);
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }

public function obtenerOpcionesMenuItem($codigoCargo, $codigoMenu) {
        try {
            $sql = "
                    select
                            m.nombre,
                            m.archivo
                    from
                            menu_item m
                            inner join menu_item_accesos a 
                            on 
                            ( 
                                    m.codigo_menu = a.codigo_menu and 
                                    m.codigo_menu_item = a.codigo_menu_item 
                            )

                    where
                            a.cargo_id = :p_cargo_id
                            and a.codigo_menu = :p_codigo_menu
                            and a.acceso = '1'
                    order by
                            a.codigo_menu_item
                ";
            
//            $sentencia = $this->dbLink->prepare($sql);
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_cargo_id", $codigoCargo);
            $sentencia->bindParam(":p_codigo_menu", $codigoMenu);
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
            
        } catch (Exception $exc) {
            throw $exc;
        }
    }
    
    
}
