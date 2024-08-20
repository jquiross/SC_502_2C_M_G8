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

        footer {
            background-color: black;
            position: absolute;
            bottom: 0;
            width: 100%;
            height: 40px;
            color: white;
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
                    <li class="nav-item"><a class="nav-link active" href="aboutus.php"
                            style="font-size: 1.1rem; color: #2e2b27;">Sobre Nosotros</a></li>
                </ul>
                <form class="d-flex">
                    <a href="carritopag.php" class="btn" style="color: #2e2b27; border-color: #2e2b27;">
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
                <!-- Botón de Pagar -->
                <div class="text-end">
                    <form method="post" action="pago.php">
                        <input type="hidden" name="total"
                            value="<?php echo array_sum(array_column($cartItems, 'total')); ?>">
                        <a href="/SC_502_2C_M_G8/pago.php" type="submit" class="btn btn-success btn-lg">Pagar</a>
                    </form>
                </div>
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
    <script>
        window.addEventListener('mouseover', initLandbot, { once: true });
        window.addEventListener('touchstart', initLandbot, { once: true });
        var myLandbot;
        function initLandbot() {
            if (!myLandbot) {
                var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true;
                s.addEventListener('load', function () {
                    var myLandbot = new Landbot.Livechat({
                        configUrl: 'https://storage.googleapis.com/landbot.online/v3/H-2561965-Y9QK9150RGYNFQ92/index.json',
                    });
                });
                s.src = 'https://cdn.landbot.io/landbot-3/landbot-3.0.0.js';
                var x = document.getElementsByTagName('script')[0];
                x.parentNode.insertBefore(s, x);
            }
        }
    </script>
</body>

</html>