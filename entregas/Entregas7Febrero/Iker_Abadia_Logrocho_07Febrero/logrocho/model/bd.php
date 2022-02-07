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

    static function getImagenRestaurante($idBar, $numeroImagen){
        try {
            $db = Conexion::getConection();

            $sql = "SELECT * FROM imagenes_bares WHERE fk_bar = ".$idBar." and numeroImagen = ".$numeroImagen;
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

    static function guardarImagenRestaurante($fk_bar,$numeroImagen, $imagen){
        try {
            $db = Conexion::getConection();

            $sql = "INSERT INTO `imagenes_bares`(`fk_bar`, `imagen`, `numeroImagen`) VALUES ('$fk_bar', '$imagen', '$numeroImagen')";
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

    static function deleteImagenRestaurante($fk_bar, $numeroImagen){
        try {
            $db = Conexion::getConection();

            $sql = "DELETE FROM imagenes_bares WHERE `fk_bar` = ".$fk_bar." and `numeroImagen` = ".$numeroImagen;
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

    static function getReseñasByUsuario($idUsuario){
        try {
            $db = Conexion::getConection();

            $sql = "SELECT * FROM reseñas WHERE fkUsuario = $idUsuario";
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

    static function getReseñasByPincho($idPincho){
        try {
            $db = Conexion::getConection();

            $sql = "SELECT * FROM reseñas WHERE fkPincho = $idPincho";
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

    static function getPinchosByRestaurante($idRestaurante){
        try {
            $db = Conexion::getConection();

            $sql = "SELECT * FROM pinchos WHERE fkBar = $idRestaurante";
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

    
    static function getImagenPincho($idPincho, $numeroImagen){
        try {
            $db = Conexion::getConection();

            $sql = "SELECT * FROM imagenes_pincho WHERE fk_pincho = ".$idPincho." and numeroImagen = ".$numeroImagen;
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

    static function guardarImagenPincho($fk_pincho,$numeroImagen, $imagen){
        try {
            $db = Conexion::getConection();

            $sql = "INSERT INTO `imagenes_pincho`(`fk_pincho`, `imagen`, `numeroImagen`) VALUES ('$fk_pincho', '$imagen', '$numeroImagen')";
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

    static function deleteImagenPincho($fk_pincho, $numeroImagen){
        try {
            $db = Conexion::getConection();

            $sql = "DELETE FROM imagenes_pincho WHERE `fk_pincho` = ".$fk_pincho." and `numeroImagen` = ".$numeroImagen;
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

    static function limpiarLikesUsuario($idUsuario){
        try {
            $db = Conexion::getConection();

            $sql = "DELETE FROM `likes` WHERE fkUsuario = '$idUsuario'";
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

    static function guardarImagenUsuario($idUsuario, $ruta){
        try {
            $db = Conexion::getConection();

            $sql = "INSERT INTO `imagenes_usuarios`(`imagen`, `fk_usuario`) VALUES ('$ruta', '$idUsuario')";
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

    static function getImagenUsuario($idUsuario){
        try {
            $db = Conexion::getConection();

            $sql = "SELECT * FROM imagenes_usuarios WHERE fk_usuario = ".$idUsuario;
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

    static function deleteImagenUsuario($idUsuario){
        try {
            $db = Conexion::getConection();

            $sql = "DELETE FROM imagenes_usuarios WHERE fk_usuario = ".$idUsuario;
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
