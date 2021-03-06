<?php

    session_start();
    require("controller/UserController.php");
    require("controller/ApiController.php");
    require_once('model/bd.php');
        
    $userController = new UserController;
    $apiController = new ApiController;
    $home = "/logrocho/index.php/";
    $ruta = str_replace($home, "", $_SERVER["REQUEST_URI"]);
    $array_ruta = array_filter(explode("/",$ruta));

    if (isset($array_ruta[0]) && $array_ruta[0] == "login") {
        $userController->index();
    }else if (isset($array_ruta[0]) && $array_ruta[0] == "loginRespuesta") {
        $userController->loginRespuesta();
    }else if (isset($array_ruta[0]) && $array_ruta[0] == "restaurantes") {
        $userController->restaurantes();
    }else if (isset($array_ruta[0]) && preg_match('/restaurante/', $array_ruta[0])) {
        $userController->restaurante();
    }else if (isset($array_ruta[0]) && $array_ruta[0] == "pinchos") {
        $userController->pinchos();
    }else if (isset($array_ruta[0]) && preg_match('/pincho/', $array_ruta[0])) {
        $userController->pincho();
    }else if (isset($array_ruta[0]) && $array_ruta[0] == "resenas") {
        $userController->resenas();
    }else if (isset($array_ruta[0]) && $array_ruta[0] == "usuarios") {
        $userController->usuarios();
    }else if (isset($array_ruta[0]) && preg_match('/usuario/', $array_ruta[0])) {
        $userController->usuario();
    }else if (isset($array_ruta[0]) && $array_ruta[0] == "error404") {//PAGINAS ERROR
        $userController->error404();
    }else if (isset($array_ruta[0]) && $array_ruta[0] == "error500") {
        $userController->error500();
    }else if (isset($array_ruta[0]) && $array_ruta[0] == "home") { //PAGINA PRINCIPAL
        $userController->home();
    }else if (isset($array_ruta[0]) && $array_ruta[0] == "frontLoginRegister") {
        $userController->frontLoginRegister();
    }else if (isset($array_ruta[0]) && $array_ruta[0] == "mapa") {
        $userController->mapa();
    }else if (isset($array_ruta[0]) && $array_ruta[0] == "infoPersonal") {
        $userController->infoPersonal();
    }else if (isset($array_ruta[0]) && $array_ruta[0] == "resenasLikeadas") {
        $userController->resenasLikeadas();
    }else if (isset($array_ruta[0]) && $array_ruta[0] == "resenasPublicadas") {
        $userController->resenasPublicadas();
    }else if (isset($array_ruta[0]) && $array_ruta[0] == "baresFront") {
        $userController->baresFront();
    }else if (isset($array_ruta[0]) && preg_match('/barFront/', $array_ruta[0]) ) {
        $userController->barFront();
    }else if (isset($array_ruta[0]) && $array_ruta[0] == "frontPinchos") {
        $userController->pinchosFront();
    }else if (isset($array_ruta[0]) && preg_match('/frontPincho/', $array_ruta[0]) ) {
        $userController->pinchoFront();
    }else if (isset($array_ruta[0]) && $array_ruta[0] == "api" && $array_ruta[1] == "restaurantes") { //API //Restaurantes
        $apiController->getBares($_POST["pagina"], $_POST["cantidadRegistros"]);
    }else if (isset($array_ruta[0]) && $array_ruta[0] == "api" && $array_ruta[1] == "restaurante") {
        $apiController->getBar($array_ruta[2]);
    }else if (isset($array_ruta[0]) && $array_ruta[0] == "api" && $array_ruta[1] == "nuevoRestaurante") {
        $apiController->newBar($_POST["nombre"], $_POST["descripcion"], $_POST["localizacion"], $_POST["latitud"], $_POST["longitud"]);
    }else if (isset($array_ruta[0]) && $array_ruta[0] == "api" && $array_ruta[1] == "deleteRestaurante") {
        $apiController->deleteBar($array_ruta[2]);
    }else if (isset($array_ruta[0]) && $array_ruta[0] == "api" && $array_ruta[1] == "updateRestaurante") {
        $apiController->updateBar($array_ruta[2], $_POST["nombre"], $_POST["descripcion"], $_POST["localizacion"]);
    }else if (isset($array_ruta[0]) && $array_ruta[0] == "api" && $array_ruta[1] == "getImagenRestaurante") {
        $apiController->getImagenRestaurante($_POST["idBar"], $_POST["numeroImagen"]);
    }else if (isset($array_ruta[0]) && $array_ruta[0]=="api" && $array_ruta[1] == "guardarImagenRestaurante") {
        $fk_bar = $_POST["fk_bar"];
        $numeroImagen = $_POST["numeroImagen"];
        $imagen = $_FILES["imagen"];
        $apiController->guardarImagenRestaurante($fk_bar, $numeroImagen, $imagen);
    }else if (isset($array_ruta[0]) && $array_ruta[0]=="api" && $array_ruta[1] == "deleteImagenRestaurante") {
        $fk_bar = $_POST["fk_bar"];
        $numeroImagen = $_POST["numeroImagen"];
        $apiController->deleteImagenRestaurante($fk_bar, $numeroImagen);
    }else if (isset($array_ruta[0]) && $array_ruta[0]=="api" && $array_ruta[1] == "restaurantesFiltrados") {
        $fTextoBuscador = $_POST["fTextoBuscador"];
        $fNotaMinima = $_POST["fNotaMinima"];
        $fNotaMaxima = $_POST["fNotaMaxima"];
        $apiController->getBaresFiltrados($fTextoBuscador, $fTextoBuscador, $fNotaMinima, $fNotaMaxima);
    }else if (isset($array_ruta[0]) && $array_ruta[0] == "api" && $array_ruta[1] == "getFullRestaurantes") { 
        $apiController->getFullRestaurantes();
    }else if (isset($array_ruta[0]) && $array_ruta[0] == "api" && $array_ruta[1] == "restaurantesConPinchos") {
        $apiController->getBarConPinchos($array_ruta[2]);
    }else if (isset($array_ruta[0]) && $array_ruta[0] == "api" && $array_ruta[1] == "resenas") { //Resenas
        $apiController->getResenas($_POST["pagina"], $_POST["cantidadRegistros"]);
    }else if (isset($array_ruta[0]) && $array_ruta[0] == "api" && $array_ruta[1] == "resena") {
        $apiController->getResena($array_ruta[2]);
    }else if (isset($array_ruta[0]) && $array_ruta[0] == "api" && $array_ruta[1] == "nuevaResena") {
        $apiController->newResena($_POST["fkUsuario"], $_POST["fkPincho"], $_POST["nota"], $_POST["textoResena"]);
    }else if (isset($array_ruta[0]) && $array_ruta[0] == "api" && $array_ruta[1] == "deleteResena") {
        $apiController->deleteResena($array_ruta[2]);
    }else if (isset($array_ruta[0]) && $array_ruta[0] == "api" && $array_ruta[1] == "updateResena") {
        $apiController->updateResena($array_ruta[2], $_POST["fkUsuario"], $_POST["fkPincho"], $_POST["nota"], $_POST["textoResena"]);
    }else if (isset($array_ruta[0]) && $array_ruta[0] == "api" && $array_ruta[1] == "resenasByUsuario") {
        $apiController->getResenasByUsuario($array_ruta[2]);
    }else if (isset($array_ruta[0]) && $array_ruta[0] == "api" && $array_ruta[1] == "resenasByPincho") {
        $apiController->getResenasByPincho($array_ruta[2]);
    }else if (isset($array_ruta[0]) && $array_ruta[0] == "api" && $array_ruta[1] == "darLike") {
        $fk_resena = $_POST["fk_resena"];
        $apiController->darLike($fk_resena);
    }else if (isset($array_ruta[0]) && $array_ruta[0] == "api" && $array_ruta[1] == "eliminarLike") {
        $fk_resena = $_POST["fk_resena"];
        $apiController->eliminarLike($fk_resena);
    }else if (isset($array_ruta[0]) && $array_ruta[0] == "api" && $array_ruta[1] == "resenasPinchosOrdenPopularidad") {
        $apiController->getResenasPinchosOrdenPopularidad();
    }else if (isset($array_ruta[0]) && $array_ruta[0] == "api" && $array_ruta[1] == "resenasLikeadasUsuario") {
        $apiController->getResenasLikeadasUsuario();
    }else if (isset($array_ruta[0]) && $array_ruta[0] == "api" && $array_ruta[1] == "pinchos") { //Pinchos
        $apiController->getPinchos($_POST["pagina"], $_POST["cantidadRegistros"]);
    }else if (isset($array_ruta[0]) && $array_ruta[0] == "api" && $array_ruta[1] == "pincho") {
        $apiController->getPincho($array_ruta[2]);
    }else if (isset($array_ruta[0]) && $array_ruta[0] == "api" && $array_ruta[1] == "nuevoPincho") {
        $apiController->newPincho($_POST["nombre"], $_POST["precio"], $_POST["fkBar"], $_POST["descripcion"]);
    }else if (isset($array_ruta[0]) && $array_ruta[0] == "api" && $array_ruta[1] == "deletePincho") {
        $apiController->deletePincho($array_ruta[2]);
    }else if (isset($array_ruta[0]) && $array_ruta[0] == "api" && $array_ruta[1] == "updatePincho") {
        $apiController->updatePincho($array_ruta[2], $_POST["nombre"], $_POST["precio"], $_POST["fkBar"], $_POST["descripcion"]);
    }else if (isset($array_ruta[0]) && $array_ruta[0] == "api" && $array_ruta[1] == "pinchosByRestaurante") {
        $apiController->getPinchosByRestaurante($array_ruta[2]);
    }else if (isset($array_ruta[0]) && $array_ruta[0] == "api" && $array_ruta[1] == "getImagenPincho") {
        $apiController->getImagenPincho($_POST["idPincho"], $_POST["numeroImagen"]);
    }else if (isset($array_ruta[0]) && $array_ruta[0]=="api" && $array_ruta[1] == "guardarImagenPincho") {
        $fk_bar = $_POST["fk_pincho"];
        $numeroImagen = $_POST["numeroImagen"];
        $imagen = $_FILES["imagen"];
        $apiController->guardarImagenPincho($fk_bar, $numeroImagen, $imagen);
    }else if (isset($array_ruta[0]) && $array_ruta[0]=="api" && $array_ruta[1] == "deleteImagenPincho") {
        $fk_pincho = $_POST["fk_pincho"];
        $numeroImagen = $_POST["numeroImagen"];
        $apiController->deleteImagenPincho($fk_pincho, $numeroImagen);
    }else if (isset($array_ruta[0]) && $array_ruta[0] == "api" && $array_ruta[1] == "pinchosImagenesResenas") {
        $apiController->getPinchoConImagenesResenas($array_ruta[2]);
    }else if (isset($array_ruta[0]) && $array_ruta[0]=="api" && $array_ruta[1] == "getPinchosFiltrados") {
        $textoBuscador = $_POST["textoBuscador"];
        $notaMinima = $_POST["notaMinima"];
        $notaMaxima = $_POST["notaMaxima"];
        $precioMinimo = $_POST["precioMinimo"];
        $precioMaximo = $_POST["precioMaximo"];
        $apiController->getPinchosFiltrados($notaMinima, $notaMaxima, $precioMinimo, $precioMaximo, $textoBuscador);
    }else if (isset($array_ruta[0]) && $array_ruta[0] == "api" && $array_ruta[1] == "usuarios") { //Usuarios
        $apiController->getUsuarios($_POST["pagina"], $_POST["cantidadRegistros"]);
    }else if (isset($array_ruta[0]) && $array_ruta[0] == "api" && $array_ruta[1] == "usuario") {
        $apiController->getUsuario($array_ruta[2]);
    }else if (isset($array_ruta[0]) && $array_ruta[0] == "api" && $array_ruta[1] == "nuevoUsuario") {
        $apiController->newUsuario($_POST["nombre"], $_POST["apellido1"], $_POST["apellido2"], $_POST["correoElectronico"], $_POST["user"], $_POST["password"], $_POST["admin"]);
    }else if (isset($array_ruta[0]) && $array_ruta[0] == "api" && $array_ruta[1] == "deleteUsuario") {
        $apiController->deleteUsuario($array_ruta[2]);
    }else if (isset($array_ruta[0]) && $array_ruta[0] == "api" && $array_ruta[1] == "updateUsuario") {
        $apiController->updateUsuario($array_ruta[2], $_POST["nombre"], $_POST["apellido1"], $_POST["apellido2"], $_POST["correoElectronico"], $_POST["user"], $_POST["password"], $_POST["admin"]);
    }else if (isset($array_ruta[0]) && $array_ruta[0] == "api" && $array_ruta[1] == "limpiarLikesUsuario") {
        $apiController->limpiarLikesUsuario($array_ruta[2]);
    }else if (isset($array_ruta[0]) && $array_ruta[0]=="api" && $array_ruta[1] == "guardarImagenUsuario") {
        $idUsuario = $_POST["usuario"];
        $imagen = $_FILES["imagen"];
        $apiController->guardarImagenUsuario($idUsuario,$imagen);
    }else if (isset($array_ruta[0]) && $array_ruta[0] == "api" && $array_ruta[1] == "getImagenUsuario") {
        $apiController->getImagenUsuario($array_ruta[2]);
    }else if (isset($array_ruta[0]) && $array_ruta[0] == "api" && $array_ruta[1] == "deleteImagenUsuario") {
        $apiController->deleteImagenUsuario($array_ruta[2]);
    }else if (isset($array_ruta[0]) && $array_ruta[0] == "api" && $array_ruta[1] == "bajaUsuario") {
        $apiController->bajaUsuario();
    }else if (isset($array_ruta[0]) && $array_ruta[0] == "api" && $array_ruta[1] == "getUsuarioLogueado") {
        $apiController->getUsuarioLogueado();
    }else if (isset($array_ruta[0]) && $array_ruta[0] == "api" && $array_ruta[1] == "loginFront") {
        $user = $_POST["user"];
        $password = $_POST["password"];
        $apiController->loginFront($user, $password);
    }else if (isset($array_ruta[0]) && $array_ruta[0] == "api" && $array_ruta[1] == "logout") {
        $apiController->logout();
    }else if (isset($array_ruta[0]) && $array_ruta[0] == "api" && $array_ruta[1] == "getImagenesSlider") {//GENERICAS
        $apiController->getImagenesSlider();
    }else if (isset($array_ruta[0]) && $array_ruta[0] == "api" && $array_ruta[1] == "buscadorBaresPinchos") {
        $textoBuscador = $_POST["textoBuscador"];
        $apiController->buscadorBaresPinchos($textoBuscador);
    }else if(count($array_ruta)==0){ //Pagina mostrada por defecto
        header("Location: ".$_SERVER["REQUEST_URI"]."home");
    }else{
        header("Location: ".$_SERVER["REQUEST_URI"]."index.php/home");
    }