<?php
// Incluir la configuración de la base de datos y la entidad Lectura
include_once('../ruta.php');
include RUTA_CONFIG;
include RUTA_LECTURAS;

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Array para almacenar los datos agrupados por año y mes
    $data = array();

    $inicio = $_GET['inicio'];
    $final = $_GET['final'];
   // Verificar y formatear la fecha de inicio
//    $finicio = isset($inicio) ? date_create_from_format('Y/m', $inicio)->format('Y/m/01') : null;

//    // Verificar y formatear la fecha de final
//    $ffinal = isset($final) ? date_create_from_format('Y/m', $final)->format('Y/m/t') : null;

    // echo $fecha_inicio;
    // echo "----";
    // echo $fecha_final;

    if (isset($inicio, $final)) {
        $sql = "Call sp_searchLectura('$inicio','$final');";
        $result = $conexion->query($sql);

        if ($result->num_rows > 1) {
            $lecturas = array();

            while ($row = $result->fetch_assoc()) {
                // Crear un objeto Lectura para cada fila de la base de datos
                $lectura = new Lectura(
                    $row['ID'],
                    $row['fecha'],
                    $row['Codigo_Empleado'],
                    $row['Lectura'],
                    $row['Img']
                );
                $lecturas[] = $lectura;
            }

            foreach ($lecturas as $key => $lectura) {
                $year = date("Y", strtotime($lectura->fecha));
                $month = date("F", strtotime($lectura->fecha));

                // Inicializar el año si aún no existe en el array
                if (!isset($data[$year])) {
                    $data[$year] = array();
                }

                // Inicializar el mes si aún no existe en el array
                if (!isset($data[$year][$month])) {
                    $data[$year][$month] = array(
                        "TOTAL" => 0,
                        "PROMEDIO" => 0,
                        "COUNT" => 0
                    );
                }

                // Calcular el consumo para cada lectura excepto la primera
                if ($key > 0) {
                    $consumo = doubleval($lectura->lectura) - doubleval($lecturas[$key - 1]->lectura);

                    // Actualizar los valores en el array
                    $data[$year][$month]["TOTAL"] += $consumo;
                    $data[$year][$month]["COUNT"] += 1;
                    $data[$year][$month]["PROMEDIO"] = round($data[$year][$month]["TOTAL"] / $data[$year][$month]["COUNT"],0);
                }
            }
        }

        // Convertir a JSON
        $jsonData = json_encode($data);

        // Devolver JSON al cliente
        header('Content-Type: application/json');
        echo $jsonData;
        $conexion->close();
        return;
    }
}

return http_response_code(201);
?>
