<?php


include_once('../crud/insert.php');
try{
    $fecha=$_POST['fecha'];
    $codigo=$_POST['codigo'];
    $lectura=$_POST['lectura'];



    $archivo = $_FILES['archivo']['name'];
    
    $tipo = $_FILES['archivo']['type'];
    $tamano = $_FILES['archivo']['size'];
    $temp = $_FILES['archivo']['tmp_name'];

//print($archivo."     /n     ");
  // print($tipo);
//	print($fecha);
//	print($codigo);
//	print($lectura);
    if ($tipo=="image/png"||$tipo=="image/jpeg"||$tipo=="image/jpg" && $tamano <= 10000000  ){

        if (empty($fecha)){
            $fecha= date('Y-m-d');
        }
        if (validar($fecha,$codigo,$lectura)){
          $insert=new insert();
          if (move_uploaded_file($temp, 'img/'.$archivo)) {
                $Result=array('respuesta'=>$insert->lectura($fecha,$codigo,$lectura."0",$archivo)); 
          }else{
            $Result=array('respuesta-mov'=>false); 
          }
        }else {
            $Result=array('respuesta'=>false); 
        }
        
    }else{
        $Result=array('respuesta-img'=>false);
    }
        echo (json_encode($Result));
    
}catch(Exception $e){
    print_r($e);
}

function validar($f,$c,$l){

       $validar=explode('-',$f); 
       if (count($validar)==3 && checkdate($validar[1], $validar[2], $validar[0]) && !empty($c) && !empty($l)){
        if (intval($l)>0 && intval($l)<1000000){
            return true;
        }
        return true;
        
       }

        return false;
   
       
    
}

 
?>
