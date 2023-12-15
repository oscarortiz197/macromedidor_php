<head>
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
</head>

<header>
    <button class="menu-btn "  onclick="toggleSidebar()">&#9776;</button> <!--&#9776-->
    <nav>
        <div class="sidebar" id="mySidebar">
            <a href="javascript:void(0)" class="close-btn" onclick="toggleSidebar()">X</a> <!--&#9665-->
            <a href="./index.php"> Inicio</a>
            <a href="./estadistica.php">Estadísticas</a>
            <a href="#">Configuración</a>
            <a href="#">Más</a>
        </div>
    </nav>

</header>
<script src="js/script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>