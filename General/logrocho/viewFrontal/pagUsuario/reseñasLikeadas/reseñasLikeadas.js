window.onload = function() {
    Console.error = () =>{};
    comprobarUsuarioLogueado();
    pintarResenas();
};

function pintarResenas() {
  var settings = {
    "url": "api/resenasLikeadasUsuario",
    "method": "GET",
    "timeout": 0,
    "headers": {
    },
  };
  
  $.ajax(settings).done(function (response) {
    var json = response;
    var resultados=eval(json);

    document.getElementById("reseñas").innerHTML = "";

    resultados["resenas"].forEach(resena => {
      
                        var textoLike = "<i onclick=\"toogleLike(this, "+resena["idReseña"]+")\" class=\"fa fa-heart btnLike\"></i>"
                        
                        document.getElementById("reseñas").innerHTML += ""+ //Pinto la reseña
                                "<div class=\"reseña\">"+
                                    "<div class=\"zonaPerfil\">"+
                                        "<div class=\"imagenPerfil\">"+
                                            "<div class=\"imgPerfil\" id=\"imgPerfil"+resena["idReseña"]+"\"></div>"+
                                        "</div>"+
                                        "<div class=\"nombreUsuario\">"+
                                            "<pp class=\"user\">"+resena["nombreUsuario"]+"</pp>"+
                                        "</div>"+
                                        "<div class=\"puntuacion\">"+
                                            "<pp class=\"puntuacionReseña\">"+getEstrellasPuntuacion(resena["nota"])+"</pp>"+
                                        "</div>"+
                                    "</div>"+               
                                    "<div class=\"zonaReseña\">"+
                                        "<div class=\"cabeceraReseña\">"+
                                            "<div class=\"nombrePincho\">"+
                                                "<pp>"+resena["nombrePincho"]+"</pp>"+
                                            "</div>"+
                                            "<div class=\"nombreBar\">"+
                                                "<pp>"+resena["nombreBar"]+"</pp>"+
                                            "</div>"+
                                            "<div class=\"like\">"+                                            
                                                textoLike+
                                            "</div>"+
                                        "</div>"+
                                        "<div class=\"textoReseña\">"+
                                            "<pp class=\"textoReseña\">"+resena["textoReseña"]+"</pp>"+
                                        "</div>"+
                                    "</div>"+
                                "</div>";
      
                                imagenUsuario = resena["imagenUsuario"];

                                if (imagenUsuario != null) {
                                    document.getElementById("imgPerfil"+resena["idReseña"]).style.backgroundImage = "url("+imagenUsuario+")";
                                }else{
                                    document.getElementById("imgPerfil"+resena["idReseña"]).style.backgroundImage = "url(../../../logrocho/RecursosGenerales/restauranteDefault.png)";
                                }
    });
  });
}

function comprobarUsuarioLogueado(){
    var settings = {
        "url": "api/getUsuarioLogueado",
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
      "url": "api/logout",
      "method": "GET",
      "timeout": 0,
      "headers": {
      },
    };
    
    $.ajax(settings).done(function (response) {
      window.location.href = "home";
    });
  }


function toogleLike(like, idResena) {
  
      like.classList.toggle("fa-heart-o");
      if (like.classList.contains("fa-heart-o")) {

          var settings = {
              "url": "api/eliminarLike",
              "method": "POST",
              "timeout": 0,
              "headers": {
                "Content-Type": "application/x-www-form-urlencoded"
              },
              "data": {
                "fk_resena": ""+idResena
              }
            };
            
            $.ajax(settings).done(function (response) {
              console.log("se ha eliminado el like de la reseña");
            });

      }else{

          var settings = {
              "url": "api/darLike",
              "method": "POST",
              "timeout": 0,
              "headers": {
                "Content-Type": "application/x-www-form-urlencoded"
              },
              "data": {
                "fk_resena": ""+idResena
              }
            };
            
            $.ajax(settings).done(function (response) {
              console.log("se ha dado like a la reseña");
            });            
      }
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