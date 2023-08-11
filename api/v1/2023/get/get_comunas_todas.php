<?php 

//echo "get_comunas_todas.php";

// Incluye tu conexión existente
include 'conexion.php';

try {
    // Consulta SQL para obtener todas las comunas
    $stmt = $pdo->query('SELECT id, nombre, idRegion FROM comunas');
    
    // Obtener todas las comunas como un array
    $comunas = $stmt->fetchAll();

    // Establecer el tipo de contenido como JSON
    header('Content-Type: application/json');

    // Si hay comunas, devolverlas, de lo contrario enviar un mensaje
    if ($comunas) {
        echo json_encode(['success' => true, 'comunas' => $comunas]);
    } else {
        echo json_encode(['success' => false, 'message' => 'No se encontraron comunas']);
    }
    
} catch (\PDOException $e) {
    // Si hay un error, devolver un mensaje de error en formato JSON
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'message' => 'Error al conectar o consultar la base de datos: ' . $e->getMessage()]);
    exit;
}



?>