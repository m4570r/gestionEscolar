<?php 

//echo "post_matricula.php"; 

// Incluye la conexión a la base de datos
include 'conexion.php';

// Recibe el payload JSON del body
$data = json_decode(file_get_contents("php://input"), true);

// Verifica que todos los campos requeridos estén establecidos
if (
    !isset($data['idAlumno']) || empty($data['idAlumno']) ||
    !isset($data['idFuncionario']) || empty($data['idFuncionario']) ||
    !isset($data['idCurso']) || empty($data['idCurso']) ||
    !isset($data['fechaMatricula']) || empty($data['fechaMatricula'])
) {
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'message' => 'No se proporcionaron todos los datos requeridos']);
    exit;
}

$idAlumno = $data['idAlumno'];
$idFuncionario = $data['idFuncionario'];
$idCurso = $data['idCurso'];
$fechaMatricula = $data['fechaMatricula'];
$fechaRetiro = isset($data['fechaRetiro']) ? $data['fechaRetiro'] : null;

try {
    // Consulta SQL para insertar los datos
    $stmt = $pdo->prepare('INSERT INTO matriculas (idAlumno, idFuncionario, idCurso, fechaMatricula, fechaRetiro) VALUES (:idAlumno, :idFuncionario, :idCurso, :fechaMatricula, :fechaRetiro)');

    // Vincula los parámetros
    $stmt->bindParam(':idAlumno', $idAlumno, PDO::PARAM_INT);
    $stmt->bindParam(':idFuncionario', $idFuncionario, PDO::PARAM_INT);
    $stmt->bindParam(':idCurso', $idCurso, PDO::PARAM_INT);
    $stmt->bindParam(':fechaMatricula', $fechaMatricula, PDO::PARAM_STR);
    $stmt->bindParam(':fechaRetiro', $fechaRetiro, PDO::PARAM_STR);

    $stmt->execute();
    
    // Establece el tipo de contenido como JSON
    header('Content-Type: application/json');
    
    // Devuelve un mensaje de éxito
    echo json_encode(['success' => true, 'message' => 'Matrícula añadida con éxito']);
    
} catch (\PDOException $e) {
    // En caso de error, devuelve un mensaje de error en formato JSON
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'message' => 'Error al conectar o insertar en la base de datos: ' . $e->getMessage()]);
    exit;
}


?>