<?php

include 'config/conexion.php';
include 'models/ProductModel.php';

//Funcion para agarrar los datos del producto y agregarlos

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['name'];
    $descripcion = $_POST['description'];
    $precio = $_POST['price'];
    $descuento = $_POST['discount'];
    $categoria_id = $_POST['category'];
    $proveedor_id = $_POST['provider'];
    $stock = $_POST['stock'];
    $img_ruta = ''; // Asignar ruta predeterminada o manejar subida de archivo

    if (!empty($_FILES['img_ruta']['name'])) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["img_ruta"]["name"]);
        if (move_uploaded_file($_FILES["img_ruta"]["tmp_name"], $target_file)) {
            $img_ruta = $target_file;
        } else {
            echo "Error al subir la imagen.";
            exit;
        }
    }

    $model = new ProductModel($conexion);
    if ($model->agregarProducto($nombre, $descripcion, $precio, $descuento, $categoria_id, $proveedor_id, $stock, $img_ruta)) {
        header('Location: products.php'); // Redirige a la página de productos
    } else {
        echo "Error al agregar el producto.";
    }
}
?>