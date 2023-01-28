<?php
/*
***********************************************************
***********************************************************
-----------------------------------------------------------
---------------DOOR Page-----------------------------------
-----------------------------------------------------------
************************************************************
************************************************************
*/
ob_start(); 
//-------session -----------
session_start();
//--------title page--------
$title='door';
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
           
        
  
             // select all users databasea--------------------
            $stmt =$con->prepare("SELECT *    FROM  door  ");
            $stmt->execute();
            $rows = $stmt->fetchAll();
            $couitem =$stmt->rowcount() ;

            ?>


        </div> <!-- end div center-->
                <div  class= "m-auto text-center ">
                <h1  style="margin-top:50px">Manag door</h1><hr>
                    <?php //---check record found ----------
                   if (!empty($rows)){ ?>
                     <table class="table table-bordered table-dark" >
                              <thead>
                                <tr>
                                  <th scope="col">#ID</th>
                                  <th scope="col">door</th>
                                  <th scope="col">place</th>
                                  <th scope="col"> Control </th>

                                </tr>
                              </thead>
                        <tbody>
                            <?php 
                            foreach($rows as $row){
                              echo   '<tr>';
                              echo '<th scope="row">'.$row['id'].'</th>';
                              echo   ' <td>'.$row['door'].'</td>'; 
                              echo   ' <td>'.$row['place'].'</td>';
                              
                              echo  '<td> <a class="btn  btn-sm btn-success ml-auto" href="door.php?do=edit&id='.$row['id'].'"
                                    ><i class="fa fa-edit "></i> Edit</a> ';
                              echo '<a class="btn btn-sm btn-danger ml-auto delete confirm" href="door.php?do=delete&id='.$row['id'].'"><i class="fa fa-trash"></i>  Delete</a>' ;
                       
                                            }
                                ?>
                        </tbody>
                        <tbody>
                         
                          <th scope="row">#</th>
                           <td colspan="5"><strong>Total door</strong></td>
                           <td colspan="3"><strong><?php echo $couitem  ?></strong></td>
                         </tbody> 

                     </table>  
                    
                    <?php }else{echo '<div class="alert alert-info">Not Record </div>';}?>
              </div>

               <a class="btn btn-primary ml-auto" href="?do=add"><i class="fa fa-plus"></i> New Door</a>
           </div>
        <?php 

           
           
           
//--------------------------------------------------------------
//-------------add page--------------------------------------
//--------------------------------------------------------------   
       }elseif($do=='add'){
           ?>
           <!--form ----------------------------------------------------->
                   
                         <h1 class="text-center" style="margin-top:50px">Add Door</h1><hr>

                         <form class="form-horizontal" action="?do=insert" method="post" enctype="multipart/form-data" >
                                
                                <label> door</label>
                                <input type="text" name='door' class='form-control'  placeholder='Insert Name door' required  />

                                <label>place</label>
                                <input type="text" name='place'  class= 'form-control' placeholder='Insert place ' required/>
                             
                             <button class='btn btn-success ' style="margin-top:10px;">Add</button>
                         </form>
                    
        <?php
     
           
           
           
           
//--------------------------------------------------------------
//-------------insert page--------------------------------------
//--------------------------------------------------------------   
       }elseif($do=='insert'){
          
           
               if($_SERVER['REQUEST_METHOD'] == 'POST'){
                   
                   echo'<h1  style="margin-top:50px">Add Door</h1><hr>';

                //get var----------------------

                $door =$_POST['door'];
                $place = $_POST['place'];
                
                // validate the form ----------------------------------------
                $error = array();
     
                  
              

                if (empty($door)){
                    $error[] =  "Empty door";
                }
                if (empty($place)){
                    $error[] =  "Empty place";
                }
           
                 
                   
                foreach($error as $errmg){
               
               //-redirect to back---------------------
               redirhome($errmg,'danger','back');
                    
                }

                  if (empty($error)){
                   
                      

                //update data-----------------------
                $stmt = $con->prepare('INSERT INTO door(door,place) VALUES(:xdoor,:xplace)')  ;
                      
                $stmt ->execute(array('xdoor'=>$door,
                                      'xplace'=>$place  )) ; 
                $cou = $stmt ->rowcount();  
                //echo sucsess--------------------------


                  $mge = $cou . ' Insert'; 
                  //-redirect to back---------------------
                  redirhome($mge,'info','door.php?do=mange');
                
            
                  }
              

    }else{
            
               $mge = 'Sorry Not Access insert'; 
               //-redirect to back---------------------
               redirhome($mge,'danger','back');
} 
           
           
           
//--------------------------------------------------------------
//-------------edit page--------------------------------------
//--------------------------------------------------------------   
       }elseif($do=='edit'){
           
           
 //-------GET methon-----------------------------------------------------
                                
    
      $id = isset($_GET['id']) && is_numeric($_GET['id']) ? intval($_GET['id']):0;

     //--------Select * & fatch----------------------------------------------  

     $stmt = $con->prepare('select * from  door  where id = ? limit 1');
     $stmt->execute(array($id));
     $rowcate = $stmt->fetch();
     $cou = $stmt ->rowcount();

        //----if found row from select ---------------------------- 
            if($cou > 0){    
         ?>
           <!--form ----------------------------------------------------->
                   
                         <h1 class="text-center" style="margin-top:50px">Edit Door</h1><hr>

                         <form class="form-horizontal" action="?do=update" method="post" enctype="multipart/form-data" >
                               <input  type= hidden name='id' value="<?php echo $rowcate['id']?>"  />
                                
                                <label> Door</label>
                                <input type="text" name='door' class='form-control' value="<?php echo $rowcate['door']?>" placeholder='Insert door' required   />

                                <label>Place</label>
                                <input type="text" name='place'  class= 'form-control'  value="<?php echo $rowcate['place']?>" placeholder='Insert place' required />
           
            
                             <button class='btn btn-success ' style="margin-top:10px;">Update</button>
                         </form>
                    
                <?php 
          //--when not found row -----------------------------------------------------
           }else{
                
            
                $mge = ' Not found'; 
               //-redirect to back---------------------
               redirhome($mge,'danger','back');
            }
           
    

                   
           
 //--------------------------------------------------------------
//-------------Update page--------------------------------------
//--------------------------------------------------------------   
       }elseif($do=='update'){   
           
           
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
        echo'<h1  style="  margin-left: 60px ; margin-top:50px">Update Door</h1><hr>';
            
            //get var----------------------
         //get var----------------------
                 $id =$_POST['id'];
                 $door =$_POST['door'];
                 $place = $_POST['place'];
               
                 // validate the form ----------------------------------------
                $error = array();
                   
                // dupliction validate----------------------------------
              // $cou = checkitm('door','door',$id);
                //----------------------------------------------------------

                if (empty($door)){
                    $error[] =  "Empty door";
                }
                if (empty($place)){
                    $error[] =  "Empty place";
                }
                   
            
                foreach($error as $errmg){
               
               //-redirect to back---------------------
               redirhome($errmg,'danger','back');
                    
                }

                  if (empty($error)){
              
                
            //update data-----------------------
            $stmt = $con->prepare("UPDATE 
                                         door 
                                    SET 
                                        door=?,
                                        place=?
                                        
                                  WHERE 
                                       id = ?" ) ;
            $stmt ->execute(array($door,$place,$id)) ; 
            $cou = $stmt ->rowcount();  
            //echo sucsess--------------------------
      
           
              $mge =  $cou . '   Update'; 
               //-redirect to back---------------------
               redirhome($mge,'info','door.php?do=mange');
              }

        }else{
            
           
              $mge =  'Sorry Not Access Update'; 
               //-redirect to bashbord---------------------
               redirhome($mge,'danger');
           
        }
        
           
           
           
           
           
           
           
           
//--------------------------------------------------------------
//-------------delete page--------------------------------------
//--------------------------------------------------------------   
       }elseif($do=='delete'){
           
                echo'<h1  style="  margin-left: 60px ; margin-top:50px">Delete Door</h1><hr>';
          //-------GET methon-----------------------------------------------------


          $id = isset($_GET['id']) && is_numeric($_GET['id']) ? intval($_GET['id']):0;

         //--------Select * & fatch----------------------------------------------  

         $stmt = $con->prepare('select * from  door  where id = ? limit 1');
         $stmt->execute(array($id));
         $cou = $stmt ->rowcount();

            //----if found row from select ---------------------------- 
      
         
            
                if($cou > 0){  
             $stmt = $con->prepare("DELETE FROM door WHERE id = :xid" );
             $stmt->bindParam(':xid',$id);
             $stmt->execute();
             
       
            
                $mge =  'DELETE Door'; 
               //-redirect to back---------------------
               redirhome($mge,'info','back');
        

             }else{
                    
               
              $mge =  'Sorry Not Door ID'; 
               //-redirect to back---------------------
               redirhome($mge,'danger','back');
                }  
           

    
           
//--------------------------------------------------------------
//-------------Not access page-----------------------------------
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
    
