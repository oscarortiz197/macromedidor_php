<?php
header("Content-Type: application/json");

// Incluir la configuración de la base de datos y la entidad Usuario
include_once('../rutas.php');
include RUTA_CONFIG;
include RUTA_USUARIOS;

if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    // Obtener el ID del usuario a eliminar
    parse_str(file_get_contents("php://input"), $datos);
    $id_usuario = $datos['id'];

    // Validar que el ID sea un número entero
    if (!is_numeric($id_usuario)) {
        echo json_encode(array("error" => "ID de usuario no válido"));
        exit;
    }

    // Realizar la consulta para eliminar al usuario
    $query = "DELETE FROM usuarios WHERE Codigo_Empleado = $id_usuario";
    $result = $conexion->query($query);

    if ($result) {
        echo json_encode(array("mensaje" => "Usuario eliminado correctamente"));
    } else {
        echo json_encode(array("error" => "Error al eliminar usuario: " . $conexion->error));
    }
} else {
    echo json_encode(array("error" => "Método no permitido"));
}

// Cerrar la conexión a la base de datos
$conexion->close();
?>
