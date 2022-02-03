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
            $_SESSION["login"] = "";

            $rutaDestino = UserController::getRuta("restaurantes", "loginRespuesta");
            header('location: ' . $rutaDestino);
        } else {
            $_SESSION["login"] = "Login incorrecto";

            $rutaDestino = UserController::getRuta("login", "loginRespuesta");
            header('location: ' . $rutaDestino);
        }
    }
    //RESTAURANTES
    public function restaurantes()
    {
        require("view/listadoRestaurantes/restaurantes.html");
    }
    public function restaurante(){
        require("view/fichaRestaurante/restaurante.html");
    }

    //PINCHOS
    public function pinchos()
    {
        require("view/listadoPinchos/pinchos.html");
    }
    public function pincho(){
        require("view/fichaPincho/pincho.html");
    }

    //RESEÑAS
    public function reseñas()
    {
        require("view/listadoReseñas/reseñas.html");
    }

    //USUARIOS
    public function usuarios()
    {
        require("view/listadoUsuarios/listadoUsuarios.html");
    }
    public function usuario(){
        require("view/fichaUsuario/usuario.html");
    }

    //PAGINAS ERROR
    public function error404()
    {
        require("view/paginasError/error404/404.html");
    }
    public function error500()
    {
        require("view/paginasError/error500/500.html");
    }


    /*GET RUTA*/
    static function getRuta($accionDestino, $accionActual)
    {
        $rutaActual = "http://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
        $ruta = str_replace($accionActual, "", $rutaActual);
        $accion =  $ruta . $accionDestino;
        return $accion;
    }
}
