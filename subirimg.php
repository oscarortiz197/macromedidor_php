
<?php 
 $archivo = $_FILES['archivo']['name']; 
 $tipo = $_FILES['archivo']['type'];
 $tamano = $_FILES['archivo']['size'];
 $temp = $_FILES['archivo']['tmp_name'];
 print_r($archivo);
 if ($tipo=="image/png"||$tipo=="image/jpeg"||$tipo=="image/jpg" && $tamano <= 10000000  ){


       if (move_uploaded_file($temp, 'vista/img/'.$archivo)) {
        $Result=array('respuesta-mov'=>true); 
       }else{
         $Result=array('respuesta-mov'=>false); 
       }

     echo (json_encode($Result));
    }
     
     ?>