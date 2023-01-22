<?php


//fun get all
function getall($select,$val=null){
    
    global $con;
    $stm = $con->prepare($select);
    $stm->execute($val);
    $rows = $stm->fetchAll();
    return $rows;  
   
      
}
//title page--------------------------

function gettitle(){
    
    global $title;

    if(isset($title)){
        echo $title;
        
    }else{
        echo 'default';
    }
}

//--redirect HOme-------------------------------------
/*
function redirect to page 
[$message text,type mge(sucsses - info - danger -primary),page ,time redirect]
*/

function  redirhome($mge,$mge_k,$page=null,$sca=1){
  
    if ($page == null){
       $page = 'index.php' ;
        
    }else{
        
        if (isset ($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER']!==''&& $page == 'back'){

         $page = $_SERVER['HTTP_REFERER'];  
       
        }
        
    }
 echo '<div  class= "m-auto"style="max-width:300px; ">';
 echo '<div class="alert alert-'.$mge_k .'" >' . $mge . '</div>';
 echo '<div class="alert alert-info" >WE will Redirect After' . $sca . ' Sacaned</div>';
 echo '</div>';
 header ("refresh:$sca;url= $page");   
    
}


/*
function check found  row  from  select data  from table
[$item ,$table ,$values ]
*/
function checkitm($itm , $tbl ,$val){
    
    global $con;
    
    $stm = $con->prepare("SELECT $itm FROM  $tbl WHERE $itm = ?");
    $stm->execute(array($val));
    $count = $stm ->rowCount();
        
    return $count;
}


/*
function count  row  from  select data  from table
[$item ,$table  ]
*/
function coutrow($itm , $tbl ){
    
    global $con;
    
    $stm = $con->prepare("SELECT COUNT($itm) FROM  $tbl");
    $stm->execute();
    $count = $stm->fetchColumn();
        
    return $count;
}





function getlast($tbl,$col,$order,$limit=5){
    
    global $con;
    $stm = $con->prepare("SELECT $col FROM  $tbl ORDER BY $order desc  limit $limit");
    $stm->execute();
    $rows = $stm->fetchAll();
    return $rows;  
   
      
}