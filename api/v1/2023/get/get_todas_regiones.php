<?php 

//echo "get_todas_regiones.php";

// Incluye tu conexión existente
include 'conexion.php';

try {
    // Consulta SQL para obtener todas las regiones
    $stmt = $pdo->query('SELECT id, nombre FROM regiones');
    
    // Obtener todas las regiones como un array
    $regiones = $stmt->fetchAll();

    // Establecer el tipo de contenido como JSON
    header('Content-Type: application/json');

    // Si hay regiones, devolverlas, de lo contrario enviar un mensaje
    if ($regiones) {
        echo json_encode(['success' => true, 'regiones' => $regiones]);
    } else {
        echo json_encode(['success' => false, 'message' => 'No se encontraron regiones']);
    }
    
} catch (\PDOException $e) {
    // Si hay un error, devolver un mensaje de error en formato JSON
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'message' => 'Error al conectar o consultar la base de datos: ' . $e->getMessage()]);
    exit;
}
?>