$(function(){
    
    'use strict';
            
//show password----------------
    var pass = $('.password')
    $('.showpass').hover(function(){
     pass.attr('type','text');  
    },function(){
     pass.attr('type','password');  
  
    }
    )

  //confirm message  delete-------
    $('.confirm').click(function(){
                        
         return  confirm('Are you sure ?');              
                        
                        });
    
//-login & signup --------------------    
    
 $('.form-log h2 span').click(function(){
     $(this).addClass('selected').siblings().removeClass('selected')

 $('.form-log form').hide();
     
 $('.' + $(this).data('class')).fadeIn(100)
 
 });
    

  
    
});


//Real time -----------------------------
//------------------------------------------------------------
function Get_Data() {
        if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp = new XMLHttpRequest();
  } else {
    // code for IE6, IE5
    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {

       let res= this.response;

        if (res == 1){
  
               document.getElementById("fatch").style.backgroundColor="green";
                 document.getElementById("fatch").textContent="   الباب الرئيسى بالمؤسسة مفتوح ";
            
 
        }else{
               document.getElementById("fatch").style.backgroundColor="red";
                 document.getElementById("fatch").textContent=" الباب الرئيسى بالمؤسسة مغلق";
      
          
         }
 
      
    }
  };
  xmlhttp.open("GET","fetch.php");
  xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xmlhttp.send();
      }

      setInterval(Get_Data, 500);