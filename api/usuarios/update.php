<?php
header("Content-Type: application/json");

// Incluir la configuración de la base de datos y la entidad Usuario
include_once('../rutas.php');
include RUTA_CONFIG;
include RUTA_USUARIOS;

if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    // Obtener datos del usuario a actualizar desde el cuerpo de la solicitud
    $datos_usuario = json_decode(file_get_contents("php://input"), true);

    // Validar que el ID del usuario y los datos requeridos están presentes
    if (
        isset($datos_usuario['codigoEmpleado']) &&
        isset($datos_usuario['nombre']) &&
        isset($datos_usuario['apellido']) &&
        isset($datos_usuario['clave']) &&
        isset($datos_usuario['id'])
    ) {
        // Crear una instancia de la entidad Usuario
        $usuario_actualizado = new Usuario(
            $datos_usuario['codigoEmpleado'],
            $datos_usuario['nombre'],
            $datos_usuario['apellido'],
            $datos_usuario['clave']
        );

        // Obtener el ID del usuario a actualizar
        $id_usuario = $datos_usuario['id'];

        // Realizar la actualización en la base de datos
        $query = "UPDATE usuarios SET Codigo_Empleado=?, nombre=?, apellido=?, Clave=? WHERE Codigo_Empleado=?";
        $stmt = $conexion->prepare($query);

        // Vincular parámetros
        $stmt->bind_param("isssi", $usuario_actualizado->codigoEmpleado, $usuario_actualizado->nombre, $usuario_actualizado->apellido, $usuario_actualizado->clave, $id_usuario);

        // Ejecutar la consulta
        $resultado = $stmt->execute();

        if ($resultado) {
            echo json_encode(array("mensaje" => "Usuario actualizado correctamente"));
        } else {
            echo json_encode(array("error" => "Error al actualizar usuario: " . $conexion->error));
        }

        // Cerrar la declaración preparada
        $stmt->close();
    } else {
        echo json_encode(array("error" => "Datos incompletos para la actualización"));
    }
} else {
    echo json_encode(array("error" => "Método no permitido"));
}

// Cerrar la conexión a la base de datos
$conexion->close();
?>
