<?php
header("Content-Type: application/json");

// Incluir la configuración de la base de datos y la entidad Usuario
include_once('../ruta.php');
include RUTA_CONFIG;
include RUTA_USUARIOS;

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Realizar la consulta para obtener un usuario específico (por ejemplo, por ID)
    if (isset($_GET['id'])) {
        $id_usuario = $_GET['id'];

        $query = "SELECT * FROM usuarios WHERE Codigo_Empleado = $id_usuario";
        $result = $conexion->query($query);

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $usuario = new Usuario($row['Codigo_Empleado'], $row['nombre'], $row['apellido'], $row['Clave']);

            echo json_encode(get_object_vars($usuario));
        } else {
            echo json_encode(array("error" => "Usuario no encontrado"));
        }
    } else {
        echo json_encode(array("error" => "ID de usuario no proporcionado"));
    }
} else {
    echo json_encode(array("error" => "Método no permitido"));
}

// Cerrar la conexión a la base de datos
$conexion->close();
?>
