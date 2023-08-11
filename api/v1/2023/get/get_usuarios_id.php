<?php 

//echo "get_usuarios_id.php";

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
    // Consulta SQL para obtener los detalles de un usuario por ID
    $stmt = $pdo->prepare('SELECT id, nombre, rut, fechaNacimiento, domicilio, calle, numero, idComuna, email, telefono, nivel FROM usuarios WHERE id = :id');
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    
    // Obtener el usuario como un objeto
    $usuario = $stmt->fetch();

    // Establecer el tipo de contenido como JSON
    header('Content-Type: application/json');

    // Si se encuentra el usuario, devolverlo, de lo contrario enviar un mensaje
    if ($usuario) {
        echo json_encode(['success' => true, 'usuario' => $usuario]);
    } else {
        echo json_encode(['success' => false, 'message' => 'No se encontró el usuario con el ID proporcionado']);
    }
    
} catch (\PDOException $e) {
    // Si hay un error, devolver un mensaje de error en formato JSON
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'message' => 'Error al conectar o consultar la base de datos: ' . $e->getMessage()]);
    exit;
}



?>