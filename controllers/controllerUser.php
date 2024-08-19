<?php

require_once './config/conexion.php';
require_once './models/UserModel.php';

function obtenerUsuarios($conexion) {
    $userModel = new UserModel($conexion);
    return $userModel->obtenerUsuarios();
}
?>
