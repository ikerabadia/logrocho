var paginaActual = 1;
var datos;
var datosOrdenados;

window.onload = function() {
    mostrarDatos();
};

function mostrarDatos() {
    var numFilas = document.getElementById("itemsPaginacion").value;    
     $.ajax({
        url: "http://localhost/logrocho/index.php/api/restaurantes",
        method: "POST",
        timeout: 0,
        headers: {
            "Content-Type": "application/x-www-form-urlencoded",
        },
        data: {
            "pagina": ""+paginaActual+"",
            "cantidadRegistros": ""+numFilas+""
        },
        success: function (response) {
            var json = response;
            resultados=eval(json);
            datos = resultados;
            if (resultados["bares"].length < numFilas) {
                document.getElementById("btnSiguiente").style.opacity = 0;
                document.getElementById("btnSiguiente").style.cursor = "default";
            }else{
                document.getElementById("btnSiguiente").style.opacity = 1;
                document.getElementById("btnSiguiente").style.cursor = "pointer";
            }  
            if (paginaActual == 1 ) {
                document.getElementById("btnAnterior").style.opacity = 0;
                document.getElementById("btnAnterior").style.cursor = "default";
            }else{
                document.getElementById("btnAnterior").style.opacity = 1;
                document.getElementById("btnAnterior").style.cursor = "pointer";
            }

            var tabla = document.getElementById("tablaRestaurantes");
            var filas = "<tr><th id=\"thId\" onclick=\"orderByIdRestaurante()\">ID</th><th id=\"thNombre\" onclick=\"orderByNombre()\">Nombre</th><th id=\"thLocalizacion\" onclick=\"orderByLocalizacion()\">Localización</th><th>Nota media</th><th></th></tr>";
            for (let i = 0; i < resultados["bares"].length; i++) {
                filas+= "<tr><td>"+resultados["bares"][i]["idRestaurante"]+"</td><td>"+resultados["bares"][i]["nombre"]+"</td><td>"+resultados["bares"][i]["localizacion"]+"</td><td>100</td><td class=\"colVerRest\"><a class=\"btn btn-primary\" href=\"restaurante?id="+resultados["bares"][i]["idRestaurante"]+"\">Ver bar</a></td></tr>";
            }
            tabla.innerHTML = filas;
        }
    }); 
}

function pintar() {
    if (datos["bares"].length < document.getElementById("itemsPaginacion").value) {
        document.getElementById("btnSiguiente").style.opacity = 0;
        document.getElementById("btnSiguiente").style.cursor = "default";
    }else{
        document.getElementById("btnSiguiente").style.opacity = 1;
        document.getElementById("btnSiguiente").style.cursor = "pointer";
    }  
    if (paginaActual == 1 ) {
        document.getElementById("btnAnterior").style.opacity = 0;
        document.getElementById("btnAnterior").style.cursor = "default";
    }else{
        document.getElementById("btnAnterior").style.opacity = 1;
        document.getElementById("btnAnterior").style.cursor = "pointer";
    }

    var tabla = document.getElementById("tablaRestaurantes");
    var filas = "<tr><th id=\"thId\" onclick=\"orderByIdRestaurante()\">ID</th><th id=\"thNombre\" onclick=\"orderByNombre()\">Nombre</th><th id=\"thLocalizacion\" onclick=\"orderByLocalizacion()\">Localización</th><th>Nota media</th><th></th></tr>";
    for (let i = 0; i < datos["bares"].length; i++) {
        filas+= "<tr><td>"+datos["bares"][i]["idRestaurante"]+"</td><td>"+datos["bares"][i]["nombre"]+"</td><td>"+datos["bares"][i]["localizacion"]+"</td><td>100</td><td class=\"colVerRest\"><a class=\"btn btn-primary\" href=\"restaurante.html\">Ver bar</a></td></tr>";
    }
    tabla.innerHTML = filas;
}
function siguiente(){
    if (document.getElementById("btnSiguiente").style.opacity == 1) {
        paginaActual++;
        mostrarDatos();
    }
    
}
function anterior(){
    if (document.getElementById("btnAnterior").style.opacity == 1) {
        paginaActual--;
        mostrarDatos();
    }
    
}

function insertarRestaurante() {
    var nombre = document.getElementById("inputNombreRestaurante").value;
    var localizacion = document.getElementById("inputLocalizacion").value;
    var descripcion = document.getElementById("inputDescripcion").value;

    var settings = {
        "url": "http://localhost/logrocho/index.php/api/nuevoRestaurante",
        "method": "POST",
        "timeout": 0,
        "headers": {
          "Content-Type": "application/x-www-form-urlencoded"
        },
        "data": {
          "nombre": ""+nombre,
          "descripcion": ""+descripcion,
          "localizacion": ""+localizacion
        }
      };
      
      $.ajax(settings).done(function (response) {
        document.getElementById("inputNombreRestaurante").value = "";
        document.getElementById("inputLocalizacion").value = "";
        document.getElementById("inputDescripcion").value = "";
        mostrarDatos();
      });
}

/*ORDENACIONES*/
/*
IMPORTANTE!!!!!!

EL DATO DE LA NOTA MEDIA TODAVIA NO LO TENGO IMPLEMENTADO EN LA API DE PHP POR LO TANTO ESE DATO NO VIENE 
EN EL JSON CON LOS DATOS POR LO QUE NO SE PUEDE ORDENAR SEGUNA LA NOTA MEDIA DE LOS PINCHOS, TODAS LAS 
DEMAS ORDENACIONES FUNCIONAN PERFECTAMENTE.

IMPORTANTE!!!!!!
*/

function ordenarAsc(p_key) {
    datos["bares"].sort(function (a, b) {
       return a[p_key] > b[p_key];
    });
}
function ordenarDesc(p_key) {
    ordenarAsc(p_key); 
    datos["bares"].reverse(); 
}

function orderByIdRestaurante() {
    ordenarDesc("idRestaurante");    
    pintar();
    document.getElementById("thId").style.background = "#0d6efd";
    document.getElementById("thId").style.color = "white";
}
function orderByNombre() {
    ordenarDesc("nombre");    
    pintar();
    document.getElementById("thNombre").style.background = "#0d6efd";
    document.getElementById("thNombre").style.color = "white";
}
function orderByLocalizacion() {
    ordenarDesc("localizacion");    
    pintar();
    document.getElementById("thLocalizacion").style.background = "#0d6efd";
    document.getElementById("thLocalizacion").style.color = "white";
}

