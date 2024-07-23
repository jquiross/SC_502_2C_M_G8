<?php

include("./config/conexion.php");

if (isset($_POST["btningresar"])) {

    if (empty($_POST["nombre_usuario"]) || empty($_POST["contraseña"])) {
        echo "<div class='alert alert-danger' role='alert'>Debes ingresar un usuario y una contraseña</div>";
    } else {

        $nombre_usuario = $_POST["nombre_usuario"];
        $contraseña = $_POST["contraseña"];

        $stmt = $conexion->prepare("SELECT * FROM Usuarios WHERE nombre_usuario = ? AND contraseña = ?");
        $stmt->bind_param("ss", $nombre_usuario, $contraseña);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->fetch_object()) {

            header("Location: indexDashboard.html");
            exit();
        } else {
            echo "<div class='alert alert-danger' role='alert'>Usuario o contraseña incorrectos</div>";
        }


        $stmt->close();
    }
}

$conexion->close();

?>
