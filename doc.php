<?php
/*
***********************************************************
***********************************************************
-----------------------------------------------------------
---------------Doc Page-----------------------------------
-----------------------------------------------------------
************************************************************
************************************************************
*/
ob_start(); 
session_start();
$title='doc';
if(isset($_SESSION['username'])){
    //int-------------------------
    include ('int.php');
   
//--page Doc--------------------  
?> 

</div><!-- end div center-->
 <h2 class="text-center">Doc</h2>
<h4>1.Varables</h4>
<h5>1.1-No navbar</h5>
<p>
 when you not want navbar include  in your page  you must wriet var $nonav='';
</p>

<!-- function ----------------------------------->
 <h4>1.Function </h4>

<h5 >1.1-Title</h5>
<p>
<strong>gettitle(name title page )</strong> function to title page ;
</p>

<h5 >1.2-Function redirect to page </h5>
<p>
    redirect to page index when not found page or back to privse page
<strong>redirhome[$message text,type mge(sucsses - info - danger -primary),page ,time redirect]</strong>
</p>

<h5 >1.3-Checkitem </h5>
<p>function check found  row  from  select data  from table
<strong>checkitm[$item ,$table ,$values ]</strong></p>

    
    
    
 <?php   
 // footer-----------------------

include ("include/temp/footer.php");     
}else{
    
header('location:index.php');
}