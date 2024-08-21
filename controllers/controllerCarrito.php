<?php
session_start();

include(__DIR__ . "/../config/conexion.php");

function agregarAlCarrito($producto_id, $cantidad)
{
    global $conexion;

    // Obtener el precio del producto desde la base de datos
    $sql = "SELECT precio FROM productos WHERE producto_id = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $producto_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $producto = $result->fetch_assoc();
    $stmt->close();

    // Verificar si se obtuvo el precio
    if ($producto) {
        if (!isset($_SESSION['carrito'])) {
            $_SESSION['carrito'] = [];
        }

        if (isset($_SESSION['carrito'][$producto_id])) {
            $_SESSION['carrito'][$producto_id]['cantidad'] += $cantidad;
        } else {
            $_SESSION['carrito'][$producto_id] = [
                'cantidad' => $cantidad,
                'precio' => $producto['precio'], // Almacenar el precio del producto en el carrito
            ];
        }
    } else {
        // Manejar el caso donde el producto no se encuentra o no tiene un precio definido
        error_log("Producto no encontrado o sin precio definido: ID $producto_id");
    }
}



// Función para obtener la cantidad total de ítems en el carrito
function obtenerCantidadEnCarrito()
{
    $totalItems = 0;
    if (isset($_SESSION['carrito'])) {
        foreach ($_SESSION['carrito'] as $producto) {
            $totalItems += $producto['cantidad'];
        }
    }
    return $totalItems;
}

// Función para obtener los productos en el carrito desde la base de datos
function obtenerProductosEnCarrito()
{
    global $conexion;

    if (!isset($_SESSION['carrito']) || empty($_SESSION['carrito'])) {
        return [];
    }

    $productosEnCarrito = [];
    foreach ($_SESSION['carrito'] as $producto_id => $detalles) {
        $sql = "SELECT nombre_producto, precio FROM productos WHERE producto_id = ?";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("i", $producto_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $producto = $result->fetch_assoc();
            $producto['cantidad'] = $detalles['cantidad'];
            $producto['total'] = $producto['precio'] * $producto['cantidad'];
            $producto['producto_id'] = $producto_id; // Asegúrate de que el ID del producto esté disponible
            $productosEnCarrito[] = $producto;
        }
        $stmt->close();
    }

    return $productosEnCarrito;
}

// Lógica de manejo del carrito en base a las solicitudes
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['producto_id'])) {
        if (isset($_POST['action']) && $_POST['action'] === 'actualizar') {
            actualizarCantidadEnCarrito($_POST['producto_id'], (int) $_POST['cantidad']);
        } else if (isset($_POST['action']) && $_POST['action'] === 'eliminar') {
            eliminarDelCarrito($_POST['producto_id']);
        } else {
            agregarAlCarrito($_POST['producto_id'], (int) $_POST['cantidad']);
        }
        echo obtenerCantidadEnCarrito();  // Devuelve la cantidad actualizada de ítems
        exit();
    }
}



// Función para actualizar la cantidad de un producto en el carrito
function actualizarCantidadEnCarrito($producto_id, $nuevaCantidad)
{
    if (isset($_SESSION['carrito'][$producto_id])) {
        if ($nuevaCantidad > 0) {
            $_SESSION['carrito'][$producto_id]['cantidad'] = $nuevaCantidad;
        } else {
            eliminarDelCarrito($producto_id);
        }
    }
}

// Función para eliminar un producto del carrito
function eliminarDelCarrito($producto_id)
{
    if (isset($_SESSION['carrito'][$producto_id])) {
        unset($_SESSION['carrito'][$producto_id]);
    }
}

// Funciones para manejar pedidos

function procesarPedido($nombre_usuario, $fecha_pedido, $total)
{
    global $conexion;

    $stmt = $conexion->prepare("SELECT usuario_id FROM Usuarios WHERE nombre_usuario = ?");
    $stmt->bind_param("s", $nombre_usuario);
    $stmt->execute();
    $stmt->bind_result($cliente_id);
    $stmt->fetch();
    $stmt->close();

    if (!$cliente_id) {
        // Si no existe el usuario, mostrar una alerta y terminar la función
        echo "<script>
                alert('Usuario no válido');
                window.location.href = '/SC_502_2C_M_G8/pago.php';
              </script>";
        exit;
    }

    $stmt = $conexion->prepare("SELECT cliente_id FROM Clientes WHERE usuario_id = ?");
    $stmt->bind_param("s", $cliente_id);
    $stmt->execute();
    $stmt->bind_result($idCliente);
    $stmt->fetch();
    $stmt->close();

    if (!$idCliente) {
        // Si no existe el usuario, mostrar una alerta y terminar la función
        echo "<script>
                alert('Usuario no válido');
                window.location.href = '/SC_502_2C_M_G8/pago.php';
              </script>";
        exit;
    }

    // Insertar el pedido en la tabla Pedidos
    $stmt = $conexion->prepare("INSERT INTO Pedidos (cliente_id, fecha_pedido, total) VALUES (?, ?, ?)");
    $stmt->bind_param("isd", $idCliente, $fecha_pedido, $total);
    $stmt->execute();
    $pedido_id = $stmt->insert_id;
    $stmt->close();

    // Insertar los detalles del pedido en la tabla DetallesPedidos
    if (isset($_SESSION['carrito'])) {
        foreach ($_SESSION['carrito'] as $producto_id => $detalles) {
            $cantidad = $detalles['cantidad'];
            $precio_unitario = isset($detalles['precio']) ? $detalles['precio'] : 0;

            if ($precio_unitario > 0) {
                $stmt = $conexion->prepare("INSERT INTO DetallesPedidos (pedido_id, producto_id, cantidad, precio_unitario) VALUES (?, ?, ?, ?)");
                $stmt->bind_param("iiid", $pedido_id, $producto_id, $cantidad, $precio_unitario);
                $stmt->execute();
                $stmt->close();

                // Actualizar el stock del producto en la tabla Productos
                actualizarStockProducto($producto_id, $cantidad);
            } else {
                error_log("Precio no definido para el producto ID $producto_id");
            }
        }
    }

    // Limpiar el carrito después de procesar el pedido
    unset($_SESSION['carrito']);

    return $pedido_id;
}


//Funcion para eliminar del stock lo que se compro
function actualizarStockProducto($producto_id, $cantidad)
{
    global $conexion;
    $stmt = $conexion->prepare("UPDATE Productos SET stock = stock - ? WHERE producto_id = ?");
    $stmt->bind_param("ii", $cantidad, $producto_id);
    $stmt->execute();
    $stmt->close();
}

// Controladores para manejar diferentes acciones

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'agregar':
                if (isset($_POST['producto_id']) && isset($_POST['cantidad'])) {
                    agregarAlCarrito($_POST['producto_id'], (int) $_POST['cantidad']);
                    echo obtenerCantidadEnCarrito();  // Devuelve la cantidad actualizada de ítems
                }
                break;

            case 'actualizar':
                if (isset($_POST['producto_id']) && isset($_POST['cantidad'])) {
                    actualizarCantidadEnCarrito($_POST['producto_id'], (int) $_POST['cantidad']);
                    echo obtenerCantidadEnCarrito();  // Devuelve la cantidad actualizada de ítems
                }
                break;

            case 'eliminar':
                if (isset($_POST['producto_id'])) {
                    eliminarDelCarrito($_POST['producto_id']);
                    echo obtenerCantidadEnCarrito();  // Devuelve la cantidad actualizada de ítems
                }
                break;

            case 'procesar_pedido':
                if (isset($_POST['nombre_usuario']) && isset($_POST['fecha_pedido']) && isset($_POST['total'])) {
                    $pedido_id = procesarPedido($_POST['nombre_usuario'], $_POST['fecha_pedido'], $_POST['total']);
                    header("Location: /SC_502_2C_M_G8/confirmacion.php?pedido_id=" . $pedido_id);
                    exit();
                }
                break;
        }
    }
    exit();
}

?>