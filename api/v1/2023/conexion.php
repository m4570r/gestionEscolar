<?php

// Configuración de la conexión a la base de datos
$host = 'localhost';        // Generalmente es 'localhost', pero podría variar según tu proveedor de hosting o configuración.
$db   = 'escuela';        // Nombre de tu base de datos
$user = 'root';       // Usuario de tu base de datos
$pass = '';    // Contraseña para el usuario de tu base de datos
$charset = 'utf8mb4';       // Juego de caracteres a usar, utf8mb4 es una buena opción general

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,     // Que arroje excepciones en caso de error
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,          // Que devuelva los resultados como arrays asociativos
    PDO::ATTR_EMULATE_PREPARES   => false,                     // Usar preparaciones nativas del driver de DB
];

try {
    // Intentar establecer una conexión con la base de datos usando PDO
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    // Si hay un error al intentar conectar, arrojar una excepción
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}

?>
