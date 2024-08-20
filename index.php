<?php

include("./config/conexion.php");
include("./controllers/controllerProductos.php");
include("./controllers/controllerCarrito.php");

$categoria_seleccionada = isset($_GET['categoria_id']) ? $_GET['categoria_id'] : null;
$products = obtenerProductos($categoria_seleccionada);
$items_en_carrito = obtenerCantidadEnCarrito();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
    <style>
        .category-link {
            display: inline-block;
            margin: 0 10px;
            padding: 10px 15px;
            text-decoration: none;
            color: #2e2b27;
            border: 1px solid transparent;
            border-radius: 20px;
            font-weight: bold;
            transition: background-color 0.3s, color 0.3s;
        }

        .category-link:hover {
            background-color: #9B8B5C;
            color: #fff;
        }

        .category-link.active {
            background-color: #2e2b27;
            color: #fff;
        }
    </style>
</head>

<body>
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container px-4 px-lg-5">
            <a class="navbar-brand" href="index.php" style="color: #2e2b27;">El Tapis</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="index.php"
                            style="font-size: 1.1rem; color: #2e2b27;">Inicio</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle active" id="navbarDropdown" href="#" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false"
                            style="font-size: 1.1rem; color: #2e2b27;">Tienda</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown"
                            style="background-color: #9B8B5C; color: #2e2b27;">
                            <li><a class="dropdown-item" href="#!">Productos en Stock</a></li>
                            <li>
                                <hr class="dropdown-divider" />
                            </li>
                            <li><a class="dropdown-item" href="#!">Más Vendido</a></li>
                            <li><a class="dropdown-item" href="#!">Nuevo en Stock</a></li>
                        </ul>
                    </li>
                </ul>
                <form class="d-flex">
                    <a href="carritopag.php" class="btn" style="color: #2e2b27; border-color: #2e2b27;">
                        <i class="bi-cart-fill me-1" style="color: #2e2b27;"></i>
                        Carrito
                        <span id="cantidadCarrito" class="badge text-white ms-1 rounded-pill"
                            style="background-color: #2e2b27;">
                            <?php echo $items_en_carrito; ?>
                        </span>
                    </a>
                    <a href="login.php" class="btn" style="color: #2e2b27; border-color: #2e2b27;">
                        <i class="bi-box-arrow-right me-1" style="color: #2e2b27;"></i>
                        Iniciar Sesión
                    </a>
                </form>
            </div>
        </div>
    </nav>
    <!-- Header-->
    <header class="bg py-5" style="background-color: #332F24;">
        <div class="container px-4 px-lg-5 my-5">
            <div class="text-center text-white">
                <h1 class="display-4 fw-bolder" style="color: #9B8B5C;">Tienda "El Tapis"</h1>
                <p class="lead fw-normal text-white-50 mb-0">Su Tienda de Confianza</p>
            </div>
        </div>
    </header>
    <!-- Categories Section -->
    <section class="py-3">
        <div class="container px-4 px-lg-5">
            <div class="row">
                <div class="col text-center">
                    <a href="index.php?categoria_id=1"
                        class="category-link <?php echo $categoria_seleccionada == 1 ? 'active' : ''; ?>">Vinos</a>
                    <a href="index.php?categoria_id=2"
                        class="category-link <?php echo $categoria_seleccionada == 2 ? 'active' : ''; ?>">Bebidas
                        Alcohólicas de Alta Gama</a>
                    <a href="index.php?categoria_id=3"
                        class="category-link <?php echo $categoria_seleccionada == 3 ? 'active' : ''; ?>">Cerveza
                        Nacional</a>
                </div>
            </div>
        </div>
    </section>
    <!-- Sección de productos -->
    <section class="py-5">
        <div class="container px-4 px-lg-5 mt-5">
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                <?php foreach ($products as $product): ?>
                    <div class="col mb-5">
                        <div class="card h-100">
                            <!-- Imagen del producto -->
                            <img class="card-img-top" src="<?php echo $product['img_ruta']; ?>" alt="..." />
                            <!-- Detalles del producto -->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Nombre del producto -->
                                    <h5 class="fw-bolder"><?php echo $product['nombre_producto']; ?></h5>
                                    <!-- Precio del producto -->
                                    <?php if ($product['descuento'] > 0): ?>
                                        <span
                                            class="text-muted text-decoration-line-through">$<?php echo $product['precio']; ?></span>
                                        $<?php echo $product['precio'] - $product['descuento']; ?>
                                    <?php else: ?>
                                        $<?php echo $product['precio']; ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <!-- Acciones del producto -->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center">
                                    <button type="button" class="btn btn-outline-dark mt-auto"
                                        onclick="agregarAlCarrito(<?php echo $product['producto_id']; ?>, 1)">Añadir al
                                        Carrito</button>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Footer-->
    <footer class="py-5" style="background-color: #332F24;">
        <div class="container">
            <p class="m-0 text-center text-white">Copyright &copy; El Tapis 2024</p>
        </div>
    </footer>
    <a href="http://wa.link/at86om" class="whatsapp-button" target="_blank">
        <img src="https://upload.wikimedia.org/wikipedia/commons/6/6b/WhatsApp.svg" alt="WhatsApp">
    </a>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
</body>

</html>