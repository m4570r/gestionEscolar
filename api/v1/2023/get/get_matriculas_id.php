<?php 

//echo "get_matriculas_id.php";

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
    // Consulta SQL para obtener los detalles de una matrícula por id
    $stmt = $pdo->prepare('SELECT id, idAlumno, idFuncionario, idCurso, fechaMatricula, fechaRetiro FROM matriculas WHERE id = :id');
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    
    // Obtener la matrícula como un objeto
    $matricula = $stmt->fetch();

    // Establecer el tipo de contenido como JSON
    header('Content-Type: application/json');

    // Si se encuentra la matrícula, devolverla, de lo contrario enviar un mensaje
    if ($matricula) {
        echo json_encode(['success' => true, 'matricula' => $matricula]);
    } else {
        echo json_encode(['success' => false, 'message' => 'No se encontró la matrícula con el id proporcionado']);
    }
    
} catch (\PDOException $e) {
    // Si hay un error, devolver un mensaje de error en formato JSON
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'message' => 'Error al conectar o consultar la base de datos: ' . $e->getMessage()]);
    exit;
}

?>