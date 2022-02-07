var datosOriginales;
var idUsuario;

window.onload = function() {
    establecerIdUsuario();
    mostrarDatos();
    pintarTablaReseñas();
    pintarImagen();
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

function guardarImagen() {
  var formData = new FormData();
      formData.append('imagen', document.getElementById("imagenUsuario").files[0]);
      formData.append('usuario', idUsuario);
      $.ajax({
          url: 'http://localhost/logrocho/index.php/api/guardarImagenUsuario',
          type: 'post',
          data: formData,
          contentType: false,
          processData: false,
          success: function (response) {
            console.log(response);
            pintarImagen();
          }
      });
}

function pintarImagen(){
  var settings = {
    "url": "http://localhost/logrocho/index.php/api/getImagenUsuario/"+idUsuario,
    "method": "GET",
    "timeout": 0,
    "headers": {
    },
  };
  
  $.ajax(settings).done(function (response) {
    var json = response;
    resultados=eval(json);
    if (resultados["imagenes"][0] == undefined) {
      document.getElementById("imagenUsuario").style.display="block";
      document.getElementById("btnGuardarImagen").style.display="block";
      document.getElementById("btnEliminarImagen").style.display="none";
      document.getElementById("imgPerfilUsuario").style.backgroundImage = "url()";
    }else{
      document.getElementById("imgPerfilUsuario").style.backgroundImage = "url("+resultados["imagenes"][0]["imagen"]+")";
      document.getElementById("imagenUsuario").style.display="none";
      document.getElementById("btnGuardarImagen").style.display="none";
      document.getElementById("btnEliminarImagen").style.display="block";
    }
    
  });
  
}

function eliminarImagen(){
  var settings = {
    "url": "http://localhost/logrocho/index.php/api/deleteImagenUsuario/1",
    "method": "DELETE",
    "timeout": 0,
    "headers": {
    },
  };
  
  $.ajax(settings).done(function (response) {
    pintarImagen();
  });
}