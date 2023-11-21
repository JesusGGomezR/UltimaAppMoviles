<?php
require_once 'db_config.php';

header('Content-Type: application/json');

$response = ['success' => false];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    $curp = $data['curp'];
    $nombre = $data['nombre'];
    $apellidos = $data['apellidos'];
    $telefono = $data['telefono'];
    $domicilio = $data['domicilio'];
    $genero = $data['genero'];
    $estatus = $data['estatus'];
    $derecho_habiendo = $data['derecho_habiendo'];
    $afiliacion = $data['afiliacion'];
    $tipo_sanguineo = $data['tipo_sanguineo'];
    $diagnostico = $data['diagnostico'];

    $sql = "INSERT INTO pacientes (id_paciente, curp, nombre, apellidos, telefono, domicilio, genero, estatus, derecho_habiendo, afiliacion, tipo_sanguineo, diagnostico) 
            VALUES (NULL, '$curp', '$nombre', '$apellidos', '$telefono', '$domicilio', '$genero', '$estatus', '$derecho_habiendo', '$afiliacion', '$tipo_sanguineo', '$diagnostico')";

        if ($conexion->query($sql) === true) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => $conexion->error]);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Método no permitido']);
}

$conexion->close();
?>
