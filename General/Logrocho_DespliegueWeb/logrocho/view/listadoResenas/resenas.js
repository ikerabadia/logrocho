var paginaActual = 1;
var datos;
var datosOrdenados;

window.onload = function() {
    //Console.error = () =>{};
    mostrarDatos();
};

function mostrarDatos() {
    var numFilas = document.getElementById("itemsPaginacion").value;    
     $.ajax({
        url: "api/resenas",
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
            if (resultados["resenas"].length < numFilas) {
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

            var tabla = document.getElementById("tablaResenas");
            var filas = "<tr><th id=\"thId\" onclick=\"orderByIdResena()\">ID</th><th id=\"thUsuario\" onclick=\"orderByUsuario()\">Usuario</th><th id=\"thPincho\" onclick=\"orderByPincho()\">Pincho</th><th id=\"thNota\" onclick=\"orderByNota()\">Nota</th><th id=\"thTexto\" >Texto resena</th><th></th></tr>";
            for (let i = 0; i < resultados["resenas"].length; i++) {
                filas+= "<tr><td>"+datos["resenas"][i]["idResena"]+"</td><td>"+datos["resenas"][i]["fkUsuario"]+"</td><td>"+datos["resenas"][i]["fkPincho"]+"</td><td>"+datos["resenas"][i]["nota"]+"</td><td>"+datos["resenas"][i]["textoResena"]+"</td><td class=\"colVerPinchos\"><a class=\"btn btn-danger\" onclick=\"eliminarResena("+datos["resenas"][i]["idResena"]+")\">Eliminar resena</a></td></tr>  ";
            }
            tabla.innerHTML = filas;
        }
    }); 
}

function pintar() {
    var numFilas = document.getElementById("itemsPaginacion").value; 
    if (datos["resenas"].length < numFilas) {
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

    var tabla = document.getElementById("tablaResenas");
    var filas = "<tr><th id=\"thId\" onclick=\"orderByIdResena()\">ID</th><th id=\"thUsuario\" onclick=\"orderByUsuario()\">Usuario</th><th id=\"thPincho\" onclick=\"orderByPincho()\">Pincho</th><th id=\"thNota\" onclick=\"orderByNota()\">Nota</th><th id=\"thTexto\" >Texto resena</th><th></th></tr>";
    for (let i = 0; i < resultados["resenas"].length; i++) {
        filas+= "<tr><td>"+datos["resenas"][i]["idResena"]+"</td><td>"+datos["resenas"][i]["fkUsuario"]+"</td><td>"+datos["resenas"][i]["fkPincho"]+"</td><td>"+datos["resenas"][i]["nota"]+"</td><td>"+datos["resenas"][i]["textoResena"]+"</td><td class=\"colVerPinchos\"><a class=\"btn btn-danger\" onclick=\"eliminarResena("+datos["resenas"][i]["idResena"]+")\">Eliminar resena</a></td></tr>  ";
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

function eliminarResena(idResena) {
    var settings = {
        "url": "api/deleteResena/"+idResena,
        "method": "DELETE",
        "timeout": 0,
      };
      
      $.ajax(settings).done(function (response) {
        //console.log(response);
        mostrarDatos();
      });
}

/*ORDENACIONES*/

function ordenarAsc(p_key) {
    datos["resenas"].sort(function (a, b) {
       return a[p_key] > b[p_key];
    });
}
function ordenarDesc(p_key) {
    ordenarAsc(p_key); 
    datos["resenas"].reverse(); 
}

function orderByIdResena() {
    ordenarDesc("idResena");    
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

