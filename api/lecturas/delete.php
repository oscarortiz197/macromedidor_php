<?php
header("Content-Type: application/json");

// Incluir la configuración de la base de datos y la entidad Lectura
include_once('../ruta.php');
include RUTA_CONFIG;
include RUTA_LECTURAS;

if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    // Obtener el ID de la lectura a eliminar
    parse_str(file_get_contents("php://input"), $datos);
    $id_lectura = $datos['id'] ?? -1;
    // var_dump( $id_lectura) ;
//    $id_lectura=intval($id_lectura);
    // Validar que el ID sea un número entero
    if (!is_numeric($id_lectura)) {
        return http_response_code(301);
    }

    // Obtener el nombre de la imagen asociada a la lectura
    $query = "SELECT Img FROM lecturas WHERE ID = $id_lectura";
    $result = $conexion->query($query);

    if ($result && $row = $result->fetch_assoc()) {
        $nombreImagen = $row['Img'];

        // Eliminar la imagen de la carpeta uploads
        $rutaImagen = RUTA_UPLOADS . $nombreImagen;
        if (file_exists($rutaImagen)) {
            unlink($rutaImagen);
        }
    }

    // Realizar la consulta para eliminar la lectura
    $queryDelete = "DELETE FROM lecturas WHERE ID = $id_lectura";
    $resultDelete = $conexion->query($queryDelete);

    if ($conexion->affected_rows > 0) {
        echo json_encode(array("mensaje" => "Lectura eliminada correctamente"));
    } else {
        echo json_encode(array("error" => "Error al eliminar lectura: " . $conexion->error));
         http_response_code(404);
    }
} else {
    echo json_encode(array("error" => "Método no permitido"));
     http_response_code(404);
}

// Cerrar la conexión a la base de datos
$conexion->close();
?>
