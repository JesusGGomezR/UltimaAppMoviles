<?php
require_once 'db_config.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    $id_paciente = $data['id_paciente'];
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

    $sql = "UPDATE pacientes SET 
            curp = '$curp',
            nombre = '$nombre',
            apellidos = '$apellidos',
            telefono = '$telefono',
            domicilio = '$domicilio',
            genero = '$genero',
            estatus = '$estatus',
            derecho_habiendo = '$derecho_habiendo',
            afiliacion = '$afiliacion',
            tipo_sanguineo = '$tipo_sanguineo',
            diagnostico = '$diagnostico'
            WHERE id_paciente = $id_paciente";

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
