<?php
/*
***********************************************************
***********************************************************
-----------------------------------------------------------
---------------card Page-----------------------------------
-----------------------------------------------------------
************************************************************
************************************************************
*/
ob_start(); 
//-------session -----------
session_start();
//--------title page--------
$title='Card';
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
            $stmt =$con->prepare("SELECT *    FROM  card  ");
            $stmt->execute();
            $rows = $stmt->fetchAll();
            $couitem =$stmt->rowcount() ;

            ?>


        </div> <!-- end div center-->
                <div  class= "m-auto text-center ">
                <h1  style="margin-top:50px">Manag card</h1><hr>
                    <?php //---check record found ----------
                   if (!empty($rows)){ ?>
                     <table class="table table-bordered table-dark" >
                              <thead>
                                <tr>
                                  <th scope="col">#ID</th>
                                  <th scope="col">card</th>
                                  <th scope="col"> Control </th>

                                </tr>
                              </thead>
                        <tbody>
                            <?php 
                            foreach($rows as $row){
                              echo   '<tr>';
                              echo '<th scope="row">'.$row['id'].'</th>';
                              echo   ' <td>'.$row['card'].'</td>'; 
                        
                              
                              echo  '<td> <a class="btn  btn-sm btn-success ml-auto" href="card.php?do=edit&id='.$row['id'].'"
                                    ><i class="fa fa-edit "></i> Edit</a> ';
                              echo '<a class="btn btn-sm btn-danger ml-auto delete confirm" href="card.php?do=delete&id='.$row['id'].'"><i class="fa fa-trash"></i>  Delete</a>' ;
                       
                                            }
                                ?>
                        </tbody>
                        <tbody>
                         
                          <th scope="row">#</th>
                           <td colspan="5"><strong>Total card</strong></td>
                           <td colspan="3"><strong><?php echo $couitem  ?></strong></td>
                         </tbody> 

                     </table>  
                    
                    <?php }else{echo '<div class="alert alert-info">Not Record </div>';}?>
              </div>

               <a class="btn btn-primary ml-auto" href="?do=add"><i class="fa fa-plus"></i> New card</a>
           </div>
        <?php 

           
           
           
//--------------------------------------------------------------
//-------------add page--------------------------------------
//--------------------------------------------------------------   
       }elseif($do=='add'){
           ?>
           <!--form ----------------------------------------------------->
                   
                         <h1 class="text-center" style="margin-top:50px">Add card</h1><hr>

                         <form class="form-horizontal" action="?do=insert" method="post" enctype="multipart/form-data" >
                                
                                <label> card</label>
                                <input type="text" name='card' class='form-control'  placeholder='Insert Name card' required  />

                             
                             <button class='btn btn-success ' style="margin-top:10px;">Add</button>
                         </form>
                    
        <?php
     
           
           
           
           
//--------------------------------------------------------------
//-------------insert page--------------------------------------
//--------------------------------------------------------------   
       }elseif($do=='insert'){
          
           
               if($_SERVER['REQUEST_METHOD'] == 'POST'){
                   
                   echo'<h1  style="margin-top:50px">Add card</h1><hr>';

                //get var----------------------

                $card =$_POST['card'];
                
                
                // validate the form ----------------------------------------
                $error = array();
     

                if (empty($card)){
                    $error[] =  "Empty card";
                }
                 
                foreach($error as $errmg){
               
               //-redirect to back---------------------
               redirhome($errmg,'danger','back');
                    
                }

                  if (empty($error)){
                   
                      

                //update data-----------------------
                $stmt = $con->prepare('INSERT INTO card(card) VALUES(:xcard)')  ;
                      
                $stmt ->execute(array('xcard'=>$card,
                                       )) ; 
                $cou = $stmt ->rowcount();  
                //echo sucsess--------------------------


                  $mge = $cou . ' Insert'; 
                  //-redirect to back---------------------
                  redirhome($mge,'info','card.php?do=mange');
                
            
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

     $stmt = $con->prepare('select * from  card  where id = ? limit 1');
     $stmt->execute(array($id));
     $rowcate = $stmt->fetch();
     $cou = $stmt ->rowcount();

        //----if found row from select ---------------------------- 
            if($cou > 0){    
         ?>
           <!--form ----------------------------------------------------->
                   
                         <h1 class="text-center" style="margin-top:50px">Edit card</h1><hr>

                         <form class="form-horizontal" action="?do=update" method="post" enctype="multipart/form-data" >
                               <input  type= hidden name='id' value="<?php echo $rowcate['id']?>"  />
                                
                                <label> card</label>
                                <input type="text" name='card' class='form-control' value="<?php echo $rowcate['card']?>" placeholder='Insert card' required   />

                                      
            
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
        echo'<h1  style="  margin-left: 60px ; margin-top:50px">Update card</h1><hr>';
            
       
         //get var----------------------
                 $id =$_POST['id'];
                 $card =$_POST['card'];
             
               
                 // validate the form ----------------------------------------
                $error = array();
                   
                // dupliction validate----------------------------------
              // $cou = checkitm('card','card',$id);
                //----------------------------------------------------------

                if (empty($card)){
                    $error[] =  "Empty card";
                }
               
                   
            
                foreach($error as $errmg){
               
               //-redirect to back---------------------
               redirhome($errmg,'danger','back');
                    
                }

                  if (empty($error)){
              
                
            //update data-----------------------
            $stmt = $con->prepare("UPDATE 
                                         card 
                                    SET 
                                        card=?    
                                  WHERE 
                                       id = ?" ) ;
            $stmt ->execute(array($card,$id)) ; 
            $cou = $stmt ->rowcount();  
            //echo sucsess--------------------------
      
           
              $mge =  $cou . '   Update'; 
               //-redirect to back---------------------
               redirhome($mge,'info','card.php?do=mange');
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
           
                echo'<h1  style="  margin-left: 60px ; margin-top:50px">Delete card</h1><hr>';
          //-------GET methon-----------------------------------------------------


          $id = isset($_GET['id']) && is_numeric($_GET['id']) ? intval($_GET['id']):0;

         //--------Select * & fatch----------------------------------------------  

         $stmt = $con->prepare('select * from  card  where id = ? limit 1');
         $stmt->execute(array($id));
         $cou = $stmt ->rowcount();

            //----if found row from select ---------------------------- 
      
         
            
                if($cou > 0){  
             $stmt = $con->prepare("DELETE FROM card WHERE id = :xid" );
             $stmt->bindParam(':xid',$id);
             $stmt->execute();
             
       
            
                $mge =  'DELETE card'; 
               //-redirect to back---------------------
               redirhome($mge,'info','back');
        

             }else{
                    
               
              $mge =  'Sorry Not card ID'; 
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
    
