<?php
header("Content-Type: application/json");

// Incluir la configuración de la base de datos y la entidad Lectura
include_once('../ruta.php');
include RUTA_CONFIG;
include RUTA_LECTURAS;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener datos de la nueva lectura desde el cuerpo de la solicitud
    $fecha = $_POST['fecha'] ?? null;
    $codigoEmpleado = $_POST['codigo'] ?? null;
    $lectura = $_POST['lectura'] ?? null;
    $lectura = $lectura*10;
    // Validar que la imagen se ha subido correctamente
    if (isset($_FILES['img']) && $_FILES['img']['error'] === UPLOAD_ERR_OK) {
        $nombreImagen = $_FILES['img']['name'];
        $rutaImagen = RUTA_UPLOADS . $nombreImagen;
            
        // Validar que la imagen no pese más de 10MB
        if ($_FILES['img']['size'] > 10 * 1024 * 1024) {
            echo json_encode(array("error" => "La imagen excede el tamaño máximo permitido (10MB)"));
            exit;
        }

        // Mover la imagen a la carpeta de uploads
        move_uploaded_file($_FILES['img']['tmp_name'], $rutaImagen);
        
    } else {
        $nombreImagen = null;
    }

    // Realizar la inserción en la base de datos
    $query = "INSERT INTO lecturas (fecha, Codigo_Empleado, Lectura, Img) VALUES (?, ?, ?, ?)";
    $stmt = $conexion->prepare($query);

    // Vincular parámetros
    $stmt->bind_param("ssss", $fecha, $codigoEmpleado, $lectura, $nombreImagen);

    // Ejecutar la consulta
    $resultado = $stmt->execute();

    if ($resultado) {
        echo json_encode(array("mensaje" => "Lectura insertada correctamente"));
    } else {
        echo json_encode(array("error" => "Error al insertar lectura: " . $conexion->error));
    }

    // Cerrar la declaración preparada
    $stmt->close();
} else {
    echo json_encode(array("error" => "Método no permitido"));
}

// Cerrar la conexión a la base de datos
$conexion->close();
?>
