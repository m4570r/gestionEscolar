<?php 

//echo "post_salud.php"; 

// Incluye la conexión a la base de datos
include 'conexion.php';

// Recibe el payload JSON del body
$data = json_decode(file_get_contents("php://input"), true);

// Verifica que todos los campos requeridos estén establecidos
if (!isset($data['idAlumno']) || 
    !isset($data['tratamientoMedico']) ||
    !isset($data['programaEscolar']) ||
    !isset($data['contraindicacionMedica']) ||
    !isset($data['alergiaMedicamento']) ||
    !isset($data['alergiaAlimento']) ||
    !isset($data['antecedentesTrastornos']) ||
    !isset($data['previsionSocial'])) {
    
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'message' => 'Todos los campos son obligatorios.']);
    exit;
}

$idAlumno = $data['idAlumno'];
$tratamientoMedico = $data['tratamientoMedico'];
$programaEscolar = $data['programaEscolar'];
$contraindicacionMedica = $data['contraindicacionMedica'];
$alergiaMedicamento = $data['alergiaMedicamento'];
$alergiaAlimento = $data['alergiaAlimento'];
$antecedentesTrastornos = $data['antecedentesTrastornos'];
$previsionSocial = $data['previsionSocial'];

try {
    // Consulta SQL para insertar los datos
    $stmt = $pdo->prepare('INSERT INTO salud (idAlumno, tratamientoMedico, programaEscolar, contraindicacionMedica, alergiaMedicamento, alergiaAlimento, antecedentesTrastornos, previsionSocial) VALUES (:idAlumno, :tratamientoMedico, :programaEscolar, :contraindicacionMedica, :alergiaMedicamento, :alergiaAlimento, :antecedentesTrastornos, :previsionSocial)');

    // Vincula los parámetros
    $stmt->bindParam(':idAlumno', $idAlumno, PDO::PARAM_INT);
    $stmt->bindParam(':tratamientoMedico', $tratamientoMedico, PDO::PARAM_STR);
    $stmt->bindParam(':programaEscolar', $programaEscolar, PDO::PARAM_STR);
    $stmt->bindParam(':contraindicacionMedica', $contraindicacionMedica, PDO::PARAM_STR);
    $stmt->bindParam(':alergiaMedicamento', $alergiaMedicamento, PDO::PARAM_STR);
    $stmt->bindParam(':alergiaAlimento', $alergiaAlimento, PDO::PARAM_STR);
    $stmt->bindParam(':antecedentesTrastornos', $antecedentesTrastornos, PDO::PARAM_STR);
    $stmt->bindParam(':previsionSocial', $previsionSocial, PDO::PARAM_STR);
    
    $stmt->execute();
    
    // Establece el tipo de contenido como JSON
    header('Content-Type: application/json');
    
    // Devuelve un mensaje de éxito
    echo json_encode(['success' => true, 'message' => 'Datos de salud añadidos con éxito']);
    
} catch (\PDOException $e) {
    // En caso de error, devuelve un mensaje de error en formato JSON
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'message' => 'Error al conectar o insertar en la base de datos: ' . $e->getMessage()]);
    exit;
}


?>