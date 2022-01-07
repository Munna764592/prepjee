<?php
$con = mysqli_connect("localhost","root","","studentdetails");

if (isset($_POST['img_file'])) {
    $data = $_POST['img_file'];

    $image_array_1 = explode(";", $data);
    $image_array_2 = explode(",", $image_array_1[1]);
    $file_base64 = base64_decode($image_array_2[1]);

    $image_path = 'upload/' . time() . '.png';
    
    file_put_contents($image_path, $file_base64);
    $image_name = 'PHP_updatepp/upload/'.time().'.png';
   
    $id=$_POST['id'];
    $qry="update loginregistration set img_pic='$image_name' where id='$id'";
    $ex_qry=mysqli_query($con,$qry);

    $quy_2="select * from loginregistration where id='$id'";
    $exe_q2= mysqli_query($con,$quy_2);
    if($exe_q2){
        $fetch=mysqli_fetch_assoc($exe_q2);
        $img_pic=$fetch['img_pic'];
        echo $img_pic;
    }
}
