<?php
//conexion a bd
include("./config/conexion.php");

//se crea una clase para que el manejo sea mas facil
class controllerProductos {
    //se hace la funcion de la consulta
    public function getProducts() {
        global $conexion;
        $stmt = $conexion->prepare("SELECT producto_id, nombre_producto, descripcion, precio, descuento, img_ruta FROM Productos");
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
