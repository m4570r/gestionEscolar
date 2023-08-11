<?php 

//echo "get_etnias_todos.php";

// Incluye tu conexión existente
include 'conexion.php';

try {
    // Consulta SQL para obtener todas las etnias
    $stmt = $pdo->query('SELECT id, nombre FROM etnias');
    
    // Obtener todas las etnias como un array
    $etnias = $stmt->fetchAll();

    // Establecer el tipo de contenido como JSON
    header('Content-Type: application/json');

    // Si hay etnias, devolverlas, de lo contrario enviar un mensaje
    if ($etnias) {
        echo json_encode(['success' => true, 'etnias' => $etnias]);
    } else {
        echo json_encode(['success' => false, 'message' => 'No se encontraron etnias']);
    }
    
} catch (\PDOException $e) {
    // Si hay un error, devolver un mensaje de error en formato JSON
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'message' => 'Error al conectar o consultar la base de datos: ' . $e->getMessage()]);
    exit;
}

?>