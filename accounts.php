<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
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
</head>

<body class="bg03">
    <div class="container">
        <div class="col-12">
            <nav class="navbar navbar-expand-xl navbar-light bg-light">
                <a class="navbar-brand" href="indexDashBoard.php">
                    <i class="fas fa-3x fa-tachometer-alt tm-site-icon"></i>
                    <h1 class="tm-site-title mb-0">Dashboard</h1>
                </a>
                <button class="navbar-toggler ml-auto mr-0" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
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
    </div>
    <!-- row -->
    <div class="row tm-content-row tm-mt-big">
                    <div class="col-xl-7 col-lg-12 tm-md-12 tm-sm-12 tm-col">
            <div class="bg-white tm-block">
                <div class="row">
                    <div class="col-12">
                        <h2 class="tm-block-title d-inline-block">Cuentas</h2>
                    </div>
                </div>
                <ol class="tm-list-group tm-list-group-alternate-color tm-list-group-pad-big">
                    <li class="tm-list-group-item">
                        Donec eget libero
                    </li>
                    <li class="tm-list-group-item">
                        Nunc luctus suscipit elementum
                    </li>
                    <li class="tm-list-group-item">
                        Maecenas eu justo maximus
                    </li>
                    <li class="tm-list-group-item">
                        Pellentesque auctor urna nunc
                    </li>
                    <li class="tm-list-group-item">
                        Sit amet aliquam lorem efficitur
                    </li>
                    <li class="tm-list-group-item">
                        Pellentesque auctor urna nunc
                    </li>
                    <li class="tm-list-group-item">
                        Sit amet aliquam lorem efficitur
                    </li>
                </ol>
            </div>
        </div>
        <div class="tm-col tm-col-big">
            <div class="bg-white tm-block">
                <div class="row">
                    <div class="col-12">
                        <h2 class="tm-block-title">Editar Cuenta</h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <form action="" class="tm-signup-form">
                            <div class="form-group">
                                <label for="name">Nombre de la Cuenta</label>
                                <input placeholder="Vulputate Eleifend Nulla" id="name" name="name" type="text" class="form-control validate">
                            </div>
                            <div class="form-group">
                                <label for="email">Email de la Cuenta</label>
                                <input placeholder="vulputate@eleifend.co" id="email" name="email" type="email" class="form-control validate">
                            </div>
                            <div class="form-group">
                                <label for="password">Contraseña</label>
                                <input placeholder="******" id="password" name="password" type="password" class="form-control validate">
                            </div>
                            <div class="form-group">
                                <label for="password2">Ingrese Nuevamente la Contraseña</label>
                                <input placeholder="******" id="password2" name="password2" type="password" class="form-control validate">
                            </div>
                            <div class="form-group">
                                <label for="phone">Teléfono</label>
                                <input placeholder="010-030-0440" id="phone" name="phone" type="tel" class="form-control validate">
                            </div>
                            <div class="row">
                                <div class="col-12 col-sm-4">
                                    <button type="submit" class="btn btn-primary">Actualizar
                                    </button>
                                </div>
                                <div class="col-12 col-sm-8 tm-btn-right">
                                    <button type="submit" class="btn btn-danger">Eliminar Cuenta
                                    </button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <script src="js/jquery-3.3.1.min.js"></script>
    <!-- https://jquery.com/download/ -->
    <script src="js/bootstrap.min.js"></script>
    <!-- https://getbootstrap.com/ -->
</body>

</html>