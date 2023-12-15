<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/calendario.css">
    <link rel="stylesheet" href="css/tabla.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>lecturas</title>
</head>

<body>
    <header>
        <button class="menu-btn" onclick="toggleSidebar()">&#9776;</button> <!--&#9776-->
        <nav>
            <div class="sidebar" id="mySidebar">
                <a href="javascript:void(0)" class="close-btn" onclick="toggleSidebar()">X</a> <!--&#9665-->
                <a href="index"> Inicio</a>
                <a href="./estadistica.php">Estadísticas</a>
                <a href="#">Configuración</a>
                <a href="#">Más</a>
            </div>
        </nav>

    </header>
    <div class="user">
        Usuario
    </div>
    <main>
        <div class="mes">
            <p>
                <?php echo (date('F')); ?>
            </p>
            <!-- <div class="opciones">
                Calendario <input type="radio" checked name="opciones" id="rbt_calendario">
                Tabla <input type="radio" name="opciones" id="rbt_tabla">


            </div> -->
        </div>
        <div class="container" id="container">
            <div class="calendario" id="calendario">
                Este es el calendario
            </div>
             <div class="fecha">
                    Desde <input id="desde"  type="date">
                   hasta <input id="hasta" type="date">
                    <button id="buscar">&#128269;</button>
                </div>
            <div class='tabla' id="tabla">
               
                <table>
                    <thead>
                        <tr>
                            <th>Fecha</th>
                            <th>Inicio</th>
                            <th>Final</th>
                            <th>Consumo</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
                <p id="total"> </p>
                <p id="promedio"></p>
                <!-- Aquí se generará dinámicamente la tabla con el contenido mediante js -->
            </div>
            <div class="acciones">
                <button id="anterior">Anterior</button>
                <button id="siguiente">Siguiente</button>
            </div>
        </div>
    </main>

    <script src="js/script.js"></script>
    <script src="js/index.js"></script>
    <script src="js/lecturas/lecturas.js"></script>
    <script src="js/acciones.js"></script>
</body>

</html>