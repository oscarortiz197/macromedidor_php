<?php
include ('../crud/listado.php');
    try{

    $estado=$_GET['estado'];

    if ($estado=='actual'){
        $mes=date('m');
        $anio=date('Y');
        if($mes==1){

        }


    }else if($estado=='anterior'){ 
        $mes=date('m')-1;
	if($mes>0 && $mes<=9){
$mes="0".$mes;
}
        $anio=date('Y');
          if ( $mes==0){
        $mes_a=11;
        $anio_a=$anio-1;
        $mes=12;
       $anio=$anio_a;
    }

    }else{
        $mes=$_GET['mes'];
        $anio=$_GET['anio'];
    }
    $datos=array();
    $data = new data();
    
    $anio_a=$anio;
    $mes_a=$mes-1;
    
    if ($mes_a<10){
        $mes_a="0".$mes_a;
    }

 if ( $mes==1){
        $mes_a=12;
        $anio_a=$anio-1;
 }
    // print_r("call sp_ultima_lectura('$anio_a-$mes_a%');");
    // print_r("call sp_lecturas('$anio-$mes%');");
    $datos['anterior']=$data->lista("call sp_ultima_lectura('$anio_a-$mes_a%');");
    $datos['lecturas']=$data->lista("call sp_lecturas('$anio-$mes%');");

    //print_r($datos);
    if($datos['lecturas'][0]["ID"]!=null){
    $json=array();
        for ($i=0;$i<count($datos['lecturas']);$i++){
 
        if ($i==0){
         $a= $datos['anterior'][0]['Lectura'];
        }else{
          $a= $datos['lecturas'][$i-1]['Lectura'];
        }
        $a2=$datos['lecturas'][$i]['Lectura'];
        $fecha= $datos['lecturas'][$i]['fecha'];
        $img= $datos['lecturas'][$i]['Img'];
        $ID=$datos['lecturas'][$i]['ID'];
        $Consumo=$a2-$a;

        $json[]=array('ID'=>$ID,
        'Fecha'=>$fecha,
        'Inicio'=>$a,
        'Final'=>$a2,
        'Consumo'=>$Consumo,
        'Img'=>$img,
      );

        }
    }else{
        $json[]=array('ID'=>null,
        'Fecha'=>null,
        'Inicio'=>null,
        'Final'=>null,
        'Consumo'=>null,
        'Img'=>null);
    }
       
   echo (json_encode($json));
    }catch(Exception $e){
        print($e);
    }


?>
