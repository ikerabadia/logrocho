var datosOriginales;

window.onload = function() {
    mostrarDatos();
};

function mostrarDatos(){
    var queryString = window.location.search;
    var urlParams = new URLSearchParams(queryString);
    var idPincho = urlParams.get('id');

    var settings = {
        "url": "http://localhost/logrocho/index.php/api/pincho/"+idPincho,
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
        "url": "http://localhost/logrocho/index.php/api/updatePincho/"+idPincho,
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