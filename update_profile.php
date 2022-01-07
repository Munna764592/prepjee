<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Profile | PrepJee</title>

    <?php include 'link.php'  ?>
    <?php include 'connection.php' ?>

</head>
<body>
    <!-- success alert message    -->

    <div class="login_alert"><i class="fas fa-check-circle"></i>
        <h5>Profile update successfull!</h5>
    </div>
    <div class="pass_ualert"><i class="fas fa-check-circle"></i>
        <h5>Password Changed!</h5>
    </div>

    <!-- showing value in input of update form    -->
    <?php

    $id = $_GET['studid'];
    $query_ip = "select * from loginregistration where id=$id";
    $execute_ip = mysqli_query($con, $query_ip);

    if ($execute_ip) {
        $fetch_data = mysqli_fetch_assoc($execute_ip);
        $name = $fetch_data['studentname'];
        $class = $fetch_data['studentclass'];
        $phone_no = $fetch_data['phoneno'];
        $email_id = $fetch_data['email'];
    }
    ?>

    <div class="container-xxl">
        <div class="up_header">
            <a href="home.php?sudid='<?php echo $_SESSION['id']; ?>' "> <img src="./images/logo.png" alt="lod..."></a>
            <h2><b>Update profile</b></h2>
        </div>
        <hr style="margin:auto;">
        <div class="upall">
            <div class="icon_st">
                <div>
                    <i id="icon_style" class="fas fa-angle-double-up fa-10x"></i>
                </div>

                <!-- image viewer backend code   -->

                <?php
                $dispaly_img = "select * from loginregistration where id=$id";

                $execute_img = mysqli_query($con, $dispaly_img);
                if ($execute_img) {
                    $fetch_img = mysqli_fetch_assoc($execute_img);
                    $img_view = $fetch_img['img_pic'];
                }
                ?>
                <!-- profile picture    -->
                <form id="form_pic" action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
                    <div id="pics">
                        <div class="pic_img">
                            <img id="uploaded_img" src="<?php echo $img_view; ?>" onerror="this.src='images/userimage.png'">
                            <label for="img_profile" id="img_label"></label>
                            <label id="img_opa" for="img_profile"> <strong>Upload picture</strong></label>
                        </div>
                        <input id="img_profile" name="img_file" type="file">
                    </div>
                </form>
            </div>

            <div class="modal fade" role="dialog" display="block" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                    <div id="modal_crop" class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="modalLabel"><b>Crop Image</b></h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="box_preview">
                                <img style="width: 100%;" src="" id="sample_image">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-sm rounded-pill" data-bs-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-primary btn-sm rounded-pill" id="crop">Crop</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- image upload backend code   -->
            <script>
                $(document).ready(function() {
                    let para_m = new URLSearchParams(window.location.search);
                    var stud_id = para_m.get('studid');

                    function alert() {
                        let log_alert = document.querySelector('.login_alert');
                        log_alert.classList.add('log_alert-active');

                        setTimeout(() => {
                            let log_alert = document.querySelector('.login_alert');
                            log_alert.classList.remove('log_alert-active');
                        }, 2000);
                    };

                    var $modal = $('#staticBackdrop');
                    var image = document.getElementById('sample_image');
                    var cropper;

                    $('#img_profile').change(function(event) {
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
                            viewMode: 3
                        });
                    }).on('hidden.bs.modal', function() {
                        cropper.destroy();
                        cropper = null;
                    });

                    $('#crop').click(function() {
                        canvas = cropper.getCroppedCanvas({
                            width: 400,
                            height: 400
                        });

                        canvas.toBlob(function(blob) {
                            url = URL.createObjectURL(blob);
                            var reader = new FileReader();
                            reader.readAsDataURL(blob);
                            reader.onloadend = function() {
                                var base64data = reader.result;

                                $.ajax({
                                    url: 'PHP_updatepp/crop_upload.php',
                                    type: 'POST',
                                    data: {
                                        img_file: base64data,
                                        id: stud_id
                                    },
                                    success: function(data) {
                                        $modal.modal('hide');
                                        $('#uploaded_img').attr('src', data);
                                        alert();
                                    }
                                });
                            };
                        });
                    });

                });
            </script>

            <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
                <div class="inp_all">
                    <div class="input-group mb-3">
                        <input id="upds_name" type="text" class="form-control" placeholder="Name" name="upd_name" value="<?php echo $name; ?>" required>
                        <span class="input-group-text" id="basic-addon2"><button type="submit" name="name_btn"><i class="fas fa-check-circle"></i></button></span>
                    </div>
            </form>
            <!-- student name update backend code    -->
            <?php
            if (isset($_POST['name_btn'])) {

                $up_name = $_POST['upd_name'];
                $up_id = $_GET['studid'];

                $query_up = "update loginregistration set studentname='$up_name' where id='$up_id' ";
                $execute_up = mysqli_query($con, $query_up);

                if ($execute_up) {
            ?>
                    <script>
                        let para_m = new URLSearchParams(window.location.search);
                        var stud_id = para_m.get('studid');

                        $(function() {
                            $.ajax({
                                url: "PHP_updatepp/ajax_name.php",
                                type: "POST",
                                data: {
                                    id: stud_id
                                },
                                success: function(data) {
                                    $('#upds_name').attr('value', data);
                                }
                            });
                        });
                        let log_alert = document.querySelector('.login_alert');
                        log_alert.classList.add('log_alert-active');
                        setTimeout(() => {
                            let log_alert = document.querySelector('.login_alert');
                            log_alert.classList.remove('log_alert-active');
                        }, 2000);
                    </script>
            <?php
                }
            };
            ?>
            <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
                <div class="input-group mb-3">
                    <input id="upds_class" type="number" name="upd_class" class="form-control" placeholder="Class" value="<?php echo $class; ?>" max="13" min="5" title="Enter your class." autocomplete="off" required>
                    <span class="input-group-text" id="basic-addon2"><button type="submit" name="class_btn"><i class="fas fa-check-circle"></i></button></span>
                </div>
            </form>
            <!-- student class backend code      -->
            <?php
            if (isset($_POST['class_btn'])) {

                $up_class = $_POST['upd_class'];
                $up_id = $_GET['studid'];

                $query_up = "update loginregistration set studentclass='$up_class' where id='$up_id' ";
                $execute_up = mysqli_query($con, $query_up);

                if ($execute_up) {
            ?>
                    <script>
                        let para_m = new URLSearchParams(window.location.search);
                        var stud_id = para_m.get('studid');

                        $(function() {
                            $.ajax({
                                url: "PHP_updatepp/ajax_class.php",
                                type: "POST",
                                data: {
                                    id: stud_id
                                },
                                success: function(data) {
                                    $('#upds_class').attr('value', data);
                                }
                            });
                        });

                        let log_alert = document.querySelector('.login_alert');
                        log_alert.classList.add('log_alert-active');

                        setTimeout(() => {
                            let log_alert = document.querySelector('.login_alert');
                            log_alert.classList.remove('log_alert-active');
                        }, 2000);
                    </script>
            <?php
                }
            };
            ?>
            <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
                <div class="input-group mb-3">
                    <input id="upds_phone" type="text" name="upd_phone" class="form-control" placeholder="Phone number" value="<?php echo $phone_no; ?>" maxlength="10" minlength="10" autocomplete="off" required>
                    <span class="input-group-text" id="basic-addon2"><button type="submit" name="phone_btn"><i class="fas fa-check-circle"></i></button></span>
                </div>
            </form>
            <!-- phone number backend code    -->
            <?php
            if (isset($_POST['phone_btn'])) {

                $up_phone = $_POST['upd_phone'];
                $up_id = $_GET['studid'];

                $query_up = "update loginregistration set phoneno='$up_phone' where id='$up_id' ";
                $execute_up = mysqli_query($con, $query_up);

                if ($execute_up) {
            ?>
                    <script>
                        let para_m = new URLSearchParams(window.location.search);
                        var stud_id = para_m.get('studid');

                        $(function() {
                            $.ajax({
                                url: "PHP_updatepp/ajax_phone.php",
                                type: "POST",
                                data: {
                                    id: stud_id
                                },
                                success: function(data) {
                                    $('#upds_phone').attr('value', data);
                                }

                            });
                        });

                        let log_alert = document.querySelector('.login_alert');
                        log_alert.classList.add('log_alert-active');

                        setTimeout(() => {
                            let log_alert = document.querySelector('.login_alert');
                            log_alert.classList.remove('log_alert-active');
                        }, 2000);
                    </script>
            <?php
                }
            };
            ?>
            <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
                <div class="input-group mb-3">
                    <input id="upds_email" type="email" name="upd_email" class="form-control" placeholder="Email id" pattern="[A-Za-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" value="<?php echo $email_id; ?>" title="Invalid email." required>
                    <span class="input-group-text" id="basic-addon2"><button type="submit" name="email_btn"><i class="fas fa-check-circle"></i></button></span>
                </div>
            </form>

            <div class="modal fade" id="modal_otp_upe" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div id="modal_upe" class="modal-content">
                        <div class="modal-header">
                            <h3><b>Verify OTP</b></h3>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">
                            <div class="form-verifyotp">
                                <input style="padding: 0px;" type="number" id="input_emails" name="otp_upe" required>
                                <label>Enter OTP</label>
                                <div class="underline_vo"></div>
                                <div class="otp_errs"></div>
                                <div id="otp_valid"></div>
                                <div class="form-elem">
                                    <button name="btn_upe" type="submit">Verify</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Email update backend code    -->
            <?php
            $otp_str = str_shuffle("0123456789");
            $otp = substr($otp_str, 0, 6);

            if (isset($_POST['email_btn'])) {

                $_SESSION['email_new'] = $_POST['upd_email'];
                $id_upe = $_GET['studid'];


                $insert_upe = "update loginregistration set OTP ='$otp' where id=$id_upe ";
                $execute_upe = mysqli_query($con, $insert_upe);

                if ($execute_upe) {

                    // message section   
            ?>
                    <script>
                        let succmsg = document.querySelector('#otp_valid');
                        succmsg.innerHTML = " <i id='succicon' class='fas fa-check-circle'></i> OTP sent.";

                        $(function() {
                            $('#modal_otp_upe').modal({
                                backdrop: 'static'
                            });
                            $('#modal_otp_upe').modal('show');
                        });
                    </script>
            <?php
                }
            }

            ?>
            <!-- // otp verification   -->

            <?php
            if (isset($_POST['btn_upe'])) {

                $otp_upe = $_POST['otp_upe'];
                $id_upe = $_GET['studid'];

                $query = "select * from loginregistration where id=$id_upe";
                $execute = mysqli_query($con, $query);

                if ($execute) {
                    $fetch_otp = mysqli_fetch_assoc($execute);
                    $otp = $fetch_otp['OTP'];

                    if ($otp === $otp_upe) {
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
                            }, 1300);
                        </script>
                        <?php

                        $email_upe = mysqli_real_escape_string($con, $_SESSION['email_new']);

                        $query_email = "update loginregistration set email= '$email_upe' where id=$id_upe";
                        $execute_email = mysqli_query($con, $query_email);

                        if ($execute_email) {
                        ?>
                            <script>
                                let para_m = new URLSearchParams(window.location.search);
                                var stud_id = para_m.get('studid');

                                $(function() {
                                    $.ajax({
                                        url: "PHP_updatepp/ajax_email.php",
                                        type: "POST",
                                        data: {
                                            id: stud_id
                                        },
                                        success: function(data) {
                                            $('#upds_email').attr('value', data);
                                        }

                                    });
                                });
                                let log_alert = document.querySelector('.login_alert');
                                log_alert.classList.add('log_alert-active');

                                setTimeout(() => {
                                    let log_alert = document.querySelector('.login_alert');
                                    log_alert.classList.remove('log_alert-active');
                                }, 2000);
                            </script>
                        <?php
                        };
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
            <!-- password update  section    -->
            <form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">
                <div class="new_pass">
                    <div class="input-group mb-3">
                        <input type="password" name="pass_up" class="form-control" placeholder=" New Password" minlength="7" required>
                    </div>
                    <div class="input-group ">
                        <input type="password" name="cpass_up" class="form-control" placeholder="Confirm new Password" minlength="7" required>
                    </div>
                    <div id="pass_valid"></div>
                    <button type="submit" name="btn_updatepass" class="btn btn-success btn-sm mt-2 rounded-pill">Submit</button>
                </div>
            </form>
            <div class="modal fade" id="modal_otp_upass" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                    <div id="modal_upe" class="modal-content">
                        <div class="modal-header">
                            <h3><b>Verify OTP</b></h3>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">
                            <div class="form-verifyotp">
                                <input style="padding: 0px;" type="number" id="input_emails" name="otp_upass" required>
                                <label>Enter OTP</label>
                                <div class="underline_up"></div>
                                <div class="otp_up"></div>
                                <div id="otp_uperr"></div>
                                <div class="form-elem">
                                    <button name="btn_upass" type="submit">Verify</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- password update backend code    -->
            <?php
            if (isset($_POST['btn_updatepass'])) {

                $password = $_POST['pass_up'];
                $cpassword = $_POST['cpass_up'];

                $_SESSION['pass_new'] = password_hash($password, PASSWORD_BCRYPT);
                $_SESSION['cpass_new'] = password_hash($cpassword, PASSWORD_BCRYPT);

                if ($password !== $cpassword) {
            ?>
                    <script>
                        let errmsg = document.querySelector('#pass_valid');
                        errmsg.innerHTML = " <i style='color: red;' id='faserror' class='fas fa-exclamation-circle'></i>Password are not matching.";
                    </script>
                    <?php
                } else {
                    $otp_str = str_shuffle("0123456789");
                    $otp = substr($otp_str, 0, 6);
                    $id = $_GET['studid'];

                    $query_p = "update loginregistration set OTP='$otp' where id=$id ";
                    $execute_p = mysqli_query($con, $query_p);

                    if ($execute_p) {
                        // message section   
                    ?>
                        <script>
                            let succmsg = document.querySelector('#otp_uperr');
                            succmsg.innerHTML = " <i id='succicon' class='fas fa-check-circle'></i> OTP sent to your email.";

                            $(function() {
                                $('#modal_otp_upass').modal({
                                    backdrop: 'static'
                                });
                                $('#modal_otp_upass').modal('show');
                            });
                        </script>
            <?php
                    }
                }
            }
            ?>
            <?php
            if (isset($_POST['btn_upass'])) {

                $otp_upass = $_POST['otp_upass'];
                $id_upass = $_GET['studid'];

                $query_cp = "select * from loginregistration where id=$id_upass";
                $execute_cp = mysqli_query($con, $query_cp);

                if ($execute_cp) {
                    $fetch_otp = mysqli_fetch_assoc($execute_cp);
                    $otp = $fetch_otp['OTP'];

                    if ($otp === $otp_upass) {
            ?>

                        <?php

                        $pass_new = mysqli_real_escape_string($con, $_SESSION['pass_new']);
                        $cpass_new = mysqli_real_escape_string($con, $_SESSION['cpass_new']);


                        $query_fp = "update loginregistration set password= '$pass_new', cpassword= '$cpass_new'  where id=$id_upass ";
                        $execute_fp = mysqli_query($con, $query_fp);

                        if ($execute_fp) {
                        ?>
                            <script>
                                let log_alert = document.querySelector('.pass_ualert');
                                log_alert.classList.add('log_alert-active');

                                setTimeout(() => {
                                    let log_alert = document.querySelector('.pass_ualert');
                                    log_alert.classList.remove('log_alert-active');
                                }, 2000);
                            </script>
                        <?php
                        };
                    } else {
                        ?>
                        <script>
                            let bordered = document.querySelector('.underline_up');
                            bordered.style.background = "red";

                            let otperrmsg = document.querySelector('.otp_up');
                            otperrmsg.innerHTML = " <i style='color:red;' id='faserror' class='fas fa-exclamation-circle'></i>OTP do not match.";

                            $(function() {
                                $('#modal_otp_upass').modal({
                                    backdrop: 'static'
                                });
                                $('#modal_otp_upass').modal('show');
                            });
                        </script>
            <?php
                    }
                }
            }
            ?>
        </div>
    </div>
    <hr style="margin:auto;">

    </div>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="JS/cropperjs/cropper.min.js"></script>

</html>