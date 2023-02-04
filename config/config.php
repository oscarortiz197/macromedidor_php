<?php
$url="localhost";
$user="oscar";                                           
$password="2500452018";
$db="macromedidor";
$mysql = new mysqli($url,$user,$password,$db);
//date_default_timezone_set('America/El_Salvador');                
  if ($mysql->connect_error){
    die ("Error al conectar".mysqli_connect_error());
}
?>