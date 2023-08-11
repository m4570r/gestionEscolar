<?php 

//echo "get_rolesUsuario_todas.php";

// Incluye tu conexión existente
include 'conexion.php';

try {
    // Consulta SQL para obtener todos los roles de usuario
    $stmt = $pdo->query('SELECT id, nombre FROM rolesUsuario');
    
    // Obtener todos los roles como un array
    $roles = $stmt->fetchAll();

    // Establecer el tipo de contenido como JSON
    header('Content-Type: application/json');

    // Si hay registros, devolverlos, de lo contrario enviar un mensaje
    if ($roles) {
        echo json_encode(['success' => true, 'roles' => $roles]);
    } else {
        echo json_encode(['success' => false, 'message' => 'No se encontraron roles de usuario']);
    }
    
} catch (\PDOException $e) {
    // Si hay un error, devolver un mensaje de error en formato JSON
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'message' => 'Error al conectar o consultar la base de datos: ' . $e->getMessage()]);
    exit;
}


?>