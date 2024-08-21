<?php
include('../config/conexion.php');
include('../models/modelRegister.php');
 
//Trae las cosas al detectar el post y crea el usuario
if (isset($_POST['btnregistrar'])) {
    $nombre_usuario = $_POST['nombre_usuario'];
    $email = $_POST['email'];
    $contraseña = md5($_POST['contraseña']);
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $direccion = $_POST['direccion'];
    $telefono = $_POST['telefono'];
 
    $model = new RegisterModel($conexion);
    $resultado = $model->registerClient($nombre_usuario, $email, $contraseña, $nombre, $apellido, $direccion, $telefono);
 
    if ($resultado) {
 
        header('Location: ../login.php?mensaje=success');
    } else {
 
        header('Location: ../register.php?mensaje=error');
    }
}
?>