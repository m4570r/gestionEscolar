<?php 

//echo "post_usuario.php";

include 'conexion.php';

// Obtener el payload JSON del body
$data = json_decode(file_get_contents("php://input"), true);

// Validar los campos necesarios
if (
    !isset($data['nombre']) || empty($data['nombre']) || 
    !isset($data['rut']) || empty($data['rut']) || 
    !isset($data['fechaNacimiento']) || empty($data['fechaNacimiento']) || 
    !isset($data['domicilio']) || 
    !isset($data['calle']) || empty($data['calle']) || 
    !isset($data['numero']) || empty($data['numero']) || 
    !isset($data['idComuna']) || empty($data['idComuna']) || 
    !isset($data['email']) || empty($data['email']) || 
    !isset($data['telefono']) || empty($data['telefono']) || 
    !isset($data['nivel']) || empty($data['nivel'])
) {
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'message' => 'No se proporcionaron todos los datos requeridos']);
    exit;
}

$nombre = $data['nombre'];
$rut = $data['rut'];
$fechaNacimiento = $data['fechaNacimiento'];
$domicilio = $data['domicilio'];
$calle = $data['calle'];
$numero = $data['numero'];
$idComuna = $data['idComuna'];
$email = $data['email'];
$telefono = $data['telefono'];
$nivel = $data['nivel'];

try {
    $stmt = $pdo->prepare('INSERT INTO usuarios (nombre, rut, fechaNacimiento, domicilio, calle, numero, idComuna, email, telefono, nivel) VALUES (:nombre, :rut, :fechaNacimiento, :domicilio, :calle, :numero, :idComuna, :email, :telefono, :nivel)');
    $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
    $stmt->bindParam(':rut', $rut, PDO::PARAM_STR);
    $stmt->bindParam(':fechaNacimiento', $fechaNacimiento, PDO::PARAM_STR);
    $stmt->bindParam(':domicilio', $domicilio, PDO::PARAM_STR);
    $stmt->bindParam(':calle', $calle, PDO::PARAM_STR);
    $stmt->bindParam(':numero', $numero, PDO::PARAM_INT);
    $stmt->bindParam(':idComuna', $idComuna, PDO::PARAM_INT);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->bindParam(':telefono', $telefono, PDO::PARAM_STR);
    $stmt->bindParam(':nivel', $nivel, PDO::PARAM_STR);

    $stmt->execute();

    header('Content-Type: application/json');
    echo json_encode(['success' => true, 'message' => 'Usuario añadido con éxito']);

} catch (\PDOException $e) {
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'message' => 'Error al conectar o insertar en la base de datos: ' . $e->getMessage()]);
    exit;
}

?>
