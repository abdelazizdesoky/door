<?php
/*
***********************************************************
***********************************************************
-----------------------------------------------------------
---------------Dashbord test Page--------------------------------
-----------------------------------------------------------
************************************************************
************************************************************
*/
ob_start();
session_start();
$title='Dashbord';
if(isset($_SESSION['username'])){
    //int-------------------------
    include ('int.php');
    
     //function lest user from table users------------------------------
   
//--page dachbord-------------------- 
    ?>

</div> <!--end div center-->
 
 <!-- Begin Page Content -->
          <div class="container">

          <!-- Page Heading ----------------------->
          <div class="d-sm-flex align-items-center justify-content-between mb-4" style="margin-top :50px;">
            <h1 class="h3 mb-0 text-gray-800" style="color:#fff" >لوحة التحكم </h1>
            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
          </div><hr>

          <!-- Content Row ----------------------->
          <div class="row">

            <!-- Total Members ---------------------------->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"> المستخدمين </div>
                        <a href="members.php?do=mange"> <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo coutrow('id' , 'user' ) ;?></div></a>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-users fa-5x text-gray-300 text-primary"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!--Panding Mambers----------------------- - -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">الكروت </div>
                      <a href="members.php?page=panding">
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                        <?php echo coutrow('card' , 'user' )  ;?></div></a>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-user fa-5x text-gray-300 text-success"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Total Items------------------- -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-info text-uppercase mb-1"> الابواب</div>
                      <a href="items.php?do=mange">
                        <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                          <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                            <?php  echo coutrow('id' , 'door' ) ;?>
                            </div>
                        </div>
                         <div class="col">
                        <!-- <div class="progress progress-sm mr-2">
                            <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>

                          </div>-->
                        </div>
                      </div></a>
                    </div>
                    <div class="col-auto">
                    
                      <i class="fas fa-door-open fa-5x text-gray-300 text-info"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- TOtal comment -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body ">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-warning text-uppercase mb-1"> الحركات </div>
                         <a href="comments.php?do=mange">
                      <div class="h5 mb-0 font-weight-bold text-gray-800">
                        <?php echo coutrow('id' , 'logs' ) ;?>
                        </div></a>
                        </div>
                       <div class="col-auto">
                       <i class="fa-light fa-person-to-door"></i>
                      <i class="fas fa-bell fa-5x text-gray-300 text-warning"></i>
                    </div>
                  </div>
                </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Last user Row -->

          <div class="row">

            <!-- Area Chart -->
            <div class="col-xl-6 col-lg-6">
              <div class="card shadow mb-4 ">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-users"></i> اخر خمس حركات     </h6>
                
                </div>
                <!-- Card Body -->
                <div class="card-body">
                  <div class="chart-area">
                      
                 <?php
                 // select all users databasea--------------------
                        $stmt =$con->prepare("SELECT   door.door,
                        door.place,
                        user.fname,
                        user.auth,
                        user.card,
                        user.avatar,
                        logs.id,
                        logs.date_status ,
                        logs.status 
                    from
                        door,
                        
                        user,
                        logs 
                    where 
                          door.id = logs.door and  
                          user.id = logs.user
                    ORDER BY id DESC  limit 5");  

                    $stmt->execute();
                    $log_user = $stmt->fetchAll();
                 
                 //---check record found ----------
                  if (!empty($log_user)){ ?>
                      
                       <!--insied box last user-->
                     <table class="table table-sm  table-striped table-light">      
                     <tbody>
                    <?php
                       foreach($log_user as $col) {
                         
                      echo   '<tr>';
                      echo   '<div class="logpass">';
                     
                      echo   '<td class="p-3 showpass">';
                      echo   '<th scope="row">' .  $col['door'] . '  فى  ' . $col['place'] . '</th>';

                        //row allow door---
                        if ($col['status']==1){ echo  ' <td class = "font-weight-bold text-success ">
                          فتح</td>'; }else{  echo ' <td class = " font-weight-bold text-danger "> غلق </td>';};  
  
                      echo   '<th scope="row">' .  $col['fname'] . '</th>';
                    
                            echo   '</td>';
                            echo   '</div>';
                            echo    '</tr>';
                          }  ?>
                          </tbody>
                    </table>  
                    
                     <?php }else{echo '<div class="alert alert-dark">Not Record </div>';}?>    
                                      
                  </div>
                </div>
              </div>
            </div>

            <!-- Last items---------------->
            
            <div class="col-xl-6 col-lg-6"  >
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-tags"></i> حالة الابواب </h6>
           
                </div>
                <!-- Card Body -->
                <div class="card-body dachcar">
                  <div class="chart-pie pt-1 pb-2">
                      
                 
                      
                      <!--insied box last user-->
                     <table class="table table-sm  table-stripe">      
                     <tbody>
                     <th  scope="row">
                      <tr>
                      
                      <tr>
                      <div  onload="Get_Data();">
                         <div id = "fatch" style="padding: 5px; border-radius:20px ; text-align: center;" > </div>
                     </div>
                        </td>
                      </tr>
          
                      <tr>
                      <td>
                       door 2
                        </th>
                        </td>

                        <tr>
                      <td>
                       door 3
                        </td>

                   
                      
                        </th>
                          </tbody>
                    </table> 
                      
                  </div>
                  <div class="mt-2 text-center small">
                    <span class="mr-2">
                      <i class="fas fa-circle text-success"></i> مفتوح 
                    </span>
                    <span class="mr-2">
                      <i class="fas fa-circle text-danger"></i> مغلق
                    </span>
                    <span class="mr-2">
                      <i class="fas fa-circle text-info"></i> غير معروف
                    </span>
                  </div>
                </div>
              </div>
            </div>
              
              
               <!-- last comment  -->
            <div class="col-xl-6 col-lg-6">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-tags"></i>الكروت المتاحة    </h6>
           
                </div>
                <!-- Card Body -->
                <div class="card-body dachccom">
                  <div class="chart-pie pt-1 pb-2">
                      
                 <?php 
                       //fetch rows---------------------------
                       
              /*   $stmt =$con->prepare("SELECT 
                                        comments.*,
                                        users.user_name as user_com,
                                        users.avatar as uavatar
                                 FROM 
                                        comments
                                 
                                INNER JOIN
                                       users
                                 ON 
                                       users.user_id=comments.user_id
                             
                               ORDER BY com_id desc  limit 3");
            $stmt->execute();
           $rows_com = $stmt->fetchAll();
           $coucomm =$stmt->rowcount() ;
                       
                    //---check record found ----------    
                   if (!empty($rows_com)){  */?>
                      
                      <!--insied box last user-->
                     <table class="table table-sm  table-striped comm ">      
                     <tbody>
                    <?php
                      /*  foreach( $rows_com as $col) {
                         
                                echo   '<span class="com-u mge-tab"><img src="upload/avatar/' . $col['uavatar'].'"alt="' . $col['uavatar'].'"><strong style="color:blue">' . $col['user_com'] . '</strong></span>' ;                        
                             echo   '<p class="com-p">' . $col['comment'] . '</p>' . '<br>';
                              
                  } */?>
                          </tbody>
                    </table> 
                      <?php //}else{echo '<div class="alert alert-dark">Not Record </div>';}?>
                      
                      
                  </div>
                </div>
              </div>
            </div>
              
            <div class="col-lg-6 mb-4">

              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">تقارير -غير مفعله</h6>
                </div>
                <div class="card-body">
                  <h4 class="small font-weight-bold">Server Migration <span class="float-right">20%</span></h4>
                  <div class="progress mb-4">
                    <div class="progress-bar bg-danger" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                  <h4 class="small font-weight-bold"> Tracking <span class="float-right">40%</span></h4>
                  <div class="progress mb-4">
                    <div class="progress-bar bg-warning" role="progressbar" style="width: 40%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                  <h4 class="small font-weight-bold">
                     Database <span class="float-right">60%</span></h4>
                  <div class="progress mb-4">
                    <div class="progress-bar" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                  <h4 class="small font-weight-bold">
                     Details <span class="float-right">80%</span></h4>
                  <div class="progress mb-4">
                    <div class="progress-bar bg-info" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                  <h4 class="small font-weight-bold">
                     Setup <span class="float-right">Complete!</span></h4>
                  <div class="progress">
                    <div class="progress-bar bg-success" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div>
              </div>


            </div>  
          </div>

          <!-- Content Row--> 
         <div class="row">
              


         
              
            
        
     </div>
      
        <!-- /.container-fluid -->

    
      








    
 <?php   
    // footer-----------------------
include ("include/temp/footer.php");     
}else{
    
header('location:index.php');
}
ob_end_flush();
?>    