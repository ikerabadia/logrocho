<?php
class ApiController
{

    function __construct()
    {
    }

    //----------------------------------------
    //BARES
    //----------------------------------------
    public function getBares($pagina, $cantidadRegistros)
    {
        header("Content-Type: application/json', 'HTTP/1.1 200 OK");
        $array = array();
        $array["bares"] = array();
        $baresbd = Conexion::getBares($pagina, $cantidadRegistros);
        foreach ($baresbd as $bar) {
            $aux = array();
            $aux["idRestaurante"] = $bar["idRestaurante"];
            $aux["nombre"] = $bar["nombre"];
            $aux["descripcion"] = $bar["descripcion"];
            $aux["localizacion"] = $bar["localizacion"];
            array_push($array["bares"], $aux);
        }
        echo json_encode($array);
    }

    public function getBar($idBar)
    {
        header("Content-Type: application/json', 'HTTP/1.1 200 OK");
        $array = array();
        $array["bar"] = array();
        $baresbd = Conexion::getBar($idBar);
        foreach ($baresbd as $bar) {
            $aux = array();
            $aux["idRestaurante"] = $bar["idRestaurante"];
            $aux["nombre"] = $bar["nombre"];
            $aux["descripcion"] = $bar["descripcion"];
            $aux["localizacion"] = $bar["localizacion"];
            array_push($array["bar"], $aux);
        }
        echo json_encode($array);
    }

    public function newBar($nombre, $descripcion, $localizacion)
    {
        header("Content-Type: application/json', 'HTTP/1.1 200 OK");
        $array = array();
        $array["bar"] = array();
        $baresbd = Conexion::newBar($nombre, $descripcion, $localizacion);
        
        echo json_encode($baresbd);
    }

    public function deleteBar($idBar)
    {
        if (isset($_SESSION["usuarioActual"]) and $_SESSION["usuarioActual"]["admin"] == 1) {
            header("Content-Type: application/json', 'HTTP/1.1 200 OK");
            $array = array();
            $array["bar"] = array();
            $baresbd = Conexion::deleteBar($idBar);
            
            echo json_encode($baresbd);
        }else{
            $error = "operacion reservada exclusivamente a administradores";
            echo json_encode($error);
        }
    }

    public function updateBar($idBar, $nombre, $descripcion, $localizacion)
    {
        header("Content-Type: application/json', 'HTTP/1.1 200 OK");
        $array = array();
        $array["bar"] = array();
        $baresbd = Conexion::updateBar($idBar, $nombre, $descripcion, $localizacion);
        
        echo json_encode($baresbd);
    }

    public function getImagenRestaurante($idBar, $numeroImagen){

        header("Content-Type: application/json', 'HTTP/1.1 200 OK");
        $array = array();
        $array["imagenes"] = array();
        $imagenesbd = Conexion::getImagenRestaurante($idBar, $numeroImagen);
        foreach ($imagenesbd as $imagen) {
            $aux = array();
            $aux["id"] = $imagen["id"];
            $aux["fk_bar"] = $imagen["fk_bar"];
            $aux["imagen"] = $imagen["imagen"];
            $aux["numeroImagen"] = $imagen["numeroImagen"];
            array_push($array["imagenes"], $aux);
        }
        echo json_encode($array);

    }

    public function guardarImagenRestaurante($fk_bar,$numeroImagen, $imagen)
    {
        $ruta ="http://localhost/logrocho/imagenes/restaurantes/".$fk_bar."/imagen".$numeroImagen."/".$imagen["name"];

        if (!file_exists("./imagenes/restaurantes/".$fk_bar."/imagen".$numeroImagen)) {
            mkdir("./imagenes/restaurantes/".$fk_bar."/imagen".$numeroImagen, 0777, true);
        }
        if (!file_exists("./imagenes/restaurantes/".$fk_bar."/imagen".$numeroImagen."/".$imagen["name"])) {

            move_uploaded_file($imagen["tmp_name"], "./imagenes/restaurantes/".$fk_bar."/imagen".$numeroImagen."/".$imagen["name"]);
        }
        
        Conexion::guardarImagenRestaurante($fk_bar,$numeroImagen, $ruta);
    }

    public function deleteImagenRestaurante($fk_bar, $numeroImagen)
    {
        header("Content-Type: application/json', 'HTTP/1.1 200 OK");
        $imagenbd = Conexion::deleteImagenRestaurante($fk_bar, $numeroImagen);
            
        echo json_encode($imagenbd);
    }

    //----------------------------------------
    //RESEÑAS
    //----------------------------------------
    public function getReseñas($pagina, $cantidadRegistros)
    {
        header("Content-Type: application/json', 'HTTP/1.1 200 OK");
        $array = array();
        $array["reseñas"] = array();
        $reseñasbd = Conexion::getReseñas($pagina, $cantidadRegistros);
        foreach ($reseñasbd as $reseña) {
            $aux = array();
            $aux["idReseña"] = $reseña["idReseña"];
            $aux["fkUsuario"] = $reseña["fkUsuario"];
            $aux["fkPincho"] = $reseña["fkPincho"];
            $aux["nota"] = $reseña["nota"];
            $aux["textoReseña"] = $reseña["textoReseña"];
            array_push($array["reseñas"], $aux);
        }
        echo json_encode($array);
    }

    public function getReseña($idReseña)
    {
        header("Content-Type: application/json', 'HTTP/1.1 200 OK");
        $array = array();
        $array["reseña"] = array();
        $reseñasbd = Conexion::getReseña($idReseña);
        foreach ($reseñasbd as $reseña) {
            $aux = array();
            $aux["idReseña"] = $reseña["idReseña"];
            $aux["fkUsuario"] = $reseña["fkUsuario"];
            $aux["fkPincho"] = $reseña["fkPincho"];
            $aux["nota"] = $reseña["nota"];
            $aux["textoReseña"] = $reseña["textoReseña"];
            array_push($array["reseña"], $aux);
        }
        echo json_encode($array);
    }

    public function newReseña($usuario, $pincho, $nota, $texto)
    {
        header("Content-Type: application/json', 'HTTP/1.1 200 OK");
        $array = array();
        $array["bar"] = array();
        $baresbd = Conexion::newReseña($usuario, $pincho, $nota, $texto);
        
        echo json_encode($baresbd);
    }

    public function deleteReseña($idReseña)
    {
        

        if (isset($_SESSION["usuarioActual"]) and $_SESSION["usuarioActual"]["admin"] == 1) {
            header("Content-Type: application/json', 'HTTP/1.1 200 OK");
            $array = array();
            $array["bar"] = array();
            $reseñasbd = Conexion::deleteReseña($idReseña);
            
            echo json_encode($reseñasbd);
        }else{
            $error = "operacion reservada exclusivamente a administradores";
            echo json_encode($error);
        }
    }

    public function updateReseña($idReseña, $usuario, $pincho, $nota, $texto)
    {

        if (isset($_SESSION["usuarioActual"]) and $_SESSION["usuarioActual"]["admin"] == 1) {
            header("Content-Type: application/json', 'HTTP/1.1 200 OK");
            $array = array();
            $array["reseña"] = array();
            $reseñasbd = Conexion::updateReseña($idReseña, $usuario, $pincho, $nota, $texto);
            
            echo json_encode($reseñasbd);
        }else{
            $error = "operacion reservada exclusivamente a administradores";
            echo json_encode($error);
            
        }

    }

    public function getReseñasByUsuario($idUsuario){
        header("Content-Type: application/json', 'HTTP/1.1 200 OK");
        $array = array();
        $array["reseñas"] = array();
        $reseñasbd = Conexion::getReseñasByUsuario($idUsuario);
        foreach ($reseñasbd as $reseña) {
            $aux = array();
            $aux["idReseña"] = $reseña["idReseña"];
            $aux["fkUsuario"] = $reseña["fkUsuario"];
            $aux["fkPincho"] = $reseña["fkPincho"];
            $aux["nota"] = $reseña["nota"];
            $aux["textoReseña"] = $reseña["textoReseña"];
            array_push($array["reseñas"], $aux);
        }
        echo json_encode($array);
    }

    public function getReseñasByPincho($idPincho){
        header("Content-Type: application/json', 'HTTP/1.1 200 OK");
        $array = array();
        $array["reseñas"] = array();
        $reseñasbd = Conexion::getReseñasByPincho($idPincho);
        foreach ($reseñasbd as $reseña) {
            $aux = array();
            $aux["idReseña"] = $reseña["idReseña"];
            $aux["fkUsuario"] = $reseña["fkUsuario"];
            $aux["fkPincho"] = $reseña["fkPincho"];
            $aux["nota"] = $reseña["nota"];
            $aux["textoReseña"] = $reseña["textoReseña"];
            array_push($array["reseñas"], $aux);
        }
        echo json_encode($array);
    }

    //----------------------------------------
    //PINCHOS
    //----------------------------------------
    public function getPinchos($pagina, $cantidadRegistros)
    {
        header("Content-Type: application/json', 'HTTP/1.1 200 OK");
        $array = array();
        $array["pinchos"] = array();
        $pinchosbd = Conexion::getPinchos($pagina, $cantidadRegistros);
        foreach ($pinchosbd as $pincho) {
            $aux = array();
            $aux["idPincho"] = $pincho["idPincho"];
            $aux["nombre"] = $pincho["nombre"];
            $aux["precio"] = $pincho["precio"];
            $aux["fkBar"] = $pincho["fkBar"];
            $aux["descripcion"] = $pincho["descripcion"];
            array_push($array["pinchos"], $aux);
        }
        echo json_encode($array);
    }

    public function getPincho($idPincho)
    {
        header("Content-Type: application/json', 'HTTP/1.1 200 OK");
        $array = array();
        $array["pinchos"] = array();
        $pinchosbd = Conexion::getPincho($idPincho);
        foreach ($pinchosbd as $pincho) {
            $aux = array();
            $aux["idPincho"] = $pincho["idPincho"];
            $aux["nombre"] = $pincho["nombre"];
            $aux["precio"] = $pincho["precio"];
            $aux["fkBar"] = $pincho["fkBar"];
            $aux["descripcion"] = $pincho["descripcion"];
            array_push($array["pinchos"], $aux);
        }
        echo json_encode($array);
    }

    public function newPincho($nombre, $precio, $bar, $descripcion)
    {
        header("Content-Type: application/json', 'HTTP/1.1 200 OK");
        $array = array();
        $array["bar"] = array();
        $baresbd = Conexion::newPincho($nombre, $precio, $bar, $descripcion);
        
        echo json_encode($baresbd);
    }

    public function deletePincho($idPincho)
    {

        if (isset($_SESSION["usuarioActual"]) and $_SESSION["usuarioActual"]["admin"] == 1) {
            header("Content-Type: application/json', 'HTTP/1.1 200 OK");
            $array = array();
            $array["pincho"] = array();
            $reseñasbd = Conexion::deletePincho($idPincho);
            
            echo json_encode($reseñasbd);
        }else{
            $error = "operacion reservada exclusivamente a administradores";
            echo json_encode($error);
        }

    }

    public function updatePincho($idPincho, $usuario, $pincho, $nota, $texto)
    {
        header("Content-Type: application/json', 'HTTP/1.1 200 OK");
        $array = array();
        $array["pincho"] = array();
        $pinchosbd = Conexion::updatePincho($idPincho, $usuario, $pincho, $nota, $texto);
        
        echo json_encode($pinchosbd);
    }

    public function getPinchosByRestaurante($idRestaurante){
        header("Content-Type: application/json', 'HTTP/1.1 200 OK");
        $array = array();
        $array["pinchos"] = array();
        $pinchosbd = Conexion::getPinchosByRestaurante($idRestaurante);
        foreach ($pinchosbd as $pincho) {
            $aux = array();
            $aux["idPincho"] = $pincho["idPincho"];
            $aux["nombre"] = $pincho["nombre"];
            $aux["precio"] = $pincho["precio"];
            $aux["fkBar"] = $pincho["fkBar"];
            $aux["descripcion"] = $pincho["descripcion"];
            array_push($array["pinchos"], $aux);
        }
        echo json_encode($array);
    }

    public function getImagenPincho($idPincho, $numeroImagen){

        header("Content-Type: application/json', 'HTTP/1.1 200 OK");
        $array = array();
        $array["imagenes"] = array();
        $imagenesbd = Conexion::getImagenPincho($idPincho, $numeroImagen);
        foreach ($imagenesbd as $imagen) {
            $aux = array();
            $aux["id"] = $imagen["id"];
            $aux["fk_pincho"] = $imagen["fk_pincho"];
            $aux["imagen"] = $imagen["imagen"];
            $aux["numeroImagen"] = $imagen["numeroImagen"];
            array_push($array["imagenes"], $aux);
        }
        echo json_encode($array);

    }

    public function guardarImagenPincho($fk_pincho,$numeroImagen, $imagen)
    {
        $ruta ="http://localhost/logrocho/imagenes/pinchos/".$fk_pincho."/imagen".$numeroImagen."/".$imagen["name"];

        if (!file_exists("./imagenes/pinchos/".$fk_pincho."/imagen".$numeroImagen)) {
            mkdir("./imagenes/pinchos/".$fk_pincho."/imagen".$numeroImagen, 0777, true);
        }
        if (!file_exists("./imagenes/pinchos/".$fk_pincho."/imagen".$numeroImagen."/".$imagen["name"])) {

            move_uploaded_file($imagen["tmp_name"], "./imagenes/pinchos/".$fk_pincho."/imagen".$numeroImagen."/".$imagen["name"]);
        }
        
        Conexion::guardarImagenPincho($fk_pincho,$numeroImagen, $ruta);
    }

    public function deleteImagenpincho($fk_pincho, $numeroImagen)
    {
        header("Content-Type: application/json', 'HTTP/1.1 200 OK");
        $imagenbd = Conexion::deleteImagenPincho($fk_pincho, $numeroImagen);
            
        echo json_encode($imagenbd);
    }
    

    //----------------------------------------
    //USUARIOS
    //----------------------------------------
    public function getUsuarios($pagina, $cantidadRegistros)
    {
        header("Content-Type: application/json', 'HTTP/1.1 200 OK");
        $array = array();
        $array["usuarios"] = array();
        $usuariosbd = Conexion::getUsuarios($pagina, $cantidadRegistros);
        foreach ($usuariosbd as $usuario) {
            $aux = array();
            $aux["idUsuario"] = $usuario["idUsuario"];
            $aux["nombre"] = $usuario["nombre"];
            $aux["apellido1"] = $usuario["apellido1"];
            $aux["apellido2"] = $usuario["apellido2"];
            $aux["correoElectronico"] = $usuario["correoElectronico"];
            $aux["user"] = $usuario["user"];
            $aux["password"] = $usuario["password"];
            $aux["admin"] = $usuario["admin"];
            array_push($array["usuarios"], $aux);
        }
        echo json_encode($array);
    }

    public function getUsuario($idUsuario)
    {
        header("Content-Type: application/json', 'HTTP/1.1 200 OK");
        $array = array();
        $array["usuarios"] = array();
        $usuariosbd = Conexion::getUser($idUsuario);
        foreach ($usuariosbd as $usuario) {
            $aux = array();
            $aux["idUsuario"] = $usuario["idUsuario"];
            $aux["nombre"] = $usuario["nombre"];
            $aux["apellido1"] = $usuario["apellido1"];
            $aux["apellido2"] = $usuario["apellido2"];
            $aux["correoElectronico"] = $usuario["correoElectronico"];
            $aux["user"] = $usuario["user"];
            $aux["password"] = $usuario["password"];
            $aux["admin"] = $usuario["admin"];
            array_push($array["usuarios"], $aux);
        }
        echo json_encode($array);
    }

    public function newUsuario($nombre, $apellido1, $apellido2, $correoElectronico, $user, $password, $admin)
    {
        header("Content-Type: application/json', 'HTTP/1.1 200 OK");
        $array = array();
        $array["usuario"] = array();
        $usuariosbd = Conexion::newUsuario($nombre, $apellido1, $apellido2, $correoElectronico, $user, $password, $admin);
        
        echo json_encode($usuariosbd);
    }

    public function deleteUsuario($idUsuario)
    {
        if (isset($_SESSION["usuarioActual"]) and $_SESSION["usuarioActual"]["admin"] == 1) {
            header("Content-Type: application/json', 'HTTP/1.1 200 OK");
            $array = array();
            $array["usuario"] = array();
            $reseñasbd = Conexion::deleteUsuario($idUsuario);
                
            echo json_encode($reseñasbd);
        }else{
            $error = "operacion reservada exclusivamente a administradores";
            echo json_encode($error);
            
        }
        
        
    }

    public function updateUsuario($idUsuario, $nombre, $apellido1, $apellido2, $correoElectronico, $user, $password, $admin)
    {
        header("Content-Type: application/json', 'HTTP/1.1 200 OK");
        $array = array();
        $array["usuario"] = array();
        $usuariosbd = Conexion::updateUsuario($idUsuario, $nombre, $apellido1, $apellido2, $correoElectronico, $user, $password, $admin);
        
        echo json_encode($usuariosbd);
    }

    public function limpiarLikesUsuario($idUsuario){
        if (isset($_SESSION["usuarioActual"]) and $_SESSION["usuarioActual"]["admin"] == 1) {
            header("Content-Type: application/json', 'HTTP/1.1 200 OK");
            //$array = array();
            //$array["usuario"] = array();
            $reseñasbd = Conexion::limpiarLikesUsuario($idUsuario);
                
            echo json_encode($reseñasbd);
        }else{
            $error = "operacion reservada exclusivamente a administradores";
            echo json_encode($error);
            
        }
    }

    public function guardarImagenUsuario($idUsuario,$imagen)
    {
        $ruta ="http://localhost/logrocho/imagenes/usuarios/".$idUsuario."/".$imagen["name"];

        if (!file_exists("./imagenes/usuarios/".$idUsuario)) {
            mkdir("./imagenes/usuarios/".$idUsuario, 0777, true);
        }
        if (!file_exists("./imagenes/usuarios/".$idUsuario."/".$imagen["name"])) {

            move_uploaded_file($imagen["tmp_name"], "./imagenes/usuarios/".$idUsuario."/".$imagen["name"]);
        }
        
        Conexion::guardarImagenUsuario($idUsuario, $ruta);
    }

    public function getImagenUsuario($idUsuario) //Hay que ponerlo bien
    {
        header("Content-Type: application/json', 'HTTP/1.1 200 OK");
        $array = array();
        $array["imagenes"] = array();
        $imagenesbd = Conexion::getImagenUsuario($idUsuario);
        foreach ($imagenesbd as $imagen) {
            $aux = array();
            $aux["id"] = $imagen["id"];
            $aux["fk_usuario"] = $imagen["fk_usuario"];
            $aux["imagen"] = $imagen["imagen"];
            array_push($array["imagenes"], $aux);
        }
        echo json_encode($array);
    }

    public function deleteImagenUsuario($idUsuario)
    {
        
        header("Content-Type: application/json', 'HTTP/1.1 200 OK");
        $imagenbd = Conexion::deleteImagenUsuario($idUsuario);
                
        echo json_encode($imagenbd);        
        
    }
    


}
