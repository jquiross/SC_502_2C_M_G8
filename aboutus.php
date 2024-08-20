<?php

include("./config/conexion.php");
include("./controllers/controllerCarrito.php");

$items_en_carrito = obtenerCantidadEnCarrito();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="Sobre Nosotros - El Tapis" />
    <meta name="author" content="" />
    <title>Sobre Nosotros - El Tapis</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
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
                    <li class="nav-item"><a class="nav-link active" href="aboutus.html"
                            style="font-size: 1.1rem; color: #2e2b27;">Sobre Nosotros</a></li>
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
                <h1 class="display-4 fw-bolder" style="color: #9B8B5C;">Sobre Nosotros</h1>
                <p class="lead fw-normal text-white-50 mb-0">Conozca más sobre El Tapis</p>
            </div>
        </div>
    </header>
    <!-- Section-->
    <section class="py-5">
        <div class="container px-4 px-lg-5 mt-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-lg-8">
                    <p class="mb-4">
                        Bienvenidos a <strong>El Tapis</strong>, su mejor opción para encontrar los más finos licores
                        nacionales e internacionales. Nuestra empresa se dedica a ofrecer una amplia selección de
                        bebidas de alta calidad para satisfacer los gustos más exigentes.
                    </p>
                    <p class="mb-4">
                        En <strong>El Tapis</strong>, nos enorgullece brindar un servicio al cliente excepcional.
                        Nuestro equipo está siempre atento y dispuesto a ayudarle con cualquier pregunta o necesidad que
                        pueda tener. Nos comprometemos a garantizar que cada uno de nuestros clientes tenga una
                        experiencia de compra satisfactoria y placentera.
                    </p>
                    <p class="mb-4">
                        Ya sea que esté buscando una botella de su licor favorito o explorando nuevas opciones, estamos
                        aquí para ayudarle. No dude en ponerse en contacto con nosotros en cualquier momento. Estamos
                        disponibles para cualquier tipo de consulta o asistencia.
                    </p>
                    <p class="mb-4">
                        Gracias por elegir <strong>El Tapis</strong>. Esperamos servirle pronto.
                    </p>
                </div>
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