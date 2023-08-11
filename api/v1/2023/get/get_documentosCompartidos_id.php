<?php

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
    // Consulta SQL para obtener los documentos compartidos de un alumno específico por idAlumno
    $stmt = $pdo->prepare('SELECT idAlumno, reglamentoInterno, textoEscolarGratis, reglamentoEvaluacion FROM documentosCompartidos WHERE idAlumno = :idAlumno');
    $stmt->bindParam(':idAlumno', $idAlumno, PDO::PARAM_INT);
    $stmt->execute();
    
    // Obtener los documentos como un objeto
    $registroDocumentos = $stmt->fetch();

    // Establecer el tipo de contenido como JSON
    header('Content-Type: application/json');

    // Si se encuentra el registro de documentos, devolverlo, de lo contrario enviar un mensaje
    if ($registroDocumentos) {
        echo json_encode(['success' => true, 'registroDocumentos' => $registroDocumentos]);
    } else {
        echo json_encode(['success' => false, 'message' => 'No se encontraron documentos compartidos con el idAlumno proporcionado']);
    }
    
} catch (\PDOException $e) {
    // Si hay un error, devolver un mensaje de error en formato JSON
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'message' => 'Error al conectar o consultar la base de datos: ' . $e->getMessage()]);
    exit;
}

?>
