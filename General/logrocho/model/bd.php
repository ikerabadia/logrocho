<?php

const DB_INFO = 'mysql:host=localhost:3307;dbname=logrocho';

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

    /*BARES*/
    static function getBares($pagina, $cantidadRegistros){
        try {
            $db = Conexion::getConection();

            $sql = "SELECT * FROM restaurantes LIMIT $cantidadRegistros OFFSET ".($pagina-1)*$cantidadRegistros;
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

    static function getBar($idBar){
        try {
            $db = Conexion::getConection();

            $sql = "SELECT * FROM restaurantes WHERE idRestaurante = ".$idBar;
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

    static function newBar($nombre, $descripcion, $localizacion){
        try {
            $db = Conexion::getConection();

            $sql = "INSERT INTO `restaurantes`(`nombre`, `descripcion`, `localizacion`) VALUES ('$nombre', '$descripcion', '$localizacion')";
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

    static function deleteBar($idBar){
        try {
            $db = Conexion::getConection();

            $sql = "DELETE FROM restaurantes WHERE idRestaurante = ".$idBar;
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

    static function updateBar($idBar, $nombre, $descripcion, $localizacion){
        try {
            $db = Conexion::getConection();

            $sql = "UPDATE `restaurantes` SET nombre = '$nombre', descripcion = '$descripcion', localizacion = '$localizacion' WHERE idRestaurante = $idBar";
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

    /*RESEÑAS*/
    static function getReseñas($pagina, $cantidadRegistros){
        try {
            $db = Conexion::getConection();

            $sql = "SELECT * FROM reseñas LIMIT $cantidadRegistros OFFSET ".($pagina-1)*$cantidadRegistros;
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

    static function getReseña($idReseña){
        try {
            $db = Conexion::getConection();

            $sql = "SELECT * FROM reseñas WHERE idReseña = ".$idReseña;
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

    static function newReseña($usuario, $pincho, $nota, $texto){
        try {
            $db = Conexion::getConection();

            $sql = "INSERT INTO `reseñas`(`fkUsuario`, `fkPincho`, `nota`, `textoReseña`) VALUES ('$usuario', '$pincho', '$nota', '$texto')";
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

    static function deleteReseña($idReseña){
        try {
            $db = Conexion::getConection();

            $sql = "DELETE FROM reseñas WHERE idReseña = ".$idReseña;
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

    static function updateReseña($idReseña, $usuario, $pincho, $nota, $texto){
        try {
            $db = Conexion::getConection();

            $sql = "UPDATE `reseñas` SET fkUsuario = '$usuario', fkPincho = '$pincho', nota = '$nota', textoReseña = '$texto' WHERE idReseña = $idReseña";
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

    /*PINCHOS*/
    static function getPinchos($pagina, $cantidadRegistros){
        try {
            $db = Conexion::getConection();

            $sql = "SELECT * FROM pinchos LIMIT $cantidadRegistros OFFSET ".($pagina-1)*$cantidadRegistros;
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

    static function getPincho($idPincho){
        try {
            $db = Conexion::getConection();

            $sql = "SELECT * FROM pinchos WHERE idPincho = ".$idPincho;
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
    static function newPincho($nombre, $precio, $bar, $descripcion){
        try {
            $db = Conexion::getConection();

            $sql = "INSERT INTO `pinchos`(`nombre`, `precio`, `fkBar`, `descripcion`) VALUES ('$nombre', '$precio', '$bar', '$descripcion')";
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

    static function deletePincho($idPincho){
        try {
            $db = Conexion::getConection();

            $sql = "DELETE FROM pinchos WHERE idPincho = ".$idPincho;
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

    static function updatePincho($idPincho, $nombre, $precio, $bar, $descripcion){
        try {
            $db = Conexion::getConection();

            $sql = "UPDATE `pinchos` SET nombre = '$nombre', precio = '$precio', fkBar = '$bar', descripcion = '$descripcion' WHERE idPincho = $idPincho";
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

    /*USUARIOS*/
    static function getUsuarios($pagina, $cantidadRegistros){
        try {
            $db = Conexion::getConection();

            $sql = "SELECT * FROM usuarios LIMIT $cantidadRegistros OFFSET ".($pagina-1)*$cantidadRegistros;
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

    static function getUser($idUsuario){
        try {
            $db = Conexion::getConection();

            $sql = "SELECT * FROM usuarios WHERE idUsuario = ".$idUsuario;
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

    static function newUsuario($nombre, $apellido1, $apellido2, $correoElectronico, $user, $password, $admin){
        try {
            $db = Conexion::getConection();

            $sql = "INSERT INTO `usuarios`(`nombre`, `apellido1`, `apellido2`, `correoElectronico`, `user`, `password`, `admin`) VALUES ('$nombre', '$apellido1', '$apellido2', '$correoElectronico', '$user', '$password', '$admin')";
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

    static function deleteUsuario($idUsuario){
        try {
            $db = Conexion::getConection();

            $sql = "DELETE FROM usuarios WHERE idUsuario = ".$idUsuario;
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

    static function updateUsuario($idUsuario, $nombre, $apellido1, $apellido2, $correoElectronico, $user, $password, $admin){
        try {
            $db = Conexion::getConection();

            $sql = "UPDATE `usuarios` SET nombre = '$nombre', apellido1 = '$apellido1', apellido2 = '$apellido2', correoElectronico = '$correoElectronico', user = '$user', password = '$password', admin = '$admin' WHERE idUsuario = $idUsuario";
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
