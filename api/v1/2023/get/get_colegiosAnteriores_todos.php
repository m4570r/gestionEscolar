<?php 

//echo "get_colegiosAnteriores_todos.php";



// Incluye tu conexión existente
include 'conexion.php';

try {
    // Consulta SQL para obtener todos los colegios anteriores
    $stmt = $pdo->query('SELECT id, nombre FROM colegiosAnteriores');
    
    // Obtener todos los colegios anteriores como un array
    $colegios = $stmt->fetchAll();

    // Establecer el tipo de contenido como JSON
    header('Content-Type: application/json');

    // Si hay colegios, devolverlos, de lo contrario enviar un mensaje
    if ($colegios) {
        echo json_encode(['success' => true, 'colegiosAnteriores' => $colegios]);
    } else {
        echo json_encode(['success' => false, 'message' => 'No se encontraron colegios anteriores']);
    }
    
} catch (\PDOException $e) {
    // Si hay un error, devolver un mensaje de error en formato JSON
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'message' => 'Error al conectar o consultar la base de datos: ' . $e->getMessage()]);
    exit;
}



?>