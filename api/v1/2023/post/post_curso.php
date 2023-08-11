<?php 

//echo "post_curso.php"; 

// Incluye la conexión a la base de datos
include 'conexion.php';

// Recibe el payload JSON del body
$data = json_decode(file_get_contents("php://input"), true);

// Verifica que el campo nombre esté establecido y no esté vacío
if (!isset($data['nombre']) || empty($data['nombre'])) {
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'message' => 'No se proporcionaron todos los datos requeridos']);
    exit;
}

$nombre = $data['nombre'];

try {
    // Consulta SQL para insertar un nuevo curso
    $stmt = $pdo->prepare('INSERT INTO cursos (nombre) VALUES (:nombre)');

    // Vincula los parámetros
    $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);

    $stmt->execute();
    
    // Establece el tipo de contenido como JSON
    header('Content-Type: application/json');
    
    // Devuelve un mensaje de éxito
    echo json_encode(['success' => true, 'message' => 'Curso añadido con éxito']);
    
} catch (\PDOException $e) {
    // En caso de error, devuelve un mensaje de error en formato JSON
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'message' => 'Error al conectar o insertar en la base de datos: ' . $e->getMessage()]);
    exit;
}

?>