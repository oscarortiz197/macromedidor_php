<?php
header("Content-Type: application/json");

// Incluir la configuración de la base de datos y la entidad Lectura
include_once('../ruta.php');
include RUTA_CONFIG;
include RUTA_LECTURAS;

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Realizar la consulta para obtener todas las lecturas
    $result = $conexion->query("SELECT * FROM lecturas");

    if ($result) {
        $lecturas = array();

        while ($row = $result->fetch_assoc()) {
            // Crear un objeto Lectura para cada fila de la base de datos
            $lectura = new Lectura($row['ID'], $row['fecha'], $row['Codigo_Empleado'], $row['Lectura'], $row['Img']);
            $lecturas[] = $lectura;
        }

        // Convertir el array de objetos Lectura a un array asociativo para la salida JSON
        $lecturasArray = array_map(function ($lectura) {
            return get_object_vars($lectura);
        }, $lecturas);

        echo json_encode($lecturasArray);
    } else {
        echo json_encode(array("error" => "Error al obtener lecturas: " . $conexion->error));
    }
} else {
    echo json_encode(array("error" => "Método no permitido"));
}

// Cerrar la conexión a la base de datos
$conexion->close();
?>
