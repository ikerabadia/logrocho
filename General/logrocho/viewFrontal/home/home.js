var fotoMostrada = 1;
var imagenesPinchosPreferidos = ["pincho01", "pincho02", "pincho03", "pincho04", "pincho05"];
var movimientoAuto = true;
var sliderMostrado = "preferidos";

window.onload = function() {
    
    setInterval(() => {
        if (movimientoAuto) {
            moverFotoIzquierda();
        }        
    }, 5000);

};

function moverFotoIzquierda(){

    fotoMostrada++;
    if (fotoMostrada == 6) {
        fotoMostrada = 1;
    }

    if (sliderMostrado == "preferidos") {

        var img1 = document.getElementById("imagen1");
        var img2 = document.getElementById("imagen2");
        
        if (img1.classList.contains("mostrado")) {
            img1.classList.remove("mostrado");
            img1.classList.add("noMostrado");
            img2.classList.remove("noMostrado");
            img2.classList.add("mostrado");

            img2.style.backgroundImage = "url(\"../../../logrocho/viewFrontal/home/imgPinchosFav/"+imagenesPinchosPreferidos[fotoMostrada-1]+".jpg\")";

            img1.style.transition = "1s";
            img1.style.left = "-100%"
            img2.style.transition = "0s";
            img2.style.left = "100%"
            setTimeout(() => {
                img2.style.transition = "1s";
                img2.style.left = "0%";
            }, 50);
        }else{
            img2.classList.remove("mostrado");
            img2.classList.add("noMostrado");
            img1.classList.remove("noMostrado");
            img1.classList.add("mostrado")

            img1.style.backgroundImage = "url(\"../../../logrocho/viewFrontal/home/imgPinchosFav/"+imagenesPinchosPreferidos[fotoMostrada-1]+".jpg\")\")";

            img2.style.transition = "1s";
            img2.style.left = "-100%"
            img1.style.transition = "0s";
            img1.style.left = "100%"
            setTimeout(() => {
                img1.style.transition = "1s";
                img1.style.left = "0%";
            }, 50);        
        }
    }else{
        var imagen = document.getElementById("imagen2_1");

        imagen.style.opacity = 0;
        imagen.style.backgroundImage = "url(\"../../../logrocho/viewFrontal/home/imgPinchosMejorVal/"+imagenesPinchosPreferidos[fotoMostrada-1]+".jpg\")";
        imagen.style.opacity = 1;
    }
    
}
function moverFotoDerecha(){

    fotoMostrada--;
    if (fotoMostrada == 0) {
        fotoMostrada = 5;
    }

    if (sliderMostrado == "preferidos") {
        var img1 = document.getElementById("imagen1");
        var img2 = document.getElementById("imagen2");   
        
        if (img1.classList.contains("mostrado")) {
            img1.classList.remove("mostrado");
            img1.classList.add("noMostrado");
            img2.classList.remove("noMostrado");
            img2.classList.add("mostrado")

            img2.style.backgroundImage = "url(\"../../../logrocho/viewFrontal/home/imgPinchosFav/"+imagenesPinchosPreferidos[fotoMostrada-1]+".jpg\")";

            img1.style.transition = "1s";
            img1.style.left = "100%"
            img2.style.transition = "0s";
            img2.style.left = "-100%"
            setTimeout(() => {
                img2.style.transition = "1s";
                img2.style.left = "0%";
            }, 50);
        }else{
            img2.classList.remove("mostrado");
            img2.classList.add("noMostrado");
            img1.classList.remove("noMostrado");
            img1.classList.add("mostrado");

            img1.style.backgroundImage = "url(\"../../../logrocho/viewFrontal/home/imgPinchosFav/"+imagenesPinchosPreferidos[fotoMostrada-1]+".jpg\")";

            img2.style.transition = "1s";
            img2.style.left = "100%"
            img1.style.transition = "0s";
            img1.style.left = "-100%"
            setTimeout(() => {
                img1.style.transition = "1s";
                img1.style.left = "0%";
            }, 50);        
        }
    }else{
        var imagen = document.getElementById("imagen2_1");

        imagen.style.opacity = 0;
        imagen.style.backgroundImage = "url(\"../../../logrocho/viewFrontal/home/imgPinchosMejorVal/"+imagenesPinchosPreferidos[fotoMostrada-1]+".jpg\")";
        imagen.style.opacity = 1;
    }
    
    
}
function pararReanudarAnimacion() {
    var boton = document.getElementById("btnPararAnimacion");
    if (movimientoAuto == true) {
        movimientoAuto = false
        boton.innerHTML = "Reanudar animacion";
        boton.style.backgroundColor = "rgb(255, 204, 0)";
    }else{
        movimientoAuto = true;
        boton.innerHTML = "Parar animacion";
        boton.style.backgroundColor = "transparent";
    }
}

function mostrarMejorValorados() {
    var btnMejorValorados = document.getElementById("btnMejorValorados");
    var btnPreferidos = document.getElementById("btnPreferidos");

    /* btnMejorValorados.style.color = "black"; */
    btnMejorValorados.style.backgroundColor = "rgb(255, 204, 0)";
    /* btnPreferidos.style.color = "white"; */
    btnPreferidos.style.backgroundColor = "transparent"

    document.getElementById("imagenes").style.display = "none";
    document.getElementById("imagenes2").style.display = "block";

    sliderMostrado = "mejorValorados";
}

function mostrarPreferidos() {
    var btnMejorValorados = document.getElementById("btnMejorValorados");
    var btnPreferidos = document.getElementById("btnPreferidos");

    /* btnPreferidos.style.color = "black"; */
    btnPreferidos.style.backgroundColor = "rgb(255, 204, 0)";
    /* btnMejorValorados.style.color = "white"; */
    btnMejorValorados.style.backgroundColor = "transparent"

    document.getElementById("imagenes").style.display = "block";
    document.getElementById("imagenes2").style.display = "none";

    sliderMostrado = "preferidos";
}