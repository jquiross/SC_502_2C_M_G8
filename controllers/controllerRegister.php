<?php
include_once('./config/conexion.php');
include_once('./models/modelRegister.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['btnregistrar'])) {
    // Obtener datos del formulario
    $nombre_usuario = $_POST['nombre_usuario'];
    $email = $_POST['email'];
    $contraseña = $_POST['contraseña'];
    $rol_id = $_POST['rol_id']; // Asegúrate de que este campo esté en el formulario o define un valor por defecto

    // Crear instancia del modelo y registrar usuario
    $model = new ModelRegister($conexion);
    $resultado = $model->registrarUsuario($nombre_usuario, $email, $contraseña, $rol_id);

    if ($resultado) {
        header('Location: register.php?mensaje=success');
        exit();
    } else {
        echo '<div class="alert alert-danger" role="alert">Error al registrar. Inténtalo de nuevo.</div>';
    }
}
?>
