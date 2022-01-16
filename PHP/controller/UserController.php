<?php
use mailer\mailer;
class UserController
{
    public function index()
    {
        require("view/login/login.php");
    }
    //LOGIN RESPUESTA
    public function loginRespuesta()
    {

        //Obtengo los datos y los guardo en variables
        $usuario = $_POST['user'];
        $contraseña = $_POST['password'];

        $login = Conexion::getLogin($usuario, $contraseña);

        if ($login->rowCount() == 1) {
            $_SESSION["usuarioActual"] = $usuario;
            $_SESSION["login"] = "Login correcto";

            /* $rutaDestino = UserController::getRuta("categorias", "loginRespuesta"); */
            $rutaDestino = UserController::getRuta("login", "loginRespuesta");
            header('location: ' . $rutaDestino);
        } else {
            $_SESSION["login"] = "Login incorrecto";

            $rutaDestino = UserController::getRuta("login", "loginRespuesta");
            header('location: ' . $rutaDestino);
        }
    }
    static function getRuta($accionDestino, $accionActual)
    {
        $rutaActual = "http://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
        $ruta = str_replace($accionActual, "", $rutaActual);
        $accion =  $ruta . $accionDestino;
        return $accion;
    }
}
