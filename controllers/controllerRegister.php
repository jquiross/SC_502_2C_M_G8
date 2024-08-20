<?php
// Incluir el modelo
require_once("./models/modelRegister.php");
include("./config/conexion.php");

// Verificar si el formulario ha sido enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $nombre_usuario = $_POST['nombre_usuario'];
    $email = $_POST['email'];
    $contraseña = $_POST['contraseña'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $direccion = $_POST['direccion'];
    $telefono = $_POST['telefono'];

    // Llamar a la función del modelo para registrar el usuario
    $resultado = registerUser($nombre_usuario, $email, $contraseña, $nombre, $apellido, $direccion, $telefono);

    if ($resultado) {
        // Redirigir a la página de registro con un mensaje de éxito
        header("Location: register.php?mensaje=success");
        exit();
    } else {
        // Redirigir a la página de registro con un mensaje de error
        header("Location: register.php?mensaje=error");
        exit();
    }
}
?>
