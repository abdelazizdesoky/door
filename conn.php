<?php

//--var-------------------------------------
$dbl ='mysql:host=localhost;dbname=door_sys';
$user ='root';
$pass ='';
$option = array(
    PDO::MYSQL_ATTR_INIT_COMMAND =>'SET NAMES utf8',  
);

//--connaction----------------------------------------

try{
  $con = new PDO($dbl,$user,$pass,$option);
  $con ->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
}

catch(PDOException $e){
    echo "field" . $e->getMessage();
}