<?php 

//echo "put_alumno.php"; 

// Incluye la conexión a la base de datos
include 'conexion.php';

// Recibe el payload JSON del body
$data = json_decode(file_get_contents("php://input"), true);

// Verifica que el idUsuario esté establecido
if (!isset($data['idUsuario'])) {
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'message' => 'El campo idUsuario es obligatorio.']);
    exit;
}

$idUsuario = $data['idUsuario'];

// Construcción dinámica de la consulta SQL
$sql = 'UPDATE alumnos SET ';
$params = [];
$first = true;

foreach ($data as $key => $value) {
    // Evita agregar el idUsuario al conjunto SET
    if ($key !== 'idUsuario') {
        if (!$first) {
            $sql .= ', ';
        }
        $sql .= "$key = :$key";
        $params[":$key"] = $value;
        $first = false;
    }
}

$sql .= ' WHERE idUsuario=:idUsuario';
$params[':idUsuario'] = $idUsuario;

try {
    // Preparar y ejecutar la consulta SQL
    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    
    // Establece el tipo de contenido como JSON
    header('Content-Type: application/json');
    
    // Devuelve un mensaje de éxito
    echo json_encode(['success' => true, 'message' => 'Alumno actualizado con éxito']);
    
} catch (\PDOException $e) {
    // En caso de error, devuelve un mensaje de error en formato JSON
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'message' => 'Error al conectar o actualizar en la base de datos: ' . $e->getMessage()]);
    exit;
}

?>