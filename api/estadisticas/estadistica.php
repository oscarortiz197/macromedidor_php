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
            $consumo = 0;
            for ($i = 1; $i <= count($lecturas) - 1; $i++) {
                $consumo = (doubleval($lecturas[$i]->lectura) - ($lecturas[$i - 1]->lectura));
                $anio = date("Y", strtotime($lecturas[$i]->fecha));
                $mes = date("F", strtotime($lecturas[$i]->fecha));
                //echo  $consumo .  ",";
                // Si el mes aún no está en el array, inicializarlo
                if (!isset($data[$anio][$mes])) {
                    $data[$anio][$mes] = array(
                        "TOTAL" => 0,
                        "PROMEDIO" => 0,
                        "COUNT" => 0
                    );
                }


                // Actualizar los valores en el array
                $data[$anio][$mes]["TOTAL"] += $consumo;
                $data[$anio][$mes]["COUNT"] += 1;
                $data[$anio][$mes]["PROMEDIO"] = round(($data[$anio][$mes]["TOTAL"] / $data[$anio][$mes]["COUNT"]),2);
            }
        }

        // var_dump($data);

        // exit();
       // Convertir a JSON
        $jsonData = json_encode($data);

        // Devolver JSON al cliente
        header('Content-Type: application/json');
        echo $jsonData;
    }
}
?>