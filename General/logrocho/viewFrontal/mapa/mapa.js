window.onload = function () {
  Console.error = () =>{};
  comprobarUsuarioLogueado();
  pintarBaresMapa();
};

function comprobarUsuarioLogueado() {
  var settings = {
    url: "api/getUsuarioLogueado",
    method: "GET",
    timeout: 0,
    headers: {},
  };

  $.ajax(settings).done(function (response) {
    var json = response;
    var resultados = eval(json);

    if (resultados == false) {
      document.getElementById("contenedorBtnLogin").innerHTML =
        '<a id="btnLogin" href="frontLoginRegister">👤 Login/Register</a>';
    } else {
      document.getElementById("contenedorBtnLogin").innerHTML =
        '<a id="btnLogin" href="infoPersonal">👤 ' +
        resultados["user"] +
        "</a>";
      document.getElementById("contenedorBtnLogin").innerHTML +=
        '<a onclick="logout()"  id="btnLogout">Logout</a>';
    }
  });
}

function pintarBaresMapa() {
  var settings = {
    url: "api/getFullRestaurantes",
    method: "GET",
    timeout: 0,
    headers: {},
  };

  $.ajax(settings).done(function (response) {
    var json = response;
    var resultados = eval(json);

    var mymap = L.map("contenedorMapa").setView(
      [42.46559459356974, -2.4483092241897157],
      18
    );

    let mapLink = '<a href="http://openstreetmap.org/%22%3EOpenStreetMap"';

    L.tileLayer("http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
      attribution: "Map data &copy; " + mapLink,
      maxZoom: 18,
    }).addTo(mymap);

    var marker;

    resultados["bares"].forEach((bar) => {
      marker = L.marker([
        parseFloat(bar["latitud"]),
        parseFloat(bar["longitud"])
      ]);
      marker.addEventListener("click",() => {
        window.location = "barFront?id="+bar["idRestaurante"];
      });
      
      marker.addTo(mymap);
    });
  });
}

function logout() {
  var settings = {
    url: "api/logout",
    method: "GET",
    timeout: 0,
    headers: {},
  };

  $.ajax(settings).done(function (response) {
    window.location.href = "home";
  });
}
