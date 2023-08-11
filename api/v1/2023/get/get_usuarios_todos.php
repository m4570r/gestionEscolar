<?php 

//echo "get_usuarios_todos.php";



// Incluye tu conexión existente
include 'conexion.php';

try {
    // Consulta SQL para obtener todos los usuarios
    $stmt = $pdo->query('SELECT id, nombre, rut, fechaNacimiento, domicilio, calle, numero, idComuna, email, telefono, nivel FROM usuarios');
    
    // Obtener todos los usuarios como un array
    $usuarios = $stmt->fetchAll();

    // Establecer el tipo de contenido como JSON
    header('Content-Type: application/json');

    // Si hay usuarios, devolverlos, de lo contrario enviar un mensaje
    if ($usuarios) {
        echo json_encode(['success' => true, 'usuarios' => $usuarios]);
    } else {
        echo json_encode(['success' => false, 'message' => 'No se encontraron usuarios']);
    }
    
} catch (\PDOException $e) {
    // Si hay un error, devolver un mensaje de error en formato JSON
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'message' => 'Error al conectar o consultar la base de datos: ' . $e->getMessage()]);
    exit;
}


?>