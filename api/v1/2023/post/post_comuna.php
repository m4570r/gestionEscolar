<?php 

//echo "post_comuna.php"; 

// Incluye la conexión a la base de datos
include 'conexion.php';

// Recibe el payload JSON del body
$data = json_decode(file_get_contents("php://input"), true);

// Verifica que los campos nombre e idRegion estén establecidos y no estén vacíos
if (!isset($data['nombre']) || empty($data['nombre']) || !isset($data['idRegion']) || empty($data['idRegion'])) {
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'message' => 'No se proporcionaron todos los datos requeridos']);
    exit;
}

$nombre = $data['nombre'];
$idRegion = $data['idRegion'];

try {
    // Consulta SQL para insertar una nueva comuna
    $stmt = $pdo->prepare('INSERT INTO comunas (nombre, idRegion) VALUES (:nombre, :idRegion)');

    // Vincula los parámetros
    $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
    $stmt->bindParam(':idRegion', $idRegion, PDO::PARAM_INT);

    $stmt->execute();
    
    // Establece el tipo de contenido como JSON
    header('Content-Type: application/json');
    
    // Devuelve un mensaje de éxito
    echo json_encode(['success' => true, 'message' => 'Comuna añadida con éxito']);
    
} catch (\PDOException $e) {
    // En caso de error, devuelve un mensaje de error en formato JSON
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'message' => 'Error al conectar o insertar en la base de datos: ' . $e->getMessage()]);
    exit;
}


?>