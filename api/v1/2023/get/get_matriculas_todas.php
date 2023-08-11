<?php 

//echo "get_matriculas_todas.php";

// Incluye tu conexión existente
include 'conexion.php';

try {
    // Consulta SQL para obtener todas las matrículas
    $stmt = $pdo->query('SELECT id, idAlumno, idFuncionario, idCurso, fechaMatricula, fechaRetiro FROM matriculas');
    
    // Obtener todas las matrículas como un array
    $matriculas = $stmt->fetchAll();

    // Establecer el tipo de contenido como JSON
    header('Content-Type: application/json');

    // Si hay matrículas, devolverlas, de lo contrario enviar un mensaje
    if ($matriculas) {
        echo json_encode(['success' => true, 'matriculas' => $matriculas]);
    } else {
        echo json_encode(['success' => false, 'message' => 'No se encontraron matrículas']);
    }
    
} catch (\PDOException $e) {
    // Si hay un error, devolver un mensaje de error en formato JSON
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'message' => 'Error al conectar o consultar la base de datos: ' . $e->getMessage()]);
    exit;
}



?>