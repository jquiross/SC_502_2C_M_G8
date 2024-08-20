<?php
$conexion = new mysqli("localhost", "root", "12345", "ElTapisDB", "3306");
$conexion->set_charset("utf8");

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}
?>
