<?php
session_start();
include("./config/conexion.php");
include("./controllers/controllerProductos.php");

$controllerProductos = new controllerProductos();
$products = $controllerProductos->getProducts();

// Inicializamos el carrito si no existe
if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = [];
}

// Añadimos productos al carrito
if (isset($_POST['add_to_cart'])) {
    $product_id = $_POST['product_id'];
    $found = false;

    // Comprobamos si el producto ya está en el carrito
    foreach ($_SESSION['carrito'] as &$item) {
        if ($item['id'] == $product_id) {
            $item['quantity'] += 1;
            $found = true;
            break;
        }
    }

    // Si no está, lo añadimos al carrito
    if (!$found) {
        $_SESSION['carrito'][] = ['id' => $product_id, 'quantity' => 1];
    }

    // Redirigimos para evitar reenvíos de formulario
    header("Location: index.php");
    exit;
}

// Contamos el número de artículos en el carrito
$total_items_in_cart = 0;
foreach ($_SESSION['carrito'] as $item) {
    $total_items_in_cart += $item['quantity'];
}
?>