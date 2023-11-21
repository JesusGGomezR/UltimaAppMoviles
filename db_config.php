<?php
$host = 'localhost';
$username = 'root';
$password = 'SoI*Z7yT[iHr';
$database = 'id21382147_hospital';

$conexion = new mysqli($host, $username, $password, $database);

if ($conexion->connect_error) {
    die('Error de conexión: ' . $conexion->connect_error);
}
?>

