<?php

require_once(__DIR__ . "/../models/ProductoModel.php");
include(__DIR__ . "/../config/conexion.php");

//Funcion para traer los productos
function obtenerProductos($categoria_id = null) {
    global $conexion;

    if ($categoria_id) {
        $stmt = $conexion->prepare("SELECT producto_id, nombre_producto, descripcion, precio, descuento, stock, img_ruta FROM Productos WHERE categoria_id = ?");
        $stmt->bind_param("i", $categoria_id);
    } else {
        $stmt = $conexion->prepare("SELECT producto_id, nombre_producto, descripcion, precio, descuento, stock, img_ruta FROM Productos");
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

class ProductController {
    private $model;

    public function __construct($conexion) {
        $this->model = new ProductModel($conexion);
    }

    //Funcion para agregar un producto
    public function add($nombre, $descripcion, $precio, $descuento, $stock, $categoria_id, $proveedor_id, $img_ruta) {
        if ($this->model->addProduct($nombre, $descripcion, $precio, $descuento, $stock, $categoria_id, $proveedor_id, $img_ruta)) {
            header("Location: ../products.php"); // Redirige a la lista de productos
            exit(); 
        } else {
            echo "Error al agregar el producto.";
        }
    }
//Funcion para eliminar un producto
    public function deleteProduct($productId) {
        if ($this->model->deleteProduct($productId)) {
            header('Location: ../products.php'); // Redirige de nuevo a la lista de productos
            exit();
        } else {
            echo "Error al eliminar el producto.";
        }
    }
}

// Manejo de la acción recibida
if (isset($_GET['action'])) {
    $controller = new ProductController($conexion);

    if ($_GET['action'] == 'add') {
        // Código para agregar producto
        $nombre = $_POST['name'];
        $descripcion = $_POST['description'];
        $precio = $_POST['price'];
        $descuento = $_POST['discount'];
        $stock = $_POST['stock'];
        $categoria_id = $_POST['category'];
        $proveedor_id = $_POST['provider'];
        $img_ruta = $_POST['img_ruta'];

        $controller->add($nombre, $descripcion, $precio, $descuento, $stock, $categoria_id, $proveedor_id, $img_ruta);
    } if (isset($_GET['action']) && $_GET['action'] == 'delete') {
        $controller = new ProductController($conexion);
        if (isset($_GET['id'])) {
            $productId = intval($_GET['id']);
            $controller->deleteProduct($productId);
        } else {
            echo "ID de producto no proporcionado.";
        }
    }
}
?>
