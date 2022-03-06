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
        url: "api/usuarios",
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
            if (resultados["usuarios"].length < numFilas) {
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

            var tabla = document.getElementById("tablaUsuarios");
            var filas = "<tr><th id=\"thId\" onclick=\"orderById()\">ID</th><th id=\"thUser\" onclick=\"orderByUser()\">Nombre Usuario</th><th id=\"thCorreo\" onclick=\"orderByMail()\">Correo Electronico</th><th id=\"thNombreApellidos\" onclick=\"orderByNombreApellidos()\">Nombre y apellidos</th><th id=\"thNotaResenas\">Nota media resenas</th><th id=\"thCantidadResenas\">Cantidad de Resenas</th><th></th></tr>";
            for (let i = 0; i < resultados["usuarios"].length; i++) {
                filas+= "<tr><td>"+datos["usuarios"][i]["idUsuario"]+"</td><td>"+datos["usuarios"][i]["user"]+"</td><td>"+datos["usuarios"][i]["correoElectronico"]+"</td><td>"+datos["usuarios"][i]["nombre"]+" "+datos["usuarios"][i]["apellido1"]+" "+datos["usuarios"][i]["apellido2"]+"</td><td>76</td><td>15</td><td class=\"colVerPinchos\"><a class=\"btn btn-primary\" href=\"usuario?id="+datos["usuarios"][i]["idUsuario"]+"\">Ver Usuario</a></td></tr>";
            }
            tabla.innerHTML = filas;
        }
    }); 
}

function pintar() {
    var numFilas = document.getElementById("itemsPaginacion").value; 
    if (datos["usuarios"].length < numFilas) {
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

    var tabla = document.getElementById("tablaUsuarios");
    var filas = "<tr><th id=\"thId\" onclick=\"orderById()\">ID</th><th id=\"thUser\" onclick=\"orderByUser()\">Nombre Usuario</th><th id=\"thCorreo\" onclick=\"orderByMail()\">Correo Electronico</th><th id=\"thNombreApellidos\" onclick=\"orderByNombreApellidos()\">Nombre y apellidos</th><th id=\"thNotaResenas\">Nota media resenas</th><th id=\"thCantidadResenas\">Cantidad de Resenas</th><th></th></tr>";
    for (let i = 0; i < datos["usuarios"].length; i++) {
        filas+= "<tr><td>"+datos["usuarios"][i]["idUsuario"]+"</td><td>"+datos["usuarios"][i]["user"]+"</td><td>"+datos["usuarios"][i]["correoElectronico"]+"</td><td>"+datos["usuarios"][i]["nombre"]+" "+datos["usuarios"][i]["apellido1"]+" "+datos["usuarios"][i]["apellido2"]+"</td><td>76</td><td>15</td><td class=\"colVerPinchos\"><a class=\"btn btn-primary\" href=\"usuario?=\""+datos["usuarios"][i]["idUsuario"]+">Ver Usuario</a></td></tr>";
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

function insertarUsuario() {
    var nombre = document.getElementById("inputNombreUsuario").value;
    var apellido1 = document.getElementById("inputApellido1").value;
    var apellido2 = document.getElementById("inputApellido2").value;
    var correoElectronico = document.getElementById("inputCorreoElectronico").value;
    var user = document.getElementById("inputUsername").value;
    var password = document.getElementById("inputPassword").value;

    var settings = {
        "url": "api/nuevoUsuario",
        "method": "POST",
        "timeout": 0,
        "headers": {
          "Content-Type": "application/x-www-form-urlencoded"
        },
        "data": {
          "nombre": ""+nombre,
          "apellido1": ""+apellido1,
          "apellido2": ""+apellido2,
          "correoElectronico": ""+correoElectronico,
          "user": ""+user,
          "password": ""+password,
          "admin": "0"
        }
      };
      
      $.ajax(settings).done(function (response) {
        document.getElementById("inputNombreUsuario").value = "";
        document.getElementById("inputApellido1").value = "";
        document.getElementById("inputApellido2").value = "";
        document.getElementById("inputCorreoElectronico").value = "";
        document.getElementById("inputApellido2").value = "";
        document.getElementById("inputPassword").value = "";
        mostrarDatos();
      });
}

/*ORDENACIONES*/

function ordenarAsc(p_key) {
    datos["usuarios"].sort(function (a, b) {
       return a[p_key] > b[p_key];
    });
}
function ordenarDesc(p_key) {
    ordenarAsc(p_key); 
    datos["usuarios"].reverse(); 
}

function orderById() {
    ordenarDesc("idUsuario");    
    pintar();
    document.getElementById("thId").style.background = "#0d6efd";
    document.getElementById("thId").style.color = "white";
}
function orderByUser() {
    ordenarDesc("user");    
    pintar();
    document.getElementById("thUser").style.background = "#0d6efd";
    document.getElementById("thUser").style.color = "white";
}
function orderByMail() {
    ordenarDesc("correoElectronico");    
    pintar();
    document.getElementById("thCorreo").style.background = "#0d6efd";
    document.getElementById("thCorreo").style.color = "white";
}
function orderByNombreApellidos() {
    ordenarDesc("nombre");    
    pintar();
    document.getElementById("thNombreApellidos").style.background = "#0d6efd";
    document.getElementById("thNombreApellidos").style.color = "white";
}

