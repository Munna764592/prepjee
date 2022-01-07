<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us | PrepJee</title>
    <?php include 'connection.php'  ?>
    <?php include 'link.php'  ?>

    <style>
        #head_about {
            font-family: 'Titillium Web', sans-serif;
            color: grey;
        }

        #para_main {
            margin-top: 20px;
            padding: 10px;
            font-family: 'Poppins', sans-serif;
        }

        #para_main i {
            color: #735bf8;
            padding: 0px;
            margin: 0px;
            width: 20px;
            font-size: 20px;
            margin-right: 5px;
        }

        .para {
            width: 100%;
        }
    </style>
</head>

<body>

    <div style="min-height: 570px;" class="container-xxl">
        <h1 id="head_about">About Us</h1>
        <hr style="width:100%; height:0.6px; margin:auto;">
        <div id="para_main">
            <div style="display: flex;"> <i class="fas fa-burn "></i>
                <div class="para">Our(<b>Prepjee</b>) inspiration is to provide digital education in an innovative ways & to interact with there own companions.</div>
            </div>
            <br>
            <div style="display: flex;"> <i class="fas fa-burn "></i>
                <div class="para">we procreate <b>e-learning environment </b> such that each and every students can learn and be educated.</div>
            </div>
            <br>
            <div style="display: flex;"> <i class="fas fa-burn "></i>
                <div class="para">Students can practice more to crack the india's most <b>competitive examinations.</b></div>
            </div>
            <br>
            <div style="display: flex;"> <i class="fas fa-burn "></i>
                <div class="para">This procreate bolster for each students.</div>
            </div>
            <br>
            <div style="display: flex;"> <i class="fas fa-burn "></i>
                <div class="para">Daily practice problems combine of three subjects physics,chemistry and mathematics with <b> jee previous year papers </b> and <b> doubt solving with own companions.</b></div>
            </div>
        </div>
        <hr style="width:100%; height:0.6px; margin:auto;">
    </div>
    <!-- footer part    -->

    <div style="margin-top: 85px;" class="footerbgp">
        <div class="footer1">Contact & Follow Us
            <div><a href="https://www.facebook.com/profile.php?id=100023807041187" target="_blank"> <i class="fab fa-facebook fa-2x"></i></a>&nbsp
                <a href="https://www.instagram.com/here_munna_07/" target="_blank"> <i class="fab fa-instagram fa-2x"></i></a>&nbsp
                <a href="https://twitter.com/here_Munna_07" target="_blank"> <i class="fab fa-twitter fa-2x"></i></a>
            </div>
        </div>
        <div style="color: white">Copyright <?php $year = date('Y');
                                            echo $year; ?>
            &#169 PrepJee.in
        </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</html>