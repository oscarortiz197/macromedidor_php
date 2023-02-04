<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lecturas</title>
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/tabla.css">
    <link rel="stylesheet" href="css/menu.css">
    <script src="js/index.js"></script>


</head>

<body>
    <div class="menu">
        <menu>
            <ul>
                <li id="btnactual"> Mes actual</li>
                <li id="btnanterior">Mes anterior</li>
                <li id="btnlista">Lista completa</li>     
                <script>mes_btn();</script>
            </ul>
        </menu>
    </div>
    <div class="tabla">
        <h1 id="mes"></h1>
        <table>
            <tr>
                <th>Fecha</th>
                <th>Incio</th>
                <th>Final</th>
                <th>Consumo</th>
            </tr>
            <tbody id="bodytable">
            <script> lista("./vista/buscar.php?estado=actual");</script>
            </tbody>
        </table>

        <p id="Consumo"></p>
    </div>
    <div class="header">

    </div>
    <script src="js/gestos.js"></script>
    
</body>

</html>
