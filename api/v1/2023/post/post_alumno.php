<?php 

//echo "post_alumno.php";

// Incluye tu conexión existente
include 'conexion.php';

// Obtener el payload JSON del body
$data = json_decode(file_get_contents("php://input"), true);

// Asegurarse de que todos los campos requeridos estén establecidos y no estén vacíos
if (
    !isset($data['idUsuario']) || empty($data['idUsuario']) || 
    !isset($data['sexo']) || empty($data['sexo']) || 
    !isset($data['viveCon']) || empty($data['viveCon']) || 
    !isset($data['idProgramaSocial']) || empty($data['idProgramaSocial']) || 
    !isset($data['idEtnia']) || empty($data['idEtnia']) || 
    !isset($data['repetidoCurso']) || empty($data['repetidoCurso']) || 
    !isset($data['idColegioAnterior']) || empty($data['idColegioAnterior']) || 
    !isset($data['necesitaTransporte']) || empty($data['necesitaTransporte']) || 
    !isset($data['sectorTransporte'])
) {
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'message' => 'No se proporcionaron todos los datos requeridos']);
    exit;
}

$idUsuario = $data['idUsuario'];
$sexo = $data['sexo'];
$viveCon = $data['viveCon'];
$viveConEspecificar = isset($data['viveConEspecificar']) ? $data['viveConEspecificar'] : null;
$idProgramaSocial = $data['idProgramaSocial'];
$idEtnia = $data['idEtnia'];
$repetidoCurso = $data['repetidoCurso'];
$idColegioAnterior = $data['idColegioAnterior'];
$necesitaTransporte = $data['necesitaTransporte'];
$sectorTransporte = $data['sectorTransporte'];

try {
    // Consulta SQL para insertar un nuevo alumno
    $stmt = $pdo->prepare('INSERT INTO alumnos (idUsuario, sexo, viveCon, viveConEspecificar, idProgramaSocial, idEtnia, repetidoCurso, idColegioAnterior, necesitaTransporte, sectorTransporte) VALUES (:idUsuario, :sexo, :viveCon, :viveConEspecificar, :idProgramaSocial, :idEtnia, :repetidoCurso, :idColegioAnterior, :necesitaTransporte, :sectorTransporte)');

    // Vincula los parámetros
    $stmt->bindParam(':idUsuario', $idUsuario, PDO::PARAM_INT);
    $stmt->bindParam(':sexo', $sexo, PDO::PARAM_STR);
    $stmt->bindParam(':viveCon', $viveCon, PDO::PARAM_STR);
    $stmt->bindParam(':viveConEspecificar', $viveConEspecificar, PDO::PARAM_STR);
    $stmt->bindParam(':idProgramaSocial', $idProgramaSocial, PDO::PARAM_INT);
    $stmt->bindParam(':idEtnia', $idEtnia, PDO::PARAM_INT);
    $stmt->bindParam(':repetidoCurso', $repetidoCurso, PDO::PARAM_STR);
    $stmt->bindParam(':idColegioAnterior', $idColegioAnterior, PDO::PARAM_INT);
    $stmt->bindParam(':necesitaTransporte', $necesitaTransporte, PDO::PARAM_STR);
    $stmt->bindParam(':sectorTransporte', $sectorTransporte, PDO::PARAM_STR);

    $stmt->execute();
    
    // Establecer el tipo de contenido como JSON
    header('Content-Type: application/json');
    
    // Devuelve un mensaje de éxito
    echo json_encode(['success' => true, 'message' => 'Alumno añadido con éxito']);
    
} catch (\PDOException $e) {
    // Si hay un error, devolver un mensaje de error en formato JSON
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'message' => 'Error al conectar o insertar en la base de datos: ' . $e->getMessage()]);
    exit;
}

?>
