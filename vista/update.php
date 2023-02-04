<?php
try{
    $ID=$_POST['id'];
    $fecha=$_POST['fecha'];
    $lectura=$_POST['lectura'];
    $img=$_POST['img'];
    if (!empty($id) && !empty($fecha)&& !empty($lectura)&& !empty($img) ){
        echo("ok");
        
    }else{
        echo("no");
    }

}catch(Exception $e){
    print_r($e);
}

?>