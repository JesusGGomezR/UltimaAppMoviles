<?php
header('Content-Type: application/json');

// Conexión a la base de datos (ajusta según tu configuración)
$mysqli = new mysqli('localhost', 'root', '', 'hospital-tarimoro');

// Manejar errores de conexión
if ($mysqli->connect_error) {
    die('Error de conexión: ' . $mysqli->connect_error);
}

// Utilizar consultas preparadas para evitar inyección SQL
$query = "SELECT * FROM pacientes"; // Ajusta el nombre de la tabla según tu base de datos
$result = $mysqli->query($query);

if ($result) {
    // Obtener resultados como una lista de pacientes
    $patientDataList = $result->fetch_all(MYSQLI_ASSOC);

    echo json_encode($patientDataList);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Error al obtener pacientes']);
}

// Cerrar la conexión a la base de datos
$mysqli->close();
?>
