<?php 

//echo "get_programaSocial_todos.php";

// Incluye tu conexión existente
include 'conexion.php';

try {
    // Consulta SQL para obtener todos los programas sociales
    $stmt = $pdo->query('SELECT id, nombre FROM programassociales');
    
    // Obtener todos los programas como un array
    $programas = $stmt->fetchAll();

    // Establecer el tipo de contenido como JSON
    header('Content-Type: application/json');

    // Si hay programas, devolverlos, de lo contrario enviar un mensaje
    if ($programas) {
        echo json_encode(['success' => true, 'programas' => $programas]);
    } else {
        echo json_encode(['success' => false, 'message' => 'No se encontraron programas sociales']);
    }
    
} catch (\PDOException $e) {
    // Si hay un error, devolver un mensaje de error en formato JSON
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'message' => 'Error al conectar o consultar la base de datos: ' . $e->getMessage()]);
    exit;
}


?>