
<nav class="navbar  navbar-expand-lg navbar-dark bg-dark   " >
 <!--container -------------------> 
 <div class="container">
        <!--brand ------------------->  
        <img src="upload/img/logo.png" width="50" height="50" class="rounded-circle d-inline-block align-top" alt="gehazy">
            <a class="navbar-brand" href="index.php"><?php //echo lang('your shop')?></a>
          
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-nav" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
             <span class="navbar-toggler-icon"></span>
        </button>
  <!--nav item-------------------> 
            <div class="collapse navbar-collapse  " id="main-nav">
                
                    <ul class="navbar-nav mr-auto  ">
                        <li class="nav-item active">
                            <a class="nav-link" href="Dashbord.php"><?php echo lang('Dashbord')?> <span class="sr-only">(current)</span></a>
                        </li>
                
                        
                    <li class="nav-item">
                        <a class="nav-link" href="door.php?do=mange"><?php echo lang('door')?></a>   
                    </li> 
                        
                     <li class="nav-item">
                        <a class="nav-link" href="users.php?do=mange"><?php echo lang('members')?></a>  
                    </li>
                    <li class="nav-item">
                           <a class="nav-link" href="log.php?do=mange">Card</a>
                    </li> 
                  
                        
                         <li class="nav-item">
                           <a class="nav-link" href="log.php?do=mange"><?php echo lang('loges')?></a>
                    </li>
                   
               </ul>


                    <!--nav item dropdown-------------------> 
                     <ul class=" navbar-nav ml-auto  ">
                    <li class="nav-item dropdown text-nowrap "  >
                        <a class="nav-link dropdown-toggle " href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <?php echo $_SESSION['username']?></a>
                        
                    <div class="dropdown-menu  " aria-labelledby="navbarDropdown">
                        
                           <a class="dropdown-item" href="members.php?do=edit&id=<?php echo  $_SESSION['id']?>"><?php echo lang('edit')?></a>
                        <a class="dropdown-item" href="../index.php">Show Shop</a>
                        
                           <a class="dropdown-item" href="#"><?php echo lang('setting')?></a>
                        
                       <div class="  dropdown-divider"></div>
                         <a class="dropdown-item" href="doc.php"><?php echo lang('doc')?></a>
                        
                           <a class="dropdown-item" href="logout.php"><?php echo lang('logout')?></a>
                        
                    </div>
                    </li>
                 
             </ul>
                
            </div>
 </div>
</nav>
<!-- inner conteiner-->
 <div class="container">
     <!--div width:450px-->
<div  class= "m-auto"style="width:500px; ">
    
        