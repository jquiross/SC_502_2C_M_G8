<?php
include_once './models/ProductoModel.php';
include_once './controllers/controllerProductos.php';
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

class ProductController {
    private $model;

    public function __construct($conexion) {
        $this->model = new ProductModel($conexion);
    }

    public function index() {
        return $this->model->getProductsWithCategories(); // Obtener productos y categorías
    }
// Mostrar un producto específico
    public function view($id) {
        $product = $this->model->getProductById($id);
        include 'views/product_view.php'; // Incluye la vista para mostrar un producto
    }

    // Añadir un nuevo producto
    public function add($nombre, $descripcion, $precio, $descuento, $stock, $categoria_id, $proveedor_id, $img_ruta) {
        $this->model->addProduct($nombre, $descripcion, $precio, $descuento, $stock, $categoria_id, $proveedor_id, $img_ruta);
        header("Location: products.php"); // Redirige a la lista de productos
    }

    // Actualizar un producto existente
    public function update($id, $nombre, $descripcion, $precio, $descuento, $stock, $categoria_id, $proveedor_id, $img_ruta) {
        $this->model->updateProduct($id, $nombre, $descripcion, $precio, $descuento, $stock, $categoria_id, $proveedor_id, $img_ruta);
        header("Location: view.php?id=$id"); // Redirige a la vista del producto
    }

    // Eliminar un producto
    public function deleteProduct($productId) {
        if ($this->model->deleteProduct($productId)) {
            header('Location: products.php'); // Redirige de nuevo a la lista de productos
        } else {
            echo "Error al eliminar el producto.";
        }
    }
}
?>


