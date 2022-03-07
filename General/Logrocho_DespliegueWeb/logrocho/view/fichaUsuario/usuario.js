var datosOriginales;
var idUsuario;

window.onload = function() {
    console.error = () =>{};
    establecerIdUsuario();
    mostrarDatos();
    pintarTablaResenas();
    pintarImagen();
};

function establecerIdUsuario() {
    var queryString = window.location.search;
    var urlParams = new URLSearchParams(queryString);
    idUsuario = urlParams.get('id');
}

function mostrarDatos(){

    var settings = {
        "url": "api/usuario/"+idUsuario,
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
      "url": "api/deleteUsuario/"+idUsuario,
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
      "url": "api/limpiarLikesUsuario/"+idUsuario,
      "method": "DELETE",
      "timeout": 0,
      "headers": {
      },
    };
    
    $.ajax(settings).done(function (response) {
      console.log(response);
    });
}

function pintarTablaResenas() {
  
      var settings = {
        "url": "api/resenasByUsuario/"+idUsuario,
        "method": "GET",
        "timeout": 0,
        "headers": {
        },
      };
      
      $.ajax(settings).done(function (response) {
          var json = response;
          resultados=eval(json);
          datos = resultados;

          var tabla = document.getElementById("tablaResenas");
          var filas = "<tr><th>ID</th><th>Nombre Usuario</th><th>Nota</th><th>Pincho</th><th>Resena</th></tr>";
          
          for (let i = 0; i < resultados["resenas"].length; i++) {
              filas+= "<tr><td>"+datos["resenas"][i]["idResena"]+"</td><td>"+datos["resenas"][i]["fkUsuario"]+"</td><td>"+datos["resenas"][i]["nota"]+"</td><td>"+datos["resenas"][i]["fkPincho"]+"</td><td class=\"columnaResena\"><textarea id=\"textoResena"+datos["resenas"][i]["idResena"]+"\" class=\"textoResena\" onblur=\"guardarTextoResena("+datos["resenas"][i]["idResena"]+","+datos["resenas"][i]["fkUsuario"]+","+datos["resenas"][i]["fkPincho"]+","+datos["resenas"][i]["nota"]+")\">"+datos["resenas"][i]["textoResena"]+"</textarea></td></tr>";
          }
          tabla.innerHTML = filas;
          if (resultados["resenas"].length == 0) {
            document.getElementById("contenedorTablaResenas").innerHTML += "Este usuario no ha publicado ninguna resena";
          }
      });
}

function guardarTextoResena(idResena, fkUsuario, fkPincho, nota) {
  var textoResena = document.getElementById("textoResena"+idResena).value;
  var settings = {
    "url": "api/updateResena/"+idResena,
    "method": "POST",
    "timeout": 0,
    "headers": {
      "Content-Type": "application/x-www-form-urlencoded"
    },
    "data": {
      "fkUsuario": ""+fkUsuario,
      "fkPincho": ""+fkPincho,
      "nota": ""+nota,
      "textoResena": ""+textoResena
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
          url: 'api/guardarImagenUsuario',
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
    "url": "api/getImagenUsuario/"+idUsuario,
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
    "url": "api/deleteImagenUsuario/"+idUsuario,
    "method": "DELETE",
    "timeout": 0,
    "headers": {
    },
  };
  
  $.ajax(settings).done(function (response) {
    pintarImagen();
  });
}