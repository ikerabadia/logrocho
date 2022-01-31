var datosOriginales;

window.onload = function() {
    mostrarDatos();
};

function mostrarDatos(){
    var queryString = window.location.search;
    var urlParams = new URLSearchParams(queryString);
    var idUsuario = urlParams.get('id');

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