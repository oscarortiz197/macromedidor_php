<?php

$partes = explode('/', dirname(__DIR__));

// Tomar las primeras tres partes y unirlas de nuevo
$ruta_cortada = implode('/', array_slice($partes, 0, 4));

include ($ruta_cortada.'/rutas.php');


?>