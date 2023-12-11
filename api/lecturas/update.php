<?php
header("Content-Type: application/json");

// Incluir la configuración de la base de datos y la entidad Lectura
include_once('../ruta.php');
include RUTA_CONFIG;
include RUTA_LECTURAS;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener datos de la lectura a actualizar desde el cuerpo de la solicitud
    $id_lectura = $_POST['id'] ?? null;
    $fecha = $_POST['fecha'] ?? null;
    $codigoEmpleado = $_POST['codigoEmpleado'] ?? null;
    $lectura = $_POST['lectura'] ?? null;
    $img = $_POST['img'] ?? null;

    // Validar que el ID sea un número entero
    if (!is_numeric($id_lectura)) {
        echo json_encode(array("error" => "ID de lectura no válido"));
        return http_response_code(400);
        
    }

    if($id_lectura==null || $fecha==null || $codigoEmpleado==null || $lectura==null ){
        return http_response_code(400);
    }

    // Realizar la actualización en la base de datos
    $query = "UPDATE lecturas SET fecha = ?, Codigo_Empleado = ?, Lectura = ?, Img = ? WHERE ID = ?";
    $stmt = $conexion->prepare($query);

    // Vincular parámetros
    $stmt->bind_param("ssssi", $fecha, $codigoEmpleado, $lectura, $img, $id_lectura);

    // Ejecutar la consulta
    $resultado = $stmt->execute();

    if ($resultado) {
        echo json_encode(array("mensaje" => "Lectura actualizada correctamente"));
    } else {
        echo json_encode(array("error" => "Error al actualizar lectura: " . $conexion->error));
         http_response_code(400);
    }

    // Cerrar la declaración preparada
    $stmt->close();
} else {
    echo json_encode(array("error" => "Método no permitido"));
}

// Cerrar la conexión a la base de datos
$conexion->close();
?>
