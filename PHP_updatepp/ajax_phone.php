<?php
$con = mysqli_connect("localhost","root","","studentdetails");

$id= $_POST['id'];
$qury="select * from loginregistration where id= '$id'";
$excute=mysqli_query($con,$qury);

if($excute){
    $fetch= mysqli_fetch_assoc($excute);
    $phone=$fetch['phoneno'];
    echo $phone;
}

?>