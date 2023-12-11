<?php
header("Content-Type: application/json");

// Incluir la configuración de la base de datos y la entidad Usuario
include_once('../ruta.php');
include RUTA_CONFIG;
include RUTA_USUARIOS;

// Realizar la consulta para obtener todos los usuarios
$result = $conexion->query("SELECT * FROM usuarios");

if ($result) {
    $usuarios = array();

    while ($row = $result->fetch_assoc()) {
        // Crear un objeto Usuario para cada fila de la base de datos
        $usuario = new Usuario($row['Codigo_Empleado'], $row['nombre'], $row['apellido'], $row['Clave']);
        $usuarios[] = $usuario;
    }

    // Convertir el array de objetos Usuario a un array asociativo para la salida JSON
    $usuariosArray = array_map(function ($usuario) {
        return get_object_vars($usuario);
    }, $usuarios);

    echo json_encode($usuariosArray);
} else {
    echo json_encode(array("error" => "Error al obtener usuarios: " . $conexion->error));
}

// Cerrar la conexión a la base de datos
$conexion->close();
?>
