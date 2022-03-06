<?php

const DB_INFO = 'mysql:host=localhost;dbname=ikerociobinario_logrocho;charset=utf8mb4;';

const DB_USER = 'ikerociobinario';

const DB_PASS = 'vesper!2021';

/**
 * [Clase con todas las llamadas a la base de datos]
 */
class Conexion
{
    
    /**
     * getConection
     *
     * @return conexion
     */
    static function getConection()
    {
        return new \PDO(DB_INFO, DB_USER, DB_PASS);
    }

    
    /**
     * getLogin
     *
     * @param  mixed $user
     * @param  mixed $password
     * @return void
     */
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
    
    /**
     * getUsuario
     *
     * @param  mixed $user
     * @return void
     */
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
    
    /**
     * getUsuarioId
     *
     * @param  mixed $id
     * @return void
     */
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

    /*----------------------------------------------------------------------------------------------------------*/
    /*BARES*/    
    /*----------------------------------------------------------------------------------------------------------*/
    /**
     * getBares
     *
     * @param  mixed $pagina
     * @param  mixed $cantidadRegistros
     * @return void
     */
    static function getBares($pagina, $cantidadRegistros){
        try {
            $db = Conexion::getConection();

            $sql = "SELECT *,TRUNCATE((Select avg(nota) from resenas where fkPincho IN(SELECT idPincho from pinchos WHERE fkBar=idRestaurante)),1) as Puntuacion FROM restaurantes LIMIT $cantidadRegistros OFFSET ".($pagina-1)*$cantidadRegistros;
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
    
    /**
     * getBar
     *
     * @param  mixed $idBar
     * @return void
     */
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
    
    /**
     * newBar
     *
     * @param  mixed $nombre
     * @param  mixed $descripcion
     * @param  mixed $localizacion
     * @return void
     */
    static function newBar($nombre, $descripcion, $localizacion, $latitud, $longitud){
        try {
            $db = Conexion::getConection();

            $sql = "INSERT INTO `restaurantes`(`nombre`, `descripcion`, `localizacion`, `latitud`, `longitud`) VALUES ('$nombre', '$descripcion', '$localizacion', '$latitud', '$longitud')";
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
    
    /**
     * deleteBar
     *
     * @param  mixed $idBar
     * @return void
     */
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
    
    /**
     * updateBar
     *
     * @param  mixed $idBar
     * @param  mixed $nombre
     * @param  mixed $descripcion
     * @param  mixed $localizacion
     * @return void
     */
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
    
    /**
     * getImagenRestaurante
     *
     * @param  mixed $idBar
     * @param  mixed $numeroImagen
     * @return void
     */
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
    
    /**
     * guardarImagenRestaurante
     *
     * @param  mixed $fk_bar
     * @param  mixed $numeroImagen
     * @param  mixed $imagen
     * @return void
     */
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
    
    /**
     * deleteImagenRestaurante
     *
     * @param  mixed $fk_bar
     * @param  mixed $numeroImagen
     * @return void
     */
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

   /**
    * @param mixed $fNombre
    * @param mixed $fLocalizacion
    * 
    * @return [type]
    */
    static function getBaresFiltrados($fNombre, $fLocalizacion){
        try {
            $db = Conexion::getConection();

            $sql = "SELECT *,TRUNCATE((Select avg(nota) from resenas where fkPincho IN(SELECT idPincho from pinchos WHERE fkBar=idRestaurante)),1) as Puntuacion FROM restaurantes where nombre LIKE '%".$fNombre."%' or localizacion LIKE '%".$fLocalizacion."%';";
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

   /**
    * @param mixed $textoBuscador
    * 
    * @return [type]
    */
    static function getBaresFiltradosNombreDescripcion($textoBuscador){
        try {
            $db = Conexion::getConection();

            $sql = "SELECT *,
            TRUNCATE((Select avg(nota) from resenas where fkPincho IN(SELECT idPincho from pinchos WHERE fkBar=idRestaurante)),1) as Puntuacion 
            FROM restaurantes where nombre LIKE '%".$textoBuscador."%' or descripcion LIKE '%".$textoBuscador."%'";
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

   /**
    * @param mixed $idBar
    * 
    * @return [type]
    */
    static function getBarConImagenes($idBar){
        
        try {
            $db = Conexion::getConection();

            $sql = "SELECT *,
            TRUNCATE((Select avg(nota) from resenas where fkPincho IN(SELECT idPincho from pinchos WHERE fkBar=r.idRestaurante)),1) as Puntuacion, 
            (SELECT imagen FROM imagenes_bares WHERE fk_Bar = r.idRestaurante and numeroImagen = 1) as imagen1, 
            (SELECT imagen FROM imagenes_bares WHERE fk_Bar = r.idRestaurante and numeroImagen = 2) as imagen2, 
            (SELECT imagen FROM imagenes_bares WHERE fk_Bar = r.idRestaurante and numeroImagen = 3) as imagen3 
            FROM `restaurantes` r where idRestaurante = ".$idBar;
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

   /**
    * @return [type]
    */
    static function getFullRestaurantes(){
        try {
            $db = Conexion::getConection();

            $sql = "SELECT *,TRUNCATE((Select avg(nota) from resenas where fkPincho IN(SELECT idPincho from pinchos WHERE fkBar=idRestaurante)),1) as Puntuacion FROM restaurantes";
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

    

    /*----------------------------------------------------------------------------------------------------------*/
    /*RESEnAS*/
    /*----------------------------------------------------------------------------------------------------------*/    
    /**
     * getRese
     *
     * @param  mixed $pagina
     * @param  mixed $cantidadRegistros
     * @return void
     */
    static function getResenas($pagina, $cantidadRegistros){
        try {
            $db = Conexion::getConection();

            $sql = "SELECT * FROM resenas LIMIT $cantidadRegistros OFFSET ".($pagina-1)*$cantidadRegistros;
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
    
    /**
     * getRese
     *
     * @param  mixed $idRese
     * @return void
     */
    static function getResena($idResena){
        try {
            $db = Conexion::getConection();

            $sql = "SELECT * FROM resenas WHERE idResena = ".$idResena;
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
    
    /**
     * newRese
     *
     * @param  mixed $usuario
     * @param  mixed $pincho
     * @param  mixed $nota
     * @param  mixed $texto
     * @return void
     */
    static function newResena($usuario, $pincho, $nota, $texto){
        try {
            $db = Conexion::getConection();

            $sql = "INSERT INTO `resenas`(`fkUsuario`, `fkPincho`, `nota`, `textoResena`) VALUES ('$usuario', '$pincho', '$nota', '$texto')";
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
    
    /**
     * deleteRese
     *
     * @param  mixed $idRese
     * @return void
     */
    static function deleteResena($idResena){
        try {
            $db = Conexion::getConection();

            $sql = "DELETE FROM resenas WHERE idResena = ".$idResena;
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
    
    /**
     * updateRese
     *
     * @param  mixed $idRese
     * @param  mixed $usuario
     * @param  mixed $pincho
     * @param  mixed $nota
     * @param  mixed $texto
     * @return void
     */
    static function updateResena($idResena, $usuario, $pincho, $nota, $texto){
        try {
            $db = Conexion::getConection();

            $sql = "UPDATE `resenas` SET fkUsuario = '$usuario', fkPincho = '$pincho', nota = '$nota', textoResena = '$texto' WHERE idResena = $idResena";
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
    
    /**
     * getRese
     *
     * @param  mixed $idUsuario
     * @return void
     */
    static function getResenasByUsuario($idUsuario){
        try {
            $db = Conexion::getConection();

            $sql = "SELECT *,
            (Select user from usuarios where idUsuario=r.fkUsuario) as nombreUsuario,
            (Select nombre from pinchos where idPincho=r.fkPincho) as nombrePincho,
            (Select nombre from restaurantes where idRestaurante=(Select fkBar from pinchos where idPincho=r.fkPincho)) as nombreBar 
            FROM resenas r WHERE fkUsuario = ".$idUsuario;
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
    
    /**
     * getRese
     *
     * @param  mixed $idPincho
     * @return void
     */
    static function getResenasByPincho($idPincho){
        try {
            $db = Conexion::getConection();

            if (isset($_SESSION["usuarioActual"])) {
                $idUsuario = $_SESSION["usuarioActual"]["idUsuario"];
            }else{
                $idUsuario = -1;
            }            

            $sql = "SELECT *, (select COUNT(*) from resenas_likes WHERE fk_usuario = $idUsuario and fk_resena = r.idResena) as likes FROM resenas r WHERE fkPincho = $idPincho";
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

   /**
    * @param mixed $idResena
    * @param mixed $idUsuario
    * 
    * @return [type]
    */
    static function darLike($idResena, $idUsuario){
        try {
            $db = Conexion::getConection();

            $sql = "INSERT INTO `resenas_likes`(`fk_usuario`, `fk_resena`) VALUES ('$idUsuario', '$idResena')";
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

   /**
    * @param mixed $idResena
    * @param mixed $idUsuario
    * 
    * @return [type]
    */
    static function eliminarLike($idResena, $idUsuario){
        try {
            $db = Conexion::getConection();

            $sql = "DELETE FROM resenas_likes WHERE fk_usuario = $idUsuario and fk_resena = $idResena";
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

   /**
    * @return [type]
    */
    static function getResenasOrderedLikes(){
        try {
            $db = Conexion::getConection();

            $sql = "SELECT *, 
            (select user from usuarios where idUsuario = r.fkUsuario) as nombreUsuario,
            (select nombre from pinchos where idPincho = r.fkPincho) as nombrePincho,
            (select COUNT(*) from resenas_likes where fk_resena = r.idResena) as cantidadLikes
            FROM resenas r ORDER BY cantidadLikes desc";
            
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

   /**
    * @param mixed $idUsuario
    * 
    * @return [type]
    */
    static function getResenasLikeadasUsuario($idUsuario){
        try {
            $db = Conexion::getConection();

            $sql = "SELECT *,
            (select user from usuarios where idUsuario = r.fkUsuario) as nombreUsuario,
            (select nombre from pinchos where idPincho = r.fkPincho) as nombrePincho,
            (select nombre from restaurantes where idRestaurante = (select fkBar from pinchos where idPincho = r.fkPincho)) as nombreBar,
            (select imagen from imagenes_usuarios where fk_usuario = r.fkUsuario) as imagenUsuario
            FROM resenas r
            where idResena IN (select fk_resena from resenas_likes rl where rl.fk_usuario = $idUsuario)";
            
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

    /*----------------------------------------------------------------------------------------------------------*/
    /*PINCHOS*/    
    /*----------------------------------------------------------------------------------------------------------*/

    /**
     * getPinchos
     *
     * @param  mixed $pagina
     * @param  mixed $cantidadRegistros
     * @return void
     */
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
    
    /**
     * getPincho
     *
     * @param  mixed $idPincho
     * @return void
     */
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
    /**
     * newPincho
     *
     * @param  mixed $nombre
     * @param  mixed $precio
     * @param  mixed $bar
     * @param  mixed $descripcion
     * @return void
     */
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
    
    /**
     * deletePincho
     *
     * @param  mixed $idPincho
     * @return void
     */
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
    
    /**
     * updatePincho
     *
     * @param  mixed $idPincho
     * @param  mixed $nombre
     * @param  mixed $precio
     * @param  mixed $bar
     * @param  mixed $descripcion
     * @return void
     */
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
    
    /**
     * getPinchosByRestaurante
     *
     * @param  mixed $idRestaurante
     * @return void
     */
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

        
    /**
     * getImagenPincho
     *
     * @param  mixed $idPincho
     * @param  mixed $numeroImagen
     * @return void
     */
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
    
    /**
     * guardarImagenPincho
     *
     * @param  mixed $fk_pincho
     * @param  mixed $numeroImagen
     * @param  mixed $imagen
     * @return void
     */
    static function guardarImagenPincho($fk_pincho,$numeroImagen, $imagen){
        try {
            $db = Conexion::getConection();

            $sql = "INSERT INTO `imagenes_pincho`(`fk_pincho`, `imagen`, `numeroImagen`) VALUES ('$fk_pincho', '$imagen', '$numeroImagen')";
            $resultado = $db->query($sql);
            
            if ($resultado) {
                /* return $db->lastInsertId(); */
                
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
    
    /**
     * deleteImagenPincho
     *
     * @param  mixed $fk_pincho
     * @param  mixed $numeroImagen
     * @return void
     */
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

   /**
    * @param mixed $idPincho
    * 
    * @return [type]
    */
    static function getNotaMediaPincho($idPincho){
        try {
            $db = Conexion::getConection();

            $sql = "SELECT TRUNCATE(AVG(nota),1) as notaPincho FROM `resenas` GROUP BY fkPincho HAVING fkPincho = ".$idPincho;
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

   /**
    * @param mixed $idBar
    * 
    * @return [type]
    */
    static function getPinchosConImagenesByBar($idBar){
        try {
            $db = Conexion::getConection();

            $sql = "SELECT *
            ,(SELECT imagen FROM imagenes_pincho WHERE fk_pincho = p.idPincho and numeroImagen = 1) as imagen1 
            ,(SELECT imagen FROM imagenes_pincho WHERE fk_pincho = p.idPincho and numeroImagen = 2) as imagen2 
            ,(SELECT imagen FROM imagenes_pincho WHERE fk_pincho = p.idPincho and numeroImagen = 3) as imagen3 
            FROM pinchos p WHERE fkBar = ".$idBar;
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

   /**
    * @param mixed $idPincho
    * 
    * @return [type]
    */
    static function getPinchoConImagenes($idPincho){
        try {
            $db = Conexion::getConection();

            $sql = "SELECT *,TRUNCATE((Select avg(nota) from resenas where fkPincho = p.idPincho),1) as Puntuacion, 
            (SELECT imagen FROM imagenes_pincho WHERE fk_pincho = p.idPincho and numeroImagen = 1) as imagen1, 
            (SELECT imagen FROM imagenes_pincho WHERE fk_pincho = p.idPincho and numeroImagen = 2) as imagen2, 
            (SELECT imagen FROM imagenes_pincho WHERE fk_pincho = p.idPincho and numeroImagen = 3) as imagen3 
            FROM `pinchos` p where idPincho = ".$idPincho;
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

   /**
    * @param mixed $textoBuscador
    * @param mixed $precioMinimo
    * @param mixed $precioMaximo
    * @param mixed $notaMinima
    * @param mixed $notaMaxima
    * 
    * @return [type]
    */
    static function getPinchosFiltrados($textoBuscador, $precioMinimo, $precioMaximo, $notaMinima, $notaMaxima){
        try {
            $db = Conexion::getConection();

            $sql = "SELECT *
            ,(SELECT imagen FROM imagenes_pincho WHERE fk_pincho = p.idPincho and numeroImagen = 1) as imagen1 
            ,(SELECT imagen FROM imagenes_pincho WHERE fk_pincho = p.idPincho and numeroImagen = 2) as imagen2 
            ,(SELECT imagen FROM imagenes_pincho WHERE fk_pincho = p.idPincho and numeroImagen = 3) as imagen3
            ,(SELECT nombre FROM restaurantes WHERE idRestaurante = p.fkBar) as nombreBar
            ,(SELECT AVG(nota) FROM resenas WHERE fkPincho = p.idPincho) as notaPincho
            FROM pinchos p WHERE p.precio BETWEEN ".$precioMinimo." and ".$precioMaximo."
            AND (p.nombre LIKE '%".$textoBuscador."%'
            OR (SELECT nombre FROM restaurantes WHERE idRestaurante = p.fkBar) LIKE '%".$textoBuscador."%')
            AND COALESCE((SELECT AVG(nota) FROM resenas WHERE fkPincho = p.idPincho),0) BETWEEN ".$notaMinima." and ".$notaMaxima."";

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

   /**
    * @param mixed $textoBuscador
    * 
    * @return [type]
    */
    static function getPinchosFiltradosNombreDescripcionTextoResena($textoBuscador){
        try {
            $db = Conexion::getConection();

            $sql = "SELECT *
            ,(SELECT imagen FROM imagenes_pincho WHERE fk_pincho = p.idPincho and numeroImagen = 1) as imagen1 
            ,(SELECT imagen FROM imagenes_pincho WHERE fk_pincho = p.idPincho and numeroImagen = 2) as imagen2 
            ,(SELECT imagen FROM imagenes_pincho WHERE fk_pincho = p.idPincho and numeroImagen = 3) as imagen3
            ,(SELECT nombre FROM restaurantes WHERE idRestaurante = p.fkBar) as nombreBar
            ,(SELECT AVG(nota) FROM resenas WHERE fkPincho = p.idPincho) as notaPincho
            FROM pinchos p WHERE 
            (p.nombre LIKE '%".$textoBuscador."%'
            OR (SELECT nombre FROM restaurantes WHERE idRestaurante = p.fkBar) LIKE '%".$textoBuscador."%'
            OR p.idPincho in (select fkPincho from resenas where textoResena LIKE '%".$textoBuscador."%'))";

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

    /**
     * getPinchos
     *
     * @param  mixed $pagina
     * @param  mixed $cantidadRegistros
     * @return void
     */
    static function getPinchosOrderedNota(){
        try {
            $db = Conexion::getConection();

            $sql = "SELECT *,
            (select nombre from restaurantes where p.fkBar = idRestaurante) as nombreBar, 
            round((select avg(nota) from resenas where fkPincho = p.idPincho),1) as nota  
            FROM pinchos p order by nota desc";
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

    /*----------------------------------------------------------------------------------------------------------*/
    /*USUARIOS*/
    /*----------------------------------------------------------------------------------------------------------*/

        
    /**
     * getUsuarios
     *
     * @param  mixed $pagina
     * @param  mixed $cantidadRegistros
     * @return void
     */
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
    
    /**
     * getUser
     *
     * @param  mixed $idUsuario
     * @return void
     */
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
    
    /**
     * newUsuario
     *
     * @param  mixed $nombre
     * @param  mixed $apellido1
     * @param  mixed $apellido2
     * @param  mixed $correoElectronico
     * @param  mixed $user
     * @param  mixed $password
     * @param  mixed $admin
     * @return void
     */
    static function newUsuario($nombre, $apellido1, $apellido2, $correoElectronico, $user, $password, $admin){
        try {
            $db = Conexion::getConection();

            $sql = "INSERT INTO `usuarios`(`nombre`, `apellido1`, `apellido2`, `correoElectronico`, `user`, `password`, `admin`) VALUES ('$nombre', '$apellido1', '$apellido2', '$correoElectronico', '$user', '$password', '$admin')";
            $resultado = $db->query($sql);

            if ($resultado) {
                return "true";
            } else {
                return "false";
            }
        } catch (\Exception $th) {
            return "false";
        } catch (\PDOException $e) {
            return "false";
        }
    }
    
    /**
     * deleteUsuario
     *
     * @param  mixed $idUsuario
     * @return void
     */
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
    
    /**
     * updateUsuario
     *
     * @param  mixed $idUsuario
     * @param  mixed $nombre
     * @param  mixed $apellido1
     * @param  mixed $apellido2
     * @param  mixed $correoElectronico
     * @param  mixed $user
     * @param  mixed $password
     * @param  mixed $admin
     * @return void
     */
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
    
    /**
     * limpiarLikesUsuario
     *
     * @param  mixed $idUsuario
     * @return void
     */
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
    
    /**
     * guardarImagenUsuario
     *
     * @param  mixed $idUsuario
     * @param  mixed $ruta
     * @return void
     */
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
    
    /**
     * getImagenUsuario
     *
     * @param  mixed $idUsuario
     * @return void
     */
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
    
    /**
     * deleteImagenUsuario
     *
     * @param  mixed $idUsuario
     * @return void
     */
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

   /**
    * @param mixed $user
    * 
    * @return [type]
    */
    static function getUserByUsername($user){
        try {
            $db = Conexion::getConection();

            $sql = "SELECT * FROM usuarios WHERE user = ".$user;
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

    //GENERICOS
    static function getImagenesMejorValorados(){
        try {
            $db = Conexion::getConection();

            $sql = "SELECT imagen FROM `imagenes_pincho` limit 5";
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

   /**
    * @param mixed $idUsuario
    * 
    * @return [type]
    */
    static function getImagenesPreferidos($idUsuario){
        try {
            $db = Conexion::getConection();

            $sql = "SELECT * FROM `imagenes_pincho` where fk_pincho in(SELECT fkPincho from resenas where fkUsuario = ".$idUsuario.") AND numeroImagen = 1";
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
