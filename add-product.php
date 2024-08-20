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
    <link rel="stylesheet" href="jquery-ui-datepicker/jquery-ui.min.css" type="text/css" />
    <!-- http://api.jqueryui.com/datepicker/ -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- https://getbootstrap.com/ -->
    <link rel="stylesheet" href="css/tooplate.css">
</head>

<body class="bg02">
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
    </div>
    <!-- row -->
    <div class="row tm-mt-big justify-content-center">
        <div class="col-xl-6 col-lg-8 col-md-10 col-sm-12">
            <div class="bg-white tm-block p-3 rounded shadow-sm">
                <div class="row mb-3">
                    <div class="col-12">
                        <h2 class="tm-block-title d-inline-block mb-3">Añadir Producto</h2>
                    </div>
                </div>
                <div class="row tm-edit-product-row">
                    <div class="col-12">
                        <form action="controllerProduct.php" method="POST" class="tm-edit-product-form">
                            <div class="form-group mb-2">
                                <label for="name" class="form-label">Nombre del Producto</label>
                                <input id="name" name="name" type="text" class="form-control validate"
                                    placeholder="Nombre del producto" required>
                            </div>
                            <div class="form-group mb-2">
                                <label for="description" class="form-label">Descripción</label>
                                <textarea id="description" name="description" class="form-control validate" rows="2"
                                    placeholder="Descripción del producto" required></textarea>
                            </div>
                            <div class="form-group mb-2">
                                <label for="price" class="form-label">Precio</label>
                                <input id="price" name="price" type="number" step="0.01" class="form-control validate"
                                    placeholder="Precio del producto" required>
                            </div>
                            <div class="form-group mb-2">
                                <label for="discount" class="form-label">Descuento</label>
                                <input id="discount" name="discount" type="number" step="0.01"
                                    class="form-control validate" placeholder="Descuento aplicado" required>
                            </div>
                            <div class="form-group mb-2">
                                <label for="category" class="form-label">Categoría</label>
                                <select class="form-select" id="category" name="category" required>
                                    <option value="" disabled selected>Seleccione una categoría</option>
                                    <?php
                                    include 'config/conexion.php';
                                    $query = "SELECT * FROM Categorías";
                                    $result = $conexion->query($query);
                                    if (!$result) {
                                        die('Error en la consulta: ' . $conexion->error);
                                    }
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<option value='{$row['categoria_id']}'>{$row['nombre_categoria']}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group mb-2">
                                <label for="provider" class="form-label">Proveedor</label>
                                <select class="form-select" id="provider" name="provider" required>
                                    <option value="" disabled selected>Seleccione un proveedor</option>
                                    <?php
                                    include 'config/conexion.php';
                                    $query = "SELECT * FROM Proveedores";
                                    $result = $conexion->query($query);
                                    if (!$result) {
                                        die('Error en la consulta: ' . $conexion->error);
                                    }
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<option value='{$row['proveedor_id']}'>{$row['nombre']}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group mb-2">
                                <label for="stock" class="form-label">Unidades en Stock</label>
                                <input id="stock" name="stock" type="number" class="form-control validate"
                                    placeholder="Unidades en stock" required>
                            </div>
                            <div class="form-group mb-2">
                                <label for="img_ruta" class="form-label">URL de la Imagen</label>
                                <input id="img_ruta" name="img_ruta" type="text" class="form-control"
                                    placeholder="URL de la imagen" required>
                            </div>
                            <div class="form-group text-center mt-3">
                                <button type="submit" class="btn btn-primary">Añadir</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    </div>

    </div>

    <script src="js/jquery-3.3.1.min.js"></script>
    <!-- https://jquery.com/download/ -->
    <script src="jquery-ui-datepicker/jquery-ui.min.js"></script>
    <!-- https://jqueryui.com/download/ -->
    <script src="js/bootstrap.min.js"></script>
    <!-- https://getbootstrap.com/ -->
    <script>
        $(function () {
            $('#expire_date').datepicker();
        });
    </script>
</body>

</html>