var paginaActual = 1;
var datos;
var datosOrdenados;

window.onload = function() {
    mostrarDatos();
};

function mostrarDatos() {
    var numFilas = document.getElementById("itemsPaginacion").value;    
     $.ajax({
        url: "http://localhost/logrocho/index.php/api/resenas",
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
            if (resultados["reseñas"].length < numFilas) {
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

            var tabla = document.getElementById("tablaReseñas");
            var filas = "<tr><th id=\"thId\" onclick=\"orderByIdReseña()\">ID</th><th id=\"thUsuario\" onclick=\"orderByUsuario()\">Usuario</th><th id=\"thPincho\" onclick=\"orderByPincho()\">Pincho</th><th id=\"thNota\" onclick=\"orderByNota()\">Nota</th><th id=\"thTexto\" >Texto reseña</th><th></th></tr>";
            for (let i = 0; i < resultados["reseñas"].length; i++) {
                filas+= "<tr><td>"+datos["reseñas"][i]["idReseña"]+"</td><td>"+datos["reseñas"][i]["fkUsuario"]+"</td><td>"+datos["reseñas"][i]["fkPincho"]+"</td><td>"+datos["reseñas"][i]["nota"]+"</td><td>"+datos["reseñas"][i]["textoReseña"]+"</td><td class=\"colVerPinchos\"><a class=\"btn btn-danger\">Eliminar reseña</a></td></tr>  ";
            }
            tabla.innerHTML = filas;
        }
    }); 
}

function pintar() {
    var numFilas = document.getElementById("itemsPaginacion").value; 
    if (datos["reseñas"].length < numFilas) {
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

    var tabla = document.getElementById("tablaReseñas");
    var filas = "<tr><th id=\"thId\" onclick=\"orderByIdReseña()\">ID</th><th id=\"thUsuario\" onclick=\"orderByUsuario()\">Usuario</th><th id=\"thPincho\" onclick=\"orderByPincho()\">Pincho</th><th id=\"thNota\" onclick=\"orderByNota()\">Nota</th><th id=\"thTexto\" >Texto reseña</th><th></th></tr>";
    for (let i = 0; i < resultados["reseñas"].length; i++) {
        filas+= "<tr><td>"+datos["reseñas"][i]["idReseña"]+"</td><td>"+datos["reseñas"][i]["fkUsuario"]+"</td><td>"+datos["reseñas"][i]["fkPincho"]+"</td><td>"+datos["reseñas"][i]["nota"]+"</td><td>"+datos["reseñas"][i]["textoReseña"]+"</td><td class=\"colVerPinchos\"><a class=\"btn btn-danger\">Eliminar reseña</a></td></tr>  ";
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

/*ORDENACIONES*/

function ordenarAsc(p_key) {
    datos["reseñas"].sort(function (a, b) {
       return a[p_key] > b[p_key];
    });
}
function ordenarDesc(p_key) {
    ordenarAsc(p_key); 
    datos["reseñas"].reverse(); 
}

function orderByIdReseña() {
    ordenarDesc("idReseña");    
    pintar();
    document.getElementById("thId").style.background = "#0d6efd";
    document.getElementById("thId").style.color = "white";
}
function orderByUsuario() {
    ordenarDesc("fkUsuario");    
    pintar();
    document.getElementById("thUsuario").style.background = "#0d6efd";
    document.getElementById("thUsuario").style.color = "white";
}
function orderByPincho() {
    ordenarDesc("fkPincho");    
    pintar();
    document.getElementById("thPincho").style.background = "#0d6efd";
    document.getElementById("thPincho").style.color = "white";
}
function orderByNota() {
    ordenarDesc("nota");    
    pintar();
    document.getElementById("thNota").style.background = "#0d6efd";
    document.getElementById("thNota").style.color = "white";
}

