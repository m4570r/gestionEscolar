<?php

//echo "post_rolUsuario.php";

// Incluye la conexión a la base de datos
include 'conexion.php';

// Recibe el payload JSON del body
$data = json_decode(file_get_contents("php://input"), true);

// Verifica que todos los campos requeridos estén establecidos
if (!isset($data['nombre']) || empty($data['nombre']) || 
    !isset($data['nivel']) || !is_numeric($data['nivel'])) { // Aquí cambiamos la verificación
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'message' => 'Los campos nombre y nivel son obligatorios.']);
    exit;
}

$nombre = $data['nombre'];
$nivel = (int) $data['nivel']; // Asegurarse de que nivel es tratado como un entero

try {
    // Consulta SQL para insertar los datos
    $stmt = $pdo->prepare('INSERT INTO rolesUsuario (nombre, nivel) VALUES (:nombre, :nivel)');

    // Vincula los parámetros
    $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
    $stmt->bindParam(':nivel', $nivel, PDO::PARAM_INT); // Usar PDO::PARAM_INT para enteros
    
    $stmt->execute();
    
    // Establece el tipo de contenido como JSON
    header('Content-Type: application/json');
    
    // Devuelve un mensaje de éxito
    echo json_encode(['success' => true, 'message' => 'Rol añadido con éxito']);
    
} catch (\PDOException $e) {
    // En caso de error, devuelve un mensaje de error en formato JSON
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'message' => 'Error al conectar o insertar en la base de datos: ' . $e->getMessage()]);
    exit;
}

?>
