<?php
// index.php

// Controlador para la API REST
// Este controlador se encargará de manejar las solicitudes HTTP y dirigirlas a las funciones correspondientes

// Obtener el método de la solicitud HTTP (GET, POST, PUT, DELETE)
$method = $_SERVER['REQUEST_METHOD'];

// Obtener la ruta de la solicitud
$request = isset($_SERVER['PATH_INFO']) ? explode('/', trim($_SERVER['PATH_INFO'],'/')) : [];

// Definir las acciones basadas en el método y la ruta
switch ($method) {
    case 'GET':
        // Lógica para las solicitudes GET
        handleGetRequest();
        break;
    case 'POST':
        // Lógica para las solicitudes POST
        handlePostRequest();
        break;
    case 'PUT':
        // Lógica para las solicitudes PUT (actualización)
        handlePutRequest();
        break;
    case 'DELETE':
        // Lógica para las solicitudes DELETE
        handleDeleteRequest();
        break;
        default:
        // Acción por defecto si el método no está soportado
        http_response_code(405); // Código de estado 405 - Método no permitido
    
        // Generar y enviar un mensaje JSON
        $response = [
            'error' => true,
            'message' => "Método no soportado: $method"
        ];
    
        header('Content-Type: application/json');
        echo json_encode($response);
    

        exit();
        break;
}

// Función para manejar solicitudes GET.
function handleGetRequest() {
    // Define el tipo de contenido de la respuesta como JSON
    header('Content-Type: application/json');

    try {
        // Verifica si la solicitud es de tipo GET
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {

            // Si se consulta la versión
            if (isset($_GET['version'])) {
                include_once 'get/get_version.php';

            // Si se solicitan todas las regiones
            } elseif (isset($_GET['regiones'])) {
                include_once 'get/get_todas_regiones.php';

            // Si se solicitan todas las comunas
            } elseif (isset($_GET['comunas'])) {
                include_once 'get/get_comunas_todas.php';

            // Si se solicitan comunas por una región específica
            } elseif (isset($_GET['comunasPorRegion'])) {
                $idRegion = $_GET['idRegion'] ?? null;
                include_once 'get/get_comunas_region.php';

            // Si se solicitan programas sociales y se verifica si se proporciona un ID específico
            } elseif (isset($_GET['programasSociales'])) {
                if (isset($_GET['id'])) {
                    $id = $_GET['id'];
                    include_once 'get/get_programaSocial_id.php';
                } else {
                    include_once 'get/get_programaSocial_todos.php';
                }

            // Si se solicitan detalles de etnias y se verifica si se proporciona un ID específico
            } elseif (isset($_GET['etnias'])) {
                if (isset($_GET['id'])) {
                    $id = $_GET['id'];
                    include_once 'get/get_etnias_id.php';
                } else {
                    include_once 'get/get_etnias_todos.php';
                }

            // Si se solicitan detalles de cursos y se verifica si se proporciona un ID específico
            } elseif (isset($_GET['cursos'])) {
                if (isset($_GET['id'])) {
                    $id = $_GET['id'];
                    include_once 'get/get_cursos_id.php';
                } else {
                    include_once 'get/get_cursos_todos.php';
                }

            // Si se solicitan colegios anteriores y se verifica si se proporciona un ID específico
            } elseif (isset($_GET['colegiosAnteriores'])) {
                if (isset($_GET['id'])) {
                    $id = $_GET['id'];
                    include_once 'get/get_colegiosAnteriores_id.php';
                } else {
                    include_once 'get/get_colegiosAnteriores_todos.php';
                }

            // Si se solicitan detalles de usuarios y se verifica si se proporciona un ID específico
            } elseif (isset($_GET['usuarios'])) {
                if (isset($_GET['id'])) {
                    $id = $_GET['id'];
                    include_once 'get/get_usuarios_id.php';
                } else {
                    include_once 'get/get_usuarios_todos.php';
                }

            // Si se solicitan alumnos por usuario y se verifica si se proporciona un ID específico de usuario
            } elseif (isset($_GET['alumnos'])) {
                if (isset($_GET['idUsuario'])) {
                    $id = $_GET['idUsuario'];
                    include_once 'get/get_alumnos_id.php';
                } else {
                    include_once 'get/get_alumnos_todas.php';
                }

            // Si se solicitan detalles de matriculas y se verifica si se proporciona un ID específico
            } elseif (isset($_GET['matriculas'])) {
                if (isset($_GET['id'])) {
                    $id = $_GET['id'];
                    include_once 'get/get_matriculas_id.php';
                } else {
                    include_once 'get/get_matriculas_todas.php';
                }

            // Si se solicitan detalles de salud y se verifica si se proporciona un ID específico de alumno
            } elseif (isset($_GET['salud'])) {
                if (isset($_GET['idAlumno'])) {
                    $id = $_GET['idAlumno'];
                    include_once 'get/get_salud_id.php';
                } else {
                    http_response_code(400);  
                    echo json_encode([
                        'success' => false,
                        'message' => "Solicitud GET no soportada."  
                    ]);
                    exit;
                }

            // Si se solicitan documentos del apoderado y se verifica si se proporciona un ID específico de alumno
            } elseif (isset($_GET['documentosApoderado'])) {
                if (isset($_GET['idAlumno'])) {
                    $id = $_GET['idAlumno'];
                    include_once 'get/get_documentosApoderado_id.php';
                } else {
                    include_once 'get/get_documentosApoderado_todas.php';
                    exit;
                }

            // Si se solicitan documentos compartidos y se verifica si se proporciona un ID específico de alumno
            } elseif (isset($_GET['documentosCompartidos'])) {
                if (isset($_GET['idAlumno'])) {
                    $id = $_GET['idAlumno'];
                    include_once 'get/get_documentosCompartidos_id.php';
                } else {
                    include_once 'get/get_documentosCompartidos_todas.php';
                    exit;
                }

            // Si se solicitan roles de usuario y se verifica si se proporciona un ID específico
            } elseif (isset($_GET['rolesUsuario'])) {
                if (isset($_GET['id'])) {
                    $id = $_GET['id'];
                    include_once 'get/get_rolesUsuario_id.php';
                } else {
                    include_once 'get/get_rolesUsuario_todas.php';
                    exit;
                }

            // Si no se reconoce la solicitud GET, se responde con un error
            } else {
                http_response_code(400); 
                echo json_encode([
                    'success' => false,
                    'message' => "Solicitud GET no soportada."
                ]);
                exit;
            }

        // Si el método de la solicitud no es GET, se responde con un error
        } else {
            http_response_code(400);  
            echo json_encode([
                'success' => false,
                'message' => "Método no soportado."  
            ]);
            exit;
        }

    // Si ocurre una excepción durante la ejecución, se responde con un error
    } catch (Exception $e) {
        http_response_code(500);  
        echo json_encode([
            'success' => false,
            'message' => "Error interno del Servidor"  
        ]);
        exit;
    }
}

// Función para manejar solicitudes POST.
function handlePostRequest() {
    // Define el tipo de contenido de la respuesta como JSON
    header('Content-Type: application/json');

    try {
        // Verifica si la solicitud es de tipo POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Si se quiere agregar una nueva región
            if (isset($_GET['agregarRegion'])) {
                include_once 'post/post_region.php';

            // Si se quiere agregar una nueva comuna
            } elseif (isset($_GET['agregarComuna'])) {
                include_once 'post/post_comuna.php';

            // Si se quiere agregar un nuevo programa social
            } elseif (isset($_GET['agregarProgramaSocial'])) {
                include_once 'post/post_programaSocial.php';

            // Si se quiere agregar una nueva etnia
            } elseif (isset($_GET['agregarEtnia'])) {
                include_once 'post/post_etnia.php';

            // Si se quiere agregar un nuevo curso
            } elseif (isset($_GET['agregarCurso'])) {
                include_once 'post/post_curso.php';

            // Si se quiere agregar un nuevo colegio anterior
            } elseif (isset($_GET['agregarColegioAnterior'])) {
                include_once 'post/post_colegioAnterior.php';

            // Si se quiere agregar un nuevo usuario
            } elseif (isset($_GET['agregarUsuario'])) {
                include_once 'post/post_usuario.php';

            // Si se quiere agregar un nuevo alumno
            } elseif (isset($_GET['agregarAlumno'])) {
                include_once 'post/post_alumno.php';

            // Si se quiere agregar una nueva matrícula
            } elseif (isset($_GET['agregarMatricula'])) {
                include_once 'post/post_matricula.php';

            // Si se quiere agregar una nueva información de salud
            } elseif (isset($_GET['agregarSalud'])) {
                include_once 'post/post_salud.php';

            // Si se quiere agregar un nuevo documento del apoderado
            } elseif (isset($_GET['agregarDocumentoApoderado'])) {
                include_once 'post/post_documentoApoderado.php';

            // Si se quiere agregar un nuevo documento compartido
            } elseif (isset($_GET['agregarDocumentoCompartido'])) {
                include_once 'post/post_documentoCompartido.php';

            // Si se quiere agregar un nuevo rol de usuario
            } elseif (isset($_GET['agregarRolUsuario'])) {
                include_once 'post/post_rolUsuario.php';

            // Si el endpoint POST proporcionado no se reconoce, se responde con un error
            } else {
                http_response_code(400);
                echo json_encode([
                    'success' => false,
                    'message' => "Endpoint POST no válido"
                ]);
                exit;
            }
        // Si el método de la solicitud no es POST, se responde con un error
        } else {
            http_response_code(400);
            echo json_encode([
                'success' => false,
                'message' => "Método no soportado"
            ]);
            exit;
        }
    // Si ocurre una excepción durante la ejecución, se responde con un mensaje detallado del error
    } catch (Exception $e) {
        http_response_code(500);
        echo json_encode([
            'success' => false,
            'message' => "Error interno del servidor: " . $e->getMessage()
        ]);
        exit;
    }
}

// Función para manejar solicitudes PUT.
function handlePutRequest() {
    // Define el tipo de contenido de la respuesta como JSON
    header('Content-Type: application/json');

    try {
        // Verifica si la solicitud es de tipo PUT
        if ($_SERVER['REQUEST_METHOD'] === 'PUT') {

            // Si se quiere actualizar una región existente
            if (isset($_GET['actualizarRegion'])) {
                include_once 'put/put_region.php';

            // Si se quiere actualizar una comuna existente
            } elseif (isset($_GET['actualizarComuna'])) {
                include_once 'put/put_comuna.php';

            // Si se quiere actualizar un programa social existente
            } elseif (isset($_GET['actualizarProgramaSocial'])) {
                include_once 'put/put_programaSocial.php';

            // Si se quiere actualizar una etnia existente
            } elseif (isset($_GET['actualizarEtnia'])) {
                include_once 'put/put_etnia.php';

            // Si se quiere actualizar un curso existente
            } elseif (isset($_GET['actualizarCurso'])) {
                include_once 'put/put_curso.php';

            // Si se quiere actualizar un colegio anterior existente
            } elseif (isset($_GET['actualizarColegioAnterior'])) {
                include_once 'put/put_colegioAnterior.php';

            // Si se quiere actualizar un usuario existente
            } elseif (isset($_GET['actualizarUsuario'])) {
                include_once 'put/put_usuario.php';

            // Si se quiere actualizar un alumno existente
            } elseif (isset($_GET['actualizarAlumno'])) {
                include_once 'put/put_alumno.php';

            // Si se quiere actualizar una matrícula existente
            } elseif (isset($_GET['actualizarMatricula'])) {
                include_once 'put/put_matricula.php';

            // Si se quiere actualizar información de salud existente
            } elseif (isset($_GET['actualizarSalud'])) {
                include_once 'put/put_salud.php';

            // Si se quiere actualizar un documento de apoderado existente
            } elseif (isset($_GET['actualizarDocumentoApoderado'])) {
                include_once 'put/put_documentoApoderado.php';

            // Si se quiere actualizar un documento compartido existente
            } elseif (isset($_GET['actualizarDocumentoCompartido'])) {
                include_once 'put/put_documentoCompartido.php';

            // Si se quiere actualizar un rol de usuario existente
            } elseif (isset($_GET['actualizarRolUsuario'])) {
                include_once 'put/put_rolUsuario.php';

            // Si el endpoint PUT proporcionado no se reconoce, se responde con un error
            } else {
                http_response_code(400);  // Código de estado 400 - Solicitud incorrecta
                echo json_encode([
                    'success' => false,
                    'message' => "Endpoint PUT no válido"
                ]);
                exit;
            }
        // Si el método de la solicitud no es PUT, se responde con un error
        } else {
            http_response_code(400);  // Código de estado 400 - Solicitud incorrecta
            echo json_encode([
                'success' => false,
                'message' => "Método no soportado"
            ]);
            exit;
        }
    // Si ocurre una excepción durante la ejecución, se responde con un mensaje detallado del error
    } catch (Exception $e) {
        http_response_code(500);  // Código de estado 500 - Error interno del servidor
        echo json_encode([
            'success' => false,
            'message' => "Error interno del servidor: " . $e->getMessage() // Mostrando el mensaje de la excepción
        ]);
        exit;
    }
}

// Función para manejar solicitudes DELETE.
function handleDeleteRequest() {
    // Define el tipo de contenido de la respuesta como JSON
    header('Content-Type: application/json');

    try {
        // Verifica si la solicitud es de tipo DELETE
        if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {

            // Si se quiere eliminar una región existente
            if (isset($_GET['eliminarRegion'])) {
                include_once 'delete/delete_region.php';

            // Si se quiere eliminar una comuna existente
            } elseif (isset($_GET['eliminarComuna'])) {
                include_once 'delete/delete_comuna.php';

            // Si se quiere eliminar un programa social existente
            } elseif (isset($_GET['eliminarProgramaSocial'])) {
                include_once 'delete/delete_programaSocial.php';

            // Si se quiere eliminar una etnia existente
            } elseif (isset($_GET['eliminarEtnia'])) {
                include_once 'delete/delete_etnia.php';

            // Si se quiere eliminar un curso existente
            } elseif (isset($_GET['eliminarCurso'])) {
                include_once 'delete/delete_curso.php';

            // Si se quiere eliminar un colegio anterior existente
            } elseif (isset($_GET['eliminarColegioAnterior'])) {
                include_once 'delete/delete_colegioAnterior.php';

            // Si se quiere eliminar un usuario existente
            } elseif (isset($_GET['eliminarUsuario'])) {
                include_once 'delete/delete_usuario.php';

            // Si se quiere eliminar un alumno existente
            } elseif (isset($_GET['eliminarAlumno'])) {
                include_once 'delete/delete_alumno.php';

            // Si se quiere eliminar una matrícula existente
            } elseif (isset($_GET['eliminarMatricula'])) {
                include_once 'delete/delete_matricula.php';

            // Si se quiere eliminar información de salud existente
            } elseif (isset($_GET['eliminarSalud'])) {
                include_once 'delete/delete_salud.php';

            // Si se quiere eliminar un documento de apoderado existente
            } elseif (isset($_GET['eliminarDocumentoApoderado'])) {
                include_once 'delete/delete_documentoApoderado.php';

            // Si se quiere eliminar un documento compartido existente
            } elseif (isset($_GET['eliminarDocumentoCompartido'])) {
                include_once 'delete/delete_documentoCompartido.php';

            // Si se quiere eliminar un rol de usuario existente
            } elseif (isset($_GET['eliminarRolUsuario'])) {
                include_once 'delete/delete_rolUsuario.php';

            // Si el endpoint DELETE proporcionado no se reconoce, se responde con un error
            } else {
                http_response_code(400);  // Código de estado 400 - Solicitud incorrecta
                echo json_encode([
                    'success' => false,
                    'message' => "Endpoint DELETE no válido"
                ]);
                exit;
            }
        // Si el método de la solicitud no es DELETE, se responde con un error
        } else {
            http_response_code(400);  // Código de estado 400 - Solicitud incorrecta
            echo json_encode([
                'success' => false,
                'message' => "Método no soportado"
            ]);
            exit;
        }
    // Si ocurre una excepción durante la ejecución, se responde con un mensaje detallado del error
    } catch (Exception $e) {
        http_response_code(500);  // Código de estado 500 - Error interno del servidor
        echo json_encode([
            'success' => false,
            'message' => "Error interno del servidor: " . $e->getMessage() // Mostrando el mensaje de la excepción
        ]);
        exit;
    }
}

?>
