<body  onload="table();">
<div id = "fatch"  > </div>

   <script>
   function fetch(){
       const xhttp =new XMLHttpRequest();
       xhttp.onreadystatechange =function(){
       let res= this.response;


       if (res == 1){

              document.getElementById("fatch").style.backgroundColor="green";
                document.getElementById("fatch").textContent="main in mossasa opened door";
           

       }else{
              document.getElementById("fatch").style.backgroundColor="red";
                document.getElementById("fatch").textContent="access deny and close door";
     
         
        }

        
     
       }
       xhttp.open("GET","fetch.php");
       xhttp.send();
       }
   
   
       setInterval(function(){
           fetch();
       },1000);

       </script></body>