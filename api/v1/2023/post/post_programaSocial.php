<?php 

//echo "post_programaSocial.php"; 

// Incluye la conexión a la base de datos
include 'conexion.php';

// Recibe el payload JSON del body
$data = json_decode(file_get_contents("php://input"), true);

// Verifica que todos los campos requeridos estén establecidos
if (!isset($data['nombre']) || empty($data['nombre'])) {
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'message' => 'No se proporcionó el nombre del programa']);
    exit;
}

$nombre = $data['nombre'];

try {
    // Consulta SQL para insertar los datos
    $stmt = $pdo->prepare('INSERT INTO programassociales (nombre) VALUES (:nombre)');

    // Vincula los parámetros
    $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
    
    $stmt->execute();
    
    // Establece el tipo de contenido como JSON
    header('Content-Type: application/json');
    
    // Devuelve un mensaje de éxito
    echo json_encode(['success' => true, 'message' => 'Programa añadido con éxito']);
    
} catch (\PDOException $e) {
    // En caso de error, devuelve un mensaje de error en formato JSON
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'message' => 'Error al conectar o insertar en la base de datos: ' . $e->getMessage()]);
    exit;
}


?>