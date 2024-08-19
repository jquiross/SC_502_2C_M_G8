<?php

include("./config/conexion.php");

if (isset($_POST["btnregistrar"])) {

    if (empty($_POST["nombre_usuario"]) || empty($_POST["email"]) || empty($_POST["contraseña"])) {
        echo "<div class='alert alert-danger' role='alert'>Todos los campos son obligatorios</div>";
    } else {

        $nombre_usuario = $_POST["nombre_usuario"];
        $email = $_POST["email"];
        $contraseña = md5($_POST["contraseña"]);

        // Verificar si el nombre de usuario ya existe
        $stmt = $conexion->prepare("SELECT COUNT(*) FROM Usuarios WHERE nombre_usuario = ?");
        $stmt->bind_param("s", $nombre_usuario);
        $stmt->execute();
        $stmt->bind_result($count);
        $stmt->fetch();
        $stmt->close();

        if ($count > 0) {
            echo "<div class='alert alert-danger' role='alert'>El nombre de usuario ya existe</div>";
        } else {
            // Insertar nuevo usuario en la base de datos
            $rol_id = 3; // Por ejemplo, asignar el rol de 'Cliente' por defecto
            $stmt = $conexion->prepare("INSERT INTO Usuarios (nombre_usuario, email, contraseña, rol_id) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("sssi", $nombre_usuario, $email, $contraseña, $rol_id);

            if ($stmt->execute()) {
                echo "<div class='alert alert-success' role='alert'>Registro exitoso. Puedes iniciar sesión.</div>";
            } else {
                echo "<div class='alert alert-danger' role='alert'>Error al registrar el usuario</div>";
            }

            $stmt->close();
        }

        $conexion->close();
    }
}
