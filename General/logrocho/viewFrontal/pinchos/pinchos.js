window.onload = function() {
    comprobarUsuarioLogueado();
    mostrarDatos();
};

function mostrarDatos(){
    var textoBuscador = document.getElementById("buscadorInput").value;
    var notaMinima = document.getElementById("inputNotaMinima").value;
    var notaMaxima = document.getElementById("inputNotaMaxima").value;
    var precioMinimo = document.getElementById("inputPrecioMinimo").value;
    var precioMaximo = document.getElementById("inputPrecioMaximo").value;

    var settings = {
        "url": "http://localhost/logrocho/index.php/api/getPinchosFiltrados",
        "method": "POST",
        "timeout": 0,
        "headers": {
          "Content-Type": "application/x-www-form-urlencoded"
        },
        "data": {
          "textoBuscador": ""+textoBuscador,
          "notaMinima": ""+notaMinima,
          "notaMaxima": ""+notaMaxima,
          "precioMinimo": ""+precioMinimo,
          "precioMaximo": ""+precioMaximo
        }
      };
      
      $.ajax(settings).done(function (response) {
        var json = response;
        var resultados=eval(json);
        
        document.getElementById("contenedorPinchos").innerHTML = "";
        var pincho;
        //Asigno los datos
        for (let i = 0; i < resultados["pinchos"].length; i++) {
            bar = resultados["pinchos"][i];
            document.getElementById("contenedorPinchos").innerHTML += ""+
            "<a href=\"frontPincho?id="+bar["idPincho"]+"\">"+
                "<div class=\"pincho\" id=\"pincho"+bar["idPincho"]+"\">"+
                    "<div class=\"datosPincho\">"+
                        "<div class=\"nombrePincho\">"+bar["nombre"]+"</div>"+
                        "<div class=\"puntuacionPrecio\">"+
                            "<div class=\"puntuacionPincho\">"+getEstrellasPuntuacion(bar["nota"])+"</div>"+
                            "<div class=\"precioPincho\">"+bar["precio"]+"€</div>"+
                        "</div>"+                            
                    "</div>"+                   
                "</div>"+
            "</a>";
        }

        for (let i = 0; i < resultados["pinchos"].length; i++) {
            bar = resultados["pinchos"][i];

            if (bar["imagen1"] != undefined) {
                document.getElementById("pincho"+bar["idPincho"]).style.backgroundImage = "url("+bar["imagen1"]+")";
            } 
            
            
        }

      });
}

function comprobarUsuarioLogueado(){
    var settings = {
        "url": "http://localhost/logrocho/index.php/api/getUsuarioLogueado",
        "method": "GET",
        "timeout": 0,
        "headers": {
        },
      };
      
      $.ajax(settings).done(function (response) {
        var json = response;
        var resultados=eval(json);
  
        if (resultados == false) {
            document.getElementById("contenedorBtnLogin").innerHTML = "<a id=\"btnLogin\" href=\"frontLoginRegister\">👤 Login/Register</a>";
            
        }else{
            document.getElementById("contenedorBtnLogin").innerHTML = "<a id=\"btnLogin\" href=\"infoPersonal\">👤 "+resultados["user"]+"</a>";
            document.getElementById("contenedorBtnLogin").innerHTML += "<a onclick=\"logout()\"  id=\"btnLogout\">Logout</a>";
        }
      });
  }
  
  function logout() {
    var settings = {
      "url": "http://localhost/logrocho/index.php/api/logout",
      "method": "GET",
      "timeout": 0,
      "headers": {
      },
    };
    
    $.ajax(settings).done(function (response) {
      window.location.href = "home";
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