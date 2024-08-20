<?php

include_once("./config/conexion.php");
include_once("./models/ProductoModel.php");

class ProductoControllerDash {
    private $productoModel;

    public function __construct($productoModel) {
        $this->productoModel = $productoModel;
    }

    public function mostrarProductos() {
        $productos = $this->productoModel->obtenerProductos();
        include '../views/products.php'; // Asegúrate de que esta ruta sea correcta
    }
}

function getAllProducts() {
    global $conexion; 
    $productoModel = new ProductoModel($conexion);
    return $productoModel->obtenerProductos();
}

?>