<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="we procreate e-learning environment such that each and every students can learn and be educated.">
    <title>PrepJEE : More you practice better be your result.</title>
    <?php include 'link.php'  ?>
    <?php include 'connection.php' ?>

</head>

<body>
    <!--  alerts    -->
    <div class="login_alert"><i class="fas fa-check-circle"></i>
        <h5>Login Successfull!</h5>
    </div>
    <div class="pass_ualert"><i class="fas fa-check-circle"></i>
        <h5>Password Changed!</h5>
    </div>
    <div class="Qus_sub"><i class="fas fa-check-circle"></i>
        <h5>Question cropped!</h5>
    </div>
    <!-- navbar   -->
    <nav id="navbar1" class="navbar sticky-top navbar-expand-lg navbar-light ">
        <div id="container-fluid" class="container-fluid">
            <div class="logo"><a class="navbar-brand" href="#"><img src="./images/logo.png"></a></div>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li id="home" class="nav-item">
                        <a class="nav-link " aria-current="page" href="./about_us.php"><strong>About Us</strong></a>
                    </li>
                    <li id="years" class="nav-item">
                        <a class="nav-link " aria-current="page" href="./pyp.php"><strong> Previous Year papers</strong></a>
                    </li>

                </ul>

                <?php

                if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
                    error_reporting(0);
                }
                if (isset($_SESSION['loggedin']) || $_SESSION['loggedin'] == true) {
                    $loggedin = true;
                } else {
                    $loggedin = false;
                }
                if (!$loggedin) {
                    echo '<div class="s_lbtn"> <button id="show-login" class="btn btn-outline-primary " data-bs-toggle="modal" data-bs-target="#login_modal" > LogIn</button>
                    <button id="show-signup" class="btn btn-outline-primary mx-1" data-bs-toggle="modal" href="#exampleModalToggle" > SignUp</button> </div> ';
                }; ?>
            </div>
        </div>
        <?php
        if ($loggedin) {
            $ids = $_SESSION['id'];
            $query = "SELECT * FROM `loginregistration` WHERE id=$ids";
            $execute = mysqli_query($con, $query);

            if ($execute) {
                $fetch = mysqli_fetch_assoc($execute);
                $name = $fetch['studentname'];
                $email = $fetch['email'];
                $img_fetch = $fetch['img_pic'];
            }
            echo '
             <div class="action">
                        <div class="profile">
                        <img id="user_pc" src=" ' . $img_fetch . '" onclick="menuToggle();" alt="lod.."  onerror="this.src=`images/userimage.png`">
                        </div>
                        <div id="menu_u" class="menu">
                            <h5>' . $name . '</h5>
                            
                               <div class="usercont"> <i id="faspropic" class="fas fa-envelope"></i><div class="cont">' . $email . '</div></div>
                               <div class="usercont"> <i id="faspropic" class="fas fa-user-edit"></i> <div class="up_profile"><a href="./update_profile.php?studid= ' . $_SESSION['id'] . ' ">update</a></div></div>
                                <i id="faspropic" class="fas fa-sign-out-alt"></i><button id="show-logout" onclick="logout()">
                                        <a href="./logout.php"><div class="cont1"> Logout </div></a></button>
                            </div>
                        </div>';
        };
        ?>
    </nav>

    <div class="heading">
        <h1>PREP.<span id="badgejee" class="badge bg-danger"> JEE</span></h1>
    </div>
    <div class="subheading">
        <p><strong> More You Practice<br>Better Be Your Results.</strong></p>
    </div>
    <div class="container my-4">
        <div id="card1" class="card">
            <img src="images/phy.jpg" class="card-img-top" alt="loading...">
            <div style="font-family: 'Rubik', sans-serif;" class="card-body">
                <h5 class="card-title">Physics Questions</h5>
                <p class="card-text">Latest Physics questions as prescribed by jee syllabus.</p>
                <a href="./pagephy.php" id="btn3" style="font-family: 'Roboto', sans-serif;" class="btn btn-primary btn-sm">Click here</a>
            </div>
        </div>

        <div id="card1" class="card">
            <img src="images/che.jpg" class="card-img-top" alt="loading...">
            <div style="font-family: 'Rubik', sans-serif;" class="card-body">
                <h5 class="card-title">Chemistry Questions</h5>
                <p class="card-text">Latest Chemistry questions as prescribed by jee syllabus.</p>
                <a href="./pageche.php" id="btn3" style="font-family: 'Roboto', sans-serif;" class="btn btn-primary btn-sm">Click here</a>
            </div>
        </div>

        <div id="card1" class="card">
            <img height=179px src="images/math1.jpg" class="card-img-top" alt="loading...">
            <div style="font-family: 'Rubik', sans-serif;" class="card-body">
                <h5 class="card-title">Math Questions</h5>
                <p class="card-text">Latest maths questions as prescribed by jee syllabus.</p>
                <a href="./pagemath.php" id="btn3" style="font-family: 'Roboto', sans-serif;" class="btn btn-primary btn-sm">Click here</a>
            </div>
        </div>
    </div>
    <div class="crack">
        <h2><strong>Crack Competitive Exams Easily.</strong></h2>
    </div>
    <!-- ask questions frontend   -->

    <div class="container browse">
        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
            <h3> Ask doubts.</h3>

            <div id="homequs">
                <textarea class="form-control" name="questions" placeholder="Leave a question here" id="floatingTextarea" required></textarea>
            </div>
            <div id="qusc_upload">
                <button type="submit" name="asksubmit" class="btnask">Submit</button>
                <div style="display:flex; margin-top:5px; position:relative;">
                    <div style=" display:flex; align-items:center; margin-right:5px;  font-family: 'Titillium Web', sans-serif; color:#0bbc80;"> <label style="cursor: pointer;" for="img_qus"><b class="qus_cam">Upload image</b></label></div>
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
                                    $('#login_modal').modal('show')
                                });

                                $('.qus_cam').click(function() {

                                    $('#login_modal').modal('show')
                                });
                            });
                        </script>
                    <?php
                    };
                    ?>
                    <input style="width:10px; position: absolute; visibility:hidden;" id="ajax_cdata" name="img_qus" type="text" value="">
                </div>
            </div>
        </form>
        <!-- crop image modal    -->

        <div class="modal fade" role="dialog" id="qus_crop" display="block" data-bs-backdrop="static" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered modal-lg " role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 style="color: #3270af;" class="modal-title" id="modalLabel"><b>Crop questions</b></h4>
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

        <!-- ask questions backend    -->
        <script>
            $(document).ready(function() {
                let para_m = new URLSearchParams(window.location.search);
                var stud_id = para_m.get('studid');

                function alert() {
                    let log_alert = document.querySelector('.Qus_sub');
                    log_alert.classList.add('log_alert-active');

                    setTimeout(() => {
                        let log_alert = document.querySelector('.Qus_sub');
                        log_alert.classList.remove('log_alert-active');
                    }, 2000);
                };

                var $modal = $('#qus_crop');
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
                                url: 'phpq&s_cam/ajax-qusu.php',
                                type: 'POST',
                                data: {
                                    img_file: base64data,
                                    id: stud_id
                                },
                                success: function(data) {
                                    $modal.modal('hide');
                                    $('#ajax_cdata').attr('value', data);
                                    alert();
                                }
                            });
                        };
                    });
                });

            });
        </script>
        <!-- database insert of questions   -->
        <?php
        $id = $_SESSION['id'];

        $quury = "select * from loginregistration where id='$id' ";
        $exe = mysqli_query($con, $quury);
        if ($exe) {
            $fetchexe = mysqli_fetch_assoc($exe);
            $stname = $fetchexe['studentname'];
            $img_pic = $fetchexe['img_pic'];
            $email = $fetchexe['email'];
        }
        $qry = "update askedquestions set studentname='$stname',email='$email',img_pic='$img_pic' where stud_id='$id'";
        $exce = mysqli_query($cons, $qry);

        if (isset($_POST['asksubmit'])) {
            if ($_SESSION['loggedin']) {

                $ida = $_SESSION['id'];
                $emailid = $_SESSION['email'];
                $Qus = $_POST['questions'];
                $q_img = $_POST['img_qus'];


                $sendQus = "insert into askedquestions(stud_id, studentname,questions,qus_pic,emailid) values('$ida', '$stname','$Qus','$q_img','$emailid') ";

                $query = mysqli_query($cons, $sendQus);
                if ($query) {
        ?>
                    <script>
                        let log_alert = document.querySelector('.Qus_sub');
                        log_alert.classList.add('log_alert-active');

                        setTimeout(() => {
                            let log_alert = document.querySelector('.Qus_sub');
                            log_alert.classList.remove('log_alert-active');
                        }, 2000);
                        alert('question submit');
                        location.replace("home.php?sudid='<?php echo $_SESSION['id']; ?>'");
                    </script>
                <?php
                } else {
                    die(mysqli_connect_error());
                }
            } else {
                ?>
                <script>
                    $(function() {
                        $('#login_modal').modal('show');
                    });
                </script>
        <?php
            }
        }
        ?>

        <div class="search_qus">
            <h2> Browse Questions</h2>
            <div class=" my-1 ">
                <input id="qus_input" type="search" placeholder="Search questions" class=" rounded-pill" onkeyup="search_qus()">
            </div>
        </div>
    </div>
    <div style="padding-left: 5px; padding-right:5px;" class="container-lg allasked">
        <!-- browse questions backend -->
        <?php
        $noresult = true;
        $sql = "select * from askedquestions order by id desc ";
        $result = mysqli_query($cons, $sql);
        while ($row = mysqli_fetch_array($result)) {
            $noresult = false;
            $studentnam = $row['studentname'];
            $ques = $row['questions'];
            $thread_time = $row['timestamp'];
            $stu_id = $row['id'];
            $img_pic = $row['img_pic'];
            $qus_pic = $row['qus_pic'];

            echo '<div style="font-family: Poppins, sans-serif;" class="container browse"> 
                            <div class="media">
                            <img class="mr-3 mt-1" src="' . $img_pic . ' " alt="lod..."onerror="this.src=`images/userimage.png`">
                            <div class="media-body">
                            <div class="browsehng mt-1">
                            <h5 class="mt-0">' . $studentnam . ' </h5>
                            &nbsp&nbsp <div class="timeshow"><time class="timeago" datetime=" ' . $thread_time . '"></time> </div>
                            </div>
                            <div id="qus_browse">  <a class="qus_asf" href="_qus&ans.php?qus_s=' . $ques . '&stuid=' . $stu_id . ' " > ' . $ques . ' </a>';
            if ($qus_pic != null) {
                echo  '<div style="position:relative;"><div id="browse_qcam">
                <img id="browse_img" src=" ' . $qus_pic . '" ><a href="_qus&ans.php?stuid= ' . $stu_id . '&qus_s=' . $ques . ' "><div id="id' . $stu_id . '" class="hover_view">VIEW </div> </a></div></div> ';
            };
            echo  ' </div><div class="ansQus" > <a href="_qus&ans.php?stuid= ' . $stu_id . '&qus_s=' . $ques . ' "> Elaborate</a>
                            </div>
                            </div>
                           </div>
                    </div>';
        };
        if ($noresult) {
            echo "<div class='container browse'><b>Ask any doubt. </b></div>";
        };
        ?>
    </div>

    <!-- footer part for social media & messages  -->

    <div class="footerbg">
        <div class="footer2">Send Feedback & Messages</div>
        <form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>" style="margin:0px;" class="row g-3">
            <div id="comment4" class="form-floating">
                <textarea name="message" class="form-control" id="floatingTextarea2"></textarea>
            </div>
            <div class="col-auto text-center ">
                <button name="send" type="submit" id="btn3" class="btn btn-primary btn-sm mb-2">Submit</button>
            </div>
        </form>

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
    <!-- login form   -->

    <div class="modal fade" id="login_modal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div id="modal_l" class="modal-content">
                <div class="modal-header">

                    <h3 id="exampleModalToggleLabel"><b>L<i class="fas fa-meteor"></i><span style="margin-left: 20px; ">gin</span></b></h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form method="POST" action="<?php $_SERVER['PHP_SELF']; ?> ">
                    <div class="form-login">

                        <input type="email" id="input_emaill" name="email_l" pattern="[A-Za-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="Invalid email." autocomplete="off" required>
                        <label class="emaill_label">Email id</label>
                        <div class="underline_l1"></div>

                        <input type="password" id="input_passl" name="pass_l" required>
                        <label class="passl_label">Password</label>
                        <div class="underline_l2"></div>
                        <div id="passl_val"></div>

                        <div class="form-elem">
                            <button name="btn_l" type="submit">Login</button>
                        </div>
                        <div class="forg_pass"><i id="forgot_icon" class="fas fa-pen-alt fa-1x"></i><a data-bs-toggle="modal" data-bs-dismiss="modal" href="#modal_forgot-pass">Forgot Password?</a></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- reset password   -->
    <div class="modal fade" id="modal_forgot-pass" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div id="modal_fp" class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><b>Reset Password</b></h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="form-fp">
                    <form method="POST" action="<?php $_SERVER['PHP_SELF']  ?>">
                        <input name="email_fp" type="email " placeholder="Email id" pattern="[A-Za-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="Enter your email." required>
                        <div id="err_efp"></div>
                        <button name="btn_efp" type="submit" id="btn_efp">Send OTP</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- verify otp for reset password   -->
    <div class="modal fade" id="modal_forgot-op" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div id="modal_fp" class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><b>Verify OTP</b></h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="form-fp">
                    <form method="POST" action="<?php $_SERVER['PHP_SELF']  ?>">
                        <input name="otp_vfp" type="number" placeholder="Enter OTP" required>
                        <div id="otp_vefp"></div>
                        <div id="otp_uperr"></div>
                        <button name="btn_vfp" type="submit" id="btn_efp">Verify</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- set new password   -->
    <div class="modal fade" id="modal_forgot-sfp" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div id="modal_fp" class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><b> Set new password</b></h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="form-sfp">
                    <form method="POST" action="<?php $_SERVER['PHP_SELF']  ?>">
                        <input name="pass_sfp" type="password" placeholder="New password" minlength="7" required>
                        <input style="margin-top: 20px;" name="cpass_sfp" type="password" placeholder="Confirm new password" minlength="7" required>
                        <div id="pass_sfp"></div>
                        <button name="btn_sfp" type="submit" id="btn_efp">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- forgot password backend code    -->
    <?php
    if (isset($_POST['btn_efp'])) {
        $email = $_POST['email_fp'];

        $email_search = "select * from loginregistration where email = '$email'";
        $query_search = mysqli_query($con, $email_search);

        if ($query_search) {
            $f_data = mysqli_fetch_assoc($query_search);
            $_SESSION['id_fp'] = $f_data['id'];
            $id_fp = $_SESSION['id_fp'];
        }

        $count_e = mysqli_num_rows($query_search);
        if ($count_e) {

            $otp_str = str_shuffle('0123456789');
            $otp = substr($otp_str, 0, 6);

            $q_s = "update loginregistration set OTP='$otp' where id='$id_fp'";
            $e_s = mysqli_query($con, $q_s);
            if ($e_s) {

    ?><script>
                    let succmsg = document.querySelector('#otp_uperr');
                    succmsg.innerHTML = " <i id='succicon' class='fas fa-check-circle'></i> OTP sent to your email.";
                    $(function() {
                        $('#modal_forgot-op').modal({
                            backdrop: 'static'
                        });
                        $('#modal_forgot-op').modal('show');
                    });
                </script>
            <?php
            }
        } else {
            ?><script>
                alert('enter correct emailid.');
            </script>
            <?php
        }
    };

    if (isset($_POST['btn_vfp'])) {
        $id_vfp = $_SESSION['id_fp'];
        $otp_vfp = $_POST['otp_vfp'];
        $q_vfp = "select * from loginregistration where id=$id_vfp";
        $e_vfp = mysqli_query($con, $q_vfp);

        if ($e_vfp) {
            $f_vfp = mysqli_fetch_assoc($e_vfp);

            if ($f_vfp['OTP'] === $otp_vfp) {
            ?><script>
                    $(function() {
                        $('#modal_forgot-sfp').modal({
                            backdrop: 'static'
                        });
                        $('#modal_forgot-sfp').modal('show');
                    });
                </script>
            <?php
            } else {
            ?><script>
                    let errmsg = document.querySelector('#otp_vefp');
                    errmsg.innerHTML = " <i id='erricon' class='fas fa-exclamation-circle'></i> OTP do not match.";
                    $(function() {
                        $('#modal_forgot-op').modal({
                            backdrop: 'static'
                        });
                        $('#modal_forgot-op').modal('show');
                    });
                </script>
            <?php
            }
        }
    }

    if (isset($_POST['btn_sfp'])) {

        $pass_sfp = mysqli_real_escape_string($con, $_POST['pass_sfp']);
        $cpass_sfp = mysqli_real_escape_string($con, $_POST['cpass_sfp']);
        $id_sfp = $_SESSION['id_fp'];

        $phash_sfp = password_hash($pass_sfp, PASSWORD_BCRYPT);
        $cphash_sfp = password_hash($cpass_sfp, PASSWORD_BCRYPT);

        if ($pass_sfp === $cpass_sfp) {

            $q_sfp = "update loginregistration set password='$phash_sfp',cpassword='$cphash_sfp' where id='$id_sfp'";
            $e_sfp = mysqli_query($con, $q_sfp);

            if ($e_sfp) {
            ?><script>
                    let log_alert = document.querySelector('.pass_ualert');
                    log_alert.classList.add('log_alert-active');


                    setTimeout(() => {
                        let log_alert = document.querySelector('.pass_ualert');
                        log_alert.classList.remove('log_alert-active');
                    }, 2000);
                </script>
            <?php
            }
        } else {
            ?><script>
                let errmsg = document.querySelector('#pass_sfp');
                errmsg.innerHTML = " <i style='color: red;' id='faserror' class='fas fa-exclamation-circle'></i>Password are not matching.";

                $(function() {
                    $('#modal_forgot-sfp').modal({
                        backdrop: 'static'
                    });
                    $('#modal_forgot-sfp').modal('show');
                });
            </script>
    <?php
        }
    }
    ?>

    <!-- login backend code -->
    <?php
    if (isset($_POST['btn_l'])) {

        $emailid = $_POST['email_l'];
        $password = $_POST['pass_l'];


        $email_search = "select * from loginregistration where email= '$emailid' ";
        $query = mysqli_query($con, $email_search);

        $email_count = mysqli_num_rows($query);

        if ($email_count) {
            $email_pass = mysqli_fetch_assoc($query);

            $db_pass = $email_pass['password'];
            $studentnam = $email_pass['studentname'];
            $up_id = $email_pass['id'];

            $pass_decode = password_verify($password, $db_pass);

            if ($pass_decode) {

                $_SESSION['loggedin'] = true;
                $_SESSION['email'] = $emailid;
                $_SESSION['studentname'] = $studentnam;
                $_SESSION['id'] = $up_id;
    ?>
                <script>
                    let log_alert = document.querySelector('.login_alert');
                    log_alert.classList.add('log_alert-active');

                    setTimeout(() => {
                        let log_alert = document.querySelector('.login_alert');
                        log_alert.classList.remove('log_alert-active');
                    }, 2000);
                    setTimeout(() => {
                        location.replace("home.php?sudid='<?php echo $_SESSION['id']; ?>' ");
                    }, 2350);
                </script>
            <?php
            } else {
            ?>
                <script>
                    let borderred = document.querySelector('.underline_l2');
                    borderred.style.background = "red";

                    let errmsg = document.querySelector('#passl_val');
                    errmsg.innerHTML = " <i id='faserror' class='fas fa-exclamation-circle'></i>Incorrect password.";

                    $(function() {
                        $('#login_modal').modal('show');
                    });
                </script>
            <?php
            }
        } else {
            ?>
            <script>
                alert("User not exist");
                $(function() {
                    $('#login_modal').modal('show');
                });
            </script>
    <?php
        }
    }
    ?>
    <!-- realtime student chat  -->

    <div id="stud_chat" class="chat_icon" onclick="stud_chat()"><i class="fas fa-comments fa-3x"></i></div>
    <?php
    if ($_SESSION != null) {
    ?>
        <script>
            function stud_chat() {
                location.replace('Chat/stud_chat.php');
            };
        </script>
    <?php
    } else {
    ?>
        <script>
            function stud_chat() {
                $(function() {
                    $('#login_modal').modal('show');
                });
            }
        </script>
    <?php
    }
    ?>


    <!-- signup form  -->

    <div class="modal fade" id="exampleModalToggle" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div id="modal_s" class="modal-content ">

                <div class="modal-header">
                    <h3 id="exampleModalToggleLabel"><b>Create Account</b></h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>">
                    <div class="form-signup">
                        <input type="email" id="input_emails" name="emailid" pattern="[A-Za-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="Invalid email." required>
                        <label>Email id</label>
                        <div class="underline"></div>
                        <div id="email_val"></div>

                        <div class="form-elem">
                            <button name="btn_sotp" type="submit">Send OTP</button>
                        </div>
                    </div>
                    <div id="footer_s"><b>#Ask questions with own</b> </div>
                    <div id="footer_so"><b>companions.</b></div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal_otp" aria-hidden="true" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div id="modal_s" class="modal-content">
                <div class="modal-header">
                    <h3 id="exampleModalToggleLabel"><b>Verify OTP</b></h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">
                    <div class="form-verifyotp">
                        <input type="number" id="input_emails" name="otp_num" required>
                        <label>Enter OTP</label>
                        <div class="underline_vo"></div>
                        <div class="otp_errs"></div>
                        <div id="otp_valid"></div>
                        <div class="form-elem">
                            <button name="btn_votp" type="submit">Verify</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- signup backend code   -->
    <?php

    $otp_str = str_shuffle("0123456789");
    $otp = substr($otp_str, 0, 6);

    $act_str = rand(10000, 10000000);
    $activation_code = str_shuffle("abcdefghijklmnopqr" . $act_str);

    if (isset($_POST['btn_sotp'])) {

        $email_id = mysqli_real_escape_string($con, $_POST['emailid']);

        $email_query =  " select * from loginregistration where email ='$email_id' ";
        $query = mysqli_query($con, $email_query);
        $email_count = mysqli_num_rows($query);

        if ($email_count > 0) {
    ?>
            <script>
                let borderred = document.querySelector('.underline');
                borderred.style.background = "red";

                let errmsg = document.querySelector('#email_val');
                errmsg.innerHTML = " <i id='faserror' class='fas fa-exclamation-circle'></i>Email already exists.";


                $(function() {
                    $('#exampleModalToggle').modal('show');
                });
            </script>

            <?php
        } else {
            // message sections  

            $insert_query = "insert into loginregistration(email,OTP) values('$email_id' ,'$otp')";
            $execute_s = mysqli_query($con, $insert_query);
            if ($execute_s) {
                $_SESSION['email_otp'] = $email_id;
            ?>
                <!-- verify OTP     -->
                <script>
                    let succmsg = document.querySelector('#otp_valid');
                    succmsg.innerHTML = " <i id='succicon' class='fas fa-check-circle'></i> OTP sent.";
                    $(function() {
                        $('#modal_otp').modal({
                            backdrop: 'static'
                        });
                        $('#modal_otp').modal('show');
                    });
                </script>
            <?php
            } else {
            ?>
                <script>
                    alert('submit unsuccessful');
                </script>
    <?php
            }
        }
    }
    ?>
    <!-- signup main section     -->
    <div class="modal fade" id="modal_Mform" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div id="modal_fs" class="modal-content">
                <div class="modal-header">
                    <h3><b>SignUp</b></h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="<?php $_SERVER['PHP_SELF']; ?> ">
                    <div class="form-finals">
                        <!-- name   -->
                        <input type="text" id="input_studname" name="studname" minlength="4" title="Invalid name." required>
                        <label class="names_label">Name</label>
                        <div class="underline_sn"></div>
                        <div id="otp_valid"></div>
                        <!-- number   -->
                        <input type="number" id="input_studclass" name="studclass" max="13" min="5" title="Invalid class." required>
                        <label class="class_label">Class</label>
                        <div class="underline_sc"></div>
                        <div id="otp_valid"></div>
                        <!-- phoneno -->
                        <input type="tel" id="input_phoneno" name="phone_no" maxlength="10" minlength="10" required>
                        <label class="phone_label">Phone number</label>
                        <div class="underline_spn"></div>
                        <div id="otp_valid"></div>
                        <!-- password  -->
                        <input type="password" id="input_pass" name="pass_s" minlength="7" required>
                        <label class="pass_label">Password</label>
                        <div class="underline_sp"></div>
                        <div id="otp_valid"></div>
                        <!-- confirm password   -->
                        <input type="password" id="input_cpass" name="cpass_s" required>
                        <label class="cpass_label">Confirm Password</label>
                        <div class="underline_scp"></div>
                        <div id="pass_valid"></div>

                        <div class="form-elem">
                            <button name="final_signup" type="submit">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- final signup backend code     -->
    <?php
    if (isset($_POST['final_signup'])) {

        $s_name = mysqli_real_escape_string($con, $_POST['studname']);
        $s_class = mysqli_real_escape_string($con, $_POST['studclass']);
        $phoneno = mysqli_real_escape_string($con, $_POST['phone_no']);
        $pass = mysqli_real_escape_string($con, $_POST['pass_s']);
        $cpass = mysqli_real_escape_string($con, $_POST['cpass_s']);
        $email_update = $_SESSION['email_otp'];

        $pass_hashs = password_hash($pass, PASSWORD_BCRYPT);
        $cpass_hashs = password_hash($cpass, PASSWORD_BCRYPT);

        if ($pass === $cpass) {

            $query_fs = "update loginregistration set studentname='$s_name',studentclass='$s_class',phoneno='$phoneno', password='$pass_hashs',cpassword='$cpass_hashs',OTP=' ' where email='$email_update' ";

            $execute_fs = mysqli_query($con, $query_fs);

            if ($execute_fs) {
    ?>
                <script>
                    alert("signup successfull");
                    $(function() {
                        $('#login_modal').modal('show');
                    });
                </script>
            <?php
            } else {
            ?>
                <script>
                    alert("please fill properly.");
                </script>
            <?php
            }
        } else {
            ?>
            <script>
                let errmsg = document.querySelector('#pass_valid');
                errmsg.innerHTML = " <i id='faserror' class='fas fa-exclamation-circle'></i>Password are not matching";
                $(function() {
                    $('#modal_Mform').modal('show')
                });
            </script>
    <?php
        }
    }

    ?>

    <!-- otp verification backend code -->
    <?php
    if (isset($_POST['btn_votp'])) {

        $ver_otp = $_POST['otp_num'];
        $email_votp = $_SESSION['email_otp'];

        $email_ser = "select * from loginregistration where email = '$email_votp'";

        $execute_vo = mysqli_query($con, $email_ser);

        if ($execute_vo) {

            $fetch_otp = mysqli_fetch_assoc($execute_vo);
            $saved_otp = $fetch_otp['OTP'];
            $email_o = $fetch_otp['email'];



            if ($saved_otp === $ver_otp) {
    ?>
                <script>
                    let succmsg = document.querySelector('#otp_valid');
                    succmsg.innerHTML = " <i id='succicon' class='fas fa-check-circle'></i> OTP verified.";

                    $(function() {
                        $('#modal_otp').modal({
                            backdrop: 'static'
                        });

                        $('#modal_otp').modal('show');
                    });
                    setTimeout(() => {
                        $(function() {
                            $('#modal_otp').modal('hide');
                        })
                    }, 1300)

                    setTimeout(() => {
                        $(function() {
                            $('#modal_Mform').modal({
                                backdrop: 'static'
                            });
                            $('#modal_Mform').modal('show');
                        });
                    }, 1301);
                </script>
            <?php
            } else {
            ?>
                <script>
                    let bordered = document.querySelector('.underline_vo');
                    bordered.style.background = "red";

                    let otperrmsg = document.querySelector('.otp_errs');
                    otperrmsg.innerHTML = " <i id='faserror' class='fas fa-exclamation-circle'></i>OTP do not match.";

                    $(function() {
                        $('#modal_otp').modal({
                            backdrop: 'static'
                        });
                        $('#modal_otp').modal('show');
                    });
                </script>
    <?php
            }
        }
    }
    ?>
</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
<script>
    console.log('hello from home');
    const logout = () => {
        alert('you are logout');
    };

    function menuToggle() {
        document.querySelector(".menu").classList.add("atoggle");
        var toggle = true;
        send_toggle(toggle);
    }

    function send_toggle(toggle) {
        if (toggle === true) {
            document.onclick = function(e) {

                if (e.target.id !== 'menu_u' && e.target.id !== 'user_pc') {
                    document.querySelector('.menu').classList.remove("atoggle");
                }
            }
        }
    };
</script>
<script src="./JS/searchfilte.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script src="timeago/jquery.timeago.js"></script>
<script type="text/javascript">
    jQuery(document).ready(function() {
        $("time.timeago").timeago();
    });
</script>

</html>