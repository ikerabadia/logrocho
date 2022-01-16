<?php

const DB_INFO = 'mysql:host=localhost:3306;dbname=logrocho';

const DB_USER = 'root';

const DB_PASS = '';

class Conexion
{

    static function getConection()
    {
        return new \PDO(DB_INFO, DB_USER, DB_PASS);
    }


    static function getLogin($user, $password)
    {
        try {
            $db = Conexion::getConection();

            $sql = "SELECT * FROM usuarios WHERE user='" . $user . "' AND password='" . $password . "'";
            $resultado = $db->query($sql);

            if ($resultado) {
                return $resultado;
            } else {
                throw new Exception("Error en el select....");
            }
        } catch (\Exception $th) {
            echo $th->getMessage();
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    static function getUsuario($user)
    {
        try {
            $db = Conexion::getConection();

            $sql = "SELECT * FROM restaurante WHERE correo='" . $user . "'";
            $resultado = $db->query($sql);

            if ($resultado) {
                return $resultado;
            } else {
                throw new Exception("Error en el select....");
            }
        } catch (\Exception $th) {
            echo $th->getMessage();
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    static function getUsuarioId($id)
    {
        try {
            $db = Conexion::getConection();

            $sql = "SELECT * FROM restaurante WHERE sha1(CodRes)='".trim($id)."'";
            //return $sql;
            $resultado = $db->query($sql);
            
            if ($resultado) {
                return $resultado;
            } else {
                throw new Exception("Error en el select....");
            } 
        } catch (\Exception $th) {
            echo $th->getMessage();
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    static function getCategorias(){
        try {
            $db = Conexion::getConection();

            $sql = "SELECT * FROM categoria";
            $resultado = $db->query($sql);

            if ($resultado) {
                return $resultado;
            } else {
                throw new Exception("Error en el select....");
            }
        } catch (\Exception $th) {
            echo $th->getMessage();
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    static function getCategoria($idCategoria){
        try {
            $db = Conexion::getConection();

            $sql = "SELECT * FROM categoria WHERE sha1(CodCat)='".$idCategoria."'";
            $resultado = $db->query($sql);

            if ($resultado) {
                return $resultado;
            } else {
                throw new Exception("Error en el select....");
            }
        } catch (\Exception $th) {
            echo $th->getMessage();
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    static function getProductos($idCategoria){
        try {
            $db = Conexion::getConection();

            $sql = "SELECT * FROM producto WHERE sha1(CodCat)='".$idCategoria."'";
            $resultado = $db->query($sql);

            if ($resultado) {
                return $resultado;
            } else {
                throw new Exception("Error en el select....");
            }
        } catch (\Exception $th) {
            echo $th->getMessage();
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    static function getProducto($idProducto){
        try {
            $db = Conexion::getConection();

            $sql = "SELECT * FROM producto WHERE CodProd=".$idProducto;
            $resultado = $db->query($sql);

            if ($resultado) {
                return $resultado;
            } else {
                throw new Exception("Error en el select....");
            }
        } catch (\Exception $th) {
            echo $th->getMessage();
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }
    static function nuevoPedido($CodRes){
        try {
            $db = Conexion::getConection();

            $sql = "INSERT INTO `pedido`(`CodPed`, `CodRes`, `Fecha`, `Enviado`) VALUES (null,".$CodRes.",now(),false)";
            $resultado = $db->query($sql);

            if ($resultado) {
                return $db->lastInsertId();
            } else {
                throw new Exception("Error en el select....");
            }
        } catch (\Exception $th) {
            echo $th->getMessage();
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }
    static function nuevoUsuario($usuario,$contraseña){
        try {
            $db = Conexion::getConection();

            $sql = "INSERT INTO `restaurante`(`CodRes`, `Correo`, `Clave`, `Direccion`, `CP`, `Pais`) VALUES (null,'".$usuario."','".$contraseña."','Direccion generica','26000','España')";
            $resultado = $db->query($sql);

            if ($resultado) {
                return $db->lastInsertId();
            } else {
                throw new Exception("Error en el select....");
            }
        } catch (\Exception $th) {
            echo $th->getMessage();
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    static function cambiarContrasena($codRes,$contraseña){
        try {
            $db = Conexion::getConection();

            $sql = "UPDATE `restaurante` SET Clave='".$contraseña."' WHERE sha1(CodRes)='".trim($codRes)."'";
            $resultado = $db->query($sql);

            if ($resultado) {
                return $db->lastInsertId();
            } else {
                throw new Exception("Error en el select....");
            }
        } catch (\Exception $th) {
            echo $th->getMessage();
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    static function getCodRes($Correo){
        try {
            $db = Conexion::getConection();

            $sql = "SELECT * FROM restaurante WHERE Correo='".$Correo."'";
            $resultado = $db->query($sql);

            if ($resultado) {
                foreach ($resultado as $restaurante) {
                    return $restaurante["CodRes"];
                }
            } else {
                throw new Exception("Error en el select....");
            }
        } catch (\Exception $th) {
            echo $th->getMessage();
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }
    static function nuevoPedidoProducto($CodPed, $CodProd, $unidades, $db){
        try {

            $sql = "INSERT INTO `pedidoproducto`(`ID`, `CodProd`, `CodPed`, `Unidades`) VALUES (null,".$CodProd.",".$CodPed.",".$unidades.")";
            $resultado = $db->query($sql);

            if ($resultado) {
                return $resultado;
            } else {
                throw new Exception("Error en el select....");
            }
        } catch (\Exception $th) {
            echo $th->getMessage();
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }
}
