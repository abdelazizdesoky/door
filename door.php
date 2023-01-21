<?php
/*
***********************************************************
***********************************************************
-----------------------------------------------------------
---------------Items Page-----------------------------------
-----------------------------------------------------------
************************************************************
************************************************************
*/
ob_start(); 
//-------session -----------
session_start();
//--------title page--------
$title='Items';
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
           
             //item approve ------------------------
            $qurey = '';

            if (isset($_GET['page']) && $_GET['page'] =='panding'){
                $qurey = 'AND approve = 0';
            }
    

             // select all users databasea--------------------
            $stmt =$con->prepare("SELECT 
                                        items.*,
                                        categories.name As cate_name,
                                        users.user_name
                                 FROM 
                                        items
                                 INNER JOIN
                                       categories
                                 ON 
                                       Categories.id=items.cat_id
                                INNER JOIN
                                       users
                                 ON 
                                       users.user_id=items.member_id
                                 $qurey
                                order by
                                    items.item_id desc ");
            $stmt->execute();
            $rows = $stmt->fetchAll();
            $couitem =$stmt->rowcount() ;

            ?>


        </div> <!-- end div center-->
                <div  class= "m-auto text-center ">
                <h1  style="margin-top:50px">Manag Items</h1><hr>
                    <?php //---check record found ----------
                   if (!empty($rows)){ ?>
                     <table class="table table-bordered table-dark" >
                              <thead>
                                <tr>
                                  <th scope="col">#ID</th>
                                  <th scope="col">Name</th>
                                  <th scope="col">Description</th>
                                  <th scope="col">Price</th>
                                  <th scope="col"> Add Date</th>
                                  <th scope="col"> country</th>
                                  <th scope="col">Categorie</th>
                                  <th scope="col">Users</th>
                                  <th scope="col"> Control </th>

                                </tr>
                              </thead>
                        <tbody>
                            <?php 
                            foreach($rows as $row){
                              echo   '<tr>';
                              echo '<th scope="row">'.$row['item_id'].'</th>';
                              echo   ' <td>'.$row['name'].'</td>'; 
                              echo   ' <td>'.$row['description'].'</td>';
                              echo   ' <td>'.$row['price'].'</td>';
                              echo   ' <td>'.$row['add_date'].'</td>';
                             echo   ' <td>'.$row['country_made'].'</td>';
                             echo   ' <td>'.$row['cate_name'].'</td>';
                             echo   ' <td>'.$row['user_name'].'</td>';
                              echo  '<td> <a class="btn  btn-sm btn-success ml-auto" href="items.php?do=edit&id='.$row['item_id'].'"
                                    ><i class="fa fa-edit "></i> Edit</a> ';
                              echo '<a class="btn btn-sm btn-danger ml-auto delete confirm" href="items.php?do=delete&id='.$row['item_id'].'"><i class="fa fa-trash"></i>  Delete</a>' ;
                            //check found user apend to show buttum---------------
                          if ($row['approve'] == 0){
                             echo '<a class="btn btn-sm btn-info ml-auto " href="items.php?do=active&id='.$row['item_id'].'"><i class="fa fa-check "></i> Approve</a> ';}
                            echo  '</tr>';
                                            }
                                ?>
                        </tbody>
                        <tbody>
                         
                          <th scope="row">#</th>
                           <td colspan="5"><strong>Total Item</strong></td>
                           <td colspan="3"><strong><?php echo $couitem  ?></strong></td>
                         </tbody> 

                     </table>  
                    
                    <?php }else{echo '<div class="alert alert-info">Not Record </div>';}?>
              </div>

               <a class="btn btn-primary ml-auto" href="?do=add"><i class="fa fa-plus"></i> New Item</a>
           </div>
        <?php 

           
           
           
//--------------------------------------------------------------
//-------------add page--------------------------------------
//--------------------------------------------------------------   
       }elseif($do=='add'){
           ?>
           <!--form ----------------------------------------------------->
                   
                         <h1 class="text-center" style="margin-top:50px">Add Item</h1><hr>

                         <form class="form-horizontal" action="?do=insert" method="post" enctype="multipart/form-data" >
                                
                                <label> Name</label>
                                <input type="text" name='name' class='form-control'  placeholder='Insert Name item' required  />

                                <label>Description</label>
                                <input type="text" name='descr'  class= 'form-control' placeholder='Insert Description ' required/>
                             
                              <label>Country Made</label>
                                <input type="text" name='country'  class= 'form-control' placeholder='Insert Description ' required/>
                             
                                <label>Price</label>
                                <input type="text" name='price'  class= 'form-control'  placeholder='Insert Price' required />

                             
                              
                   <!---select status---------------------> 
                                   <div class="form-group">
                                    <label for="exampleFormControlSelect2">Status</label>
                                    <select  class="form-control" name="status" required>
                                        <option value="0" >--</option>
                                        <option value="1" >*</option>
                                        <option value="2" >**</option>
                                        <option value="3" >***</option>
                                        <option value="4" >****</option>
                                        <option value="5" >*****</option>
                                        
                                    </select>
                                  </div>
                                
                             
                             
                           <!---select users--------------------->
                                
                              <?php
           
                          // select all users databasea---------------
        
                                $stmt = $con->prepare("SELECT user_id ,user_name FROM users ");
                                $stmt->execute();
                                $rows = $stmt->fetchAll();           

                             ?>
                             
                                <div class="form-group">
                                    <label for="exampleFormControlSelect2">User</label>
                                    <select  class="form-control" name="users" required>
                                        <option value="0">--</option>
                                    <?php
           
                                  foreach($rows as $row){
                                      
                                  echo    ' <option value ="' .$row['user_id'] . '">' .$row['user_name'] . '</option>';
                                      
                                   }?>
                                    </select>
                                 </div>
                           <!---select users--------------------->  
                             
                               <?php
           
                          // select all users databasea---------------
        
                                $stmt = $con->prepare("SELECT id ,name FROM categories ");
                                $stmt->execute();
                                $rows = $stmt->fetchAll();           

                                ?>
                             
                                <div class="form-group">
                                    <label for="exampleFormControlSelect2">Categorie</label>
                                    <select  class="form-control" name="cate" required>
                                        <option value="0">--</option>
                                    <?php
                                   foreach($rows as $row){
                                  echo    ' <option value ="' .$row['id'] . '">' .$row['name'] . '</option>';
                                       
                                        //subcat------------------------------------- 
                                        $id_sub =  $row['id'];
                                        $select = "SELECT * FROM categories WHERE parent =$id_sub";
                                        $rowcat = getall($select,$val=null);

                                        foreach($rowcat as $c){ 

                                        echo  '<option value ="' .$c['id'] . '">-- ' .$c['name'] . '</option>';

                                          }  
                                       
                                       
                                       
                                    }?>
                                    </select>
                                  </div>    
                              <!--img  -->
                              <lable>
                                  Image
                             </lable>
                             
                             <input type="file" name ="img" class="form-control" >
                            <!--Tag it -->
                        
                              <label>Tags</label>
                             
                                <input type="text" name='tags'  class= 'form-control'  placeholder='Inter Tags ' />

                             <button class='btn btn-success ' style="margin-top:10px;">Add</button>
                         </form>
                    
        <?php
     
           
           
           
           
//--------------------------------------------------------------
//-------------insert page--------------------------------------
//--------------------------------------------------------------   
       }elseif($do=='insert'){
          
           
               if($_SERVER['REQUEST_METHOD'] == 'POST'){
                   
                   echo'<h1  style="margin-top:50px">Add Member</h1><hr>';

                //get var----------------------

                $name =$_POST['name'];
                $descr = $_POST['descr'];
                $country = $_POST['country']; 
                $price =$_POST['price'];
                $status =$_POST['status'];
                $users =$_POST['users'];
                $cate =$_POST['cate'];
                $tags =$_POST['tags'];
                   //file-----------
                $img     =  $_FILES['img'];
                $imgname =  $img['name'];
                $imgsize =  $img['size']; 
                $imgtemp =  $img['tmp_name'];
                  
                $imgallow = array("jpg","jpeg","png","gif");
            
                  $imgal = (explode('.',$imgname));
                  $imgex = end($imgal);

                // validate the form ----------------------------------------
                $error = array();
                   
                //user dupliction validate----------------------------------
               $cou = checkitm('name','items',$name);
                //----------------------------------------------------------

              
                  
                 if (strlen($name)>20){
                    $error[] =  " Name more than 20 char";
                }
                  if (strlen($name) <2){
                    $error[] =  " Name less than 2 char";
                }

                if (empty($name)){
                    $error[] =  "Empty Name";
                }
                if (empty($descr)){
                    $error[] =  "Empty Description";
                }
                    if (empty($price)){
                    $error[] = "Empty Price";
                }
                  if (empty($status)){
                    $error[] = "Empty Status";
                }
                  if (empty($users)){
                    $error[] = "Empty User";
                }
                    if (empty($cate)){
                    $error[] = "Empty Categorie";
                }
                   if(!empty($imgex)){
                       if(!in_array($imgex,$imgallow)){
                         $error[] = "Not allow extension";
                       } 
                       if ($imgsize >100000){
                         $error[] = "Image Size is larger than 10mb";
                            
                   }}
                foreach($error as $errmg){
               
               //-redirect to back---------------------
               redirhome($errmg,'danger','back');
                    
                }

                  if (empty($error)){
                    //if not insert img ------ 
                    if (!empty($imgex)){
                          $img=rand(0,10000000) . '-' . $imgname;
                    }else{
                        $img='img.png';
                    }
                      //uplode-------------------
                   move_uploaded_file($imgtemp,'upload\img\\' . $img);
                      

                //update data-----------------------
                $stmt = $con->prepare('INSERT INTO
items(name,description,price,add_date,country_made,status,cat_id,member_id,img,tags) 
VALUES(:xname,:xdescr,:xprice,now(),:xcountry,:xstatus,:xcate,:xuser,:ximg,:xtags)')  ;
                      
                $stmt ->execute(array('xname'=>$name,
                                      'xdescr'=>$descr, 
                                      'xprice'=>$price,
                                      'xcountry'=>$country,
                                      'xstatus'=>$status,
                                      'xcate'=>$cate,
                                      'xuser'=>$users,
                                      'ximg' =>$img,
                                      'xtags'=>$tags
                                     )) ; 
                $cou = $stmt ->rowcount();  
                //echo sucsess--------------------------

              $mge = $cou . ' Insert'; 
               //-redirect to back---------------------
               redirhome($mge,'info','back');
                      
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
                                
    
      $itemid = isset($_GET['id']) && is_numeric($_GET['id']) ? intval($_GET['id']):0;

     //--------Select * & fatch----------------------------------------------  

     $stmt = $con->prepare('select * from  items  where item_id = ? limit 1');
     $stmt->execute(array($itemid));
     $rowcate = $stmt->fetch();
     $cou = $stmt ->rowcount();

        //----if found row from select ---------------------------- 
            if($cou > 0){    
         ?>
           <!--form ----------------------------------------------------->
                   
                         <h1 class="text-center" style="margin-top:50px">Edit Item</h1><hr>

                         <form class="form-horizontal" action="?do=update" method="post" enctype="multipart/form-data" >
                               <input  type= hidden name='itemid' value="<?php echo $rowcate['item_id']?>"  />
                                
                                <label> Name</label>
                                <input type="text" name='name' class='form-control' value="<?php echo $rowcate['name']?>" placeholder='Insert Name item' required   />

                                <label>Description</label>
                                <input type="text" name='descr'  class= 'form-control'  value="<?php echo $rowcate['description']?>" placeholder='Insert description item' required />
                             
                              <label>Country Made</label>
                                <input type="text" name='country'  class= 'form-control'  value="<?php echo $rowcate['country_made']?>"  placeholder='Insert country made item' required/>
                             
                                <label>Price</label>
                                <input type="text" name='price'  class= 'form-control' value="<?php echo $rowcate['price']?>" placeholder='Insert Price item' required  />

                             
                              
                   <!---select status---------------------> 
                                   <div class="form-group">
                                    <label for="exampleFormControlSelect2">Status</label>
                                    <select  class="form-control" name="status">
                                      
                                        <option value="1" <?php if ($rowcate['status'] == 1){ echo 'selected';} ?> >*</option>
                                        <option value="2" <?php if ($rowcate['status'] == 2){ echo 'selected';} ?> >**</option>
                                        <option value="3" <?php if ($rowcate['status'] == 3){ echo 'selected';} ?> >***</option>
                                        <option value="4" <?php if ($rowcate['status'] == 4){ echo 'selected';} ?> >****</option>
                                        <option value="5"  <?php if ($rowcate['status'] == 5){ echo 'selected';} ?>>*****</option>
                                        
                                    </select>
                                  </div>
                                
                             
                             
                           <!---select users--------------------->
                                
                              <?php
           
                          // select all users databasea---------------
        
                                $stmt = $con->prepare("SELECT user_id ,user_name FROM users ");
                                $stmt->execute();
                                $rows = $stmt->fetchAll();           

                             ?>
                             
                                <div class="form-group">
                                    <label for="exampleFormControlSelect2">User</label>
                                    <select  class="form-control" name="users">
                                      
                                    <?php
           
                                  foreach($rows as $row){
                                      
                                  echo    ' <option value ="' . $row['user_id'] . '" '; if ($rowcate['member_id'] == $row['user_id'] ){ echo 'selected';}
                                  echo  '>' . $row['user_name'] . '</option>';
                                      
                                   }?>
                                    </select>
                                 </div>
                           <!---select users--------------------->  
                             
                               <?php
           
                          // select all users databasea---------------
        
                                $stmt = $con->prepare("SELECT id ,name FROM categories ");
                                $stmt->execute();
                                $rows = $stmt->fetchAll();           

                                ?>
                             
                                <div class="form-group">
                                    <label for="exampleFormControlSelect2">Categorie</label>
                                    <select  class="form-control" name="cate">
                                        
                                    <?php
                                   foreach($rows as $row){
                                  echo    ' <option value ="' .$row['id'] . '"'; 
                                       if ($rowcate['cat_id'] == $row['id'] ){ echo 'selected';}
                                          
                                  echo  '>' .$row['name'] . '</option>';
                                       
                                       
                                        //subcat------------------------------------- 
                                        $id_sub =  $row['id'];
                                        $select = "SELECT * FROM categories WHERE parent =$id_sub";
                                        $rowcat = getall($select,$val=null);

                                        foreach($rowcat as $c){ 

                                        echo  '<option value ="' .$c['id'] . '"';
                                            if ($rowcate['cat_id'] == $c['id'] ){ echo 'selected';}
                                            
                                        echo   '>-- ' .$c['name'] . '</option>';

                                          } 
                                    }?>
                                    </select>
                                  </div>
                             
                                <div class= "mge-tab2 text-center">
                             <img  src="upload/img/<?php echo $rowcate['img'];?>"alt="<?php echo $rowcate['img'];?>">
                             <input type="file" name="img"   />    
                            </div>
                             
                             
                             <!--Taf it -->
                        
                              <label>Tags</label>
                             
                                <input type="text" name='tags'  class= 'form-control' value="<?php echo $rowcate['tags']?>" placeholder='Inter Tags ' />
                            

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
        echo'<h1  style="  margin-left: 60px ; margin-top:50px">Update Item</h1><hr>';
            
            //get var----------------------
         //get var----------------------
                 $id =$_POST['itemid'];
                 $name =$_POST['name'];
                 $descr = $_POST['descr'];
                 $country = $_POST['country']; 
                 $price =$_POST['price'];
                 $status =$_POST['status'];
                 $users =$_POST['users'];
                 $cate =$_POST['cate'];
                 $tags =$_POST['tags'];
       
                
                //file-----------
                $img     =  $_FILES['img'];
                $imgname =  $img['name'];
                $imgsize =  $img['size']; 
                $imgtemp =  $img['tmp_name'];
                  
                $imgallow = array("jpg","jpeg","png","gif");
            
                  $imgal = (explode('.',$imgname));
                  $imgex = end($imgal);
                
                
                 // validate the form ----------------------------------------
                $error = array();
                   
                //user dupliction validate----------------------------------
               $cou = checkitm('name','items',$name);
                //----------------------------------------------------------

              
                  
                 if (strlen($name)>20){
                    $error[] =  " Name more than 20 char";
                }
                  if (strlen($name) <2){
                    $error[] =  " Name less than 2 char";
                }

                if (empty($name)){
                    $error[] =  "Empty Name";
                }
                if (empty($descr)){
                    $error[] =  "Empty Description";
                }
                    if (empty($price)){
                    $error[] = "Empty Price";
                }
                  if (empty($status)){
                    $error[] = "Empty Status";
                }
                  if (empty($users)){
                    $error[] = "Empty User";
                }
                    if (empty($cate)){
                    $error[] = "Empty Categorie";
                }
                if(!empty($imgex)){
                       if(!in_array($imgex,$imgallow)){
                         $error[] = "Not allow extension";
                       } 
                       if ($imgsize >100000){
                         $error[] = "Image Size is larger than 10mb";
                            
                   }}
                foreach($error as $errmg){
               
               //-redirect to back---------------------
               redirhome($errmg,'danger','back');
                    
                }

                  if (empty($error)){
              
                  
                     if (!empty($imgex)){
                  
                   // name random file------------  
                   $img=rand(0,10000000) . '-' . $imgname;
                    //upload file------------------  
                   move_uploaded_file($imgtemp,'upload\img\\' . $img);
                  }else{
                      
                    $stmt = $con->prepare('SELECT * FROM items WHERE  item_id = ?') ;
                    $stmt ->execute(array($id)) ; 
                    $row = $stmt ->fetch(); 
                    $img=$row['img'];
                  }   
         
            //update data-----------------------
            $stmt = $con->prepare("UPDATE 
                                         items 
                                    SET 
                                        name=?,
                                        description=?,
                                        price=?,
                                        country_made=?,
                                        status=?,
                                        cat_id=?,
                                        member_id=?,
                                        img=?,
                                        tags=?
                                        
                                  WHERE 
                                       item_id= ?" ) ;
            $stmt ->execute(array($name,$descr,$price,$country,$status,$cate,$users,$img,$tags,$id)) ; 
            $cou = $stmt ->rowcount();  
            //echo sucsess--------------------------
      
           
              $mge =  $cou . '   Update'; 
               //-redirect to back---------------------
               redirhome($mge,'info','back');
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
           
                echo'<h1  style="  margin-left: 60px ; margin-top:50px">Delete Item</h1><hr>';
          //-------GET methon-----------------------------------------------------


          $itemid = isset($_GET['id']) && is_numeric($_GET['id']) ? intval($_GET['id']):0;

         //--------Select * & fatch----------------------------------------------  

         $stmt = $con->prepare('select * from  items  where item_id = ? limit 1');
         $stmt->execute(array($itemid));
         $cou = $stmt ->rowcount();

            //----if found row from select ---------------------------- 
      
         
            
                if($cou > 0){  
             $stmt = $con->prepare("DELETE FROM items WHERE item_id = :xid" );
             $stmt->bindParam(':xid',$itemid);
             $stmt->execute();
             
       
            
                $mge =  'DELETE Item'; 
               //-redirect to back---------------------
               redirhome($mge,'info','back');
        

             }else{
                    
               
              $mge =  'Sorry Not Item ID'; 
               //-redirect to back---------------------
               redirhome($mge,'danger','back');
                }  
           

           
           
                      
//--------------------------------------------------------------
//-------------Active page--------------------------------------
//--------------------------------------------------------------   
       }elseif($do=='active'){

       
               echo'<h1  style="  margin-left: 60px ; margin-top:50px">Approve Item</h1><hr>';
          //-------GET methon-----------------------------------------------------


          $itemid = isset($_GET['id']) && is_numeric($_GET['id']) ? intval($_GET['id']):0;

         //--------Select * & fatch----------------------------------------------  

         $stmt = $con->prepare('select * from  items  where item_id = ? limit 1');
         $stmt->execute(array($itemid));
         $cou = $stmt ->rowcount();

            //----if found row from select ---------------------------- 
      
         
            
                if($cou > 0){  
             $stmt = $con->prepare("UPDATE items SET approve = 1 WHERE item_id = :xid" );
             $stmt->bindParam(':xid',$itemid);
             $stmt->execute();
             
       
            
                $mge =  'Approve Item'; 
               //-redirect to back---------------------
               redirhome($mge,'info','back');
        

             }else{
                    
               
              $mge =  'Sorry Not Items ID'; 
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
    
