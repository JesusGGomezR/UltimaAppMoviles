<?php
header('Content-Type: application/json');

// Conexión a la base de datos (ajusta según tu configuración)
$mysqli = new mysqli('localhost', 'root', '', 'hospital-tarimoro');

// Manejar errores de conexión
if ($mysqli->connect_error) {
    die('Error de conexión: ' . $mysqli->connect_error);
}

// Utilizar consultas preparadas para evitar inyección SQL
$query = "SELECT * FROM usuarios";
$result = $mysqli->query($query);

if ($result) {
    // Obtener resultados como una lista de usuarios
    $userDataList = $result->fetch_all(MYSQLI_ASSOC);

    echo json_encode($userDataList);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Error al obtener usuarios']);
}

// Cerrar la conexión a la base de datos
$mysqli->close();
?>
