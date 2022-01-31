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
        /* echo $idBar; */
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
        header("Content-Type: application/json', 'HTTP/1.1 200 OK");
        $array = array();
        $array["bar"] = array();
        $baresbd = Conexion::deleteBar($idBar);
        
        echo json_encode($baresbd);
    }

    public function updateBar($idBar, $nombre, $descripcion, $localizacion)
    {
        header("Content-Type: application/json', 'HTTP/1.1 200 OK");
        $array = array();
        $array["bar"] = array();
        $baresbd = Conexion::updateBar($idBar, $nombre, $descripcion, $localizacion);
        
        echo json_encode($baresbd);
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
        header("Content-Type: application/json', 'HTTP/1.1 200 OK");
        $array = array();
        $array["bar"] = array();
        $reseñasbd = Conexion::deleteReseña($idReseña);
        
        echo json_encode($reseñasbd);
    }

    public function updateReseña($idReseña, $usuario, $pincho, $nota, $texto)
    {
        header("Content-Type: application/json', 'HTTP/1.1 200 OK");
        $array = array();
        $array["reseña"] = array();
        $reseñasbd = Conexion::updateReseña($idReseña, $usuario, $pincho, $nota, $texto);
        
        echo json_encode($reseñasbd);
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
        header("Content-Type: application/json', 'HTTP/1.1 200 OK");
        $array = array();
        $array["pincho"] = array();
        $reseñasbd = Conexion::deletePincho($idPincho);
        
        echo json_encode($reseñasbd);
    }

    public function updatePincho($idPincho, $usuario, $pincho, $nota, $texto)
    {
        header("Content-Type: application/json', 'HTTP/1.1 200 OK");
        $array = array();
        $array["pincho"] = array();
        $pinchosbd = Conexion::updatePincho($idPincho, $usuario, $pincho, $nota, $texto);
        
        echo json_encode($pinchosbd);
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
        header("Content-Type: application/json', 'HTTP/1.1 200 OK");
        $array = array();
        $array["usuario"] = array();
        $reseñasbd = Conexion::deleteUsuario($idUsuario);
        
        echo json_encode($reseñasbd);
    }

    public function updateUsuario($idUsuario, $nombre, $apellido1, $apellido2, $correoElectronico, $user, $password, $admin)
    {
        header("Content-Type: application/json', 'HTTP/1.1 200 OK");
        $array = array();
        $array["usuario"] = array();
        $usuariosbd = Conexion::updateUsuario($idUsuario, $nombre, $apellido1, $apellido2, $correoElectronico, $user, $password, $admin);
        
        echo json_encode($usuariosbd);
    }


}
