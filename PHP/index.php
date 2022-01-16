<?php

    session_start();
    require("controller/UserController.php");
    require_once('model/bd.php');
        
    $userController = new UserController;
    $home = "/logrocho/index.php/";
    $ruta = str_replace($home, "", $_SERVER["REQUEST_URI"]);
    $array_ruta = array_filter(explode("/",$ruta));

    if (isset($array_ruta[0]) && $array_ruta[0] == "login") {
        $userController->index();
    }else if (isset($array_ruta[0]) && $array_ruta[0] == "loginRespuesta") {
        $userController->loginRespuesta();
    }else if(count($array_ruta)==0){
        header("Location: ".$_SERVER["REQUEST_URI"]."login");
    }else{
        header("Location: ".$_SERVER["REQUEST_URI"]."index.php/login");
    }