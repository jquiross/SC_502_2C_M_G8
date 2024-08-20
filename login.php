<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login Page - Dashboard Admin Template</title>
    <!--
    Template 2108 Dashboard
    http://www.tooplate.com/view/2108-dashboard
    -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600">
    <!-- https://fonts.google.com/specimen/Open+Sans -->
    <link rel="stylesheet" href="css/fontawesome.min.css">
    <!-- https://fontawesome.com/ -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- https://getbootstrap.com/ -->
    <link rel="stylesheet" href="css/tooplate.css">
    <style>
        .btn-yellow {
            background-color: #f7c11f;
            color: #000;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 16px;
            text-decoration: none;
        }

        .btn-yellow:hover {
            background-color: #e6b800;
            color: #fff;
        }

        .btn-container {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>

<body class="bg03">
    <div class="container">
        <div class="row tm-mt-big">
            <div class="col-12 mx-auto tm-login-col">
                <div class="bg-white tm-block">
                    <div class="row">
                        <div class="col-12 text-center">
                            <i class="fas fa-3x fa-tachometer-alt tm-site-icon text-center"></i>
                            <h2 class="tm-block-title mt-3">Iniciar Sesión</h2>
                            <?php
                            if (isset($_GET['mensaje']) && $_GET['mensaje'] == 'success') {
                                echo '<div class="alert alert-success" role="alert">¡Registro exitoso! Ahora puedes iniciar sesión.</div>';
                            }
                            include("./config/conexion.php");
                            include("./controllers/controllerLogin.php");
                            ?>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-12">
                            <form action="" method="post" class="tm-login-form">
                                <div class="input-group">
                                    <label for="nombre_usuario" class="col-xl-4 col-lg-4 col-md-4 col-sm-5 col-form-label">Usuario</label>
                                    <input name="nombre_usuario" type="text" class="form-control validate col-xl-9 col-lg-8 col-md-8 col-sm-7" id="nombre_usuario">
                                </div>
                                <div class="input-group mt-3">
                                    <label for="contraseña" class="col-xl-4 col-lg-4 col-md-4 col-sm-5 col-form-label">Contraseña</label>
                                    <input name="contraseña" type="password" class="form-control validate" id="contraseña">
                                </div>
                                <div class="input-group mt-3">
                                    <button name="btningresar" type="submit" class="btn btn-primary d-inline-block mx-auto">Iniciar Sesión</button>
                                </div>
                                <div class="text-center mt-3">
                                    <p class="mb-0">¿No tienes cuenta? <a href="register.php">Regístrate aquí</a></p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Botón de redireccionamiento fuera del card de inicio de sesión -->
        <div class="btn-container">
            <a href="index.php" class="btn-yellow">Volver al Inicio</a>
        </div>
    </div>
</body>

</html>