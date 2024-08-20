<?php
// Incluir archivo de configuración de la base de datos
include_once("./config/conexion.php"); // Asegúrate de que la ruta es correcta


// Función para registrar un nuevo usuario y cliente
function registerUser($nombre_usuario, $email, $contraseña, $nombre, $apellido, $direccion, $telefono) {
    $conexion = getDatabaseConnection();

    // Hash de la contraseña
    $contraseña_hash = password_hash($contraseña, PASSWORD_BCRYPT);

    // Iniciar una transacción
    $conexion->begin_transaction();

    try {
        // Insertar el nuevo usuario en la tabla Usuarios
        $query_usuario = "INSERT INTO Usuarios (nombre_usuario, email, contraseñausuarios) VALUES (?, ?, ?)";
        $stmt_usuario = $conexion->prepare($query_usuario);
        $stmt_usuario->bind_param('sss', $nombre_usuario, $email, $contraseña_hash);
        $stmt_usuario->execute();

        // Obtener el ID del nuevo usuario
        $usuario_id = $conexion->insert_id;

        // Insertar el nuevo cliente en la tabla Clientes
        $query_cliente = "INSERT INTO Clientes (usuario_id, nombre, apellido, direccion, telefono) VALUES (?, ?, ?, ?, ?)";
        $stmt_cliente = $conexion->prepare($query_cliente);
        $stmt_cliente->bind_param('issss', $usuario_id, $nombre, $apellido, $direccion, $telefono);
        $stmt_cliente->execute();

        // Confirmar la transacción
        $conexion->commit();

        // Cerrar conexión
        $stmt_usuario->close();
        $stmt_cliente->close();
        $conexion->close();

        return true;
    } catch (Exception $e) {
        // Revertir la transacción en caso de error
        $conexion->rollback();
        
        // Cerrar conexión
        $stmt_usuario->close();
        $stmt_cliente->close();
        $conexion->close();

        // Mostrar mensaje de error
        echo "Error: " . $e->getMessage();
        return false;
    }
}
?>
