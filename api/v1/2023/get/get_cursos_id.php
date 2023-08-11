<?php 

//echo "get_cursos_id.php";

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
    // Consulta SQL para obtener los detalles de un curso por ID
    $stmt = $pdo->prepare('SELECT id, nombre FROM cursos WHERE id = :id');
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    
    // Obtener el curso como un objeto
    $curso = $stmt->fetch();

    // Establecer el tipo de contenido como JSON
    header('Content-Type: application/json');

    // Si se encuentra el curso, devolverlo, de lo contrario enviar un mensaje
    if ($curso) {
        echo json_encode(['success' => true, 'curso' => $curso]);
    } else {
        echo json_encode(['success' => false, 'message' => 'No se encontró el curso con el ID proporcionado']);
    }
    
} catch (\PDOException $e) {
    // Si hay un error, devolver un mensaje de error en formato JSON
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'message' => 'Error al conectar o consultar la base de datos: ' . $e->getMessage()]);
    exit;
}



?>