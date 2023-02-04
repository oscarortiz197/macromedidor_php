<?php
include ('../crud/listado.php');
    try{
    $datos=array();
    $data = new data();

    $datos=$data->lista("select * from lista");
    $a=0;
    $json=array();
    for ($i=0;$i<count($datos);$i++){
  
    $a2=$datos[$i]['Lectura'];
    $fecha= $datos[$i]['fecha'];
    $img= $datos[$i]['Img'];
    $ID=$datos[$i]['ID'];
    $Consumo=$a2-$a;

    $json[]=array('ID'=>$ID,
    'Fecha'=>$fecha,
    'Inicio'=>$a,
    'Final'=>$a2,
    'Consumo'=>$Consumo,
    'Img'=>$img
        );

        $a=$datos[$i]['Lectura'];
    }
    echo(json_encode($json));
  
    }catch(Exception $e){
      echo(json_encode($e));
    }

?>
