<?php 

//echo "get_etnias_id.php";

// Incluye tu conexión existente
include 'conexion.php';

// Asegurarse de que el id esté establecido y no esté vacío
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'message' => 'El id no fue proporcionado']);
    exit;
}

$id = $_GET['id'];

try {
    // Consulta SQL para obtener los detalles de una etnia por ID
    $stmt = $pdo->prepare('SELECT id, nombre FROM etnias WHERE id = :id');
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    
    // Obtener la etnia como un objeto
    $etnia = $stmt->fetch();

    // Establecer el tipo de contenido como JSON
    header('Content-Type: application/json');

    // Si se encuentra la etnia, devolverla, de lo contrario enviar un mensaje
    if ($etnia) {
        echo json_encode(['success' => true, 'etnia' => $etnia]);
    } else {
        echo json_encode(['success' => false, 'message' => 'No se encontró la etnia con el ID proporcionado']);
    }
    
} catch (\PDOException $e) {
    // Si hay un error, devolver un mensaje de error en formato JSON
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'message' => 'Error al conectar o consultar la base de datos: ' . $e->getMessage()]);
    exit;
}


?>