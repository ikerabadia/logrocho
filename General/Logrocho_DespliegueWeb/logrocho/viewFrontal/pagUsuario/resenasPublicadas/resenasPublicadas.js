var usuarioActual;

window.onload = function() {
  //Console.error = () =>{};
  comprobarUsuarioLogueado();
  
};

function pintarTabla() {
  var settings = {
    "url": "api/resenasByUsuario/"+usuarioActual["idUsuario"],
    "method": "GET",
    "timeout": 0,
    "headers": {
    },
  };
  
  $.ajax(settings).done(function (response) {
    var json = response;
    var resultados=eval(json);

    document.getElementById("tablaResenas").innerHTML = "<tr><th class=\"columnaPincho\">Pincho</th><th class=\"columnaBar\">Bar</th><th class=\"columnaValoracion\">Valoracion</th><th class=\"columnaTexto\">textoResena</th><th class=\"columnaEliminar\"></th></tr>";
    resultados["resenas"].forEach(resena => {
      
      document.getElementById("tablaResenas").innerHTML += "<tr><td class=\"columnaPincho\">"+resena["nombrePincho"]+"</td> <td class=\"columnaBar\">"+resena["nombreBar"]+"</td><td class=\"columnaValoracion\">"+resena["nota"]+"/10</td><td class=\"columnaTexto\">"+resena["textoResena"]+"</td><td class=\"columnaEliminar\"> <div class=\"btnEliminar\" onclick=\"eliminarResena("+resena["idResena"]+")\">🗑</div> </td></tr>"

    });

  });
}

function eliminarResena(idResena) {
  var settings = {
    "url": "api/deleteResena/"+idResena,
    "method": "DELETE",
    "timeout": 0,
    "headers": {
    },
  };
  
  $.ajax(settings).done(function (response) {
    pintarTabla();
  });
}

function comprobarUsuarioLogueado(){
    var settings = {
        "url": "api/getUsuarioLogueado",
        "method": "GET",
        "timeout": 0,
        "headers": {
        },
      };
      
      $.ajax(settings).done(function (response) {
        var json = response;
        var resultados=eval(json);

        usuarioActual = resultados;
  
        if (resultados == false) {
            document.getElementById("contenedorBtnLogin").innerHTML = "<a id=\"btnLogin\" href=\"frontLoginRegister\">👤 Login/Register</a>";
            
        }else{
            document.getElementById("contenedorBtnLogin").innerHTML = "<a id=\"btnLogin\" href=\"infoPersonal\">👤 "+resultados["user"]+"</a>";
            document.getElementById("contenedorBtnLogin").innerHTML += "<a onclick=\"logout()\"  id=\"btnLogout\">Logout</a>";
        }
        pintarTabla();
      });
  }
  
  function logout() {
    var settings = {
      "url": "api/logout",
      "method": "GET",
      "timeout": 0,
      "headers": {
      },
    };
    
    $.ajax(settings).done(function (response) {
      window.location.href = "home";
    });
  }