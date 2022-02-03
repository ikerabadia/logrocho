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



function eliminarUsuario() {
    var idUsuario = datosOriginales["usuarios"][0]["idUsuario"];

    var settings = {
      "url": "http://localhost/logrocho/index.php/api/deleteUsuario/"+idUsuario,
      "method": "DELETE",
      "timeout": 0,
      "headers": {
      },
    };
    
    $.ajax(settings).done(function (response) {
      console.log(response);
    });
  
}