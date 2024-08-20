<?php

class RegisterModel {
    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    public function registerClient($nombre_usuario, $email, $contraseña_encriptada, $nombre, $apellido, $direccion, $telefono) {
        // Iniciar la transacción
        $this->conexion->begin_transaction();
        
        try {
            // Insertar usuario en la tabla Usuarios
            $sql = "INSERT INTO Usuarios (nombre_usuario, email, contraseña) VALUES (?, ?, ?)";
            $stmt = $this->conexion->prepare($sql);
            if (!$stmt) {
                throw new Exception('Error en la preparación de la consulta de usuario: ' . $this->conexion->error);
            }
            $stmt->bind_param("sss", $nombre_usuario, $email, $contraseña_encriptada);
            if (!$stmt->execute()) {
                throw new Exception('Error al insertar el usuario: ' . $stmt->error);
            }

            // Obtener el ID del usuario insertado
            $usuario_id = $stmt->insert_id;
            $stmt->close();

            // Insertar cliente en la tabla Clientes
            $sql = "INSERT INTO Clientes (usuario_id, nombre, apellido, direccion, telefono) VALUES (?, ?, ?, ?, ?)";
            $stmt = $this->conexion->prepare($sql);
            if (!$stmt) {
                throw new Exception('Error en la preparación de la consulta de cliente: ' . $this->conexion->error);
            }
            $stmt->bind_param("issss", $usuario_id, $nombre, $apellido, $direccion, $telefono);
            if (!$stmt->execute()) {
                throw new Exception('Error al insertar el cliente: ' . $stmt->error);
            }

            // Confirmar la transacción
            $this->conexion->commit();
            return true;
        } catch (Exception $e) {
            // Revertir la transacción en caso de error
            $this->conexion->rollback();
            echo 'Error: ' . $e->getMessage();
            return false;
        }
    }
}
?>
