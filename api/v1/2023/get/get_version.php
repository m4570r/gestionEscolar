<?php

try {
    $mensaje = 'API escrita en PHP';

    // Armar el JSON de respuesta
    $response = [
        'version' => "1.1.9",
        'nombreColegio' => "escuela",
        'mensaje' => $mensaje
    ];

    // Establecer encabezados de respuesta
    header('Content-Type: application/json');
    http_response_code(200); // Código de estado 200 - OK

    // Imprimir la respuesta JSON
    echo json_encode($response, JSON_PRETTY_PRINT);
} catch (Exception $e) {
    // Error al obtener la versión o el nombre del colegio
    header('Content-Type: application/json');
    http_response_code(500); // Código de estado 500 - Error interno del servidor

    $response = [
        'success' => false,
        'message' => 'Error al obtener la versión o el nombre del colegio'
    ];

    echo json_encode($response, JSON_PRETTY_PRINT);
}

// Fin del script
exit();
?>