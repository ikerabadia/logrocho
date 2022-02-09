<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../../../logrocho/view/login/login.css" />
    <title>Login Logrocho</title>
</head>

<body>
    <div class="content">
        <div class="container tituloAdministracion">
            <h2 class="text-white">
                PAGINA DE <br>ADMINISTRACION<br> DE LOGROCHO
            </h2>
        </div>
        <div class="contenedorLogin">
            <a class="btn btn-secondary btnPaginaPrincipal" href="">🢀 Ir a la página principal</a>
            <div class="login card">
                <form action=<?php echo UserController::getRuta("loginRespuesta","login") ?> method="POST">
                    <h1 class="h3 mb-3 fw-normal">Acceso a la zona de administración</h1>

                    <div class="form-floating">
                        <input type="text" class="form-control" id="floatingInput" placeholder="username" name="user">
                        <label for="floatingInput">Usuario</label>
                    </div>
                    <div class="form-floating">
                        <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="password">
                        <label for="floatingPassword">Contraseña</label>
                    </div>

                    <div class="checkbox mb-3">
                        <label>
                            <input type="checkbox" value="remember-me"> Recuerdame
                        </label>
                    </div>
                    <small class="loginIncorrecto"> <?php 
                        if (isset($_SESSION["login"])) {
                            $mensaje = $_SESSION["login"];
                            echo "$mensaje<br>";
                        }
                    ?></small>
                    <button class="w-100 btn btn-lg btn-primary" type="submit">Acceder</button>
                    <a href="">He olvidado la contraseña</a>
                    <p class="mt-5 mb-3 text-muted">© 2022</p>
                </form>
            </div>
        </div>        
    </div>
</body>

</html>