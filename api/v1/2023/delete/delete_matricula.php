<?php 

//echo "delete_matricula.php"; 

// Incluye la conexión a la base de datos
include 'conexion.php';

// Recibe el payload JSON del body
$data = json_decode(file_get_contents("php://input"), true);

// Verifica que el idAlumno esté establecido
if (!isset($data['idAlumno'])) {
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'message' => 'El campo idAlumno es obligatorio.']);
    exit;
}

$idAlumno = $data['idAlumno'];

// Construye la consulta SQL
$sql = 'DELETE FROM matriculas WHERE idAlumno=:idAlumno';

try {
    // Preparar y ejecutar la consulta SQL
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':idAlumno' => $idAlumno]);
    
    // Establece el tipo de contenido como JSON
    header('Content-Type: application/json');
    
    // Si ningún registro fue eliminado, devuelve un mensaje
    if ($stmt->rowCount() === 0) {
        echo json_encode(['success' => false, 'message' => 'No se encontraron registros de matrícula con el idAlumno especificado.']);
    } else {
        // Devuelve un mensaje de éxito
        echo json_encode(['success' => true, 'message' => 'Registro de matrícula eliminado con éxito']);
    }
    
} catch (\PDOException $e) {
    // En caso de error, devuelve un mensaje de error en formato JSON
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'message' => 'Error al conectar o eliminar en la base de datos: ' . $e->getMessage()]);
    exit;
}

?>