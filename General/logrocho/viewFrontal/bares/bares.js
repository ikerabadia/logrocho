window.onload = function() {
    mostrarDatos();
};

function mostrarDatos() {
    var fTextoBuscador = document.getElementById("buscadorInput").value;
    var fNotaMinima = document.getElementById("inputNotaMinima").value;
    var fNotaMaxima = document.getElementById("inputNotaMaxima").value;
    var settings = {
        "url": "http://localhost/logrocho/index.php/api/restaurantesFiltrados",
        "method": "POST",
        "timeout": 0,
        "headers": {
          "Content-Type": "application/x-www-form-urlencoded"
        },
        "data": {
          "fTextoBuscador": ""+fTextoBuscador,
          "fNotaMinima": ""+fNotaMinima,
          "fNotaMaxima": ""+fNotaMaxima
        }
      };
      
      $.ajax(settings).done(function (response) {
        var json = response;
        var resultados=eval(json);

        document.getElementById("contenedorBares").innerHTML = "";
        var bar;
        //Asigno los datos
        for (let i = 0; i < resultados["bares"].length; i++) {
            bar = resultados["bares"][i];
            document.getElementById("contenedorBares").innerHTML += ""+
            "<a href=\"barFront?id="+bar["idRestaurante"]+"\">"+
                    "<div class=\"bar\" id=\"bar"+bar["idRestaurante"]+"\">"+
                        "<div class=\"datosBar\">"+
                            "<div class=\"nombrePuntuacionBar\">"+
                                "<div class=\"nombreBar\">"+bar["nombre"]+"</div>"+
                                "<div class=\"puntuacionBar\">"+getEstrellasPuntuacion(bar["nota"])+"</div>"+
                            "</div>"+
                            "<div class=\"localizacionBar\">"+bar["localizacion"]+"</div>"+
                        "</div> "+            
                    "</div>"+
                "</a>";
        }
        //Asigno las imagenes
         for (let i = 0; i < resultados["bares"].length; i++) {
            
            var settings = {
                "url": "http://localhost/logrocho/index.php/api/getImagenRestaurante",
                "method": "POST",
                "timeout": 0,
                "headers": {
                "Content-Type": "application/x-www-form-urlencoded"
                },
                "data": {
                "idBar": ""+resultados["bares"][i]["idRestaurante"],
                "numeroImagen": "1"
                }
            };
            
            $.ajax(settings).done(function (response) {
                var json2 = response;
                var resultados2=eval(json2);
                var idContenedor = "bar"+resultados["bares"][i]["idRestaurante"];
                var contenedor = document.getElementById(idContenedor);
                if (resultados2["imagenes"][0] != undefined) {
                    contenedor.style.backgroundImage = "url(\""+resultados2["imagenes"][0]["imagen"]+"\")";
                }                
            });            
        }
      });
      
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