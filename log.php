<?php
/*
***********************************************************
***********************************************************
-----------------------------------------------------------
---------------log Page-----------------------------------
-----------------------------------------------------------
************************************************************
************************************************************
*/
ob_start(); 
//-------session -----------
session_start();
//--------title page--------
$title='log';
//int-------------------------
 include ('int.php');

//check session found and start ---------------------
if (isset($_SESSION['username'])){
    
    
//-----check do page found and where not found go to manage---
if (isset($_GET['do'])){$do=$_GET['do']; }else{ $do='mange'; }
    
//--------------------------------------------------------------
//-------------Mange page--------------------------------------
//--------------------------------------------------------------   
    
       if ($do=='mange') {
          
           echo  '<div  class= "m-auto text-center " >';
           echo      '<i class="fa fa-wrench fa-6x" style ="margin-top:50px" ></i>';

      echo   '<h1  style="margin-top:50px">Under Maintenance</h1><hr>';
           
           
           
//--------------------------------------------------------------
//-------------add page--------------------------------------
//--------------------------------------------------------------   
       }elseif($do=='add'){
           
           
           
           
           
           
//--------------------------------------------------------------
//-------------insert page--------------------------------------
//--------------------------------------------------------------   
       }elseif($do=='insert'){
           
           
           
           
//--------------------------------------------------------------
//-------------edit page--------------------------------------
//--------------------------------------------------------------   
       }elseif($do=='edit'){
           
           
           
           
//--------------------------------------------------------------
//-------------delete page--------------------------------------
//--------------------------------------------------------------   
       }elseif($do=='delete'){
           
           
           
           
//--------------------------------------------------------------
//-------------active page--------------------------------------
//--------------------------------------------------------------   
       }elseif($do=='active'){
           
           
           

       
//--------------------------------------------------------------
//-------------Not access page-------------------------------------
 //-------------------------------------------------------------- 
            } else{
         //-redirect to bashbord---------------------
          redirhome('Sorry Not Access this page','danger');
           }

 //--footer-------------------------  
include ("include/temp/footer.php");     
}else{
 //--when no session go to index page-------
    
header('location:index.php');
}
?>
    