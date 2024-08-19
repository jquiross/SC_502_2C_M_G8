<?php
class Cart {
    public $conexion;

    // Constructor para establecer la conexión a la base de datos
    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    // Método para añadir un producto al carrito
    public function addProduct($product_id) {
        $product_id = intval($product_id);

        // Verificar si el producto ya está en el carrito
        $stmt = $this->conexion->prepare("SELECT cantidad FROM carrito WHERE producto_id = ?");
        $stmt->bind_param("i", $product_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $existingProduct = $result->fetch_assoc();
        $stmt->close();

        if ($existingProduct) {
            // Actualizar la cantidad si el producto ya existe en el carrito
            $newQuantity = $existingProduct['cantidad'] + 1;
            $stmt = $this->conexion->prepare("UPDATE carrito SET cantidad = ? WHERE producto_id = ?");
            $stmt->bind_param("ii", $newQuantity, $product_id);
            $stmt->execute();
            $stmt->close();
        } else {
            // Insertar nuevo producto en el carrito
            $quantity = 1; // Cantidad inicial
            $stmt = $this->conexion->prepare("INSERT INTO carrito (producto_id, cantidad) VALUES (?, ?)");
            $stmt->bind_param("ii", $product_id, $quantity);
            $stmt->execute();
            $stmt->close();
        }

        // Redirigir al carrito
        header("Location: carrito.php");
        exit();
    }
}
?>