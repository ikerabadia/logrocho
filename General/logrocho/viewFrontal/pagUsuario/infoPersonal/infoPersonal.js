var usuarioActual;

window.onload = function() {
  comprobarUsuarioLogueado();

};

function comprobarUsuarioLogueado(){
  var settings = {
      "url": "http://localhost/logrocho/index.php/api/getUsuarioLogueado",
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

      pintarDatosUsuario()
    });
}

function pintarDatosUsuario(){
  document.getElementById("inputNombre").value = usuarioActual["nombre"];
  document.getElementById("inputApellido1").value = usuarioActual["apellido1"];
  document.getElementById("inputApellido2").value = usuarioActual["apellido2"];
  document.getElementById("inputNombreUsuario").value = usuarioActual["user"];
  document.getElementById("inputMail").value = usuarioActual["correoElectronico"];

  

  if (usuarioActual["imagen"] != "") {
    document.getElementById("foto").innerHTML = "";
    document.getElementById("foto").style.backgroundImage = "url("+usuarioActual["imagen"]+")";
  }


}

function logout() {
  var settings = {
    "url": "http://localhost/logrocho/index.php/api/logout",
    "method": "GET",
    "timeout": 0,
    "headers": {
    },
  };
  
  $.ajax(settings).done(function (response) {
    window.location.href = "home";
  });
}




//Codigo del input
"use strict";

(function (document, window, index) {
  var inputs = document.querySelectorAll(".inputfile");
  Array.prototype.forEach.call(inputs, function (input) {
    var label = input.nextElementSibling,
      labelVal = label.innerHTML;

    input.addEventListener("change", function (e) {
      var fileName = "";
      if (this.files && this.files.length > 1)
        fileName = (this.getAttribute("data-multiple-caption") || "").replace(
          "{count}",
          this.files.length
        );
      else fileName = e.target.value.split("\\").pop();

      if (fileName) label.querySelector("span").innerHTML = fileName;
      else label.innerHTML = labelVal;
    });
  });
})(document, window, 0);