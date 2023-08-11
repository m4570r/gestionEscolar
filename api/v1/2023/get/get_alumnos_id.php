<?php 

//echo "get_alumnos_id.php";

// Incluye tu conexión existente
include 'conexion.php';

// Asegurarse de que el idUsuario esté establecido y no esté vacío
if (!isset($_GET['idUsuario']) || empty($_GET['idUsuario'])) {
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'message' => 'El idUsuario no fue proporcionado']);
    exit;
}

$idUsuario = $_GET['idUsuario'];

try {
    // Consulta SQL para obtener los detalles de un alumno por idUsuario
    $stmt = $pdo->prepare('SELECT idUsuario, sexo, viveCon, viveConEspecificar, idProgramaSocial, idEtnia, repetidoCurso, idColegioAnterior, necesitaTransporte, sectorTransporte FROM alumnos WHERE idUsuario = :idUsuario');
    $stmt->bindParam(':idUsuario', $idUsuario, PDO::PARAM_INT);
    $stmt->execute();
    
    // Obtener el alumno como un objeto
    $alumno = $stmt->fetch();

    // Establecer el tipo de contenido como JSON
    header('Content-Type: application/json');

    // Si se encuentra el alumno, devolverlo, de lo contrario enviar un mensaje
    if ($alumno) {
        echo json_encode(['success' => true, 'alumno' => $alumno]);
    } else {
        echo json_encode(['success' => false, 'message' => 'No se encontró el alumno con el idUsuario proporcionado']);
    }
    
} catch (\PDOException $e) {
    // Si hay un error, devolver un mensaje de error en formato JSON
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'message' => 'Error al conectar o consultar la base de datos: ' . $e->getMessage()]);
    exit;
}

?>