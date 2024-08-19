<?php

include("./config/conexion.php");

if (isset($_POST["btningresar"])) {

    if (empty($_POST["nombre_usuario"]) || empty($_POST["contraseña"])) {
        echo "<div class='alert alert-danger' role='alert'>Debes ingresar un usuario y una contraseña</div>";
    } else {

        $nombre_usuario = $_POST["nombre_usuario"];
        $contraseña = md5($_POST["contraseña"]);

        // Consulta para obtener la contraseña y el rol del usuario
        $stmt = $conexion->prepare("SELECT contraseña, rol_id FROM Usuarios WHERE nombre_usuario = ?");
        $stmt->bind_param("s", $nombre_usuario);
        $stmt->execute();
        $stmt->bind_result($db_contraseña, $rol_id);
        $stmt->fetch();
        $stmt->close();

        $stmt2 = $conexion->prepare("SELECT nombre_rol FROM roles WHERE rol_id = ?");
        $stmt2->bind_param("s", $rol_id);
        $stmt2->execute();
        $stmt2->bind_result($rol);
        $stmt2->fetch();

        $conexion->close();
        

        // Verificar si la contraseña ingresada coincide con la almacenada
        if ($contraseña === $db_contraseña) {
            // Redirigir según el rol
            if ($rol == 'Administrador') {
                header("Location: indexDashboard.html");
            } else if ($rol == 'Proveedor') {
                header("Location: indecDashboard.php");          
            } else if ($rol == 'Cliente') {
                header("Location: index.php");
            }
            
            exit();
        } else {
            echo "<div class='alert alert-danger' role='alert'>Usuario o contraseña incorrectos</div>";
        }
        $stmt2->close();
    }
}



?>
