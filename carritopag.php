<?php

include("./controllers/controllerCarrito.php");
// Obtener los productos del carrito
$cartItems = obtenerProductosEnCarrito();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <style>
        .carrito-actions {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .carrito-actions form {
            margin: 0;
            display: flex;
            align-items: center;
        }

        .carrito-actions input[type="number"] {
            width: 60px;
            text-align: center;
            border: 1px solid #ced4da;
            border-radius: 4px;
            padding: 5px;
            margin-right: 10px;
        }

        .carrito-actions button {
            padding: 6px 12px;
            font-size: 0.875rem;
            border-radius: 4px;
        }

        .carrito-actions .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            color: #fff;
        }

        .carrito-actions .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }

        .carrito-actions .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
            color: #fff;
        }

        .carrito-actions .btn-danger:hover {
            background-color: #c82333;
            border-color: #bd2130;
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
                    <li class="nav-item"><a class="nav-link active" href="info.php"
                            style="font-size: 1.1rem; color: #2e2b27;">Info</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle active" id="navbarDropdown" href="#" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false"
                            style="font-size: 1.1rem; color: #2e2b27;">Tienda</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown"
                            style="background-color: #9B8B5C; color: #2e2b27;">
                            <li><a class="dropdown-item" href="productos.php">Productos en Stock</a></li>
                            <li>
                                <hr class="dropdown-divider" />
                            </li>
                            <li><a class="dropdown-item" href="mas-vendidos.php">Más Vendido</a></li>
                            <li><a class="dropdown-item" href="nuevos.php">Nuevo en Stock</a></li>
                        </ul>
                    </li>
                </ul>
                <form class="d-flex">
                    <a href="carrito.php" class="btn" style="color: #2e2b27; border-color: #2e2b27;">
                        <i class="bi-cart-fill me-1" style="color: #2e2b27;"></i>
                        Carrito
                        <span class="badge text-white ms-1 rounded-pill" style="background-color: #2e2b27;">
                            <?php echo obtenerCantidadEnCarrito(); ?>
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
    <!-- Cart Section-->
    <section class="py-5">
        <div class="container px-4 px-lg-5">
            <h2 class="fw-bolder">Tu Carrito</h2>
            <?php if (empty($cartItems)): ?>
                <p>Tu carrito está vacío.</p>
            <?php else: ?>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Precio</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($cartItems as $item): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($item['nombre_producto']); ?></td>
                                <td>
                                    <div class="carrito-actions">
                                        <form class="actualizar-carrito" method="post"
                                            action="controllers/controllerCarrito.php">
                                            <input type="number" name="cantidad"
                                                value="<?php echo htmlspecialchars($item['cantidad']); ?>" min="1">
                                            <input type="hidden" name="producto_id" value="<?php echo $item['producto_id']; ?>">
                                            <input type="hidden" name="action" value="actualizar">
                                            <button type="submit" class="btn btn-primary btn-sm">
                                                <i class="bi bi-arrow-repeat"></i> Actualizar
                                            </button>
                                        </form>

                                        <form class="eliminar-carrito" method="post" action="controllers/controllerCarrito.php">
                                            <input type="hidden" name="producto_id" value="<?php echo $item['producto_id']; ?>">
                                            <input type="hidden" name="action" value="eliminar">
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="bi bi-trash"></i> Eliminar
                                            </button>
                                        </form>
                                    </div>
                                </td>
                                <td>$<?php echo htmlspecialchars($item['precio']); ?></td>
                                <td>$<?php echo htmlspecialchars($item['total']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>


                    <tfoot>
                        <tr>
                            <td colspan="3" class="text-end"><strong>Total:</strong></td>
                            <td>
                                $<?php echo array_sum(array_column($cartItems, 'total')); ?>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            <?php endif; ?>
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="js/scripts.js"></script>
</body>

</html>