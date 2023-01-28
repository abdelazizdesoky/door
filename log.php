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
          
              //log all data form table logs------------------
              
    // select all users databasea--------------------
    $stmt =$con->prepare("SELECT logs.* ,logs.id as logsid, door.* , user.* from logs INNER JOIN user on user.id = logs.user INNER JOIN door ON door.id = logs.door ORDER BY `logs`.`id` DESC
    ");  

            $stmt->execute();
            $rows = $stmt->fetchAll();

            ?>
            </div> <!-- end div center-->
           <div  class= "m-auto text-center ">
           <h1  style="margin-top:50px">The Last Logs </h1><hr>
               
               <?php //---check record found ----------

         if (!empty($rows)){ ?>

                    <div  style="margin-bottom: 25px;">
                    <a class="btn btn-primary mb-2 float-left" href="?do=mange"><i class="fa fa-spinner"></i>  Refresh</a>
                    </div>
                      
                      
                   
                <table class="table mge-tab table-bordered table-striped table-dark"  id= "table_id">
               
                         <thead>
                           <tr >
                             <th scope="col">#ID</th>
                             <th scope="col">Door</th> 
                             <th scope="col">Place</th>
                             <th scope="col">Image </th>
                             <th scope="col">User</th>
                             <th scope="col">Card</th>
                             <th scope="col">Allow open </th>
                             <th scope="col">Date Log</th>
                           </tr>
                         </thead>
                                 <tbody id="tbody_table_record">
                       <?php 
                       foreach($rows as $row){
                      
                              echo   '<tr>';
                              echo '<th scope="row">'.$row['logsid'].'</th>';
                              echo   ' <td>'.$row['door'].'</td>'; 
                              echo   ' <td>'.$row['place'].'</td>';
                              echo   ' <td><img src="upload/avatar/'.$row['avatar'].'"alt="'.$row['avatar'].'"></td>';
                              echo   ' <td>'.$row['fname'].'</td>';
                              echo   ' <td>'.$row['card'].'</td>';
                            //row allow door---
                                    if ($row['status']==1){ echo  ' <td class = "font-weight-bold text-success ">
                                          فتح</td>'; }else{  echo ' <td class = " font-weight-bold text-danger "> غلق </td>';};
                              
                              echo   ' <td>'.$row['date_status'].'</td>';
                              echo  '</tr>';
                            }
                              ?>
                  </tbody>
                </table>
             <?php }else{echo '<div class="alert alert-info">Not Log  </div>';}?>  
         </div>
   
         <div class="btn-group pagination pagination-lg ">
      <button class="button page-item btn-lg btn-dark" id="btn_prev" onclick="prevPage()">Prev </button>
      <button class="button page-item btn-lg btn-dark" id="btn_next" onclick="nextPage()">Next </button>
      <div style="display: inline-block; position:relative; border: 0px solid #e3e3e3; margin-left: 2px;">

        <p class= "page-item btn-lg font-weight-bold">  <span id="page"></span></p>
      </div>
      <select class="page-item btn-dark" name="number_of_rows" id="number_of_rows">
        <option value="10">10</option>
        <option value="25">25</option>
        <option value="50">50</option>
        <option value="100">100</option>
      </select>
      <button class="button page-item  btn-secondary" id="btn_apply" onclick="apply_Number_of_Rows()">Apply</button>
    </div>

    <br>
    
    <script>
      //------------------------------------------------------------
      var current_page = 1;
      var records_per_page = 10;
      var l = document.getElementById("table_id").rows.length
      //------------------------------------------------------------
      
      //------------------------------------------------------------
      function apply_Number_of_Rows() {
        var x = document.getElementById("number_of_rows").value;
        records_per_page = x;
        changePage(current_page);
      }
      //------------------------------------------------------------
      
      //------------------------------------------------------------
      function prevPage() {
        if (current_page > 1) {
            current_page--;
            changePage(current_page);
        }
      }
      //------------------------------------------------------------
      
      //------------------------------------------------------------
      function nextPage() {
        if (current_page < numPages()) {
            current_page++;
            changePage(current_page);
        }
      }
      //------------------------------------------------------------
      
      //------------------------------------------------------------
      function changePage(page) {
        var btn_next = document.getElementById("btn_next");
        var btn_prev = document.getElementById("btn_prev");
        var listing_table = document.getElementById("table_id");
        var page_span = document.getElementById("page");
       
        // Validate page
        if (page < 1) page = 1;
        if (page > numPages()) page = numPages();

        [...listing_table.getElementsByTagName('tr')].forEach((tr)=>{
            tr.style.display='none'; // reset all to not display
        });
        listing_table.rows[0].style.display = ""; // display the title row

        for (var i = (page-1) * records_per_page + 1; i < (page * records_per_page) + 1; i++) {
          if (listing_table.rows[i]) {
            listing_table.rows[i].style.display = ""
          } else {
            continue;
          }
        }
          
        page_span.innerHTML = page + " /  " + numPages()  ;
        
        if (page == 0 && numPages() == 0) {
          btn_prev.disabled = true;
          btn_next.disabled = true;
          return;
        }

        if (page == 1) {
          btn_prev.disabled = true;
        } else {
          btn_prev.disabled = false;
        }

        if (page == numPages()) {
          btn_next.disabled = true;
        } else {
          btn_next.disabled = false;
        }
      }
      //------------------------------------------------------------
      
      //------------------------------------------------------------
      function numPages() {
        return Math.ceil((l - 1) / records_per_page);
      }
      //------------------------------------------------------------
      
      //------------------------------------------------------------
      window.onload = function() {
        var x = document.getElementById("number_of_rows").value;
        records_per_page = x;
        changePage(current_page);
      };
      //------------------------------------------------------------
    </script>
          
      </div>


   <?php   
      
           
           
           
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
    
