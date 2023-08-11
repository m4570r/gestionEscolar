<?php 

//echo "post_documentoCompartido.php"; 

// Incluye la conexión a la base de datos
include 'conexion.php';

// Recibe el payload JSON del body
$data = json_decode(file_get_contents("php://input"), true);

// Verifica que todos los campos estén establecidos
if (
    !isset($data['idAlumno']) || 
    !isset($data['reglamentoInterno']) || 
    !isset($data['textoEscolarGratis']) || 
    !isset($data['reglamentoEvaluacion'])
) {
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'message' => 'No se proporcionaron todos los datos requeridos']);
    exit;
}

$idAlumno = $data['idAlumno'];
$reglamentoInterno = $data['reglamentoInterno'];
$textoEscolarGratis = $data['textoEscolarGratis'];
$reglamentoEvaluacion = $data['reglamentoEvaluacion'];

try {
    // Consulta SQL para insertar los datos
    $stmt = $pdo->prepare('INSERT INTO documentoscompartidos (idAlumno, reglamentoInterno, textoEscolarGratis, reglamentoEvaluacion) VALUES (:idAlumno, :reglamentoInterno, :textoEscolarGratis, :reglamentoEvaluacion)');

    // Vincula los parámetros
    $stmt->bindParam(':idAlumno', $idAlumno, PDO::PARAM_INT);
    $stmt->bindParam(':reglamentoInterno', $reglamentoInterno, PDO::PARAM_STR);
    $stmt->bindParam(':textoEscolarGratis', $textoEscolarGratis, PDO::PARAM_STR);
    $stmt->bindParam(':reglamentoEvaluacion', $reglamentoEvaluacion, PDO::PARAM_STR);

    $stmt->execute();
    
    // Establece el tipo de contenido como JSON
    header('Content-Type: application/json');
    
    // Devuelve un mensaje de éxito
    echo json_encode(['success' => true, 'message' => 'Documentos añadidos con éxito']);
    
} catch (\PDOException $e) {
    // En caso de error, devuelve un mensaje de error en formato JSON
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'message' => 'Error al conectar o insertar en la base de datos: ' . $e->getMessage()]);
    exit;
}


?>