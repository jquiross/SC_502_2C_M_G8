<?php

include("./config/conexion.php");

if (isset($_POST["btningresar"])) {

    if (empty($_POST["nombre_usuario"]) || empty($_POST["contraseña"])) {
        echo "<div class='alert alert-danger' role='alert'>Debes ingresar un usuario y una contraseña</div>";
    } else {

        $nombre_usuario = $_POST["nombre_usuario"];
        $contraseña = $_POST["contraseña"];

        // Consulta para obtener la contraseña y el rol del usuario
        $stmt = $conexion->prepare("SELECT contraseña, rol FROM Usuarios WHERE nombre_usuario = ?");
        $stmt->bind_param("s", $nombre_usuario);
        $stmt->execute();
        $stmt->bind_result($db_contraseña, $rol);
        $stmt->fetch();

        // Verificar si la contraseña ingresada coincide con la almacenada
        if ($contraseña === $db_contraseña) {
            // Redirigir según el rol
            if ($rol == 'proveedor') {
                header("Location: indexDashboard.html");
            } else if ($rol == 'cliente') {
                header("Location: index.html");
            }
            exit();
        } else {
            echo "<div class='alert alert-danger' role='alert'>Usuario o contraseña incorrectos</div>";
        }

        $stmt->close();
    }
}

$conexion->close();

?>
