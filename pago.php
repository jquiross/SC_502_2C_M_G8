<?php
include("./config/conexion.php");
include("./controllers/controllerCarrito.php");

// Obtener los productos del carrito
$cartItems = obtenerProductosEnCarrito();

// Calcular el total
$total = array_sum(array_column($cartItems, 'total'));

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Captura el valor del total enviado desde el carrito
    $total = isset($_POST['total']) ? $_POST['total'] : 0;

    // Aquí iría el resto de la lógica de procesamiento si es necesario
}
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

    <div class="container">
        <h2 class="mt-5">Formulario de Pago</h2>
        <form method="post" action="controllers/controllerCarrito.php">
            <input type="hidden" name="action" value="procesar_pedido">
            <input type="hidden" name="total" value="<?php echo $total; ?>">
            <div class="mb-3">
                <label for="nombre_usuario" class="form-label">Usuaio de Cliente</label>
                <input type="text" class="form-control" id="nombre_usuario" name="nombre_usuario" required>
            </div>
            <div class="mb-3">
                <label for="fecha_pedido" class="form-label">Fecha de Pedido</label>
                <input type="datetime-local" class="form-control" id="fecha_pedido" name="fecha_pedido" required>
            </div>
            <div class="mb-3">
                <label for="total" class="form-label">Total</label>
                <input type="text" class="form-control" id="total" name="total" value="<?php echo $total; ?>" readonly>
            </div>
            <button type="submit" class="btn btn-primary">Confirmar Pedido</button>
        </form>
    </div>

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
        window.addEventListener('mouseover', initLandbot, {
            once: true
        });
        window.addEventListener('touchstart', initLandbot, {
            once: true
        });
        var myLandbot;

        function initLandbot() {
            if (!myLandbot) {
                var s = document.createElement('script');
                s.type = 'text/javascript';
                s.async = true;
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