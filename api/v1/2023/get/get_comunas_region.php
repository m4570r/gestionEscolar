<?php 

//echo "get_comunas_region.php";


// Incluye tu conexión existente
include 'conexion.php';

// Asegurarse de que el idRegion esté establecido y no esté vacío
if (!isset($_GET['idRegion']) || empty($_GET['idRegion'])) {
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'message' => 'El idRegion no fue proporcionado']);
    exit;
}

$idRegion = $_GET['idRegion'];

try {
    // Consulta SQL para obtener las comunas por idRegion
    $stmt = $pdo->prepare('SELECT id, nombre FROM comunas WHERE idRegion = :idRegion');
    $stmt->bindParam(':idRegion', $idRegion, PDO::PARAM_INT);
    $stmt->execute();
    
    // Obtener todas las comunas como un array
    $comunas = $stmt->fetchAll();

    // Establecer el tipo de contenido como JSON
    header('Content-Type: application/json');

    // Si hay comunas, devolverlas, de lo contrario enviar un mensaje
    if ($comunas) {
        echo json_encode(['success' => true, 'comunas' => $comunas]);
    } else {
        echo json_encode(['success' => false, 'message' => 'No se encontraron comunas para la región proporcionada']);
    }
    
} catch (\PDOException $e) {
    // Si hay un error, devolver un mensaje de error en formato JSON
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'message' => 'Error al conectar o consultar la base de datos: ' . $e->getMessage()]);
    exit;
}



?>