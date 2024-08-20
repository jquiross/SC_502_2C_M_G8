<?php
include("./config/conexion.php");

function obtenerProductos($categoria_id = null) {
    global $conexion;


    if ($categoria_id) {
        $stmt = $conexion->prepare("SELECT producto_id,nombre_producto, descripcion, precio, descuento, stock, img_ruta FROM Productos WHERE categoria_id = ?");
        $stmt->bind_param("i", $categoria_id);
    } else {
        $stmt = $conexion->prepare("SELECT producto_id,nombre_producto, descripcion, precio, descuento, stock, img_ruta FROM Productos");
    }
    
    $stmt->execute();
    $result = $stmt->get_result();

    $products = [];
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }

    $stmt->close();
    return $products;
}
?>