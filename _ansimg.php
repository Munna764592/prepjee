<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ans_img</title>
    <?php include 'connection.php' ?>
    <?php include 'link.php'  ?>
</head>

<body>
    <div style="height: 100vh; align-items:center;" class="container-xl d-flex">

        <!-- fetch image backend code   -->
        <?php
        $id = $_GET['stuid'];

        $qry = "select * from answers where id='$id'";
        $exex = mysqli_query($cons, $qry);

        if ($exex) {
            $fetch = mysqli_fetch_assoc($exex);
            $ans_pic = $fetch['ans_pic'];
        }
        ?>
        <div style="width: 100%; border:1px solid grey; border-radius:3px; ">
             <img style="width: 100%;" src="<?php echo $ans_pic; ?>">
        </div>
    </div>
</body>
</html>