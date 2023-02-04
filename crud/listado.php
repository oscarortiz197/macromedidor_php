<?php 


class data{
    
    public function lista($consulta){
        require("../config/config.php");
        try{

            $result = $mysql->query($consulta);
            $row=array();
            if ($result->num_rows>0){
            while($rows = $result->fetch_assoc()){
                $row[]=$rows;
            }
        }else{
            $row=array('ID'=>'0',
                        'fecha'=>'0',
                        'Codigo_Empleado'=>'8805',
                        'Lectura'=>'0',
                        'Img'=>'null',

                    );
        }
            return $row;
        }catch(Exception $e){
            print_r($e);
            print_r($consulta);
        }
        $result->close();
        $mysql->close();
    }
}
?>