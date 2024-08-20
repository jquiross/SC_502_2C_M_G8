<?php
session_start();

include(__DIR__ . "/../config/conexion.php");

function agregarAlCarrito($producto_id, $cantidad) {
    if (!isset($_SESSION['carrito'])) {
        $_SESSION['carrito'] = [];
    }

    if (isset($_SESSION['carrito'][$producto_id])) {
        $_SESSION['carrito'][$producto_id]['cantidad'] += $cantidad;
    } else {
        $_SESSION['carrito'][$producto_id] = [
            'cantidad' => $cantidad,
        ];
    }
}

// Función para obtener la cantidad total de ítems en el carrito
function obtenerCantidadEnCarrito() {
    $totalItems = 0;
    if (isset($_SESSION['carrito'])) {
        foreach ($_SESSION['carrito'] as $producto) {
            $totalItems += $producto['cantidad'];
        }
    }
    return $totalItems;
}

// Función para obtener los productos en el carrito desde la base de datos
function obtenerProductosEnCarrito() {
    global $conexion;

    if (!isset($_SESSION['carrito']) || empty($_SESSION['carrito'])) {
        return [];
    }

    $productosEnCarrito = [];
    foreach ($_SESSION['carrito'] as $producto_id => $detalles) {
        $sql = "SELECT nombre_producto, precio FROM productos WHERE producto_id = ?";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("i", $producto_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $producto = $result->fetch_assoc();
            $producto['cantidad'] = $detalles['cantidad'];
            $producto['total'] = $producto['precio'] * $producto['cantidad'];
            $producto['producto_id'] = $producto_id; // Asegúrate de que el ID del producto esté disponible
            $productosEnCarrito[] = $producto;
        }
        $stmt->close();
    }

    return $productosEnCarrito;
}

// Lógica de manejo del carrito en base a las solicitudes
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['producto_id'])) {
        if (isset($_POST['action']) && $_POST['action'] === 'actualizar') {
            actualizarCantidadEnCarrito($_POST['producto_id'], (int)$_POST['cantidad']);
        } else if (isset($_POST['action']) && $_POST['action'] === 'eliminar') {
            eliminarDelCarrito($_POST['producto_id']);
        } else {
            agregarAlCarrito($_POST['producto_id'], (int)$_POST['cantidad']);
        }
        echo obtenerCantidadEnCarrito();  // Devuelve la cantidad actualizada de ítems
        exit();
    }
}



// Función para actualizar la cantidad de un producto en el carrito
function actualizarCantidadEnCarrito($producto_id, $nuevaCantidad) {
    if (isset($_SESSION['carrito'][$producto_id])) {
        if ($nuevaCantidad > 0) {
            $_SESSION['carrito'][$producto_id]['cantidad'] = $nuevaCantidad;
        } else {
            eliminarDelCarrito($producto_id);
        }
    }
}

// Función para eliminar un producto del carrito
function eliminarDelCarrito($producto_id) {
    if (isset($_SESSION['carrito'][$producto_id])) {
        unset($_SESSION['carrito'][$producto_id]);
    }
}



?>