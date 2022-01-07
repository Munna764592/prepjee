<?php
$cons=mysqli_connect("localhost","root","","prepjeequestions");

if(isset($_POST['img_file'])){

    $data= $_POST['img_file'];
    $image_array_1 = explode(";", $data);
    $image_array_2 = explode(",", $image_array_1[1]);
    $file_base64 = base64_decode($image_array_2[1]);

    $image_path = 'upload-cam-ans/' . time() . '.png';
    
    file_put_contents($image_path, $file_base64);
    $qus_pic = 'phpq&s_cam/upload-cam-ans/'.time().'.png';
    echo $qus_pic;

};
?>