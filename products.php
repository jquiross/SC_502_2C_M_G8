<?php
require_once './config/conexion.php'; // Incluye el archivo de conexión a la base de datos
require_once './models/ProductoModel.php'; // Incluye el modelo de productos
require_once './controllers/controllerProductos.php'; // Incluye el controlador de productos

// Crear una instancia del modelo
$model = new ProductModel($conexion);
$controller = new ProductController($conexion);

// Verificar si se ha solicitado eliminar un producto
if (isset($_GET['delete'])) {
    $productId = intval($_GET['delete']);
    $controller->deleteProduct($productId);
}

// Obtener productos para mostrar
$products = $model->getProductsWithCategories();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600">
    <!-- https://fonts.google.com/specimen/Open+Sans -->
    <link rel="stylesheet" href="css/fontawesome.min.css">
    <!-- https://fontawesome.com/ -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- https://getbootstrap.com/ -->
    <link rel="stylesheet" href="css/tooplate.css">
    <title>Productos</title>
</head>

<body id="reportsPage" class="bg02">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="navbar navbar-expand-xl navbar-light bg-light">
                    <a class="navbar-brand" href="indexDashBoard.php">
                        <i class="fas fa-3x fa-tachometer-alt tm-site-icon"></i>
                        <h1 class="tm-site-title mb-0">Dashboard</h1>
                    </a>
                    <button class="navbar-toggler ml-auto mr-0" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
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
        <div class="container">
            <div class="row tm-content-row tm-mt-big justify-content-center">
                <div class="col-xl-8 col-lg-12 tm-md-12 tm-sm-12 tm-col">
                    <div class="bg-white tm-block h-100">
                        <div class="row">
                            <div class="col-md-8 col-sm-12">
                                <h2 class="tm-block-title d-inline-block">Productos</h2>
                            </div>
                            <div class="col-md-4 col-sm-12 text-right">
                                <a href="add-product.php" class="btn btn-small btn-primary">Añadir Producto</a>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover table-striped tm-table-striped-even mt-3">
                                <thead>
                                    <tr class="tm-bg-gray">
                                        <th scope="col">Nombre del Producto</th>
                                        <th scope="col" class="text-center">Unidades Agotadas</th>
                                        <th scope="col" class="text-center">En Stock</th>
                                        <th scope="col">Precio Por Unidad</th>
                                        <th scope="col">&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (isset($products) && $products->num_rows > 0): ?>
                                        <?php while ($row = $products->fetch_assoc()): ?>
                                            <tr>
                                                <td class="tm-product-name">
                                                    <?php echo htmlspecialchars($row['nombre_producto']); ?>
                                                </td>
                                                <td class="text-center">
                                                    <?php echo htmlspecialchars($row['stock'] - $row['descuento']); ?>
                                                </td>
                                                <td class="text-center"><?php echo htmlspecialchars($row['stock']); ?></td>
                                                <td><?php echo htmlspecialchars($row['precio']); ?></td>
                                                <td>
                                                    <a href="?delete=<?php echo $row['producto_id']; ?>"
                                                        class="fas fa-trash-alt tm-trash-icon"
                                                        onclick="return confirm('¿Estás seguro de que deseas eliminar este producto?');"></a>
                                                </td>
                                            </tr>
                                        <?php endwhile; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="5" class="text-center">No hay productos disponibles.</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- end row -->
    </div>
    </div>
    </div>
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script>
        $(function () {
            $('.tm-product-name').on('click', function () {
                window.location.href = "edit-product.html";
            });
        });
    </script>
</body>

</html>