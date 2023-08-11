<?php 

//echo "get_alumnos_todos.php";

// Incluye tu conexión existente
include 'conexion.php';

try {
    // Consulta SQL para obtener todos los alumnos
    $stmt = $pdo->query('SELECT idUsuario, sexo, viveCon, viveConEspecificar, idProgramaSocial, idEtnia, repetidoCurso, idColegioAnterior, necesitaTransporte, sectorTransporte FROM alumnos');
    
    // Obtener todos los alumnos como un array
    $alumnos = $stmt->fetchAll();

    // Establecer el tipo de contenido como JSON
    header('Content-Type: application/json');

    // Si hay alumnos, devolverlos, de lo contrario enviar un mensaje
    if ($alumnos) {
        echo json_encode(['success' => true, 'alumnos' => $alumnos]);
    } else {
        echo json_encode(['success' => false, 'message' => 'No se encontraron alumnos']);
    }
    
} catch (\PDOException $e) {
    // Si hay un error, devolver un mensaje de error en formato JSON
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'message' => 'Error al conectar o consultar la base de datos: ' . $e->getMessage()]);
    exit;
}



?>