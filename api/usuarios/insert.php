<?php
header("Content-Type: application/json");

// Incluir la configuración de la base de datos y la entidad Usuario
include_once('../rutas.php');
include RUTA_CONFIG;
include RUTA_USUARIOS;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener datos del nuevo usuario desde el cuerpo de la solicitud
    $datos_usuario = json_decode(file_get_contents("php://input"), true);

    // Validar los datos requeridos
    if (
        isset($datos_usuario['codigoEmpleado']) &&
        isset($datos_usuario['nombre']) &&
        isset($datos_usuario['apellido']) &&
        isset($datos_usuario['clave'])
    ) {
        // Crear una instancia de la entidad Usuario
        $nuevo_usuario = new Usuario(
            $datos_usuario['codigoEmpleado'],
            $datos_usuario['nombre'],
            $datos_usuario['apellido'],
            $datos_usuario['clave']
        );

        // Realizar la inserción en la base de datos
        $query = "INSERT INTO usuarios (Codigo_Empleado, nombre, apellido, Clave) VALUES (?, ?, ?, ?)";
        $stmt = $conexion->prepare($query);

        // Vincular parámetros
        $stmt->bind_param("isss", $nuevo_usuario->codigoEmpleado, $nuevo_usuario->nombre, $nuevo_usuario->apellido, $nuevo_usuario->clave);

        // Ejecutar la consulta
        $resultado = $stmt->execute();

        if ($resultado) {
            echo json_encode(array("mensaje" => "Usuario insertado correctamente"));
        } else {
            echo json_encode(array("error" => "Error al insertar usuario: " . $conexion->error));
        }

        // Cerrar la declaración preparada
        $stmt->close();
    } else {
        echo json_encode(array("error" => "Datos incompletos para la inserción"));
    }
} else {
    echo json_encode(array("error" => "Método no permitido"));
}

// Cerrar la conexión a la base de datos
$conexion->close();
?>
