<?php
session_start();
include("./config/conexion.php");

// Obtener los productos del carrito

$sql = "
    SELECT p.nombre_producto, p.precio, c.cantidad, (p.precio * c.cantidad) AS total
    FROM carrito c
    JOIN productos p ON c.producto_id = p.producto_id
";
$result = $conexion->query($sql);

$cartItems = [];
while ($row = $result->fetch_assoc()) {
    $cartItems[] = $row;
}
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
</head>
<body>
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container px-4 px-lg-5">
            <a class="navbar-brand" href="#!" style="color: #2e2b27;">El Tapis</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="#!" style="font-size: 1.1rem; color: #2e2b27;">Inicio</a></li>
                    <li class="nav-item"><a class="nav-link active" href="#!" style="font-size: 1.1rem; color: #2e2b27;">Info</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle active" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="font-size: 1.1rem; color: #2e2b27;">Tienda</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown" style="background-color: #9B8B5C; color: #2e2b27;">
                            <li><a class="dropdown-item" href="#!">Productos en Stock</a></li>
                            <li><hr class="dropdown-divider" /></li>
                            <li><a class="dropdown-item" href="#!">Más Vendido</a></li>
                            <li><a class="dropdown-item" href="#!">Nuevo en Stock</a></li>
                        </ul>
                    </li>
                </ul>
                <form class="d-flex">
                    <a href="carrito.php" class="btn" style="color: #2e2b27; border-color: #2e2b27;">
                        <i class="bi-cart-fill me-1" style="color: #2e2b27;"></i>
                        Carrito
                        <span class="badge text-white ms-1 rounded-pill" style="background-color: #2e2b27;">
                            <?php echo count($cartItems); ?>
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
                            <td><?php echo htmlspecialchars($item['cantidad']); ?></td>
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
        </div>
    </section>
    <!-- Footer-->
    <footer class="py-5" style="background-color: #332F24;">
        <div class="container" ><p class="m-0 text-center text-white">Copyright &copy; El Tapis 2024</p></div> 
    </footer>
    <a href="http://wa.link/at86om" class="whatsapp-button" target="_blank">
        <img src="https://upload.wikimedia.o
