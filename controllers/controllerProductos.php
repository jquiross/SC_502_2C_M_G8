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
=======
//conexion a bd
include("./config/conexion.php");

//se crea una clase para que el manejo sea mas facil
class controllerProductos {
    //se hace la funcion de la consulta
    public function getProducts() {
        global $conexion;
        $stmt = $conexion->prepare("SELECT nombre_producto, descripcion, precio, descuento, img_ruta FROM Productos");
        $stmt->execute();
        $result = $stmt->get_result();

        $products = [];
        while ($row = $result->fetch_assoc()) {
            $products[] = $row;
        }

        $stmt->close();
        return $products;
    }

}
?>
