var usuarioActual;

window.onload = function() {
  //Console.error = () =>{};
  comprobarUsuarioLogueado();

};

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
    document.getElementById("btnEliminarFoto").style.display = "flex";
    document.getElementById("btnGuardarFoto").style.display = "none";
  }else{
    document.getElementById("foto").innerHTML = "<input type=\"file\" id=\"inputImagenPerfil\">";
    document.getElementById("btnEliminarFoto").style.display = "none";
    document.getElementById("btnGuardarFoto").style.display = "flex";
  }


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

function updateUsuario(){
  var settings = {
    "url": "api/updateUsuario/"+usuarioActual["idUsuario"],
    "method": "POST",
    "timeout": 0,
    "headers": {
      "Content-Type": "application/x-www-form-urlencoded"
    },
    "data": {
      "nombre": ""+document.getElementById("inputNombre").value,
      "apellido1": ""+document.getElementById("inputApellido1").value,
      "apellido2": ""+document.getElementById("inputApellido2").value,
      "correoElectronico": ""+document.getElementById("inputMail").value,
      "user": ""+document.getElementById("inputNombreUsuario").value,
      "password": ""+usuarioActual["password"],
      "admin": ""+usuarioActual["admin"]
    }
  };
  
  $.ajax(settings).done(function (response) {
    console.log(response);
  });
}

function guardarFoto() {
  var formData = new FormData();
      formData.append('imagen', document.getElementById("inputImagenPerfil").files[0]);
      formData.append('usuario', usuarioActual["idUsuario"]);
      $.ajax({
          url: 'api/guardarImagenUsuario',
          type: 'post',
          data: formData,
          contentType: false,
          processData: false,
          success: function (response) {
            console.log(response);
            comprobarUsuarioLogueado();
          }
      });
}

function eliminarFoto(){
  var settings = {
    "url": "api/deleteImagenUsuario/"+usuarioActual["idUsuario"],
    "method": "DELETE",
    "timeout": 0,
    "headers": {
    },
  };
  
  $.ajax(settings).done(function (response) {
    document.getElementById("foto").style.backgroundImage = "";
    comprobarUsuarioLogueado();
  });
}

function bajaUsuario(){
  var settings = {
    "url": "api/bajaUsuario/"+usuarioActual["idUsuario"],
    "method": "GET",
    "timeout": 0,
    "headers": {
    },
  };
  
  $.ajax(settings).done(function (response) {
    console.log(response);
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