

var imagenesBar = ["../../../logrocho/imagenes/restaurantes/1/imagen1/tabernaTioBlas1.jfif", "../../../logrocho/imagenes/restaurantes/1/imagen2/tabernaTioBlas2.png", "../../../logrocho/imagenes/restaurantes/1/imagen3/tabernaTioBlas3.jfif"];
var idBar;
var imagenMostrada = 0;


window.onload = function() {
    pintarDatos();
};

function pintarDatos() {
    var queryString = window.location.search;
    var urlParams = new URLSearchParams(queryString);
    idBar = urlParams.get('id');

    var settings = {
        "url": "http://localhost/logrocho/index.php/api/restaurantesConPinchos/"+idBar,
        "method": "GET",
        "timeout": 0,
        "headers": {
        },
      };
      
      $.ajax(settings).done(function (response) {
        var json = response;
        var resultados=eval(json);

        document.getElementById("spanTitulo").innerHTML = resultados["bares"][0]["nombre"];
        document.getElementById("spanPuntuacion").innerHTML = getEstrellasPuntuacion(resultados["bares"][0]["nota"]);
        document.getElementById("descripcionBar").innerHTML = resultados["bares"][0]["descripcion"];
        document.getElementById("localizacionBar").innerHTML = resultados["bares"][0]["localizacion"];

        if (resultados["bares"][0]["imagen1"] == null) {
            imagenesBar[0] = "../../../logrocho/RecursosGenerales/restauranteDefault.png";
        }else{
            imagenesBar[0] = resultados["bares"][0]["imagen1"];
        }

        if (resultados["bares"][0]["imagen2"] == null) {
            imagenesBar[1] = "../../../logrocho/RecursosGenerales/restauranteDefault.png";
        }else{
            imagenesBar[1] = resultados["bares"][0]["imagen2"];
        }

        if (resultados["bares"][0]["imagen3"] == null) {
            imagenesBar[2] = "../../../logrocho/RecursosGenerales/restauranteDefault.png";
        }else{
            imagenesBar[2] = resultados["bares"][0]["imagen3"];
        }      

        mostrarImagen();
        pintarPinchos(resultados["bares"][0]["pinchos"]);
      });
}

function pintarPinchos(pinchos) {
    document.getElementById("contenedorPinchos").innerHTML = "";

    pinchos.forEach(pincho => {
        document.getElementById("contenedorPinchos").innerHTML += ""+
        "<a href=\"frontPincho?id="+pincho["idPincho"]+"\" >"+
            "<div class=\"pincho\" id=\"pincho"+pincho["idPincho"]+"\">"+
                "<div class=\"datosPincho\">"+
                    "<div class=\"nombrePincho\">"+pincho["nombre"]+"</div>"+
                    "<div class=\"puntuacionPincho\">"+getEstrellasPuntuacion(pincho["nota"])+"</div>"+
                "</div> "   +                
            "</div>"+
        "</a>";    
        if (pincho["imagen1"] != null) {
            document.getElementById("pincho"+pincho["idPincho"]).style.backgroundImage = "url("+pincho["imagen1"]+")";
        }else{
            document.getElementById("pincho"+pincho["idPincho"]).style.backgroundImage = "url(../../../logrocho/RecursosGenerales/restauranteDefault.png)";
        }
          
    });
}

function siguienteImagen() {
    imagenMostrada++;
    if (imagenMostrada == 3) {
        imagenMostrada = 0;
    }
    mostrarImagen();
}
function anteriorImagen() {
    imagenMostrada--;
    if (imagenMostrada == -1) {
        imagenMostrada = 2;
    }
    mostrarImagen();
}

function mostrarImagen() {    
    document.getElementById("imagenMostrada").style.backgroundImage = "url("+imagenesBar[imagenMostrada]+")";
}

function getEstrellasPuntuacion(puntuacion) {
    if (puntuacion<2 || puntuacion == null) {
        return "☆☆☆☆☆";
    }else if(puntuacion<4){
        return "★☆☆☆☆";
    }else if(puntuacion<6){
        return "★★☆☆☆";
    }else if(puntuacion<8){
        return "★★★☆☆";
    }else if(puntuacion<9.5){
        return "★★★★☆";
    }else if(puntuacion>=9.5){
        return "★★★★★";
    }
}