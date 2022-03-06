<?php
class ApiController
{

    function __construct()
    {
    }

    //----------------------------------------
    //BARES
    //----------------------------------------    
    /**
     * getBares
     *
     * @param  mixed $pagina
     * @param  mixed $cantidadRegistros
     * @return void
     */
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
            $aux["nota"] = $bar["Puntuacion"];

            array_push($array["bares"], $aux);
        }
        echo json_encode($array);
    }
    
    /**
     * getBar
     *
     * @param  mixed $idBar
     * @return void
     */
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
            /* $aux["notaMedia"] = $this->getNotaMediaRestaurante($bar["idRestaurante"]); */
            array_push($array["bar"], $aux);
        }
        echo json_encode($array);
    }
    
    /**
     * newBar
     *
     * @param  mixed $nombre
     * @param  mixed $descripcion
     * @param  mixed $localizacion
     * @return void
     */
    public function newBar($nombre, $descripcion, $localizacion, $latitud, $longitud)
    {
        header("Content-Type: application/json', 'HTTP/1.1 200 OK");
        $array = array();
        $array["bar"] = array();
        $baresbd = Conexion::newBar($nombre, $descripcion, $localizacion, $latitud, $longitud);
        
        echo json_encode($baresbd);
    }
    
    /**
     * deleteBar
     *
     * @param  mixed $idBar
     * @return void
     */
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
    
    /**
     * updateBar
     *
     * @param  mixed $idBar
     * @param  mixed $nombre
     * @param  mixed $descripcion
     * @param  mixed $localizacion
     * @return void
     */
    public function updateBar($idBar, $nombre, $descripcion, $localizacion)
    {
        header("Content-Type: application/json', 'HTTP/1.1 200 OK");
        $array = array();
        $array["bar"] = array();
        $baresbd = Conexion::updateBar($idBar, $nombre, $descripcion, $localizacion);
        
        echo json_encode($baresbd);
    }
    
    /**
     * getImagenRestaurante
     *
     * @param  mixed $idBar
     * @param  mixed $numeroImagen
     * @return void
     */
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
    
    /**
     * guardarImagenRestaurante
     *
     * @param  mixed $fk_bar
     * @param  mixed $numeroImagen
     * @param  mixed $imagen
     * @return void
     */
    public function guardarImagenRestaurante($fk_bar,$numeroImagen, $imagen)
    {
        $ruta ="https://iker.ociobinario.com/logrocho/imagenes/restaurantes/".$fk_bar."/imagen".$numeroImagen."/".$imagen["name"];

        if (!file_exists("./imagenes/restaurantes/".$fk_bar."/imagen".$numeroImagen)) {
            mkdir("./imagenes/restaurantes/".$fk_bar."/imagen".$numeroImagen, 0777, true);
        }
        if (!file_exists("./imagenes/restaurantes/".$fk_bar."/imagen".$numeroImagen."/".$imagen["name"])) {

            move_uploaded_file($imagen["tmp_name"], "./imagenes/restaurantes/".$fk_bar."/imagen".$numeroImagen."/".$imagen["name"]);
        }
        
        Conexion::guardarImagenRestaurante($fk_bar,$numeroImagen, $ruta);
    }
    
    /**
     * deleteImagenRestaurante
     *
     * @param  mixed $fk_bar
     * @param  mixed $numeroImagen
     * @return void
     */
    public function deleteImagenRestaurante($fk_bar, $numeroImagen)
    {
        header("Content-Type: application/json', 'HTTP/1.1 200 OK");
        $imagenbd = Conexion::deleteImagenRestaurante($fk_bar, $numeroImagen);
            
        echo json_encode($imagenbd);
    }

    /**
     * @param mixed $fNombre
     * @param mixed $fLocalizacion
     * @param mixed $fNotaMinima
     * @param mixed $fNotaMaxima
     * 
     * @return [type]
     */
    public function getBaresFiltrados($fNombre, $fLocalizacion, $fNotaMinima, $fNotaMaxima)
    {

        header("Content-Type: application/json', 'HTTP/1.1 200 OK");
        $array = array();
        $array["bares"] = array();
        $baresbd = Conexion::getBaresFiltrados($fNombre, $fLocalizacion);
        foreach ($baresbd as $bar) {
            $aux = array();
            $aux["idRestaurante"] = $bar["idRestaurante"];
            $aux["nombre"] = $bar["nombre"];
            $aux["descripcion"] = $bar["descripcion"];
            $aux["localizacion"] = $bar["localizacion"];
            $aux["nota"] = $bar["Puntuacion"];


            if (($bar["Puntuacion"] >= $fNotaMinima && $bar["Puntuacion"] <= $fNotaMaxima)|| $bar["Puntuacion"]==null) {
                array_push($array["bares"], $aux);
            }
            
            
        }
        echo json_encode($array);
    }

    /**
     * @param mixed $idBar
     * 
     * @return [type]
     */
    public function getBarConPinchos($idBar){
        header("Content-Type: application/json', 'HTTP/1.1 200 OK");
        $array = array();
        $array["bares"] = array();
        $baresbd = Conexion::getBarConImagenes($idBar);
        foreach ($baresbd as $bar) {
            $aux = array();
            $aux["idRestaurante"] = $bar["idRestaurante"];
            $aux["nombre"] = $bar["nombre"];
            $aux["descripcion"] = $bar["descripcion"];
            $aux["localizacion"] = $bar["localizacion"];
            $aux["nota"] = $bar["Puntuacion"];
            $aux["imagen1"] = $bar["imagen1"];
            $aux["imagen2"] = $bar["imagen2"];
            $aux["imagen3"] = $bar["imagen3"];
            $aux["pinchos"] = $this->getPinchosConImagenesByBar($aux["idRestaurante"]);
            
            array_push($array["bares"], $aux);
            
        }
        echo json_encode($array);
    }

    /**
     * @return [type]
     */
    public function getFullRestaurantes(){
        header("Content-Type: application/json', 'HTTP/1.1 200 OK");
        $array = array();
        $array["bares"] = array();
        $baresbd = Conexion::getFullRestaurantes();
        foreach ($baresbd as $bar) {
            $aux = array();
            $aux["idRestaurante"] = $bar["idRestaurante"];
            $aux["nombre"] = $bar["nombre"];
            $aux["descripcion"] = $bar["descripcion"];
            $aux["localizacion"] = $bar["localizacion"];
            $aux["nota"] = $bar["Puntuacion"];
            $aux["latitud"] = $bar["latitud"];
            $aux["longitud"] = $bar["longitud"];

            array_push($array["bares"], $aux);
        }
        echo json_encode($array);
    }

    

    //----------------------------------------
    //RESEnAS
    //----------------------------------------    
    /**
     * getRese
     *
     * @param  mixed $pagina
     * @param  mixed $cantidadRegistros
     * @return void
     */
    public function getResenas($pagina, $cantidadRegistros)
    {
        header("Content-Type: application/json', 'HTTP/1.1 200 OK");
        $array = array();
        $array["resenas"] = array();
        $resenasbd = Conexion::getResenas($pagina, $cantidadRegistros);
        foreach ($resenasbd as $resena) {
            $aux = array();
            $aux["idResena"] = $resena["idResena"];
            $aux["fkUsuario"] = $resena["fkUsuario"];
            $aux["fkPincho"] = $resena["fkPincho"];
            $aux["nota"] = $resena["nota"];
            $aux["textoResena"] = $resena["textoResena"];
            array_push($array["resenas"], $aux);
        }
        echo json_encode($array);
    }
    
    /**
     * getRese
     *
     * @param  mixed $idRese
     * @return void
     */
    public function getResena($idResena)
    {
        header("Content-Type: application/json', 'HTTP/1.1 200 OK");
        $array = array();
        $array["resena"] = array();
        $resenasbd = Conexion::getResena($idResena);
        foreach ($resenasbd as $resena) {
            $aux = array();
            $aux["idResena"] = $resena["idResena"];
            $aux["fkUsuario"] = $resena["fkUsuario"];
            $aux["fkPincho"] = $resena["fkPincho"];
            $aux["nota"] = $resena["nota"];
            $aux["textoResena"] = $resena["textoResena"];
            array_push($array["resena"], $aux);
        }
        echo json_encode($array);
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
    public function newResena($usuario, $pincho, $nota, $texto)
    {
        header("Content-Type: application/json', 'HTTP/1.1 200 OK");
        $array = array();
        $array["bar"] = array();
        $baresbd = Conexion::newResena($usuario, $pincho, $nota, $texto);
        
        echo json_encode($baresbd);
    }
    
    /**
     * deleteRese
     *
     * @param  mixed $idRese
     * @return void
     */
    public function deleteResena($idResena)
    {
        

        if (isset($_SESSION["usuarioActual"]) and $_SESSION["usuarioActual"]["admin"] == 1) {
            header("Content-Type: application/json', 'HTTP/1.1 200 OK");
            $array = array();
            $array["bar"] = array();
            $resenasbd = Conexion::deleteResena($idResena);
            
            echo json_encode($resenasbd);
        }else{
            $error = "operacion reservada exclusivamente a administradores";
            echo json_encode($error);
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
    public function updateResena($idResena, $usuario, $pincho, $nota, $texto)
    {

        if (isset($_SESSION["usuarioActual"]) and $_SESSION["usuarioActual"]["admin"] == 1) {
            header("Content-Type: application/json', 'HTTP/1.1 200 OK");
            $array = array();
            $array["resena"] = array();
            $resenasbd = Conexion::updateResena($idResena, $usuario, $pincho, $nota, $texto);
            
            echo json_encode($resenasbd);
        }else{
            $error = "operacion reservada exclusivamente a administradores";
            echo json_encode($error);
            
        }

    }
    
    /**
     * getRese
     *
     * @param  mixed $idUsuario
     * @return void
     */
    public function getResenasByUsuario($idUsuario){
        header("Content-Type: application/json', 'HTTP/1.1 200 OK");
        $array = array();
        $array["resenas"] = array();
        $resenasbd = Conexion::getResenasByUsuario($idUsuario);
        foreach ($resenasbd as $resena) {
            $aux = array();
            $aux["idResena"] = $resena["idResena"];
            $aux["fkUsuario"] = $resena["fkUsuario"];
            $aux["fkPincho"] = $resena["fkPincho"];
            $aux["nota"] = $resena["nota"];
            $aux["textoResena"] = $resena["textoResena"];
            $aux["nombreUsuario"] = $resena["nombreUsuario"];
            $aux["nombrePincho"] = $resena["nombrePincho"];
            $aux["nombreBar"] = $resena["nombreBar"];
            array_push($array["resenas"], $aux);
        }
        echo json_encode($array);
    }
    
    /**
     * getRese
     *
     * @param  mixed $idPincho
     * @return void
     */
    public function getResenasByPincho($idPincho){
        header("Content-Type: application/json', 'HTTP/1.1 200 OK");
        $array = array();
        $array["resenas"] = array();
        $resenasbd = Conexion::getResenasByPincho($idPincho);
        foreach ($resenasbd as $resena) {
            $aux = array();
            $aux["idResena"] = $resena["idResena"];
            $aux["fkUsuario"] = $resena["fkUsuario"];
            $aux["fkPincho"] = $resena["fkPincho"];
            $aux["nota"] = $resena["nota"];
            $aux["textoResena"] = $resena["textoResena"];
            array_push($array["resenas"], $aux);
        }
        echo json_encode($array);
    }

    /**
     * @param mixed $idResena
     * 
     * @return [type]
     */
    public function darLike($idResena){
        header("Content-Type: application/json', 'HTTP/1.1 200 OK");
        

        $array = array();
        $array["resultado"] = "";

        /* Conexion::darLike($idResena, 4); */

        if (isset($_SESSION["usuarioActual"])) {
            $idUsuario = $_SESSION["usuarioActual"]["idUsuario"];
            Conexion::darLike($idResena, $idUsuario);
            $array["resultado"] = "Like aplicado correctamente a la resena";
        }else{
            $array["resultado"] = "No existe un usuario registrado";
        }

        echo json_encode($array);
        
    }

    /**
     * @param mixed $idResena
     * 
     * @return [type]
     */
    public function eliminarLike($idResena){
        header("Content-Type: application/json', 'HTTP/1.1 200 OK");
        

        $array = array();
        $array["resultado"] = "";

        /* Conexion::darLike($idResena, 4); */

        if (isset($_SESSION["usuarioActual"])) {
            $idUsuario = $_SESSION["usuarioActual"]["idUsuario"];
            Conexion::eliminarLike($idResena, $idUsuario);
            $array["resultado"] = "Like eliminado correctamente de la resena";
        }else{
            $array["resultado"] = "No existe un usuario registrado";
        }

        echo json_encode($array);
        
    }


    /**
     * @return [type]
     */
    public function getResenasPinchosOrdenPopularidad(){

        header("Content-Type: application/json', 'HTTP/1.1 200 OK");
        $array = array();

        $array["pinchos"] = array();
        $pinchosbd = Conexion::getPinchosOrderedNota();
        foreach ($pinchosbd as $pincho) {
            $aux = array();
            $aux["idPincho"] = $pincho["idPincho"];
            $aux["nombre"] = $pincho["nombre"];
            $aux["precio"] = $pincho["precio"];
            $aux["fkBar"] = $pincho["fkBar"];
            $aux["nombreBar"] = $pincho["nombreBar"];
            $aux["descripcion"] = $pincho["descripcion"];
            $aux["nota"] = $pincho["nota"];
            array_push($array["pinchos"], $aux);
        }  

        $array["resenas"] = array();        
        $resenasbd = Conexion::getResenasOrderedLikes();
        foreach ($resenasbd as $resena) {
            $aux = array();
            $aux["idResena"] = $resena["idResena"];
            $aux["fkUsuario"] = $resena["fkUsuario"];
            $aux["nombreUsuario"] = $resena["nombreUsuario"];
            $aux["fkPincho"] = $resena["fkPincho"];
            $aux["nombrePincho"] = $resena["nombrePincho"];
            $aux["nota"] = $resena["nota"];
            $aux["cantidadLikes"] = $resena["cantidadLikes"];
            $aux["textoResena"] = $resena["textoResena"];
            array_push($array["resenas"], $aux);
        }
        echo json_encode($array);

    }

    /**
     * @return [type]
     */
    public function getResenasLikeadasUsuario(){

        header("Content-Type: application/json', 'HTTP/1.1 200 OK");
        $array = array();

        $array["resenas"] = array();
        if (isset($_SESSION["usuarioActual"])) {
            $idUsuario = $_SESSION["usuarioActual"]["idUsuario"];
            $resenasbd = Conexion::getResenasLikeadasUsuario($idUsuario);
            foreach ($resenasbd as $resena) {
                $aux = array();
                $aux["idResena"] = $resena["idResena"];
                $aux["fkUsuario"] = $resena["fkUsuario"];
                $aux["fkPincho"] = $resena["fkPincho"];
                $aux["nota"] = $resena["nota"];
                $aux["textoResena"] = $resena["textoResena"];
                $aux["nombreUsuario"] = $resena["nombreUsuario"];
                $aux["nombrePincho"] = $resena["nombrePincho"];
                $aux["nombreBar"] = $resena["nombreBar"];
                $aux["imagenUsuario"] = $resena["imagenUsuario"];

                array_push($array["resenas"], $aux);
            } 
            echo json_encode($array);
        }else{
            $error = "Debes loguearte para realizar esta peticion";
            echo json_encode($error);
        }
         
    }
    //----------------------------------------
    //PINCHOS
    //----------------------------------------    
    /**
     * getPinchos
     *
     * @param  mixed $pagina
     * @param  mixed $cantidadRegistros
     * @return void
     */
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
            $notaMedia = Conexion::getNotaMediaPincho($pincho["idPincho"]);
            foreach ($notaMedia as $nota){
                $aux["notaMedia"] = $nota["notaPincho"];
            }
            array_push($array["pinchos"], $aux);
        }
        echo json_encode($array);
    }
    
    /**
     * getPincho
     *
     * @param  mixed $idPincho
     * @return void
     */
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
            $notaMedia = Conexion::getNotaMediaPincho($pincho["idPincho"]);
            foreach ($notaMedia as $nota){
                $aux["notaMedia"] = $nota["notaPincho"];
            }
            
            array_push($array["pinchos"], $aux);
        }
        echo json_encode($array);
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
    public function newPincho($nombre, $precio, $bar, $descripcion)
    {
        header("Content-Type: application/json', 'HTTP/1.1 200 OK");
        $array = array();
        $array["bar"] = array();
        $baresbd = Conexion::newPincho($nombre, $precio, $bar, $descripcion);
        
        echo json_encode($baresbd);
    }
    
    /**
     * deletePincho
     *
     * @param  mixed $idPincho
     * @return void
     */
    public function deletePincho($idPincho)
    {

        if (isset($_SESSION["usuarioActual"]) and $_SESSION["usuarioActual"]["admin"] == 1) {
            header("Content-Type: application/json', 'HTTP/1.1 200 OK");
            $array = array();
            $array["pincho"] = array();
            $resenasbd = Conexion::deletePincho($idPincho);
            
            echo json_encode($resenasbd);
        }else{
            $error = "operacion reservada exclusivamente a administradores";
            echo json_encode($error);
        }

    }
    
    /**
     * updatePincho
     *
     * @param  mixed $idPincho
     * @param  mixed $usuario
     * @param  mixed $pincho
     * @param  mixed $nota
     * @param  mixed $texto
     * @return void
     */
    public function updatePincho($idPincho, $usuario, $pincho, $nota, $texto)
    {
        header("Content-Type: application/json', 'HTTP/1.1 200 OK");
        $array = array();
        $array["pincho"] = array();
        $pinchosbd = Conexion::updatePincho($idPincho, $usuario, $pincho, $nota, $texto);
        
        echo json_encode($pinchosbd);
    }
    
    /**
     * getPinchosByRestaurante
     *
     * @param  mixed $idRestaurante
     * @return void
     */
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
            $notaMedia = Conexion::getNotaMediaPincho($pincho["idPincho"]);
            foreach ($notaMedia as $nota){
                $aux["notaMedia"] = $nota["notaPincho"];
            }
            array_push($array["pinchos"], $aux);
        }
        echo json_encode($array);
    }

    /**
     * @param mixed $idRestaurante
     * 
     * @return [type]
     */
    private function getPinchosByRestauranteInterno($idRestaurante){
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
            $notaMedia = Conexion::getNotaMediaPincho($pincho["idPincho"]);
            foreach ($notaMedia as $nota){
                $aux["notaMedia"] = $nota["notaPincho"];
            }
            array_push($array["pinchos"], $aux);
        }
        return $array;
    }

    
    
    /**
     * getImagenPincho
     *
     * @param  mixed $idPincho
     * @param  mixed $numeroImagen
     * @return void
     */
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
    
    /**
     * guardarImagenPincho
     *
     * @param  mixed $fk_pincho
     * @param  mixed $numeroImagen
     * @param  mixed $imagen
     * @return void
     */
    public function guardarImagenPincho($fk_pincho,$numeroImagen, $imagen)
    {
        $ruta ="https://iker.ociobinario.com/logrocho/imagenes/pinchos/".$fk_pincho."/imagen".$numeroImagen."/".$imagen["name"];

        if (!file_exists("./imagenes/pinchos/".$fk_pincho."/imagen".$numeroImagen)) {
            mkdir("./imagenes/pinchos/".$fk_pincho."/imagen".$numeroImagen, 0777, true);
        }
        if (!file_exists("./imagenes/pinchos/".$fk_pincho."/imagen".$numeroImagen."/".$imagen["name"])) {

            move_uploaded_file($imagen["tmp_name"], "./imagenes/pinchos/".$fk_pincho."/imagen".$numeroImagen."/".$imagen["name"]);
        }
        
        echo json_encode(Conexion::guardarImagenPincho($fk_pincho,$numeroImagen, $ruta));
    }
    
    /**
     * deleteImagenpincho
     *
     * @param  mixed $fk_pincho
     * @param  mixed $numeroImagen
     * @return void
     */
    public function deleteImagenpincho($fk_pincho, $numeroImagen)
    {
        header("Content-Type: application/json', 'HTTP/1.1 200 OK");
        $imagenbd = Conexion::deleteImagenPincho($fk_pincho, $numeroImagen);
            
        echo json_encode($imagenbd);
    }


    /**
     * @param mixed $idBar
     * 
     * @return [type]
     */
    public function getPinchosConImagenesByBar($idBar){
        header("Content-Type: application/json', 'HTTP/1.1 200 OK");
        $array = array();
        $array["pinchos"] = array();
        $pinchosbd = Conexion::getPinchosConImagenesByBar($idBar);
        foreach ($pinchosbd as $pincho) {
            $aux = array();
            $aux["idPincho"] = $pincho["idPincho"];
            $aux["nombre"] = $pincho["nombre"];
            $aux["precio"] = $pincho["precio"];
            $aux["fkBar"] = $pincho["fkBar"];
            $aux["descripcion"] = $pincho["descripcion"];
            $notaMedia = Conexion::getNotaMediaPincho($pincho["idPincho"]);
            $aux["notaMedia"] = null;
            foreach ($notaMedia as $nota){
                $aux["notaMedia"] = $nota["notaPincho"];
            }
            $aux["imagen1"] = $pincho["imagen1"];
            $aux["imagen2"] = $pincho["imagen2"];
            $aux["imagen3"] = $pincho["imagen3"];

            array_push($array["pinchos"], $aux);
        }
        return $array["pinchos"];
    }

    /**
     * @param mixed $idPincho
     * 
     * @return [type]
     */
    public function getPinchoConImagenesResenas($idPincho){
        header("Content-Type: application/json', 'HTTP/1.1 200 OK");
        $array = array();
        $array["pinchos"] = array();
        $pinchosbd = Conexion::getPinchoConImagenes($idPincho);
        foreach ($pinchosbd as $pincho) {
            $aux = array();
            $aux["idPincho"] = $pincho["idPincho"];
            $aux["nombre"] = $pincho["nombre"];
            $aux["precio"] = $pincho["precio"];
            $aux["fkBar"] = $pincho["fkBar"];
            $aux["descripcion"] = $pincho["descripcion"];
            $aux["nota"] = $pincho["Puntuacion"];
            $aux["imagen1"] = $pincho["imagen1"];
            $aux["imagen2"] = $pincho["imagen2"];
            $aux["imagen3"] = $pincho["imagen3"];
            
            $aux["resenas"] = array();
            $resenas = Conexion::getResenasByPincho($aux["idPincho"]);
            foreach ($resenas as $resena) {
                $auxResena = array();
                $auxResena["idResena"] = $resena["idResena"];
                $auxResena["fkUsuario"] = $resena["fkUsuario"];
                $auxResena["fkPincho"] = $resena["fkPincho"];
                $auxResena["nota"] = $resena["nota"];
                $auxResena["textoResena"] = $resena["textoResena"];
                $auxResena["likes"] = $resena["likes"];
                array_push($aux["resenas"], $auxResena);
            }
            
            array_push($array["pinchos"], $aux);
            
        }
        echo json_encode($array);
    }

    /**
     * @param mixed $notaMinima
     * @param mixed $notaMaxima
     * @param mixed $precioMinimo
     * @param mixed $precioMaximo
     * @param mixed $textoBuscador
     * 
     * @return [type]
     */
    public function getPinchosFiltrados($notaMinima, $notaMaxima, $precioMinimo, $precioMaximo, $textoBuscador){
        header("Content-Type: application/json', 'HTTP/1.1 200 OK");
        $array = array();
        $array["pinchos"] = array();
        $pinchosbd = Conexion::getPinchosFiltrados($textoBuscador, $precioMinimo, $precioMaximo, $notaMinima, $notaMaxima);

        foreach($pinchosbd as $pincho){
            $aux = array();
            $aux["idPincho"] = $pincho["idPincho"];
            $aux["nombre"] = $pincho["nombre"];
            $aux["precio"] = $pincho["precio"];
            $aux["fkBar"] = $pincho["fkBar"];
            $aux["nombreBar"] = $pincho["nombreBar"];
            $aux["descripcion"] = $pincho["descripcion"];
            $aux["nota"] = $pincho["notaPincho"];
            $aux["imagen1"] = $pincho["imagen1"];
            $aux["imagen2"] = $pincho["imagen2"];
            $aux["imagen3"] = $pincho["imagen3"];

            array_push($array["pinchos"], $aux);
        }

        echo json_encode($array);
    }

    

    //----------------------------------------
    //USUARIOS
    //----------------------------------------    
    /**
     * getUsuarios
     *
     * @param  mixed $pagina
     * @param  mixed $cantidadRegistros
     * @return void
     */
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
    
    /**
     * getUsuario
     *
     * @param  mixed $idUsuario
     * @return void
     */
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
    public function newUsuario($nombre, $apellido1, $apellido2, $correoElectronico, $user, $password, $admin)
    {
        header("Content-Type: application/json', 'HTTP/1.1 200 OK");
        $array = array();
        $array["usuario"] = array();
        $usuariosbd = Conexion::newUsuario($nombre, $apellido1, $apellido2, $correoElectronico, $user, $password, $admin);
        
        echo json_encode($usuariosbd);
    }
    
    /**
     * deleteUsuario
     *
     * @param  mixed $idUsuario
     * @return void
     */
    public function deleteUsuario($idUsuario)
    {
        if (isset($_SESSION["usuarioActual"]) and $_SESSION["usuarioActual"]["admin"] == 1) {
            header("Content-Type: application/json', 'HTTP/1.1 200 OK");
            $array = array();
            $array["usuario"] = array();
            $resenasbd = Conexion::deleteUsuario($idUsuario);
                
            echo json_encode($resenasbd);
        }else{
            $error = "operacion reservada exclusivamente a administradores";
            echo json_encode($error);
            
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
    public function updateUsuario($idUsuario, $nombre, $apellido1, $apellido2, $correoElectronico, $user, $password, $admin)
    {
        header("Content-Type: application/json', 'HTTP/1.1 200 OK");
        $array = array();
        $array["usuario"] = array();
        $usuariosbd = Conexion::updateUsuario($idUsuario, $nombre, $apellido1, $apellido2, $correoElectronico, $user, $password, $admin);
        
        echo json_encode($usuariosbd);
    }
    
    /**
     * limpiarLikesUsuario
     *
     * @param  mixed $idUsuario
     * @return void
     */
    public function limpiarLikesUsuario($idUsuario){
        if (isset($_SESSION["usuarioActual"]) and $_SESSION["usuarioActual"]["admin"] == 1) {
            header("Content-Type: application/json', 'HTTP/1.1 200 OK");
            //$array = array();
            //$array["usuario"] = array();
            $resenasbd = Conexion::limpiarLikesUsuario($idUsuario);
                
            echo json_encode($resenasbd);
        }else{
            $error = "operacion reservada exclusivamente a administradores";
            echo json_encode($error);
            
        }
    }
    
    /**
     * guardarImagenUsuario
     *
     * @param  mixed $idUsuario
     * @param  mixed $imagen
     * @return void
     */
    public function guardarImagenUsuario($idUsuario,$imagen)
    {
        $ruta ="https://iker.ociobinario.com/logrocho/imagenes/usuarios/".$idUsuario."/".$imagen["name"];

        if (!file_exists("./imagenes/usuarios/".$idUsuario)) {
            mkdir("./imagenes/usuarios/".$idUsuario, 0777, true);
        }
        if (!file_exists("./imagenes/usuarios/".$idUsuario."/".$imagen["name"])) {

            move_uploaded_file($imagen["tmp_name"], "./imagenes/usuarios/".$idUsuario."/".$imagen["name"]);
        }
        
        Conexion::guardarImagenUsuario($idUsuario, $ruta);
    }
    
    /**
     * getImagenUsuario
     *
     * @param  mixed $idUsuario
     * @return void
     */
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
    
    /**
     * deleteImagenUsuario
     *
     * @param  mixed $idUsuario
     * @return void
     */
    public function deleteImagenUsuario($idUsuario)
    {
        
        header("Content-Type: application/json', 'HTTP/1.1 200 OK");
        $imagenbd = Conexion::deleteImagenUsuario($idUsuario);
                
        echo json_encode($imagenbd);        
        
    }
    

    /**
     * @return [type]
     */
    public function bajaUsuario(){
        header("Content-Type: application/json', 'HTTP/1.1 200 OK");
        

        $array = array();
        $array["resultado"] = "";

        
        /* echo $_SESSION["usuarioActual"]["idUsuario"]; */

        if (isset($_SESSION["usuarioActual"])) {
            $idUsuario = $_SESSION["usuarioActual"]["idUsuario"];
            Conexion::deleteUsuario($idUsuario);
            $array["resultado"] = "Usuario dado de baja correctamente";
            session_destroy();
        }else{
            $array["resultado"] = "No existe un usuario logueado";
        }

        echo json_encode($array);
    }

    /**
     * @return [type]
     */
    public function getUsuarioLogueado(){
        header("Content-Type: application/json', 'HTTP/1.1 200 OK");

        if(isset($_SESSION["usuarioActual"])){
            $array = array();
            $array["usuarios"] = array();
            $usuario = array();

            $usuariosbd = Conexion::getUser($_SESSION["usuarioActual"]["idUsuario"]);
            foreach ($usuariosbd as $usuariobd) {
                $aux = array();
                $aux["idUsuario"] = $usuariobd["idUsuario"];
                $aux["nombre"] = $usuariobd["nombre"];
                $aux["apellido1"] = $usuariobd["apellido1"];
                $aux["apellido2"] = $usuariobd["apellido2"];
                $aux["correoElectronico"] = $usuariobd["correoElectronico"];
                $aux["user"] = $usuariobd["user"];
                $aux["password"] = $usuariobd["password"];
                $aux["admin"] = $usuariobd["admin"];

                $aux["imagen"] ="";
                $imagenesbd = Conexion::getImagenUsuario($usuariobd["idUsuario"]);
                foreach ($imagenesbd as $imagen) {
                    $aux["imagen"] = $imagen["imagen"];
                }
                /* array_push($array["usuarios"], $aux); */
                $usuario = $aux;
            }

            /* $usuario["idUsuario"] = $_SESSION["usuarioActual"]["idUsuario"];
            $usuario["nombre"] = $_SESSION["usuarioActual"]["nombre"];
            $usuario["apellido1"] = $_SESSION["usuarioActual"]["apellido1"];
            $usuario["apellido2"] = $_SESSION["usuarioActual"]["apellido2"];
            $usuario["correoElectronico"] = $_SESSION["usuarioActual"]["correoElectronico"];
            $usuario["user"] = $_SESSION["usuarioActual"]["user"];
            $usuario["password"] = $_SESSION["usuarioActual"]["password"];
            $usuario["admin"] = $_SESSION["usuarioActual"]["admin"]; */

            

            /* array_push($array["usuarios"], $usuario); */

            echo json_encode($usuario);
        }else{
            echo json_encode("false");
        }
    }

    /**
     * @param mixed $user
     * @param mixed $password
     * 
     * @return [type]
     */
    public function loginFront($user, $password){

        $login = Conexion::getLogin($user, $password);

        if ($login->rowCount() == 1) {
            $_SESSION["usuarioActual"] = $login->fetch();

            echo json_encode("true");
        } else {
            echo json_encode("false");
        }

    }

    /**
     * @return [type]
     */
    public function logout(){
        session_destroy();
    }

    //-------------------------------------
    //GENERICAS
    //-------------------------------------
    /**
     * @return [type]
     */
    public function getImagenesSlider(){

        header("Content-Type: application/json', 'HTTP/1.1 200 OK");
        $array = array();
        $array["mejorValorados"] = array();
        $mejorValoradosbd = Conexion::getImagenesMejorValorados();
        foreach ($mejorValoradosbd as $imagen) {
            $aux = array();
            $aux["imagen"] = $imagen["imagen"];

            array_push($array["mejorValorados"], $aux);
        }

        $idUsuario = 0;

        if (isset($_SESSION["usuarioActual"])) {
            $idUsuario = $_SESSION["usuarioActual"]["idUsuario"];
        }

        $array["preferidos"] = array();
        $preferidos = Conexion::getImagenesPreferidos($idUsuario);
        foreach ($preferidos as $imagen) {
            $aux = array();
            $aux["imagen"] = $imagen["imagen"];

            array_push($array["preferidos"], $aux);
        }

        echo json_encode($array);

    }

    /**
     * @param mixed $textoBuscador
     * 
     * @return [type]
     */
    public function buscadorBaresPinchos($textoBuscador)
    {

        header("Content-Type: application/json', 'HTTP/1.1 200 OK");
        $array = array();
        $array["bares"] = array();
        $baresbd = Conexion::getBaresFiltradosNombreDescripcion($textoBuscador);

        foreach ($baresbd as $bar) {

            $aux = array();
            $aux["idRestaurante"] = $bar["idRestaurante"];
            $aux["nombre"] = $bar["nombre"];
            $aux["descripcion"] = $bar["descripcion"];
            $aux["localizacion"] = $bar["localizacion"];
            $aux["nota"] = $bar["Puntuacion"];
            array_push($array["bares"], $aux);           
            
        }

        $array["pinchos"] = array();        
        $pinchosbd = Conexion::getPinchosFiltradosNombreDescripcionTextoResena($textoBuscador, 0, 100, 0, 10);

        foreach($pinchosbd as $pincho){
            $aux = array();
            $aux["idPincho"] = $pincho["idPincho"];
            $aux["nombre"] = $pincho["nombre"];
            $aux["precio"] = $pincho["precio"];
            $aux["fkBar"] = $pincho["fkBar"];
            $aux["nombreBar"] = $pincho["nombreBar"];
            $aux["descripcion"] = $pincho["descripcion"];
            $aux["nota"] = $pincho["notaPincho"];
            $aux["imagen1"] = $pincho["imagen1"];
            $aux["imagen2"] = $pincho["imagen2"];
            $aux["imagen3"] = $pincho["imagen3"];

            array_push($array["pinchos"], $aux);
        }
        echo json_encode($array);
    }

}
