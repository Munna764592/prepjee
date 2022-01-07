<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    error_reporting(0);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ask questions with own companions.</title>
    <?php include 'link.php'  ?>
    <?php include 'connection.php' ?>
</head>

<body>
    <!-- alert   -->
    <div class="Qus_sub"><i class="fas fa-check-circle"></i>
        <h5>Answer cropped!</h5>
    </div>
    <!-- navbar   -->
    <nav class="navbar1">
        <div class="navins">
            <div class="navimg">
                <a class="navbar-brand" href="home.php">
                    <img src="./images/logo.png" alt="load.." width="30" height="24">
                </a>
                <h3><strong>PrepJEE</strong></h3>

            </div>
            <div class="ans_mail">
                <?php
                if ($_SESSION['loggedin']) {
                    $id = $_SESSION['id'];
                    $query = "SELECT * FROM `loginregistration` WHERE id='$id'";
                    $execute = mysqli_query($con, $query);

                    if ($execute) {
                        $fetch = mysqli_fetch_assoc($execute);
                        $name = $fetch['studentname'];
                        $email = $fetch['email'];
                        $img_fetch = $fetch['img_pic'];
                    }
                    echo ' <div id="useremail"><b>' . $name . '</b></div>';
                }; ?>
            </div>
        </div>
    </nav>
    <!-- browse each questions backend -->
    <?php

    $stuid = $_GET['stuid'];
    $sql = "select * from askedquestions where id= '$stuid' ";
    $result = mysqli_query($cons, $sql);

    $row = mysqli_fetch_assoc($result);

    if ($row) {
        $studentnam = $row['studentname'];
        $ques = $row['questions'];
        $thread_time = $row['timestamp'];
        $img_pic = $row['img_pic'];
        $qus_pic = $row['qus_pic'];
    }; ?>

    <!-- showing questions section  -->
    <div class="container elaborate">
        <h3>Discussion</h3>
        <hr style=" height:0.5px; margin:auto;">

        <!-- questions part   -->
        <div class="anscon">
            <h6 style="padding: 5px; font-family: 'Poppins', sans-serif;"><?php echo $ques; ?> </h6>
            <?php
            if ($qus_pic != null) {
                echo ' <div class="qus_img">
                <img style="width:90%" src="' . $qus_pic . '">
            </div>';
            }
            ?>
            <div style="display: flex; justify-content:right;">
                <div style="font-size: 13px;" class="usersend">asked&nbsp<time class="timeago" datetime="<?php echo $thread_time; ?>"></time>
                    <div class="useri">
                        <img src="<?php echo $img_pic; ?>" alt="lod..." onerror="this.src='images/userimage.png'">
                        &nbsp <h6 style="color: #ca2f2f; margin-bottom:0px;"> <?php echo $studentnam; ?></h6>
                    </div>
                </div>
            </div>
        </div>

        <div id="yourAns" class="yourAns">
            <h5> Type your answers</h5>
            <form action="" method="POST">
                <textarea id="succ_ans" name="answer_s" class="form-control" placeholder="Write your answers." id="floatingTextarea"></textarea>
                <div class="succmsg"></div>
                <div style="display: flex; justify-content:space-between; align-items:center;">
                    <button style="margin-top:6px; font-family: 'Poppins', sans-serif;" type="submit" name="anssubmit" class="btnask btn-sm rounded-pill">Submit</button>

                    <!-- image upload section   -->
                    <div style="display: flex;">
                        <div style=" display:flex; align-items:center; margin-right:5px;  font-family: 'Titillium Web', sans-serif; color:#0bbc80;">
                            <label style="cursor: pointer;" for="img_qus"><b class="qus_cam">Upload image</b></label>
                        </div>
                        <label for="img_qus">
                            <buttom class="qus_cam"> <i style="padding-top:0px; width: 31px; color:#0bbc80;" class="fas fa-camera"></i></buttom>
                        </label>
                        <?php
                        if ($_SESSION['loggedin']) {
                            echo '<input id="img_qus" type="file" name="img_qus"> ';
                        } else {
                        ?>
                            <script>
                                $(document).ready(function() {
                                    $('.btnask').click(function() {
                                        alert('please login first.');
                                    });

                                    $('.qus_cam').click(function() {
                                        alert('please login first.');
                                    });
                                });
                            </script>
                        <?php
                        };
                        ?>
                        <input style="width:10px; position: absolute; visibility:hidden;" id="ajax_adata" name="img_ans" type="text" value="">
                    </div>
                </div>
            </form>
        </div>
        <!-- answer image submit backend code   -->
        <script>
            $(document).ready(function() {
                let para_m = new URLSearchParams(window.location.search);
                var stud_id = para_m.get('stuid');

                function alert() {
                    let log_alert = document.querySelector('.Qus_sub');
                    log_alert.classList.add('log_alert-active');

                    setTimeout(() => {
                        let log_alert = document.querySelector('.Qus_sub');
                        log_alert.classList.remove('log_alert-active');
                    }, 2000);
                };

                var $modal = $('#ans_crop');
                var image = document.getElementById('sam_img');
                var cropper;

                $('#img_qus').change(function(event) {
                    var files = event.target.files;

                    var done = function(url) {
                        image.src = url;
                        $modal.modal('show');
                    };

                    if (files && files.length > 0) {
                        reader = new FileReader();
                        reader.onload = function(event) {
                            done(reader.result);
                        };
                        reader.readAsDataURL(files[0]);
                    }
                });
                $modal.on('shown.bs.modal', function() {
                    cropper = new Cropper(image, {
                        aspectRatio: NaN,
                        viewMode: 2

                    });
                }).on('hidden.bs.modal', function() {
                    cropper.destroy();
                    cropper = null;
                });

                $('#submit_c').click(function() {
                    canvas = cropper.getCroppedCanvas({
                        width: 1500,
                        height: 1500
                    });

                    canvas.toBlob(function(blob) {
                        url = URL.createObjectURL(blob);
                        var reader = new FileReader();
                        reader.readAsDataURL(blob);
                        reader.onloadend = function() {
                            var base64data = reader.result;

                            $.ajax({
                                url: 'phpq&s_cam/ajax-ans.php',
                                type: 'POST',
                                data: {
                                    img_file: base64data,
                                    id: stud_id
                                },
                                success: function(data) {
                                    $modal.modal('hide');
                                    $('#ajax_adata').attr('value', data);
                                    alert();
                                }
                            });
                        };
                    });
                });
            });
        </script>
        <!-- crop image modal    -->

        <div class="modal fade" role="dialog" id="ans_crop" display="block" data-bs-backdrop="static" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 style="color: #3270af;" class="modal-title" id="modalLabel"><b>Crop Answer</b></h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div style="padding:1px" class="modal-body">
                        <div class="box_preview">
                            <img style="width: 100%; max-height:100vh;" src="" id="sam_img">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary btn-sm rounded-pill" id="submit_c">Crop</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- submit answers backend   -->

        <?php
        $id = $_SESSION['id'];

        $quury = "select * from loginregistration where id='$id' ";
        $exe = mysqli_query($con, $quury);

        if ($exe) {
            $fetchexe = mysqli_fetch_assoc($exe);
            $stu_name = $fetchexe['studentname'];
            $emailid = $fetchexe['email'];
            $img_pic = $fetchexe['img_pic'];
        }
        $qry = "update answers set studentname='$stu_name',img_pic='$img_pic' where stud_id='$id'";
        $exce = mysqli_query($cons, $qry);

        if (isset($_POST['anssubmit'])) {

            if ($_SESSION['loggedin']) {
                $Ans = $_POST['answer_s'];
                $img_ans = $_POST['img_ans'];

                $submit_ans = "insert into answers( stud_id,studentname,email_id,ans_qus,ans_pic,ans_a) values ('$id','$stu_name','$emailid','$ques','$img_ans','$Ans')";
                $ansquery = mysqli_query($cons, $submit_ans);

                if ($ansquery) {
        ?>
                    <script>
                        let succ_ans = document.getElementById('succ_ans');
                        succ_ans.style.border = "1px solid #28a745"

                        let succmsg = document.querySelector('.succmsg');
                        succmsg.innerHTML = " <i id='succicon' class='fas fa-check-circle'></i>Answer submit.";
                        setTimeout(() => {
                            location.replace("_qus&ans.php?qus_s=<?php echo $ques; ?>&stuid=<?php echo $stuid; ?> ");
                        }, 1000);
                    </script>
        <?php
                }
            }
        }
        ?>
        <div class="anshead">
            <h4>Answers</h4>
        </div>
        <hr style=" height:0.5px; margin:auto; margin-bottom:15px;">

        <!-- browse answers backend    -->
        <div class="ans_browse">
            <?php
            $quss = $_GET['qus_s'];
            $sqll = "select * from `answers` where ans_qus='$quss' order by id desc";
            $ress = mysqli_query($cons, $sqll);
            $noresult = true;
            while ($rows = mysqli_fetch_assoc($ress)) {

                if ($rows['ver_admin'] === 'verified') {

                    $noresult = false;
                    $stud_name = $rows['studentname'];
                    $time_ago = $rows['time_stamp'];
                    $ans_given = $rows['ans_a'];
                    $img_pic = $rows['img_pic'];
                    $ans_pic = $rows['ans_pic'];
                    $id = $rows['id'];

                    echo '<div class="ansbrowse">
                <div id="mediaalign" class="media">
                <img class="mr-3 mt-1" src="' . $img_pic . '" alt="lod..." onerror="this.src=`images/userimage.png`">
                <div class="media-body">
                    <div style="justify-content:space-between;" class="browsehng">
                    <div style="display:flex;">  <h5 class="mt-0" style="font-family: Poppins, sans-serif;"><b>' . $stud_name . '</b> </h5>
                    &nbsp&nbsp <div class="timeshow"><time class="timeago" datetime=" ' . $time_ago . '"></time> </div></div>
                    </div>
                    <div class="qus_browse">' . $ans_given . ' </div>';
                    if ($qus_pic != null) {
                        echo  '<div class="mb-2" style="position:relative;"><div id="browse_qcam">
                        <img id="browse_img" src=" ' . $ans_pic . '" ><div class="hover_view"  data-id_ans="' . $id . '">VIEW</div></div></div>';
                    }
                    echo '<div class="ver_admin"><i class="far fa-check-circle "></i>admin verified</div></div></div></div>';
                }
            }

            $qus = $_GET['qus_s'];
            $sql = "select * from `answers` where ans_qus='$qus' order by id desc";
            $res = mysqli_query($cons, $sql);

            while ($row = mysqli_fetch_assoc($res)) {
                $noresult = false;
                $stud_name = $row['studentname'];
                $time_ago = $row['time_stamp'];
                $ans_given = $row['ans_a'];
                $img_pic = $row['img_pic'];
                $ans_pic = $row['ans_pic'];
                $id = $row['id'];
                $ver_admin = $row['ver_admin'];

                if ($ver_admin == null) {
                    echo '<div class="ansbrowse">
                <div id="mediaalign" class="media">
                <img class="mr-3 mt-1" src="' . $img_pic . '" alt="lod..." onerror="this.src=`images/userimage.png`">
                <div class="media-body">
                    <div style="justify-content:space-between;" class="browsehng">
                    <div style="display:flex;">  <h5 class="mt-0" style="font-family: Poppins, sans-serif;"><b>' . $stud_name . '</b> </h5>
                    &nbsp&nbsp <div class="timeshow"><time class="timeago" datetime=" ' . $time_ago . '"></time> </div></div>
                    </div>
                    <div class="qus_browse">' . $ans_given . ' </div>';
                    if ($qus_pic != null) {
                        echo  '<div class="mb-2" style="position:relative;"><div id="browse_qcam">
                        <img id="browse_img" src=" ' . $ans_pic . '" ><div class="hover_view"  data-id_ans="' . $id . '">VIEW</div></div></div>';
                    };

                    echo '</div></div></div>';
                }
            }
            if ($noresult) {
                echo '<div class="container ansbrowse"><b>Elaborate your views. </b></div>';
            };
            ?>
            <!-- view answers images modal  -->

            <div class="modal fade" role="dialog" id="ans_viewer" display="block" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 style="color: #3270af;" class="modal-title" id="modalLabel"><b>Answer</b></h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div style="padding:1px; padding-bottom:25px;" class="modal-body">
                            <div class="box_preview">
                                <img style="width: 100%; max-height:100vh;" src="" id="img_ansv">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <script>
                $(document).on("click", ".hover_view", function() {
                    var thisimg = $(this).data("id_ans");

                    $.ajax({
                        url: '_ansimgviewer/ans_imgviewer.php',
                        type: 'POST',
                        data: {
                            id_img: thisimg
                        },
                        success: function(data) {
                            $("#img_ansv").attr('src', data)
                        }
                    })
                    $('#ans_viewer').modal('show');
                    $('#ans_viewer').modal('handleUpdate');

                });
            </script>
        </div>
    </div>
    <div class="footerbgp">
        <div class="footer1">Contact & Follow Us
            <div><a href="https://www.facebook.com/profile.php?id=100023807041187" target="_blank"> <i class="fab fa-facebook fa-2x"></i></a>&nbsp
                <a href="https://www.instagram.com/here_munna_07/" target="_blank"> <i class="fab fa-instagram fa-2x"></i></a>&nbsp
                <a href="https://twitter.com/here_Munna_07" target="_blank"> <i class="fab fa-twitter fa-2x"></i></a>
            </div>
        </div>
        <div style="color: white">Copyright <?php
                                            $year = date('Y');
                                            echo $year;
                                            ?>
            &#169 PrepJee.in</div>
    </div>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="timeago/jquery.timeago.js"></script>
<script type="text/javascript">
    jQuery(document).ready(function() {
        $("time.timeago").timeago();
    });
</script>

</html>