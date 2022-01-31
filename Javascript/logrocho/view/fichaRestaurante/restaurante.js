var datosOriginales;

window.onload = function() {
    mostrarDatos();
};

function mostrarDatos(){
    var queryString = window.location.search;
    var urlParams = new URLSearchParams(queryString);
    var idRestaurante = urlParams.get('id');

    var settings = {
        "url": "http://localhost/logrocho/index.php/api/restaurante/"+idRestaurante,
        "method": "GET",
        "timeout": 0,
      };
      
      $.ajax(settings).done(function (response) {
        var json = response;
        resultados=eval(json);
        datosOriginales = resultados;

        document.getElementById("inputNombreRestaurante").value = resultados["bar"][0]["nombre"];
        document.getElementById("muestraId").innerHTML = "ID: "+ resultados["bar"][0]["idRestaurante"];
        document.getElementById("inputDescripcion").value = resultados["bar"][0]["descripcion"];
        document.getElementById("inputDireccionRestaurante").value = resultados["bar"][0]["localizacion"];
        
        
      });
}

function descartarCambios() {
    document.getElementById("inputNombreRestaurante").value = datosOriginales["bar"][0]["nombre"];
    document.getElementById("muestraId").innerHTML = "ID: "+ datosOriginales["bar"][0]["idRestaurante"];
    document.getElementById("inputDescripcion").value = datosOriginales["bar"][0]["descripcion"];
    document.getElementById("inputDireccionRestaurante").value = datosOriginales["bar"][0]["localizacion"];
}

function guardarCambios() {
    var queryString = window.location.search;
    var urlParams = new URLSearchParams(queryString);
    var idRestaurante = urlParams.get('id');

    var nombre = document.getElementById("inputNombreRestaurante").value;
    var descripcion = document.getElementById("inputDescripcion").value;
    var localizacion = document.getElementById("inputDireccionRestaurante").value;

    var settings = {
        "url": "http://localhost/logrocho/index.php/api/updateRestaurante/"+idRestaurante,
        "method": "POST",
        "timeout": 0,
        "headers": {
          "Content-Type": "application/x-www-form-urlencoded"
        },
        "data": {
          "nombre": ""+nombre+"",
          "descripcion": ""+descripcion+"",
          "localizacion": ""+localizacion+""
        }
      };
      
      $.ajax(settings).done(function (response) {
        console.log(response);
      });
}