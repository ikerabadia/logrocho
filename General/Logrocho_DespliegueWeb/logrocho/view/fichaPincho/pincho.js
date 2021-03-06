var datosOriginales;
var idPincho;

window.onload = function() {
    console.error = () =>{};
    establecerIdPincho();  
    mostrarDatos();    
    pintarTablaResenas();
    pintarImagenes();
};

function establecerIdPincho() {
    var queryString = window.location.search;
    var urlParams = new URLSearchParams(queryString);
    idPincho = urlParams.get('id');
}

function mostrarDatos(){
    

    var settings = {
        "url": "api/pincho/"+idPincho,
        "method": "GET",
        "timeout": 0,
      };
      
      $.ajax(settings).done(function (response) {
        var json = response;
        resultados=eval(json);
        datosOriginales = resultados;

        document.getElementById("idPincho").innerHTML= "ID: "+resultados["pinchos"][0]["idPincho"];
        document.getElementById("inputNombrePincho").value = resultados["pinchos"][0]["nombre"];
        document.getElementById("inputPrecioPincho").value = resultados["pinchos"][0]["precio"];
        document.getElementById("inputBar").value = resultados["pinchos"][0]["fkBar"];
        document.getElementById("inputDescripcion").value = resultados["pinchos"][0]["descripcion"];
        
        
        
      });
}

function pintarTablaResenas() {
  
  var settings = {
    "url": "api/resenasByPincho/"+idPincho,
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
      var filas = "Este pincho no tiene resenas asociadas";
      for (let i = 0; i < resultados["resenas"].length; i++) {
          if (i == 0) {
            filas = "<small class=\"smallInfo\">Los textos de las resenas se actualizarán cuando el texto pierda el foco, no al guardar los datos del pincho</small>";
          }
          filas+= "<div class=\"resena card\">"+
          "<div class=\"textosResena\">"+
              "<div class=\"cabeceraResena\">"+
                  "<a class=\"h3 usuarioResena\">"+datos["resenas"][i]["fkUsuario"]+"</a>"+
                  "<h3>46/100</h3>"+
              "</div>"+
              "<div class=\"descripcionResena\">"+
                  "<textarea id=\"textoResena1\" class=\"textoResena\" onblur=\"guardarTextoResena("+datos["resenas"][i]["idResena"]+","+datos["resenas"][i]["fkUsuario"]+","+datos["resenas"][i]["fkPincho"]+","+datos["resenas"][i]["nota"]+")\">"+datos["resenas"][i]["textoResena"]+"</textarea>"+
              "</div>"+
              "<a class=\"btnEliminarComentario btn btn-outline-danger\" onclick=\"eliminarResena("+datos["resenas"][i]["idResena"]+")\">🗑</a>"+
          "</div>"+
      "</div>"
      }
      tabla.innerHTML = filas;
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

function descartarCambios() {
    document.getElementById("idPincho").innerHtml = "ID: "+datosOriginales["pinchos"][0]["idPincho"];
        document.getElementById("inputNombrePincho").valueL = datosOriginales["pinchos"][0]["nombre"];
        document.getElementById("inputPrecioPincho").value = datosOriginales["pinchos"][0]["precio"];
        document.getElementById("inputBar").value = datosOriginales["pinchos"][0]["fkBar"];
        document.getElementById("inputDescripcion").value = datosOriginales["pinchos"][0]["descripcion"];
}

function guardarCambios() {
    var queryString = window.location.search;
    var urlParams = new URLSearchParams(queryString);
    var idPincho = urlParams.get('id');

    var nombre = document.getElementById("inputNombrePincho").value;
    var descripcion = document.getElementById("inputDescripcion").value;
    var precio = document.getElementById("inputPrecioPincho").value;
    var bar = document.getElementById("inputBar").value;

    var settings = {
        "url": "api/updatePincho/"+idPincho,
        "method": "POST",
        "timeout": 0,
        "headers": {
          "Content-Type": "application/x-www-form-urlencoded"
        },
        "data": {
          "nombre": ""+nombre+"",
          "descripcion": ""+descripcion+"",
          "precio": ""+precio+"",
          "fkBar": ""+bar+""
        }
      };
      
      $.ajax(settings).done(function (response) {
        console.log(response);
      });
}

function eliminarPincho() {
  var settings = {
    "url": "api/deletePincho/"+datosOriginales["pinchos"][0]["idPincho"],
    "method": "DELETE",
    "timeout": 0,
  };
  
  $.ajax(settings).done(function (response) {
    //console.log(response);
    window.location.href = "pinchos";
  });
}

function pintarImagenes() {
  pintarImagen(1);
  pintarImagen(2);
  pintarImagen(3);
}

function pintarImagen(numeroImagen) {
  var settings = {
    "url": "api/getImagenPincho",
    "method": "POST",
    "timeout": 0,
    "headers": {
      "Content-Type": "application/x-www-form-urlencoded",
    },
    "data": {
      "idPincho": ""+idPincho,
      "numeroImagen": ""+numeroImagen
    }
  };
  
  $.ajax(settings).done(function (response) {
    var json = response;
    resultados=eval(json);
    if (resultados["imagenes"][0] == undefined) {
      document.getElementById("miniatura"+numeroImagen).style.backgroundImage = "url()";
      document.getElementById("miniatura"+numeroImagen).innerHTML = "<input type=\"file\" id=\"inputImagen"+numeroImagen+"\">";
      document.getElementById("btnEliminarImagen"+numeroImagen).style.display = "none";
      document.getElementById("btnGuardarImagen"+numeroImagen).style.display = "flex";
    }else{
      document.getElementById("miniatura"+numeroImagen).style.backgroundImage = "url("+resultados["imagenes"][0]["imagen"]+")";
      document.getElementById("miniatura"+numeroImagen).innerHTML = "";
      document.getElementById("btnEliminarImagen"+numeroImagen).style.display = "flex";
      document.getElementById("btnGuardarImagen"+numeroImagen).style.display = "none";
    }
  });
}

function guardarImagen(numeroImagen) {
  var formData = new FormData();
      formData.append('fk_pincho', idPincho);
      formData.append('numeroImagen', numeroImagen);
      var idInput = "inputImagen"+numeroImagen;
      var input = document.getElementById(idInput);
      formData.append('imagen', input.files[0]);
      $.ajax({
          url: 'api/guardarImagenPincho',
          type: 'post',
          data: formData,
          contentType: false,
          processData: false,
          success: function (response) {
            //console.log(response);
            pintarImagenes();
          }
      });
}

function eliminarImagen(numeroImagen){
  var settings = {
    "url": "api/deleteImagenPincho",
    "method": "POST",
    "timeout": 0,
    "headers": {
      "Content-Type": "application/x-www-form-urlencoded",
    },
    "data": {
      "fk_pincho": ""+idPincho,
      "numeroImagen": ""+numeroImagen
    }
  };
  
  $.ajax(settings).done(function (response) {
    pintarImagenes();
  });
}

function mostrarImagen(numeroImagen){
  document.getElementById("imagenGrande").style.backgroundImage = document.getElementById("miniatura"+numeroImagen).style.backgroundImage;
}