<?php

include_once ('./config/conexion.php');
include_once("./models/UserModel.php");

function eliminarUsuarioController($conexion, $id) {
    $userModel = new UserModel($conexion);
    if ($userModel->eliminarUsuario($id)) {
        header("Location: accounts.php"); // Redirigir para evitar el reenvío del formulario
        exit();
    } else {
        echo "Error al eliminar el usuario.";
    }
}

function obtenerUsuarios($conexion) {
    $userModel = new UserModel($conexion);
    return $userModel->obtenerUsuarios();
}
?>