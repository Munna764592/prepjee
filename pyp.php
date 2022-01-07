<?php session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
  error_reporting(0);
}; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PrepJEE: Previous Year Papers</title>
  <?php include 'link.php'  ?>
  <?php include 'connection.php' ?>

</head>
<body>
  <nav class="navbar1">
    <div class="navins">
      <div class="navimg">
        <?php
        if ($_SESSION['loggedin']) {
          echo '<a class="navbar-brand" href="home.php?sudid=' . $_SESSION['id'] . '">';
        } else {
          echo '<a class="navbar-brand" href="home.php">';
        };
        ?>
        <img src="./images/logo.png" alt="" width="30" height="24">
        </a>
        <h3><strong> Previous Years Papers.</strong></h3>
      </div>
      <div class="searchbar">
        <form class=" search d-flex">
          <input id="myInput" class=" me-2" type="text" placeholder="Search" aria-label="Search" onkeyup="searchpypFun()">
          <!-- <button id="btns" class="btn btn-outline-danger" type="submit">Search</button> -->
        </form>
      </div>
    </div>
  </nav>
  <h2 class="heading1"><strong>Jee Main</strong></h2>
  
  <div class="main3">
    <table id="myTable" class="table-striped table-hover">
      <thead>
        <tr>
          <th style="text-align: center;" class="width_tbody1"><b>Years</b></th>
          <th style="text-align: center;"><b>Download Papers</b></th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td class="width_tbody1">alanine</td>
          <td> <a href="#"> glycine </a>
            <br> <a href="#"> incredible </a>
            <br> <a href="#"> flare </a>
            <br> <a href="#"> Rhetoric </a>
            <br> <a href="#"> dubious </a>
            <br> <a href="#"> preclude </a>
          </td>
        </tr>
        <tr>
          <td class="width_tbody1">amino</td>
          <td>Jacob</td>

        </tr>
        <tr>
          <td class="width_tbody1">acids</td>
          <td>Larry</td>

        </tr>
        <tr>
          <td class="width_tbody1">let</th>
          <td>Mark</td>

        </tr>
        <tr>
          <td class="width_tbody1">everything</td>
          <td>Jacob</td>

        </tr>
        <tr>
          <td class="width_tbody1">cursive</td>
          <td>Larry</td>

        </tr>
        <tr>
          <td class="width_tbody1">candidates</td>
          <td>may</td>

        </tr>
        <tr>
          <td class="width_tbody1">provided</td>
          <td>note</td>

        </tr>
        <tr>
          <td class="width_tbody1">rough</td>
          <td>work</td>

        </tr>
        <tr>
          <td class="width_tbody1">be</td>
          <td>done</td>

        </tr>
        <tr>
          <td class="width_tbody1">be</td>
          <td>done</td>

        </tr>
        <tr>
          <td class="width_tbody1">be</td>
          <td>done</td>

        </tr>
         <tr>
          <td class="width_tbody1">be</td>
          <td>done</td>

          </tr>
          <tr>
            <td class="width_tbody1">be</td>
            <td>done</td>

          </tr>
          <tr>
            <td class="width_tbody1">be</td>
            <td>done</td>

          </tr>
      </tbody>

    </table>

  </div>
  <h2 class="heading2"><strong>Jee Advanced </strong></h2>
  <div class="main3">
    <table id="myTablead" class="table-striped">
      <thead>
        <tr>
          <th style="text-align: center;" class="width_tbody1"><b>Years</b></th>
          <th style="text-align: center;"><b>Download Papers</b></th>
        </tr>
      </thead>


      <tbody>
        <tr>
          <td class="width_tbody1">2021</td>
          <td>glycine
            <br>hello
          </td>

        </tr>
        <tr>
          <td class="width_tbody1">2020</td>
          <td>Jacob</td>

        </tr>
        <tr>
          <td class="width_tbody1">2019</td>
          <td>Larry</td>

        </tr>
        <tr>
          <td class="width_tbody1">2018</th>
          <td>Mark</td>

        </tr>
        <tr>
          <td class="width_tbody1">2017</td>
          <td>Jacob</td>

        </tr>
        <tr>
          <td class="width_tbody1">2016</td>
          <td>Larry</td>

        </tr>
        <tr>
          <td class="width_tbody1">2015</td>
          <td>may</td>

        </tr>
        <tr>
          <td class="width_tbody1">2014</td>
          <td>note</td>

        </tr>
        <tr>
          <td class="width_tbody1">2013</td>
          <td>work</td>

        </tr>
        <tr>
          <td class="width_tbody1">2012</td>
          <td>done</td>

        </tr>
        <tr>
          <td class="width_tbody1">2011</td>
          <td>done</td>

        </tr>
        <tr>
          <td class="width_tbody1">2010</td>
          <td>done</td>

        </tr>
         <tr>
          <td class="width_tbody1">2009</td>
          <td>done</td>

          </tr>
          <tr>
            <td class="width_tbody1">2008</td>
            <td>done</td>

          </tr>
          <tr>
            <td class="width_tbody1">2007</td>
            <td>done</td>

          </tr>
      </tbody>

    </table>

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
<script src="./JS/searchfilte.js"></script>
</html>