window.onload = function() {
  //Console.error = () =>{};
};

function verificarLogin() {
    var user = document.getElementById("campoLoginInputUsuario").value;
    var password = document.getElementById("campoLoginInputContrasena").value;

    var settings = {
        "url": "api/loginFront",
        "method": "POST",
        "timeout": 0,
        "headers": {
          "Content-Type": "application/x-www-form-urlencoded",
        },
        "data": {
          "user": ""+user,
          "password": ""+password
        }
      };
      
      $.ajax(settings).done(function (response) {
        var json = response;
        var resultados=eval(json);

        if (resultados == "true") {
            window.location.href = 'home';
        }else{
            document.getElementById("errorLogin").innerHTML = "Usuario o contrasena incorrectos"
        }
      });
}

function register(){
  var email = document.getElementById("campoRegisterInputEmail").value;
  var usuario = document.getElementById("campoRegisterInputUsuario").value;
  var contrasena = document.getElementById("campoRegisterInputContrasena").value;
  var repetirContrasena = document.getElementById("campoRegisterInputRepetirContrasena").value;

  var camposCorrectos = true;

  if (contrasena != repetirContrasena) {
    document.getElementById("campoRegisterInputContrasena").style.boxShadow = "0px 0px 10px red";
    document.getElementById("campoRegisterInputRepetirContrasena").style.boxShadow = "0px 0px 10px red";
    document.getElementById("errorRegister").innerHTML = "las contrasenas no coinciden";
    camposCorrectos = false;
  }else{
    document.getElementById("campoRegisterInputContrasena").style.boxShadow = "0px 0px 0px red";
    document.getElementById("campoRegisterInputRepetirContrasena").style.boxShadow = "0px 0px 0px red";
    document.getElementById("errorRegister").innerHTML = "";

    if (email == "" || /'\\/.test(email)) {
      document.getElementById("campoRegisterInputEmail").style.boxShadow = "0px 0px 10px red";
      camposCorrectos = false;
    }else{
      document.getElementById("campoRegisterInputEmail").style.boxShadow = "0px 0px 0px red";
    }
  
    if (usuario == "" || /\'/.test(usuario)) {
      document.getElementById("campoRegisterInputUsuario").style.boxShadow = "0px 0px 10px red";
      camposCorrectos = false;
    }else{
      document.getElementById("campoRegisterInputUsuario").style.boxShadow = "0px 0px 0px red";
    }
  
    if (contrasena == "" || /\'/.test(contrasena)) {
      document.getElementById("campoRegisterInputContrasena").style.boxShadow = "0px 0px 10px red";
      camposCorrectos = false;
    }else{
      document.getElementById("campoRegisterInputContrasena").style.boxShadow = "0px 0px 0px red";
    }
  
    if (repetirContrasena == "" || /\'/.test(repetirContrasena)) {
      document.getElementById("campoRegisterInputRepetirContrasena").style.boxShadow = "0px 0px 10px red";
      camposCorrectos = false;
    }else{
      document.getElementById("campoRegisterInputRepetirContrasena").style.boxShadow = "0px 0px 0px red";
    }
  }

  

  if(camposCorrectos){
    var settings = {
      "url": "api/nuevoUsuario",
      "method": "POST",
      "timeout": 0,
      "headers": {
        "Content-Type": "application/x-www-form-urlencoded"
      },
      "data": {
        "nombre": "",
        "apellido1": "",
        "apellido2": "",
        "correoElectronico": ""+email,
        "user": ""+usuario,
        "password": ""+contrasena,
        "admin": "0"
      }
    };
    
    $.ajax(settings).done(function (response) {
      var json = response;
      var resultados=eval(json);

      if (resultados == true) {
        window.location.href = "frontLoginRegister";
      }else{
        document.getElementById("errorRegister").innerHTML = "El nombre de usuario ya esta en uso.";
      }
      
    });
  }
  
}