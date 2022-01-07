<?php

$username ="root";
$password ="";
$server ="localhost";
$db ="studentdetails";

$con=mysqli_connect($server,$username,$password,$db);

$db = mysqli_select_db($con,$db);

if($con){
    // echo "Connection Successful";
}else{
     
   die("no connection". mysqli_connect_error());
}

?>

<?php

$username ="root";
$password = "";
$server ="localhost";
$db ="prepjeequestions";

$cons=mysqli_connect($server,$username,$password,$db);

$db = mysqli_select_db($cons,$db);

if($cons){
   
    
 }else{
        die("no connection". mysqli_connect_error());
 }


?>