<?php

class UserModel {
    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    //model para obtener usuarios
    public function obtenerUsuarios() {
        try {
            $query = "SELECT * FROM Usuarios";
            $stmt = $this->conexion->prepare($query);
            $stmt->execute();
            return $stmt->get_result()->fetch_all(MYSQLI_ASSOC); // Usar fetch_all() para obtener todos los registros
        } catch (mysqli_sql_exception $e) {
            echo "Error: " . $e->getMessage();
            return [];
        }
    }

    //model para obtener usuarios por id
    public function obtenerUsuarioPorId($id) {
        try {
            $query = "SELECT * FROM Usuarios WHERE usuario_id = ?";
            $stmt = $this->conexion->prepare($query);
            $stmt->bind_param('i', $id);
            $stmt->execute();
            return $stmt->get_result()->fetch_assoc();
        } catch (mysqli_sql_exception $e) {
            echo "Error: " . $e->getMessage();
            return null;
        }
    }

    //models para crud de los usuarios
    public function agregarUsuario($nombre, $email, $contraseña, $rol_id) {
        try {
            $query = "INSERT INTO Usuarios (nombre_usuario, email, contraseña, rol_id) VALUES (?, ?, ?, ?)";
            $stmt = $this->conexion->prepare($query);
            $stmt->bind_param("sssi", $nombre, $email, password_hash($contraseña, PASSWORD_DEFAULT), $rol_id);
            return $stmt->execute();
        } catch (mysqli_sql_exception $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    public function actualizarUsuario($id, $nombre, $email, $password) {
        try {
            $query = "UPDATE Usuarios SET nombre_usuario = ?, email = ?, contraseña = ? WHERE usuario_id = ?";
            $stmt = $this->conexion->prepare($query);
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);
            $stmt->bind_param('sssi', $nombre, $email, $passwordHash, $id);
            return $stmt->execute();
        } catch (mysqli_sql_exception $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    public function eliminarUsuario($id) {
        try {
            $query = "DELETE FROM Clientes WHERE usuario_id = ?";
            $stmt = $this->conexion->prepare($query);
            $stmt->bind_param("i", $id);
            $stmt->execute();
            
            $query = "DELETE FROM Usuarios WHERE usuario_id = ?";
            $stmt = $this->conexion->prepare($query);
            $stmt->bind_param("i", $id);
            return $stmt->execute();
        } catch (mysqli_sql_exception $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
}
?>