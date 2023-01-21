<?php
/*
***********************************************************
***********************************************************
-----------------------------------------------------------
---------------index Page-----------------------------------
-----------------------------------------------------------
************************************************************
************************************************************
*/
ob_start(); 

session_start();
//no navbar-------------
$nonav ='';
//function title-----------------
$title='Login';
//----------------------------------
if(isset($_SESSION['username'])){
    header('location:Dashbord.php');
}
//inclde int.-----------------------
include ("int.php");

//------------------------------
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
     $name = $_POST['user'] ;
     $pass = $_POST['pass'];
     $hach = sha1($pass);

//-----------------------------------
$stmt = $con->prepare('SELECT
                            id,user,Pass
                        FROM
                             user
                        WHERE 
                             user = ? 
                        AND 
                             pass = ? 
                       AND 
                           prim = 1
                       ');
 $stmt->execute(array($name,$hach));
 $row = $stmt->fetch();
 $cou = $stmt ->rowcount();
    
//-------------------------------------  
    if($cou > 0){
   $_SESSION['username']=$name; 
   $_SESSION['id'] = $row['id'];     
   header('location:Dashbord.php');
   exit();
    
   
    }else {
        echo "<div class= 'container'>";
        echo '<script> alert("' . lang("not found") . '")</script>';     
    
    }
}
?>

            <div class= 'row' style="margin:150px auto; width: 300px ">
                <div class='col text-center'>
                   <img class = "rounded-circle" src="upload\img\logo.png" alt="logo" style=" width: 250px;   margin-bottom: 20px;"> 
                   
                       <form class =" text-center" action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">
                              <input class = "form-control" style="margin-bottom:10px" type="text"  name= "user" placeholder=" <?php echo lang('username'); ?>" autocomplete="off" required='required'>
                              <div class="logpass">
                               <a class="showpass"><i class="fa fa-eye "></i></a>
                              <input class = "form-control  password "style="margin-bottom:10px" type="password" name="pass" placeholder="<?php echo lang('password'); ?>" autocomplete="off" required='required'></div>
                              <button class ="btn btn-success btn-block"  type="submit"><?php echo lang('login'); ?></button>   
                        </form>
               </div>
            </div>

<?php // footer---------------------------------
include ("include/temp/footer.php");         
ob_end_flush();
?>
