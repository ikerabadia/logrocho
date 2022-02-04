var datosOriginales;
var idRestaurante;

window.onload = function() {
    establecerIdRestaurante();
    mostrarDatos();
    pintarTablaPinchos();
};

function establecerIdRestaurante() {
    var queryString = window.location.search;
    var urlParams = new URLSearchParams(queryString);
    idRestaurante = urlParams.get('id');
}

function mostrarDatos(){  

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

function pintarTablaPinchos() {
  var settings = {
    "url": "http://localhost/logrocho/index.php/api/pinchosByRestaurante/"+idRestaurante,
    "method": "GET",
    "timeout": 0,
    "headers": {
    },
  };
  
  $.ajax(settings).done(function (response) {
    var json = response;
            resultados=eval(json);
            datos = resultados;

            var tabla = document.getElementById("tablaPinchos");
            var filas = "<tr><th id=\"thId\" onclick=\"orderByIdPinchos()\">ID</th><th id=\"nombrePincho\" onclick=\"orderByNombre()\">Nombre Pincho</th><th id=\"precioPincho\" onclick=\"orderByPrecio()\">Precio</th><th id=\"bar\" onclick=\"orderByBar()\">Bar</th><th id=\"notaMediaPincho\" >Nota media</th><th id=\"cantidadReseñasPincho\">Cantidad de Reseñas</th><th></th></tr>";
            for (let i = 0; i < resultados["pinchos"].length; i++) {
                filas+= "<tr><td>"+resultados["pinchos"][i]["idPincho"]+"</td><td>"+resultados["pinchos"][i]["nombre"]+"</td><td>"+resultados["pinchos"][i]["precio"]+" €</td><td >"+resultados["pinchos"][i]["fkBar"]+"</td><td>8.9</td><td>15</td><td class=\"colVerRest\"><a class=\"btn btn-primary\" href=\"pincho?id="+resultados["pinchos"][i]["idPincho"]+"\">Ver pincho</a></td></tr>";
            }            
            tabla.innerHTML = filas;
            if (resultados["pinchos"].length == 0) {
              document.getElementById("contenedorTablaPinchos").innerHTML += "Este restaurante no tiene ningun pincho.";
            }
  });
}

function descartarCambios() {
    document.getElementById("inputNombreRestaurante").value = datosOriginales["bar"][0]["nombre"];
    document.getElementById("muestraId").innerHTML = "ID: "+ datosOriginales["bar"][0]["idRestaurante"];
    document.getElementById("inputDescripcion").value = datosOriginales["bar"][0]["descripcion"];
    document.getElementById("inputDireccionRestaurante").value = datosOriginales["bar"][0]["localizacion"];
}

function guardarCambios() {

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

function eliminarRestaurante() {
  var settings = {
    "url": "http://localhost/logrocho/index.php/api/deleteRestaurante/"+datosOriginales["bar"][0]["idRestaurante"],
    "method": "DELETE",
    "timeout": 0,
  };
  
  $.ajax(settings).done(function (response) {
    //console.log(response);
    window.location.href = "restaurantes";
  });
}