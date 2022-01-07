<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PrepJEE | Chemistry Questions</title>
    <?php include 'link.php' ?>
    <?php include 'connection.php' ?>

</head>
<body>
    <div class="headingp">
        <h2>Chemistry</h2>
        <div class="searchche">
            <form class=" cheinqus">
                <input id="cheInput" class=" me-2" type="search" placeholder="Search" aria-label="Search" onkeyup="searchchemFun()">
            </form>
        </div>
    </div>
    <hr style="width:95%; margin:auto;">

    <!-- questions part fetch backend part.  -->
    <div id="mainqus">
        <?php
        $qryfetch = "select * from `chequs&ans` order by id desc ";

        $exse = mysqli_query($cons, $qryfetch);
        while ($fetchche = mysqli_fetch_assoc($exse)) {

            $chequs_tit = $fetchche['chequs_tit'];
            $chequs_dec = $fetchche['chequs_dec'];
            $che_img = $fetchche['che_img'];
            $op1 = $fetchche['op1'];
            $op2 = $fetchche['op2'];
            $op3 = $fetchche['op3'];
            $op4 = $fetchche['op4'];
            $id = $fetchche['id'];

            echo '
            <div class="cards" >
            <h3 id="head_link" class="quslink" >' . $chequs_tit . '</h3>
            <p class="qus_desc" ><b>Q.</b> ' . $chequs_dec . '</p>';

            if ($op1 && $op2 && $op3 && $op4 != null) {
                echo '<div style="flex-direction:column; display:flex;">
            <button class="opt_select" data-id="' . $op1 . '" data-qus_id="' . $id . '"><div class="opt_design"><div class="op_circle">1</div><span class="giv_opt">' . $op1 . '</span></div></button>
            <button class="opt_select" data-id="' . $op2 . '" data-qus_id="' . $id . '"><div class="opt_design"><div class="op_circle">2</div><span class="giv_opt">' . $op2 . '</span></div></button>
            <button class="opt_select" data-id="' . $op3 . '" data-qus_id="' . $id . '"><div class="opt_design"><div class="op_circle">3</div><span class="giv_opt">' . $op3 . '</span></div></button>
            <button class="opt_select" data-id="' . $op4 . '" data-qus_id="' . $id . '"><div class="opt_design"><div class="op_circle">4</div><span class="giv_opt">' . $op4 . '</span></div></button> </div>';
            };
            if ($che_img != null) {
                echo '<div class="subqus_img"><img style=" height:100%;" src="images/wallpaper.jpg" ></div>';
            };
            echo '<div class="btnsol"> <a class="bttns" href="sub_solche.php?qus_id=' . $id . '">Solution</a></div>
        </div>';
        };
        ?>
        <!-- option selection backend code   -->
        <script>
            $(document).ready(function() {
                $(document).on("click", ".opt_select", function() {
                    var opt_val = $(this).data("id");
                    var qus_id = $(this).data("qus_id");
                    var elem = this;

                    $.ajax({
                        url: 'opt_secajax/opt_checkche.php',
                        type: 'POST',
                        data: {
                            copt_val: opt_val,
                            cqus_id: qus_id
                        },
                        success: function(data) {
                            if (data == 1) {
                                $(elem).find(".op_circle").html(`<i id="corr_icon"  class="fas fa-check fa-1x "></i>`);
                                $(elem).find(".opt_design").css("color", "green");
                                $(elem).find(".op_circle").css("border-color", "green");
                            } else {

                                $('.giv_opt').each(function() {
                                    var corr_option = $(this).text();

                                    if (corr_option == data) {
                                        $(this).parent(".opt_design").find(".op_circle").html(`<i id="corr_icon"  class="fas fa-check fa-1x "></i>`);
                                        $(this).parent(".opt_design").css("color", "green");
                                        $(this).parent(".opt_design").find(".op_circle").css("border-color", "green");
                                    }
                                });

                                $(elem).find(".op_circle").html(`<i id="incorr_icon" class="fas fa-times fa-1x "></i>`);
                                $(elem).find(".opt_design").css("color", "red");
                                $(elem).find(".op_circle").css("border-color", "red");
                            }
                        }
                    });
                });
            });
        </script>
    </div>
    <!-- footer part    -->

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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="./JS/phypopup.js"></script>
<script src="./JS/searchfilte.js"></script>

</html>