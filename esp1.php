<?php

 //connect database ---------------------   
 include('conn.php');

//red data------------------------------
if ($_SERVER['REQUEST_METHOD'] == 'POST'){

    
    $card = $_POST['uid'] ;
    $door = 1;

    //e1fef71c
     
   //check card found and user auth ----------------
    $stmt = $con->prepare ("SELECT  door.id , user.card, user.auth ,user.id as userid
                             FROM user,door
                             WHERE   user.card= ? AND door.id = ? AND user.auth = ?;" );
    $stmt->execute(array($card,$door,1));
    $rows = $stmt->fetch();
    $cou = $stmt ->rowcount();
    

    if ($cou == 1 ){

         echo "Open Door";

         //insert log user-----------
     $stmtin = $con->prepare('INSERT INTO logs (card,user,door ,status,date_status)
       VALUES (:xcard,:xuser,:xdoor,1,now())');
        $stmtin->execute(array('xcard'=>$card,
                               'xuser'=>$rows['userid'],
                               'xdoor'=>$door            
                              ));


      
    }else{
        echo "Close Door";
        //check user------------
   $stmt = $con->prepare ("SELECT   card,user.id   FROM user  WHERE   card= ?;" );
        $stmt->execute(array($card));
        $row = $stmt->fetch();
        $cou1 = $stmt ->rowcount();
      

     if ($cou1 >= 1){

    //insert log user when user not auth -----------
    $stmtin = $con->prepare('INSERT INTO logs (card,user,door ,status,date_status) VALUES (:xcard,:xuser,:xdoor,0,now())');
     $stmtin->execute(array('xcard'=>$card,
                             'xuser'=>$row['id'],
                             'xdoor'=>$door ));
    }else{

         //insert log nuknem when user not auth -----------
    $stmtin = $con->prepare('INSERT INTO logs (card,user,door ,status,date_status) VALUES (:xcard,:xuser,:xdoor,0,now())');
    $stmtin->execute(array('xcard'=>$card,
                            'xuser'=>'no user',
                            'xdoor'=>$door ));

    }

}

 


}else {
        echo "no found N1";
}

?>