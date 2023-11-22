<?php
require_once 'db_config.php';

header('Content-Type: application/json');

$response = ['success' => false];

// Verifica la conexión
if ($conn->connect_error) {
    $response['message'] = "Error de conexión: " . $conn->connect_error;
} else {
    // Obtiene el ID del usuario a eliminar desde la solicitud POST
    $id = $_POST['id'];

    // Convierte el ID a un número entero
    $id = intval($id);

    // Consulta SQL para eliminar el usuario
    $sql = "DELETE FROM usuarios WHERE id = $id";

    // Ejecuta la consulta
    if ($conn->query($sql) === TRUE) {
        // Éxito al eliminar el usuario
        $response = array('success' => true, 'message' => 'Usuario eliminado exitosamente');
    } else {
        // Error al eliminar el usuario
        $response['message'] = 'Error al eliminar el usuario: ' . $conn->error;
    }
}

// Cierra la conexión a la base de datos
$conn->close();

// Devuelve la respuesta como JSON
echo json_encode($response);
?>
