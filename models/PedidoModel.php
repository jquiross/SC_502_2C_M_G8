<?php
require_once './config/conexion.php'; 
require_once './controllers/controllerPedido.php'; 

class PedidoModel {
    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    public function obtenerPedidos() {
        $query = "
            SELECT p.pedido_id, 
                   c.nombre AS nombre_solicitante, 
                   dp.cantidad AS unidades_solicitadas, 
                   i.cantidad AS en_stock, 
                   p.fecha_pedido AS dia_entrega
            FROM Pedidos p
            JOIN DetallesPedidos dp ON p.pedido_id = dp.pedido_id
            LEFT JOIN Inventario i ON dp.producto_id = i.producto_id
            JOIN Clientes c ON p.cliente_id = c.cliente_id
        ";

        if ($stmt = $this->conexion->prepare($query)) {
            $stmt->execute();
            $resultado = $stmt->get_result();
            $pedidos = $resultado->fetch_all(MYSQLI_ASSOC);
            $stmt->close();
            return $pedidos;
        } else {
            throw new Exception('Error en la consulta: ' . $this->conexion->error);
        }
    }

    public function borrarPedido($pedido_id) {
        try {
            $this->conexion->begin_transaction();

            $query = "DELETE FROM DetallesPedidos WHERE pedido_id = ?";
            $stmt = $this->conexion->prepare($query);
            $stmt->execute([$pedido_id]);

            $query = "DELETE FROM Pedidos WHERE pedido_id = ?";
            $stmt = $this->conexion->prepare($query);
            $stmt->execute([$pedido_id]);

            $this->conexion->commit();
            return true;
        } catch (Exception $e) {
            $this->conexion->rollback();
            return false;
        }
    }
}
?>
