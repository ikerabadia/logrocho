var datosOriginales;
var idUsuario;

window.onload = function() {
    establecerIdUsuario();
    mostrarDatos();
    pintarTablaReseñas();
};

function establecerIdUsuario() {
    var queryString = window.location.search;
    var urlParams = new URLSearchParams(queryString);
    idUsuario = urlParams.get('id');
}

function mostrarDatos(){

    var settings = {
        "url": "http://localhost/logrocho/index.php/api/usuario/"+idUsuario,
        "method": "GET",
        "timeout": 0,
      };
      
      $.ajax(settings).done(function (response) {
        var json = response;
        resultados=eval(json);
        datosOriginales = resultados;

        document.getElementById("spanUser").innerHTML = resultados["usuarios"][0]["user"];
        document.getElementById("spanCorreo").innerHTML = resultados["usuarios"][0]["correoElectronico"];
        document.getElementById("nombreCompleto").innerHTML = resultados["usuarios"][0]["nombre"]+" "+resultados["usuarios"][0]["apellido1"]+" "+resultados["usuarios"][0]["apellido2"];
        document.getElementById("idUsuario").innerHTML = resultados["usuarios"][0]["idUsuario"];
        
        
      });
}



function eliminarUsuario() {

    var settings = {
      "url": "http://localhost/logrocho/index.php/api/deleteUsuario/"+idUsuario,
      "method": "DELETE",
      "timeout": 0,
      "headers": {
      },
    };
    
    $.ajax(settings).done(function (response) {
      //console.log(response);
      window.location.href = "usuarios";
    });
  
}

function limpiarLikesUsuario() {

    var settings = {
      "url": "http://localhost/logrocho/index.php/api/limpiarLikesUsuario/"+idUsuario,
      "method": "DELETE",
      "timeout": 0,
      "headers": {
      },
    };
    
    $.ajax(settings).done(function (response) {
      console.log(response);
    });
}

function pintarTablaReseñas() {
  
      var settings = {
        "url": "http://localhost/logrocho/index.php/api/resenasByUsuario/"+idUsuario,
        "method": "GET",
        "timeout": 0,
        "headers": {
        },
      };
      
      $.ajax(settings).done(function (response) {
          var json = response;
          resultados=eval(json);
          datos = resultados;

          var tabla = document.getElementById("tablaReseñas");
          var filas = "<tr><th>ID</th><th>Nombre Usuario</th><th>Nota</th><th>Pincho</th><th>Reseña</th></tr>";
          
          for (let i = 0; i < resultados["reseñas"].length; i++) {
              filas+= "<tr><td>"+datos["reseñas"][i]["idReseña"]+"</td><td>"+datos["reseñas"][i]["fkUsuario"]+"</td><td>"+datos["reseñas"][i]["nota"]+"</td><td>"+datos["reseñas"][i]["fkPincho"]+"</td><td class=\"columnaReseña\"><textarea id=\"textoReseña"+datos["reseñas"][i]["idReseña"]+"\" class=\"textoReseña\" onblur=\"guardarTextoReseña("+datos["reseñas"][i]["idReseña"]+","+datos["reseñas"][i]["fkUsuario"]+","+datos["reseñas"][i]["fkPincho"]+","+datos["reseñas"][i]["nota"]+")\">"+datos["reseñas"][i]["textoReseña"]+"</textarea></td></tr>";
          }
          tabla.innerHTML = filas;
          if (resultados["reseñas"].length == 0) {
            document.getElementById("contenedorTablaReseñas").innerHTML += "Este usuario no ha publicado ninguna reseña";
          }
      });
}

function guardarTextoReseña(idReseña, fkUsuario, fkPincho, nota) {
  var textoReseña = document.getElementById("textoReseña"+idReseña).value;
  var settings = {
    "url": "http://localhost/logrocho/index.php/api/updateResena/"+idReseña,
    "method": "POST",
    "timeout": 0,
    "headers": {
      "Content-Type": "application/x-www-form-urlencoded"
    },
    "data": {
      "fkUsuario": ""+fkUsuario,
      "fkPincho": ""+fkPincho,
      "nota": ""+nota,
      "textoResena": ""+textoReseña
    }
  };
  
  $.ajax(settings).done(function (response) {
    console.log(response);
  });
}