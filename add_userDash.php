<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600">
    <link rel="stylesheet" href="css/fontawesome.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/tooplate.css">

    <?php
    include_once("./config/conexion.php");
    include_once("./models/UserModel.php");

    // Manejar la adición si se recibe un formulario POST
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nombre = $_POST['nombre'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $rol_id = $_POST['rol_id'];

        $userModel = new UserModel($conexion);
        $success = $userModel->agregarUsuario($nombre, $email, $password, $rol_id);

        if ($success) {
            header("Location: accounts.php"); // Redirigir después de agregar
            exit();
        } else {
            $error = "No se pudo agregar el usuario.";
        }
    }
    ?>
</head>

<body class="bg03">
    <div class="container">
        <div class="col-12">
            <nav class="navbar navbar-expand-xl navbar-light bg-light">
                <a class="navbar-brand" href="indexDashBoard.php">
                    <i class="fas fa-3x fa-tachometer-alt tm-site-icon"></i>
                    <h1 class="tm-site-title mb-0">Dashboard</h1>
                </a>
                <button class="navbar-toggler ml-auto mr-0" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mx-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="products.php">Productos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="accounts.php">Cuentas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="pedidos.php">Pedidos</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link d-flex" href="index.php">
                                <i class="far fa-user mr-2 tm-logout-icon"></i>
                                <span>Cerrar Sesión</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>

        <!-- Formulario de Adición de Usuario -->
        <div class="row tm-content-row tm-mt-big justify-content-center">
            <div class="col-7">
                <div class="bg-white tm-block">
                    <div class="row">
                        <div class="col-12">
                            <h2 class="tm-block-title d-inline-block">Añadir Usuario</h2>
                        </div>
                    </div>
                    <?php if (isset($error)): ?>
                        <div class="alert alert-danger" role="alert">
                            <?= htmlspecialchars($error) ?>
                        </div>
                    <?php endif; ?>
                    <form method="POST" class="tm-signup-form">
                        <div class="form-group">
                            <label for="nombre">Nombre</label>
                            <input id="nombre" name="nombre" type="text" class="form-control validate" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input id="email" name="email" type="email" class="form-control validate" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Contraseña</label>
                            <input id="password" name="password" type="password" class="form-control validate" required>
                        </div>
                        <div class="form-group">
                            <label for="rol_id">Rol ID</label>
                            <input id="rol_id" name="rol_id" type="number" class="form-control validate" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Añadir Usuario</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>

</html>