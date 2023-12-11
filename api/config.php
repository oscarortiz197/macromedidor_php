<?php

$host = "localhost";
$usuario = "oscar";
$clave = "2500452018";
$base_datos = "macromedidor";

$conexion = new mysqli($host, $usuario, $clave, $base_datos);

if ($conexion->connect_error) {
    die("Error de conexión a la base de datos: " . $conexion->connect_error);
}

?>