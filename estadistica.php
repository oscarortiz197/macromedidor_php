<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estadistica</title>

    <link rel="stylesheet" href="css/estadistica/grafico.css">
</head>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>

<?php require $_SERVER['DOCUMENT_ROOT'] . "/macromedidor/plantilla/menu.php"; ?>

<body>


    <div class="container " style="text-align: center;">
        <h4 class="mt-5">Estadisticas</h4>
        <div class="fecha">

            Desde <input id="desde" type="date">
            hasta <input id="hasta" type="date">
            <button onclick="obtenerEstadistica();" class="btn btn-outline-primary" id="buscar">&#128269;</button>
        </div>



    </div>
    <div class="grafico">

        <canvas id="miGrafica" width="400" height="200"></canvas>
    </div>
    <div class="container" tyle="text-align: center;">
        <button class="btn btn-outline-primary" onclick="printChart()">🖨</button>
    </div>


</body>

</html>


<script src="js/estadistica/estadistica.js?<?php echo time() ?>"></script>