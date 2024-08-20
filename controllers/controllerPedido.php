<?php
require_once './config/conexion.php'; // Incluye la conexión a la base de datos
require_once './models/PedidoModel.php';

class PedidoController {
    private $pedidoModel;

    public function __construct($conexion) {
        $this->pedidoModel = new PedidoModel($conexion);
    }

    public function mostrarPedidos() {
        $pedidos = $this->pedidoModel->obtenerPedidos();
        return $pedidos;
    }

    public function eliminarPedido($pedidoId) {
        $resultado = $this->pedidoModel->borrarPedido($pedidoId);
        return $resultado;  // Ya devuelve true o false directamente
    }
}

// Manejar las solicitudes POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Asegúrate de que la conexión se crea solo una vez
    if (isset($_POST['pedido_id'])) {
        $pedidoId = intval($_POST['pedido_id']);
        
        // Crear la instancia del controlador
        $controller = new PedidoController($conexion);

        if ($controller->eliminarPedido($pedidoId)) {
            header('Location: ../views/pedidos.php'); // Ajusta la ruta según la ubicación de pedidos.php
            exit(); // Asegúrate de que el script se detenga después de redirigir
        } else {
            echo 'Error al eliminar el pedido.';
        }
    }
}
?>
