var imagenesPincho = ["../../../logrocho/imagenes/restaurantes/1/imagen1/tabernaTioBlas1.jfif", "../../../logrocho/imagenes/restaurantes/1/imagen2/tabernaTioBlas2.png", "../../../logrocho/imagenes/restaurantes/1/imagen3/tabernaTioBlas3.jfif"];
var idPincho;
var imagenMostrada = 0;
var usuario = "";

window.onload = function() {
    Console.error = () =>{};
    comprobarUsuarioLogueado();
    pintarDatos();
};

function pintarDatos() {
    var queryString = window.location.search;
    var urlParams = new URLSearchParams(queryString);
    idPincho = urlParams.get('id');

    var settings = {
        "url": "api/pinchosImagenesResenas/"+idPincho,
        "method": "GET",
        "timeout": 0,
        "headers": {
        },
      };
      
      $.ajax(settings).done(function (response) {
        var json = response;
        var resultados=eval(json);

        document.getElementById("spanNombrePincho").innerHTML = resultados["pinchos"][0]["nombre"];
        document.getElementById("spanPrecio").innerHTML = resultados["pinchos"][0]["precio"]+"€";
        document.getElementById("spanPuntuacion").innerHTML = getEstrellasPuntuacion(resultados["pinchos"][0]["nota"]);
        document.getElementById("descripcionPincho").innerHTML = resultados["pinchos"][0]["descripcion"];

        var settings2 = {
            "url": "api/restaurante/"+resultados["pinchos"][0]["fkBar"],
            "method": "GET",
            "timeout": 0,
            "headers": {
            },
        };
          
        $.ajax(settings2).done(function (response2) {
            var json2 = response2;
            var resultados2=eval(json2);

            document.getElementById("barPincho").innerHTML = resultados2["bar"][0]["nombre"];
        });

        
        if (resultados["pinchos"][0]["imagen1"] == null) {
            imagenesPincho[0] = "../../../logrocho/RecursosGenerales/restauranteDefault.png";
        }else{
            imagenesPincho[0] = resultados["pinchos"][0]["imagen1"];
        }

        if (resultados["pinchos"][0]["imagen2"] == null) {
            imagenesPincho[1] = "../../../logrocho/RecursosGenerales/restauranteDefault.png";
        }else{
            imagenesPincho[1] = resultados["pinchos"][0]["imagen2"];
        }

        if (resultados["pinchos"][0]["imagen3"] == null) {
            imagenesPincho[2] = "../../../logrocho/RecursosGenerales/restauranteDefault.png";
        }else{
            imagenesPincho[2] = resultados["pinchos"][0]["imagen3"];
        }      

        mostrarImagen();
        pintarResenas(resultados["pinchos"][0]["resenas"]);
      });
}

function pintarResenas(resenas) {
    document.getElementById("resenas").innerHTML = "";

    resenas.forEach(resena => {

        var nombreUsuario = "";
        var estrellasPuntuacion = getEstrellasPuntuacion(resena["nota"]);
        var nombrePincho = "";
        var nombreBar = getNombreBar(resena["fkPincho"]);

        var settings = {
            "url": "api/usuario/"+resena["fkUsuario"], //Obtengo el nombre de usuario
            "method": "GET",
            "timeout": 0,
            "headers": {
            },
          };
          
          $.ajax(settings).done(function (response) {
            var json = response;
            var resultados=eval(json);
    
            nombreUsuario = resultados["usuarios"][0]["user"];

            var settings = {
                "url": "api/pincho/"+resena["fkPincho"], //Obtengo el nombre del pincho
                "method": "GET",
                "timeout": 0,
                "headers": {
                },
              };
              
              $.ajax(settings).done(function (response2) {
                var json2 = response2;
                var resultados2=eval(json2);
        
                nombrePincho = resultados2["pinchos"][0]["nombre"];

                var settings = {
                    "url": "api/pincho/"+resena["fkPincho"], //Obtengo el nombre del bar
                    "method": "GET",
                    "timeout": 0,
                    "headers": {
                    },
                  };
                  
                  $.ajax(settings).done(function (response3) {
                    var json3 = response3;
                    var resultados3=eval(json3);
            
                    var idBar = resultados3["pinchos"][0]["fkBar"];
            
                    var settings = {
                        "url": "api/restaurante/"+idBar,
                        "method": "GET",
                        "timeout": 0,
                        "headers": {
                        },
                      };
                      
                      $.ajax(settings).done(function (response2) {
                        var json2 = response2;
                        var resultados2 =eval(json2);
            
                        nombreBar = resultados2["bar"][0]["nombre"];

                        var textoLike = "";
                        if (resena["likes"] > 0) {
                            textoLike = "<i onclick=\"toogleLike(this, "+resena["idReseña"]+")\" class=\"fa fa-heart btnLike\"></i>"
                        }else{
                            textoLike = "<i onclick=\"toogleLike(this, "+resena["idReseña"]+")\" class=\"fa fa-heart btnLike fa-heart-o\"></i>"
                        }

                        document.getElementById("resenas").innerHTML += ""+ //Pinto la reseña
                                "<div class=\"reseña\">"+
                                    "<div class=\"zonaPerfil\">"+
                                        "<div class=\"imagenPerfil\">"+
                                            "<div class=\"imgPerfil\" id=\"imgPerfil"+resena["idReseña"]+"\"></div>"+
                                        "</div>"+
                                        "<div class=\"nombreUsuario\">"+
                                            "<pp class=\"user\">"+nombreUsuario+"</pp>"+
                                        "</div>"+
                                        "<div class=\"puntuacion\">"+
                                            "<pp class=\"puntuacionReseña\">"+estrellasPuntuacion+"</pp>"+
                                        "</div>"+
                                    "</div>"+               
                                    "<div class=\"zonaReseña\">"+
                                        "<div class=\"cabeceraReseña\">"+
                                            "<div class=\"nombrePincho\">"+
                                                "<pp>"+nombrePincho+"</pp>"+
                                            "</div>"+
                                            "<div class=\"nombreBar\">"+
                                                "<pp>"+nombreBar+"</pp>"+
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

                        
        
                        var imagenUsuario = "";
                        var settings = {
                            "url": "api/getImagenUsuario/"+resena["fkUsuario"],
                            "method": "GET",
                            "timeout": 0,
                            "headers": {
                            },
                        };
                                  
                        $.ajax(settings).done(function (response) {
                            var json = response;
                            var resultados=eval(json);
                            
                            imagenUsuario = resultados["imagenes"][0]["imagen"];

                            if (imagenUsuario != null) {
                                document.getElementById("imgPerfil"+resena["idReseña"]).style.backgroundImage = "url("+imagenUsuario+")";
                            }else{
                                document.getElementById("imgPerfil"+resena["idReseña"]).style.backgroundImage = "url(../../../logrocho/RecursosGenerales/restauranteDefault.png)";
                            }
                        });
                    });
                });
            });
        });


        
          
    });
}

function getImagenUsuario(fkUsuario){
    var settings = {
        "url": "api/getImagenUsuario/"+fkUsuario,
        "method": "GET",
        "timeout": 0,
        "headers": {
        },
      };
      
      $.ajax(settings).done(function (response) {
        var json = response;
        var resultados=eval(json);

        return resultados["imagenes"][0]["imagen"];
      });
}

function getNombreBar(fkPincho) {
    var settings = {
        "url": "api/pincho/"+fkPincho,
        "method": "GET",
        "timeout": 0,
        "headers": {
        },
      };
      
      $.ajax(settings).done(function (response) {
        var json = response;
        var resultados=eval(json);

        var idBar = resultados["pinchos"][0]["fkBar"];

        var settings = {
            "url": "api/restaurante/"+idBar,
            "method": "GET",
            "timeout": 0,
            "headers": {
            },
          };
          
          $.ajax(settings).done(function (response2) {
            var json2 = response2;
            var resultados2 =eval(json2);

            return resultados2["bar"][0]["nombre"];
          });
    });
}

function getNombrePincho(fkPincho) {
    var settings = {
        "url": "api/pincho/"+fkPincho,
        "method": "GET",
        "timeout": 0,
        "headers": {
        },
      };
      
      $.ajax(settings).done(function (response) {
        var json = response;
        var resultados=eval(json);

        return resultados["pinchos"][0]["nombre"];
    });
}

function getNombreUsuario(fkUsuario) {
    
    var settings = {
        "url": "api/usuario/"+fkUsuario,
        "method": "GET",
        "timeout": 0,
        "headers": {
        },
      };
      
      $.ajax(settings).done(function (response) {
        var json = response;
        var resultados=eval(json);

        return resultados["usuarios"][0]["user"];
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
    document.getElementById("slider").style.backgroundImage = "url("+imagenesPincho[imagenMostrada]+")";
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
            usuario = resultados;
            document.getElementById("contenedorBtnLogin").innerHTML = "<a id=\"btnLogin\" href=\"infoPersonal\">👤 "+resultados["user"]+"</a>";
            document.getElementById("contenedorBtnLogin").innerHTML += "<a onclick=\"logout()\"  id=\"btnLogout\">Logout</a>";
        }
        usuario = resultados;
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

function publicarResena() {
    var textoReseña = document.getElementById("inputDescripcionReseña").value;

    if (usuario != false) {
        if (/\'/.test(textoReseña)) {
            document.getElementById("inputDescripcionReseña").style.boxShadow = "0px 0px 10px red";
            document.getElementById("inputDescripcionReseña").style.border = "2px solid red";
        }else{
            var nota = document.getElementById("inputPuntuacionResena").value;
            var textoResena = document.getElementById("inputDescripcionReseña").value;
            var settings = {
                "url": "api/nuevaResena",
                "method": "POST",
                "timeout": 0,
                "headers": {
                  "Content-Type": "application/x-www-form-urlencoded",
                },
                "data": {
                  "fkUsuario": ""+usuario["idUsuario"],
                  "fkPincho": ""+idPincho,
                  "nota": ""+nota,
                  "textoResena": ""+textoResena
                }
              };
              
              $.ajax(settings).done(function (response) {
                document.getElementById("inputPuntuacionResena").value = 0;
                document.getElementById("inputDescripcionReseña").value = "";
                document.getElementById("inputDescripcionReseña").style.boxShadow = "0px 0px 0px black";
                document.getElementById("inputDescripcionReseña").style.border = "1px solid black";
                pintarDatos();
              });
        }
    }else{
        this.window.href = window.location.href = "frontLoginRegister";
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

/*LIKE*/
function toogleLike(like, idResena) {
    if (usuario != false) {
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
    }else{
        this.window.href = window.location.href = "frontLoginRegister";
    }
    
}