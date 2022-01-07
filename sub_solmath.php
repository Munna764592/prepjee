<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solutions</title>
    <?php include 'link.php' ?>
    <?php include 'connection.php' ?>

</head>

<body>
    <?php
    $id = $_GET['qus_id'];
    $qry = "select * from `mathqus&ans` where id='$id'";
    $ex = mysqli_query($cons, $qry);

    if ($ex) {
        $fetch = mysqli_fetch_assoc($ex);
        $math_imgsol = $fetch['math_imgsol'];
    }
    ?>

    <div class="container-xxl">
        <div class="head_sol">
            <h1 style="font-size: 35px;">Solution</h1>
        </div>
        <hr style="width:100%; height:0.5px; margin:auto; margin-bottom:15px;">
        <div style="font-family: 'Poppins', sans-serif;">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quod nostrum placeat accusantium aliquam fuga ipsum, magni et esse, id delectus fugit! Nihil quo temporibus assumenda natus, molestias a quibusdam optio at debitis, repellendus sapiente placeat minima reprehenderit voluptate doloremque. Ratione iste qui alias .</div>
        <?php

        if ($math_imgsol != null) {
            echo '<div ><img style="width: 100%; height:100%;" src=" ' . $math_imgsol . ' "> </div>';
        };
        ?>
    </div>
</body>

</html>