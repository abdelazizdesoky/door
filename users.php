<?php
/*
***********************************************************
***********************************************************
-----------------------------------------------------------
---------------user Page---------------------------------
-----------------------------------------------------------
************************************************************
************************************************************
*/
ob_start(); 
session_start();
$avatar="";
$title='User';
if(isset($_SESSION['username'])){
    //int-------------------------
    include ('int.php');
    
// get page------------------------------------------------ 
    
if (isset($_GET['do'])){$do = $_GET['do'];}else{$do='mange';}
    
//--------------------------------------------------------------
//-------------Mange page--------------------------------------
//--------------------------------------------------------------   
if($do == 'mange'){ 
    
            //mamber panding ------------------------
           /* $qurey = '';

            if (isset($_GET['page']) && $_GET['page'] =='panding'){
                $qurey = 'AND  prim = 0';
            } */
    
    // select all users databasea--------------------
    $stmt =$con->prepare("SELECT * FROM user  ");  
    $stmt->execute();
    $rows = $stmt->fetchAll();
   
    
        
    ?>
    
      
</div> <!-- end div center-->
        <div  class= "m-auto text-center ">
        <h1  style="margin-top:50px">Manag User</h1><hr>
            
            <?php //---check record found ----------
                   if (!empty($rows)){ ?>
             <table class="table mge-tab table-bordered table-dark" >
                      <thead>
                        <tr >
                          <th scope="col">#ID</th>
                          <th scope="col">Image</th> 
                          <th scope="col">User</th>
                          <th scope="col">Full name</th>
                          <th scope="col">Position</th>
                          <th scope="col">Allow open </th>
                          <th scope="col">Allow login </th>
                          <th scope="col">Date Regster</th>
                          <th scope="col">Control</th>
                        </tr>
                      </thead>
                              <tbody>
                    <?php 
                    foreach($rows as $row){
                            echo   '<tr>';
                            echo '<th scope="row">'.$row['id'].'</th>';
                             echo   ' <td><img src="upload/avatar/'.$row['avatar'].'"alt="'.$row['avatar'].'"></td>'; 
                            echo   ' <td>'.$row['user'].'</td>'; 
                            echo   ' <td>'.$row['name'].'</td>';
                            echo   ' <td>'.$row['position'].'</td>';
                            //row allow door---
                            if ($row['auth']==1){ echo  ' <td class = "font-weight-bold text-success ">Allow Open</td>'; }else{  echo ' <td class = " font-weight-bold text-danger ">Deny Open</td>';};
                            //row login ----
                            if ($row['prim']==1){ echo  ' <td class = "font-weight-bold text-success ">Allow Login</td>'; }else{  echo ' <td class = "font-weight-bold text-danger ">Deny Login</td>';};
                            echo   ' <td>'.$row['date_reg'].'</td>';
                            echo  '<td> <a class="btn  btn-sm btn-success ml-auto" href="users.php?do=edit&id='.$row['id'].'"
                            ><i class="fa fa-edit "></i> Edit</a> ';
                            echo '<a class="btn btn-sm btn-danger ml-auto delete confirm" href="users.php?do=delete&id='.$row['id'].'"><i class="fa fa-trash"></i>  Delete</a>' ;
                        //check found user apend to show buttum---------------
                         if ($row['auth'] == 0){
                             echo '<a class="btn btn-sm btn-info ml-auto " href="users.php?do=active&id='.$row['id'].'"><i class="fa fa-check "></i> Allow Open</a> </td>' ;  
                         }
                              
                             echo  '</tr>';}
                        ?>
                              </tbody>
             </table>
          <?php }else{echo '<div class="alert alert-info">Not Record </div>';}?>  
      </div>

       <a class="btn btn-primary ml-auto" href="?do=add"><i class="fa fa-plus"></i> New User</a>
   </div>
<?php   

//--------------------------------------------------------------
//-------------Add page-----------------------------------------
//--------------------------------------------------------------  
}elseif  ($do == 'add'){

?>
           <!--form ----------------------------------------------------->
                   
                         <h1 class="text-center" style="margin-top:50px">Add User</h1><hr>

                         <form class="form-horizontal" action="?do=insert" method="post" enctype="multipart/form-data" >
                                
                                <label>User </label>
                             
                                <input type="text" name='name' class='form-control' autocomplete='off' placeholder='Insert Name User'required='required'/>

                                <label>Password</label>
                             <div class="logpass">
                                 <a class="showpass"><i class="fa fa-eye "></i></a>
                                <input type="password" name='pass'  class= 'form-control password' placeholder='Insert Password 'autocomplete="password"/>
                               </div>

                                <label>Full name</label>
                             
                                <input type="name" name='fullname'  class= 'form-control' required='required' placeholder='Insert Full Name' autocomplete='off' />

                                <label>Position</label>
                             
                             <input type="text" name='position'  class= 'form-control' required='required' placeholder='Insert Postion' autocomplete='off' />
                             
                                <!---select auth---------------------> 
                                <div class="form-group">
                                    <label for="exampleFormControlSelect2">Allow Open</label>
                                    <select  class="form-control" name="auth" required>
                                        <option value="1" >Allow Open</option>
                                        <option value="0" >Dany Open</option>
                                        
                                    </select>
                                  </div>
                                   <!---select auth---------------------> 
                                <div class="form-group">
                                    <label for="exampleFormControlSelect2">Allow login</label>
                                    <select  class="form-control" name="prim" required>
                                        <option value="1" >Allow login</option>
                                        <option value="0" >Dany login</option>
                                        
                                    </select>
                                  </div>
                               
                                <label>Avatar</label>
                             
                                <input type="file" name='avatar' class= 'form-control' />


                             <button class='btn btn-success ' style="margin-top:10px;">Add</button>
                         </form>
                    
        <?php
      
//--------------------------------------------------------------
//-------------Insert page---------------------------------------
 //--------------------------------------------------------------   
}  elseif  ($do == 'insert'){
   

               if($_SERVER['REQUEST_METHOD'] == 'POST'){
                   
                   echo'<h1  style="margin-top:50px">Add user</h1><hr>';

                //get var----------------------
                   
                $name     = $_POST['name'];
                $pass     = $_POST['pass'];
                $fname    = $_POST['fullname'];
                $position    = $_POST['position'];
                $hashpass = sha1($pass);
                 $auth    = $_POST['auth'];
                $prim     = $_POST['prim']; 
                //get var image file-------------  
                $avatar = $_FILES["avatar"];
                //get attr array ------------------- 
                 $nameav = $avatar["name"];
                 $sizeav = $avatar["size"];
                 $typeav = $avatar["type"];
                 $tmp_nameav =  $avatar["tmp_name"];
                   
                //extantion allow to upload--------
                 $avatarallow=array("jpg","jpeg","png","gif");
                   
                 $avatarex = explode('.', $nameav);
                 $avatarexend= end($avatarex) ;
                  
               

                // validate the form ----------------------------------------
                $error = array();
                   
                //user dupliction validate----------------------------------
               $cou = checkitm('user','user',$name);
                //----------------------------------------------------------

                 if($cou > 0){
                    $error[] =  " Name Duplicate";
                } 
                  
                 if (strlen($name)>20){
                    $error[] =  " Name more than 20 char";
                }
                  if (strlen($name) <2){
                    $error[] =  " Name less than 2 char";
                }

                if (empty($name)){
                    $error[] =  "Empty Name";
                }
                if (empty($position)){
                  $error[] =  "Empty position";
              }
                if (empty($pass)){
                    $error[] =  "Empty Password";
                }
                  
                  if (empty($fname)){
                    $error[] = "Empty full Name";
                }
                if (!empty($avatarexend)){
                        if (!in_array($avatarexend,$avatarallow)){
                         $error[] = "Not allow extension";
                        }
                          //  if ($sizeav>100000){
                       //  $error[] = "Image Size is larger than 100mb";
                            
                      //  }
              }else{
                   $error[] = "No file found";  
                }
                foreach($error as $errmg){
               
               //-redirect to back---------------------
               redirhome($errmg,'danger','back');
                    
                }

                  if (empty($error)){
                    // name random file------------  
                   $avatar=rand(0,1000000) . '_' . $nameav;
                    //upload file------------------  
                    move_uploaded_file($tmp_nameav,'upload\avatar\\' . $avatar);
                      
                     
                //update data-----------------------
                $stmt = $con->prepare('INSERT INTO
                                   user(user,pass,name,position,auth,prim,avatar,date_reg) 
                                  VALUES(:xname,:xpass,:xfname,:xposition,:xauth,:xprim,:xavatar,now())') ;
                      
                $stmt ->execute(array('xname'=>$name,
                                      'xpass'=>$hashpass, 
                                      'xfname'=>$fname,
                                      'xposition'=>$position,
                                      'xauth'=>$auth,
                                      'xprim'=>$prim,
                                      'xavatar'=>$avatar)) ; 
                $cou = $stmt ->rowcount();  
                //echo sucsess--------------------------
              

                $mge = $cou . ' Insert'; 
                //-redirect to back---------------------
                redirhome($mge,'info','users.php?do=mange');

          
                     
                  }
              

    }else{
            
               $mge = 'Sorry Not Access insert'; 
               //-redirect to back---------------------
               redirhome($mge,'danger','back');
} 
      
      
  
    
//--------------------------------------------------------------
//-------------Edit page---------------------------------------
 //-------------------------------------------------------------- 
  }  elseif  ($do == 'edit'){

 //-------GET methon-----------------------------------------------------
                                
    
      $userid = isset($_GET['id']) && is_numeric($_GET['id']) ? intval($_GET['id']):0;

     //--------Select * & fatch----------------------------------------------  

     $stmt = $con->prepare('select * from  user  where id = ? limit 1');
     $stmt->execute(array($userid));
     $row = $stmt->fetch();
     $cou = $stmt ->rowcount();

        //----if found row from select ---------------------------- 
            if($cou > 0){    
         ?>

            <!--form ----------------------------------------------------->
           
                 <h1 class="text-center" style="margin-top:50px">Edit Member</h1><hr>
               
                   
                 <form class="form-horizontal  " action="?do=update" method="post"  enctype="multipart/form-data">
   
                        <input  type= hidden name='userid' value="<?php echo $row['id']?>"  />
                        <label>User</label>
                        <input type="text" name='name' value="<?php echo $row['user']?>"class='form-control' autocomplete='off' required='required'/>

                        <label>Password</label>
                        <input type=hidden  name='oldpass' value="<?php echo $row['pass']?>"  a/>
                        <input type="password" name='newpass'  class= 'form-control' autocomplete="new-password"/>

                        <label>Full name</label>
                        <input type="name" name='fullname' value="<?php echo $row['name']?>" class= 'form-control' required='required'/>

                        <label>Position</label>
                        <input type="text" name='position' value="<?php echo $row['position']?>" class= 'form-control' required='required'/>

                         <!---select auth---------------------> 
                         <div class="form-group">
                                    <label for="exampleFormControlSelect2">Allow Open</label>
                                    <select  class="form-control" name="auth" required>
                                    <option value="1" <?php if ($row['auth'] == 1){ echo 'selected';} ?> >Allow Open</option>
                                        <option value="0" <?php if ($row['auth'] == 0){ echo 'selected';} ?> >Deny Open</option>
                                        
                                    </select>
                                  </div>
                                   <!---select auth---------------------> 
                                <div class="form-group">
                                    <label for="exampleFormControlSelect2">Allow login</label>
                                    <select  class="form-control" name="prim" required>
                                    <option value="1" <?php if ($row['prim'] == 1){ echo 'selected';} ?> >Allow login</option>
                                        <option value="0" <?php if ($row['prim'] == 0){ echo 'selected';} ?> >Deny Login</option>
                                        
                                    </select>
                                  </div>
                     
                            <div class= "mge-tab2 text-center">
                             <img  src="upload/avatar/<?php echo $row['avatar'];?>"alt="<?php echo $row['avatar'];?>">
                             <input type="file" name="avatar"   />    
                            </div>
                     
                        
                     <button class='btn btn-success ' style="margin-top:10px;">Save</button>
                </form>
                    



           <?php 
          //--when not found row -----------------------------------------------------
           }else{
                
            
                $mge = ' Not found'; 
               //-redirect to back---------------------
               redirhome($mge,'danger','back');
            }
//--------------------------------------------------------------
//-------------Update page-------------------------------------
 //--------------------------------------------------------------   
    }elseif ($do == 'update'){
      
     
        
            

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
        echo'<h1  style="  margin-left: 60px ; margin-top:50px">Update Member</h1><hr>';
            
            //get var----------------------
            $id        =$_POST['userid'];
            $name      =$_POST['name'];
            $fname     =$_POST['fullname'];
            $position  =$_POST['position'];
            $auth      = $_POST['auth'];
            $prim      = $_POST['prim']; 
                //get var image file-------------  
               $avatar = $_FILES["avatar"];
            
                //get attr array ------------------- 
                 $nameav = $avatar["name"];
                 $sizeav = $avatar["size"];
                 $typeav = $avatar["type"];
                 $tmp_nameav =  $avatar["tmp_name"];
                   
                //extantion allow to upload--------
                 $avatarallow=array("jpg","jpeg","png","gif");
                   
                 $avatarex = explode('.', $nameav);
                 $avatarexend= end($avatarex) ;
                  
               
            
            
            
           //get password(old/new)----------------------- 
           $pass=  empty($_POST['newpass'])?$_POST['oldpass']:sha1($_POST['newpass']);
            // validate the form ----------------------
            $error = array();
            
               
             if (strlen($name)>20){
                $error[] =  " Name more than 20 char";
            }
              if (strlen($name) <2){
                $error[] =  " Name less than 2 char";
            }
            
            if (empty($name)){
                $error[] =  "Empty Name";
            }
          
              if (empty($fname)){
                $error[] = "Empty full Name";
              }
                if (empty($position)){
                  $error[] = "Empty Position";
            }
            if (!empty($avatarexend))
              if (!in_array($avatarexend,$avatarallow)){
                         $error[] = "Not allow extension";
                   }
            foreach($error as $errmg){
             
               //-redirect to back ---------------------
               redirhome($errmg,'danger','back');
            }
              
              if (empty($error)){
                  if (!empty($avatarexend)){
                  
                   // name random file------------  
                   $avatar=rand(0,1000000) . '_' . $nameav;
                    //upload file------------------  
                    move_uploaded_file($tmp_nameav,'upload\avatar\\' . $avatar);
                  }else{
                      
                    $stmt = $con->prepare('SELECT * FROM user WHERE  id != ? ') ;
                    $stmt ->execute(array( $id)) ; 
                    $row = $stmt ->fetch(); 
                    $avatar=$row['avatar'];
                  }
                  //select name & id for exist ---------------
                  
                    $stmt = $con->prepare('SELECT * FROM user WHERE name = ? AND id != ? ') ;
                    $stmt ->execute(array( $name ,$id)) ; 
                    $cou = $stmt ->rowcount();   
                  
                  if ($con !== 1){
                      
                    
         
            //update data-----------------------
            $stmt = $con->prepare('UPDATE user SET user= ?,name= ?,position=?, pass=?,auth=?,prim=? ,avatar=? where id= ?' ) ;
            $stmt ->execute(array( $name, $fname ,$position,$pass ,$auth,$prim,$avatar,$id)) ; 
            $cou = $stmt ->rowcount();  
            //echo sucsess--------------------------
      
           
              $mge =  $cou . '   Update'; 
               //-redirect to back---------------------
               redirhome($mge,'info','users.php?do=mange');
                      
                  }else{
                       
                $mge = 'User exist'; 
               //-redirect to back---------------------
               redirhome($mge,'info','back');
              }}

        }else{
            
           
              $mge =  'Sorry Not Access Update'; 
               //-redirect to bashbord---------------------
               redirhome($mge,'danger');
           
        }
        
        
        
        
        
//--------------------------------------------------------------
//-------------delete page-------------------------------------
 //--------------------------------------------------------------         
}elseif ($do == 'delete'){
        
       echo'<h1  style="  margin-left: 60px ; margin-top:50px">Delete User</h1><hr>';
          //-------GET methon-----------------------------------------------------


          $userid = isset($_GET['id']) && is_numeric($_GET['id']) ? intval($_GET['id']):0;

         //--------Select * & fatch----------------------------------------------  

         $stmt = $con->prepare('select * from  user  where id = ? limit 1');
         $stmt->execute(array($userid));
         $cou = $stmt ->rowcount();

            //----if found row from select ---------------------------- 
      
         
            
                if($cou > 0){  
             $stmt = $con->prepare("DELETE FROM user WHERE id = :xid" );
             $stmt->bindParam(':xid',$userid);
             $stmt->execute();
             
       
            
                $mge =  'DELETE USER'; 
               //-redirect to back---------------------
               redirhome($mge,'info','back');
        

             }else{
                    
               
              $mge =  'Sorry Not User ID'; 
               //-redirect to back---------------------
               redirhome($mge,'danger','back');
                }
             
//--------------------------------------------------------------
//-------------open door page-------------------------------------
 //--------------------------------------------------------------  
    
    }elseif ($do == 'active'){
        
      echo'<h1  style="  margin-left: 60px ; margin-top:50px">Allow Open  User</h1><hr>';
          //-------GET methon-----------------------------------------------------


          $userid = isset($_GET['id']) && is_numeric($_GET['id']) ? intval($_GET['id']):0;

         //--------Select * & fatch----------------------------------------------  

         $stmt = $con->prepare('select * from  user  where id = ? limit 1');
         $stmt->execute(array($userid));
         $cou = $stmt ->rowcount();

            //----if found row from select ---------------------------- 
      
         
            
                if($cou > 0){  
             $stmt = $con->prepare("UPDATE user SET auth = 1 WHERE id = :xid" );
             $stmt->bindParam(':xid',$userid);
             $stmt->execute();
             
       
            
                $mge =  'Allow  USER'; 
               //-redirect to back---------------------
               redirhome($mge,'info','back');
        

             }else{
                    
               
              $mge =  'Sorry Not User ID'; 
               //-redirect to back---------------------
               redirhome($mge,'danger','back');
                }
              echo "</div>";
  //--------------------------------------------------------------
//-------------Not access page-------------------------------------
 //-------------------------------------------------------------- 
            } else{
     //-redirect to bashbord---------------------
      redirhome('Sorry Not Access Manged','danger');
}
    
    
    
 // footer---------------------------------------------------------------
include ("include/temp/footer.php");     
}else{
    
header('location:index.php');
}
ob_end_flush();
?>
