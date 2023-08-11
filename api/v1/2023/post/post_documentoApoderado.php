<?php 

//echo "post_documentoApoderado.php"; 

// Incluye la conexión a la base de datos
include 'conexion.php';

// Recibe el payload JSON del body
$data = json_decode(file_get_contents("php://input"), true);

// Verifica que todos los campos estén establecidos y no estén vacíos
if (
    !isset($data['idAlumno']) || 
    !isset($data['certificadoEstudios']) || 
    !isset($data['informePersonalidad']) || 
    !isset($data['informeNotas']) || 
    !isset($data['fotocopiaHojaVida']) || 
    !isset($data['boletaAporte']) ||
    !isset($data['certificadoMedico'])
) {
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'message' => 'No se proporcionaron todos los datos requeridos']);
    exit;
}

$idAlumno = $data['idAlumno'];
$certificadoEstudios = $data['certificadoEstudios'];
$informePersonalidad = $data['informePersonalidad'];
$informeNotas = $data['informeNotas'];
$fotocopiaHojaVida = $data['fotocopiaHojaVida'];
$boletaAporte = $data['boletaAporte'];
$certificadoMedico = $data['certificadoMedico'];

try {
    // Consulta SQL para insertar los datos
    $stmt = $pdo->prepare('INSERT INTO documentosapoderado (idAlumno, certificadoEstudios, informePersonalidad, informeNotas, fotocopiaHojaVida, boletaAporte, certificadoMedico) VALUES (:idAlumno, :certificadoEstudios, :informePersonalidad, :informeNotas, :fotocopiaHojaVida, :boletaAporte, :certificadoMedico)');

    // Vincula los parámetros
    $stmt->bindParam(':idAlumno', $idAlumno, PDO::PARAM_INT);
    $stmt->bindParam(':certificadoEstudios', $certificadoEstudios, PDO::PARAM_STR);
    $stmt->bindParam(':informePersonalidad', $informePersonalidad, PDO::PARAM_STR);
    $stmt->bindParam(':informeNotas', $informeNotas, PDO::PARAM_STR);
    $stmt->bindParam(':fotocopiaHojaVida', $fotocopiaHojaVida, PDO::PARAM_STR);
    $stmt->bindParam(':boletaAporte', $boletaAporte, PDO::PARAM_STR);
    $stmt->bindParam(':certificadoMedico', $certificadoMedico, PDO::PARAM_STR);

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