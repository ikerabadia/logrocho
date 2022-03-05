var paginaActual = 1;
var datos;
var datosOrdenados;

window.onload = function() {
    mostrarDatos();
    cargarBares();
};

function mostrarDatos() {
    var numFilas = document.getElementById("itemsPaginacion").value;    
     $.ajax({
        url: "http://localhost/logrocho/index.php/api/pinchos",
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
            if (resultados["pinchos"].length < numFilas) {
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

            var tabla = document.getElementById("tablaPinchos");
            var filas = "<tr><th id=\"thId\" onclick=\"orderByIdPinchos()\">ID</th><th id=\"nombrePincho\" onclick=\"orderByNombre()\">Nombre Pincho</th><th id=\"precioPincho\" onclick=\"orderByPrecio()\">Precio</th><th id=\"bar\" onclick=\"orderByBar()\">Bar</th><th id=\"notaMediaPincho\" >Nota media</th><th id=\"cantidadReseñasPincho\">Cantidad de Reseñas</th><th></th></tr>";
            for (let i = 0; i < resultados["pinchos"].length; i++) {
                filas+= "<tr><td>"+resultados["pinchos"][i]["idPincho"]+"</td><td>"+resultados["pinchos"][i]["nombre"]+"</td><td>"+resultados["pinchos"][i]["precio"]+" €</td><td >"+resultados["pinchos"][i]["fkBar"]+"</td><td>8.9</td><td>15</td><td class=\"colVerRest\"><a class=\"btn btn-primary\" href=\"pincho?id="+resultados["pinchos"][i]["idPincho"]+"\">Ver pincho</a></td></tr>";
            }
            tabla.innerHTML = filas;
        }
    }); 
}

function pintar() {
    var numFilas = document.getElementById("itemsPaginacion").value; 
    if (datos["pinchos"].length < numFilas) {
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

    var tabla = document.getElementById("tablaPinchos");
    var filas = "<tr><th id=\"thId\" onclick=\"orderByIdPinchos()\">ID</th><th id=\"nombrePincho\" onclick=\"orderByNombre()\">Nombre Pincho</th><th id=\"precioPincho\" onclick=\"orderByPrecio()\">Precio</th><th id=\"bar\" onclick=\"orderByBar()\">Bar</th><th id=\"notaMediaPincho\" >Nota media</th><th id=\"cantidadReseñasPincho\">Cantidad de Reseñas</th><th></th></tr>";
    for (let i = 0; i < datos["pinchos"].length; i++) {
        filas+= "<tr><td>"+datos["pinchos"][i]["idPincho"]+"</td><td>"+datos["pinchos"][i]["nombre"]+"</td><td>"+datos["pinchos"][i]["precio"]+" €</td><td >"+datos["pinchos"][i]["fkBar"]+"</td><td>8.9</td><td>15</td><td class=\"colVerRest\"><a class=\"btn btn-primary\" href=\"pincho?id="+datos["pinchos"][i]["idPincho"]+"\">Ver pincho</a></td></tr>";
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

function cargarBares(){
    $.ajax({
        url: "http://localhost/logrocho/index.php/api/restaurantes",
        method: "POST",
        timeout: 0,
        headers: {
            "Content-Type": "application/x-www-form-urlencoded",
        },
        data: {
            "pagina": "1",
            "cantidadRegistros": "1000"
        },
        success: function (response) {
            var json = response;
            resultados=eval(json);
            var bares = "";

            var datalist = document.getElementById("bares");            
            for (let i = 0; i < resultados["bares"].length; i++) {
                bares += "<option value=\""+resultados["bares"][i]["idRestaurante"]+"\">"+resultados["bares"][i]["nombre"]+"</option>";
            }
            datalist.innerHTML = bares;
        }
    }); 
}

function insertarPincho() {
    var nombre = document.getElementById("inputNombrePincho").value;
    var precio = document.getElementById("inputPrecio").value;
    var bar = document.getElementById("inputBar").value;
    var descripcion = document.getElementById("inputDescripcion").value;

    var settings = {
        "url": "http://localhost/logrocho/index.php/api/nuevoPincho",
        "method": "POST",
        "timeout": 0,
        "headers": {
          "Content-Type": "application/x-www-form-urlencoded"
        },
        "data": {
          "nombre": ""+nombre,
          "precio": ""+precio,
          "fkBar": ""+bar,
          "descripcion": ""+descripcion
        }
      };
      
      $.ajax(settings).done(function (response) {
        document.getElementById("inputNombrePincho").value = "";
        document.getElementById("inputPrecio").value = "";
        document.getElementById("inputBar").value = "";
        document.getElementById("inputDescripcion").value = "";

        mostrarDatos();
      });
}

/*ORDENACIONES*/
/*
IMPORTANTE!!!!!!

LOS DATOS DE LA NOTA MEDIA Y CANTIDAD DE RESEÑAS SON CAMPOS CALCULADOS QUE TODAVIA NO TENGO IMPLEMENTADOS 
EN LA API DE PHP POR LO TANTO ESOS DATOS NO VIENEN EN EL JSON CON LOS DATOS POR LO QUE NO SE PUEDE ORDENAR 
SEGUNA LA NOTA MEDIA DE LOS PINCHOS NI POR LA CANTIDAD DE RESEÑAS, TODAS LAS DEMAS ORDENACIONES FUNCIONAN PERFECTAMENTE.

IMPORTANTE!!!!!!
*/

function ordenarAsc(p_key) {
    datos["pinchos"].sort(function (a, b) {
       return a[p_key] > b[p_key];
    });
}
function ordenarDesc(p_key) {
    ordenarAsc(p_key); 
    datos["pinchos"].reverse(); 
}

function orderByPrecio() {
    ordenarDesc("precio");    
    pintar();
    document.getElementById("precioPincho").style.background = "#0d6efd";
    document.getElementById("precioPincho").style.color = "white";
}
function orderByNombre() {
    ordenarDesc("nombre");    
    pintar();
    document.getElementById("nombrePincho").style.background = "#0d6efd";
    document.getElementById("nombrePincho").style.color = "white";
}
function orderByIdPinchos() {
    ordenarDesc("idPincho");    
    pintar();
    document.getElementById("thId").style.background = "#0d6efd";
    document.getElementById("thId").style.color = "white";
}
function orderByBar() {
    ordenarDesc("fkbar");    
    pintar();
    document.getElementById("bar").style.background = "#0d6efd";
    document.getElementById("bar").style.color = "white";
}

