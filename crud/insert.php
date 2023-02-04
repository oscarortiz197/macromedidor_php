<?php

class insert{

    public function lectura ($fecha,$codigo,$lectura,$img){
        
        require('../config/config.php');
        $query=("call sp_newlectura('".$fecha."',".$codigo.",".$lectura.",'".$img."');");
        $result=$mysql->query($query);
      


        $mysql->close();
      
        return $result;
    }

    
}

//call sp_newlectura('2022-10-22',8805,67940,null)
?>