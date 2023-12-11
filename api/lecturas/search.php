<?php
header("Content-Type: application/json");

// Incluir la configuración de la base de datos y la entidad Lectura
include_once('../ruta.php');
include RUTA_CONFIG;
include RUTA_LECTURAS;

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $sql = "";
    if ($_GET['estado'] == 'actual') {

        $sql = "Call sp_searchLectura('" . date('Y/m') . "/01','" . date('Y/m/t') . "');";

    } else if ($_GET['estado'] == 'anterior') {
        $sql = "call sp_searchLectura('" . date('Y/m', strtotime("-1 months")) . "/01','" . date('Y/m/t', strtotime("-1 months")) . "');";
    } else {
        $inicio = $_GET['inicio'];
        $final = $_GET['final'];
        if (isset($_GET['inicio'], $_GET['final'])) {
            $sql = "Call sp_searchLectura('$inicio','$final');";
        } else {
            return http_response_code(400);
        }
    }

    //   print($sql);
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
        $consumo=0;
        $resultado = array();
        $count=0;
        for ($i = 1; $i <= count($lecturas)-1; $i++) {
            $consumo=$consumo+(doubleval($lecturas[$i]->lectura)-($lecturas[$i-1]->lectura));
            $count++;
            $rs = array(
               'ID' =>$lecturas[$i]->ID ,
               'Fecha'=> $lecturas[$i]->fecha, 
               'Inicio'=> $lecturas[$i-1]->lectura,
               'Final'=> $lecturas[$i]->lectura,
               'Consumo'=> (doubleval($lecturas[$i]->lectura)-($lecturas[$i-1]->lectura)),
               'Imagen'=> $lecturas[$i]->img,
               
            );
            $resultado[]=$rs;
                
        }
        $resultado[]=array('Total'=> $consumo,'Promedio'=>round($consumo/$count,0)); 
        
            echo json_encode($resultado);

    } else {
        return http_response_code(201);
    }

} else {
    echo json_encode(array("error" => "Método no permitido"));
}

// Cerrar la conexión a la base de datos
$conexion->close();
?>