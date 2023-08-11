<?php 

//echo "get_cursos_todos.php";

// Incluye tu conexión existente
include 'conexion.php';

try {
    // Consulta SQL para obtener todos los cursos
    $stmt = $pdo->query('SELECT id, nombre FROM cursos');
    
    // Obtener todos los cursos como un array
    $cursos = $stmt->fetchAll();

    // Establecer el tipo de contenido como JSON
    header('Content-Type: application/json');

    // Si hay cursos, devolverlos, de lo contrario enviar un mensaje
    if ($cursos) {
        echo json_encode(['success' => true, 'cursos' => $cursos]);
    } else {
        echo json_encode(['success' => false, 'message' => 'No se encontraron cursos']);
    }
    
} catch (\PDOException $e) {
    // Si hay un error, devolver un mensaje de error en formato JSON
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'message' => 'Error al conectar o consultar la base de datos: ' . $e->getMessage()]);
    exit;
}

?>