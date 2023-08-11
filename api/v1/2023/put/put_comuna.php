<?php 

//echo "put_comuna.php"; 

// Incluye la conexión a la base de datos
include 'conexion.php';

// Recibe el payload JSON del body
$data = json_decode(file_get_contents("php://input"), true);

// Verifica que el id esté establecido
if (!isset($data['id'])) {
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'message' => 'El campo id es obligatorio.']);
    exit;
}

$id = $data['id'];

// Construcción dinámica de la consulta SQL
$sql = 'UPDATE comunas SET ';
$params = [];
$first = true;

foreach ($data as $key => $value) {
    // Evita agregar el id al conjunto SET
    if ($key !== 'id') {
        if (!$first) {
            $sql .= ', ';
        }
        $sql .= "$key = :$key";
        $params[":$key"] = $value;
        $first = false;
    }
}

$sql .= ' WHERE id=:id';
$params[':id'] = $id;

try {
    // Preparar y ejecutar la consulta SQL
    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    
    // Establece el tipo de contenido como JSON
    header('Content-Type: application/json');
    
    // Devuelve un mensaje de éxito
    echo json_encode(['success' => true, 'message' => 'Comuna actualizada con éxito']);
    
} catch (\PDOException $e) {
    // En caso de error, devuelve un mensaje de error en formato JSON
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'message' => 'Error al conectar o actualizar en la base de datos: ' . $e->getMessage()]);
    exit;
}

?>