<?php
class ModelRegister {
    private $conn;

    public function __construct($conexion) {
        $this->conn = $conexion;
    }

    public function registrarUsuario($nombre_usuario, $email, $contraseña, $rol_id) {
        // Preparar consulta SQL
        $sql = "INSERT INTO Usuarios (nombre_usuario, email, contraseña, rol_id) VALUES (?, ?, ?, ?)";

        // Preparar declaración
        $stmt = $this->conn->prepare($sql);

        // Verificar si la declaración fue preparada correctamente
        if ($stmt === false) {
            die('Error en la preparación de la consulta: ' . $this->conn->error);
        }

        // Ejecutar declaración con los parámetros
        $passwordHash = password_hash($contraseña, PASSWORD_DEFAULT);
        return $stmt->bind_param("sssi", $nombre_usuario, $email, $passwordHash, $rol_id) && $stmt->execute();
    }
}
?>
