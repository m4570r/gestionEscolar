<?php 

//echo "delete_usuario.php"; 

// Incluye la conexión a la base de datos
include 'conexion.php';

// Recibe el payload JSON del body
$data = json_decode(file_get_contents("php://input"), true);

// Verifica que el id esté establecido
if (!isset($data['id'])) {
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'message' => 'El campo id es obligatorio.']);
    exit;
}

$id = $data['id'];

// Construye la consulta SQL
$sql = 'DELETE FROM usuarios WHERE id=:id';

try {
    // Preparar y ejecutar la consulta SQL
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':id' => $id]);
    
    // Establece el tipo de contenido como JSON
    header('Content-Type: application/json');
    
    // Si ningún registro fue eliminado, devuelve un mensaje
    if ($stmt->rowCount() === 0) {
        echo json_encode(['success' => false, 'message' => 'No se encontró el usuario con el id especificado.']);
    } else {
        // Devuelve un mensaje de éxito
        echo json_encode(['success' => true, 'message' => 'Usuario eliminado con éxito']);
    }
    
} catch (\PDOException $e) {
    // En caso de error, devuelve un mensaje de error en formato JSON
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'message' => 'Error al conectar o eliminar en la base de datos: ' . $e->getMessage()]);
    exit;
}


?>