<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estadistica</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
</head>

<body>

    <div class="container " style= "text-align: center;">
        <h4 class="mt-5">Estadisticas</h4>
        <div class="fecha">
   
            Desde <input id="desde" type="date">
            hasta <input id="hasta" type="date">
            <button onclick="obtenerEstadistica(); " id="buscar">&#128269;</button>
        </div>

    </div>

</body>

</html>
<script src="bootstrap/js/bootstrap.min.js"></script>
<script src="js/estadistica/estadistica.js"></script>
