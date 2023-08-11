<?php 

//echo "get_salud_id.php";

// Incluye tu conexión existente
include 'conexion.php';

// Asegurarse de que el idAlumno esté establecido y no esté vacío
if (!isset($_GET['idAlumno']) || empty($_GET['idAlumno'])) {
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'message' => 'El idAlumno no fue proporcionado']);
    exit;
}

$idAlumno = $_GET['idAlumno'];

try {
    // Consulta SQL para obtener los detalles de salud por idAlumno
    $stmt = $pdo->prepare('SELECT idAlumno, tratamientoMedico, programaEscolar, contraindicacionMedica, alergiaMedicamento, alergiaAlimento, antecedentesTrastornos, previsionSocial FROM salud WHERE idAlumno = :idAlumno');
    $stmt->bindParam(':idAlumno', $idAlumno, PDO::PARAM_INT);
    $stmt->execute();
    
    // Obtener la información de salud como un objeto
    $registroSalud = $stmt->fetch();

    // Establecer el tipo de contenido como JSON
    header('Content-Type: application/json');

    // Si se encuentra el registro de salud, devolverlo, de lo contrario enviar un mensaje
    if ($registroSalud) {
        echo json_encode(['success' => true, 'registroSalud' => $registroSalud]);
    } else {
        echo json_encode(['success' => false, 'message' => 'No se encontró el registro de salud con el idAlumno proporcionado']);
    }
    
} catch (\PDOException $e) {
    // Si hay un error, devolver un mensaje de error en formato JSON
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'message' => 'Error al conectar o consultar la base de datos: ' . $e->getMessage()]);
    exit;
}



?>