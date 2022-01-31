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
        $userController->reseñas();
    }else if (isset($array_ruta[0]) && $array_ruta[0] == "usuarios") {
        $userController->usuarios();
    }else if (isset($array_ruta[0]) && preg_match('/usuario/', $array_ruta[0])) {
        $userController->usuario();
    }else if (isset($array_ruta[0]) && $array_ruta[0] == "api" && $array_ruta[1] == "restaurantes") { //API
        $apiController->getBares($_POST["pagina"], $_POST["cantidadRegistros"]);
    }else if (isset($array_ruta[0]) && $array_ruta[0] == "api" && $array_ruta[1] == "restaurante") {
        $apiController->getBar($array_ruta[2]);
    }else if (isset($array_ruta[0]) && $array_ruta[0] == "api" && $array_ruta[1] == "nuevoRestaurante") {
        $apiController->newBar($_POST["nombre"], $_POST["descripcion"], $_POST["localizacion"]);
    }else if (isset($array_ruta[0]) && $array_ruta[0] == "api" && $array_ruta[1] == "deleteRestaurante") {
        $apiController->deleteBar($array_ruta[2]);
    }else if (isset($array_ruta[0]) && $array_ruta[0] == "api" && $array_ruta[1] == "updateRestaurante") {
        $apiController->updateBar($array_ruta[2], $_POST["nombre"], $_POST["descripcion"], $_POST["localizacion"]);
    }else if (isset($array_ruta[0]) && $array_ruta[0] == "api" && $array_ruta[1] == "resenas") {
        $apiController->getReseñas($_POST["pagina"], $_POST["cantidadRegistros"]);
    }else if (isset($array_ruta[0]) && $array_ruta[0] == "api" && $array_ruta[1] == "resena") {
        $apiController->getReseña($array_ruta[2]);
    }else if (isset($array_ruta[0]) && $array_ruta[0] == "api" && $array_ruta[1] == "nuevaResena") {
        $apiController->newReseña($_POST["fkUsuario"], $_POST["fkPincho"], $_POST["nota"], $_POST["textoResena"]);
    }else if (isset($array_ruta[0]) && $array_ruta[0] == "api" && $array_ruta[1] == "deleteResena") {
        $apiController->deleteReseña($array_ruta[2]);
    }else if (isset($array_ruta[0]) && $array_ruta[0] == "api" && $array_ruta[1] == "updateResena") {
        $apiController->updateReseña($array_ruta[2], $_POST["fkUsuario"], $_POST["fkPincho"], $_POST["nota"], $_POST["textoResena"]);
    }else if (isset($array_ruta[0]) && $array_ruta[0] == "api" && $array_ruta[1] == "pinchos") {
        $apiController->getPinchos($_POST["pagina"], $_POST["cantidadRegistros"]);
    }else if (isset($array_ruta[0]) && $array_ruta[0] == "api" && $array_ruta[1] == "pincho") {
        $apiController->getPincho($array_ruta[2]);
    }else if (isset($array_ruta[0]) && $array_ruta[0] == "api" && $array_ruta[1] == "nuevoPincho") {
        $apiController->newPincho($_POST["nombre"], $_POST["precio"], $_POST["fkBar"], $_POST["descripcion"]);
    }else if (isset($array_ruta[0]) && $array_ruta[0] == "api" && $array_ruta[1] == "deletePincho") {
        $apiController->deletePincho($array_ruta[2]);
    }else if (isset($array_ruta[0]) && $array_ruta[0] == "api" && $array_ruta[1] == "updatePincho") {
        $apiController->updatePincho($array_ruta[2], $_POST["nombre"], $_POST["precio"], $_POST["fkBar"], $_POST["descripcion"]);
    }else if (isset($array_ruta[0]) && $array_ruta[0] == "api" && $array_ruta[1] == "usuarios") {
        $apiController->getUsuarios($_POST["pagina"], $_POST["cantidadRegistros"]);
    }else if (isset($array_ruta[0]) && $array_ruta[0] == "api" && $array_ruta[1] == "usuario") {
        $apiController->getUsuario($array_ruta[2]);
    }else if (isset($array_ruta[0]) && $array_ruta[0] == "api" && $array_ruta[1] == "nuevoUsuario") {
        $apiController->newUsuario($_POST["nombre"], $_POST["apellido1"], $_POST["apellido2"], $_POST["correoElectronico"], $_POST["user"], $_POST["password"], $_POST["admin"]);
    }else if (isset($array_ruta[0]) && $array_ruta[0] == "api" && $array_ruta[1] == "deleteUsuario") {
        $apiController->deleteUsuario($array_ruta[2]);
    }else if (isset($array_ruta[0]) && $array_ruta[0] == "api" && $array_ruta[1] == "updateUsuario") {
        $apiController->updateUsuario($array_ruta[2], $_POST["nombre"], $_POST["apellido1"], $_POST["apellido2"], $_POST["correoElectronico"], $_POST["user"], $_POST["password"], $_POST["admin"]);
    }else if(count($array_ruta)==0){
        header("Location: ".$_SERVER["REQUEST_URI"]."login");
    }else{
        header("Location: ".$_SERVER["REQUEST_URI"]."index.php/login");
    }