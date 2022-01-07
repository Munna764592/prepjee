<?php
$cons = mysqli_connect("localhost", "root", "", "prepjeequestions");

if (isset($_POST['id_img'])) {

    $id=$_POST['id_img'];
    $qry = "select * from `answers` where id='$id'";
    $exe = mysqli_query($cons, $qry);

    if ($exe) {
        $fetch = mysqli_fetch_assoc($exe);
        echo $fetch['ans_pic'];
    }
}
?>