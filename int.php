<?php



//route---------------------
$tmp = "include/temp/";
$lang = "include/lang/";
$fun = "include/fun/";

//-------------connect databases-----------
include ('conn.php');
//----------functions----------------------
include  ($fun . "fun.php");

//lang------lang -----------------------



    include ($lang . "eng.php");
    


//temp--------header ---------------------
include  ($tmp . "header.php");
//-nav-----------------------------------
if (!isset($nonav)){   
    include ($tmp . "nav.php");
    
}
