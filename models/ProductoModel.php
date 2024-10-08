<?php

class ProductModel {
    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    //model para obtener productos
    public function getProducts() {
        $sql = "SELECT * FROM Productos";
        return $this->conexion->query($sql);
    }

    //model para obtener productos por categoria
    public function getProductsWithCategories() {
        $sql = "SELECT p.producto_id, p.nombre_producto, p.descripcion, p.precio, p.descuento, p.stock, p.img_ruta, c.nombre_categoria
                FROM Productos p
                JOIN Categorías c ON p.categoria_id = c.categoria_id";
        return $this->conexion->query($sql);
    }

    //model para obtener productos por id
    public function getProductById($id) {
        $sql = "SELECT * FROM Productos WHERE producto_id = ?";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result();
    }

    //models de crud para los productos
    public function addProduct($nombre, $descripcion, $precio, $descuento, $stock, $categoria_id, $proveedor_id, $img_ruta) {
        $sql = "INSERT INTO Productos (nombre_producto, descripcion, precio, descuento, stock, categoria_id, proveedor_id, img_ruta)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("ssddiiis", $nombre, $descripcion, $precio, $descuento, $stock, $categoria_id, $proveedor_id, $img_ruta);
        return $stmt->execute();
    }


    public function updateProduct($id, $nombre, $descripcion, $precio, $descuento, $stock, $categoria_id, $proveedor_id, $img_ruta) {
        $sql = "UPDATE Productos
                SET nombre_producto = ?, descripcion = ?, precio = ?, descuento = ?, stock = ?, categoria_id = ?, proveedor_id = ?, img_ruta = ?
                WHERE producto_id = ?";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("ssddiiisi", $nombre, $descripcion, $precio, $descuento, $stock, $categoria_id, $proveedor_id, $img_ruta, $id);
        return $stmt->execute();
    }

    public function deleteProduct($productId) {
        $stmt = $this->conexion->prepare("DELETE FROM Productos WHERE producto_id = ?");
        $stmt->bind_param("i", $productId);
        return $stmt->execute();
    }
}
    
?>