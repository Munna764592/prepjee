<?php
$cons = mysqli_connect("localhost", "root", "", "prepjeequestions");

if (isset($_POST['copt_val'])) {

    $check_data = $_POST['copt_val'];
    $id = $_POST['cqus_id'];

    $qry = "select * from `mathqus&ans` where id='$id'";
    $exe = mysqli_query($cons, $qry);
    if ($exe) {
        $fetch_data = mysqli_fetch_assoc($exe);
        $cor_opt = $fetch_data['cor_opt'];

        if ($cor_opt === $check_data) {
            echo 1;
        }else{
            echo $cor_opt;
        }
    }
}
?>