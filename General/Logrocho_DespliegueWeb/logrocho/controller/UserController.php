<?php
use mailer\mailer;
class UserController
{
    public function index()
    {
        require("view/login/login.php");
    }
    //LOGIN RESPUESTA    
    /**
     * loginRespuesta
     *
     * @return void
     */
    public function loginRespuesta()
    {

        //Obtengo los datos y los guardo en variables
        $usuario = $_POST['user'];
        $contrasena = $_POST['password'];

        $login = Conexion::getLogin($usuario, $contrasena);

        if ($login->rowCount() == 1) {
            $_SESSION["usuarioActual"] = $login->fetch();
            $_SESSION["login"] = "";

            //var_dump($_SESSION["usuarioActual"]["admin"]);

            $rutaDestino = UserController::getRuta("restaurantes", "loginRespuesta");
            header('location: ' . $rutaDestino);
        } else {
            $_SESSION["login"] = "Login incorrecto";

            //var_dump($login->rowCount());

            $rutaDestino = UserController::getRuta("login", "loginRespuesta");
            header('location: ' . $rutaDestino);
        }
    }

    /*----------------------------------------------------------------------------------------------------------*/
    //RESTAURANTES
    /*----------------------------------------------------------------------------------------------------------*/
    /**
     * @return [type]
     */
    public function restaurantes()
    {
        require("view/listadoRestaurantes/restaurantes.html");
    }
    /**
     * @return [type]
     */
    public function restaurante(){
        require("view/fichaRestaurante/restaurante.html");
    }


    /*----------------------------------------------------------------------------------------------------------*/
    //PINCHOS
    /*----------------------------------------------------------------------------------------------------------*/
    /**
     * @return [type]
     */
    public function pinchos()
    {
        require("view/listadoPinchos/pinchos.html");
    }
    /**
     * @return [type]
     */
    public function pincho(){
        require("view/fichaPincho/pincho.html");
    }

    /*----------------------------------------------------------------------------------------------------------*/
    //RESEnAS
    /*----------------------------------------------------------------------------------------------------------*/
    /**
     * @return [type]
     */
    public function resenas()
    {
        require("view/listadoResenas/resenas.html");
    }

    /*----------------------------------------------------------------------------------------------------------*/
    //USUARIOS
    /*----------------------------------------------------------------------------------------------------------*/
    /**
     * @return [type]
     */
    public function usuarios()
    {
        require("view/listadoUsuarios/listadoUsuarios.html");
    }
    /**
     * @return [type]
     */
    public function usuario(){
        require("view/fichaUsuario/usuario.html");
    }

    /*----------------------------------------------------------------------------------------------------------*/
    //PAGINAS ERROR
    /*----------------------------------------------------------------------------------------------------------*/
    /**
     * @return [type]
     */
    public function error404()
    {
        require("view/paginasError/error404/404.html");
    }
    /**
     * @return [type]
     */
    public function error500()
    {
        require("view/paginasError/error500/500.html");
    }


    /*----------------------------------------------------------------------------------------------------------*/
    //ZONA DE FRONT / PAGINA PRINCIPAL
    /*----------------------------------------------------------------------------------------------------------*/
    /**
     * @return [type]
     */
    public function home(){
        require("viewFrontal/home/home.html");
    }
    /*----------------------------------------------------------------------------------------------------------*/
    //LOGIN REGISTER
    /*----------------------------------------------------------------------------------------------------------*/
    /**
     * @return [type]
     */
    public function frontLoginRegister(){
        require("viewFrontal/loginRegister/loginRegister.html");
    }
    /*----------------------------------------------------------------------------------------------------------*/
    //MAPA
    /*----------------------------------------------------------------------------------------------------------*/
    /**
     * @return [type]
     */
    public function mapa(){
        require("viewFrontal/mapa/mapa.html");
    }

    /* ZONA DE USUARIO */
    /**
     * @return [type]
     */
    public function infoPersonal(){
        require("viewFrontal/pagUsuario/infoPersonal/infoPersonal.html");
    }
    /**
     * @return [type]
     */
    public function resenasLikeadas(){
        require("viewFrontal/pagUsuario/resenasLikeadas/resenasLikeadas.html");
    }
    /**
     * @return [type]
     */
    public function resenasPublicadas(){
        require("viewFrontal/pagUsuario/resenasPublicadas/resenasPublicadas.html");
    }

    /*BARES FRONT*/
    /**
     * @return [type]
     */
    public function baresFront(){
        require("viewFrontal/bares/bares.html");
    }
    /**
     * @return [type]
     */
    public function barFront(){
        require("viewFrontal/bar/bar.html");
    }
    /*PINCHOS FRONT*/
    /**
     * @return [type]
     */
    public function pinchoFront(){
        require("viewFrontal/pincho/pincho.html");
    }
    /**
     * @return [type]
     */
    public function pinchosFront(){
        require("viewFrontal/pinchos/pinchos.html");
    }

    /*----------------------------------------------------------------------------------------------------------*/
    /*GET RUTA*/
    /*----------------------------------------------------------------------------------------------------------*/    
    /**
     * getRuta
     *
     * @param  mixed $accionDestino
     * @param  mixed $accionActual
     * @return accion
     */
    static function getRuta($accionDestino, $accionActual)
    {
        $rutaActual = "http://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
        $ruta = str_replace($accionActual, "", $rutaActual);
        $accion =  $ruta . $accionDestino;
        return $accion;
    }
}
