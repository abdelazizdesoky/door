
<?php

// connect database ---------------------   
include('conn.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST'){

    $sta = $_POST['status'];

//update data ---------------------
$stmtin = $con->prepare('UPDATE  door_status SET id =? ');
$stmtin->execute(array( $sta));
}


//get data -----------------------
$stmt = $con->prepare ("SELECT * FROM door_status  LIMIT 1" );
$stmt->execute();
$row = $stmt->fetch();

    
echo $row['id'];

?>
 
