<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/insert.css">
    <title>Document</title>
</head>
<body>
    
    <form enctype="multipart/form-data" action="vista/insert.php" method="POST">
        
        <input type="text" name="codigo" id="" placeholder=">  codigo">
       
        <input type="text" name="lectura" id="" placeholder="> lectura">
        
<input name="archivo" type="file" />

<input type="submit" value="Subir archivo"  id="btn"/>


</form>
</body>
</html>

<!-- $fecha=$_POST['fecha'];
    $codigo=$_POST['codigo'];
    $lectura=$_POST['lectura'];
    $archivo = $_FILES['archivo']['name']; -->
