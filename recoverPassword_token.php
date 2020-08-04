<?php
    session_start();
    include "phpScripts/accessBD.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>TriEscape</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="keywords">
  <meta content="" name="description">
  <link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet">


  <!-- Favicons -->
  <link href="img/favicon.png" rel="icon">
  <link href="img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Poppins:300,400,500,700" rel="stylesheet">

  <!-- Bootstrap CSS File -->
  <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- JavaScript CSS File -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" rel="stylesheet">

  <!-- Libraries CSS Files -->
  <link href="lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="lib/animate/animate.min.css" rel="stylesheet">

  <!-- Main Stylesheet File -->
  <link href="css/style.css" rel="stylesheet">
  <script src="https://kit.fontawesome.com/a81368914c.js"></script>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

</head>

<body>
    <?php
		if (isset($_SESSION["messageReceived"])) {
			echo "<script>alert('". $_SESSION["messageReceived"] ."');</script>";
			unset($_SESSION["messageReceived"]);
        }
        
        if (isset($_GET['key'])){
            $token = $_GET['key'];
            $tokenQuery = "select idUsername from reset_token where token='$token'";
            $getToken = mysqli_query($conn, $tokenQuery);
            $row = mysqli_fetch_array($getToken);
            if (mysqli_num_rows($getToken)>0){
                $user = $row[0];
            }
            else{
                header("Location: index.php");
            }
        }
        else{
            header("Location: index.php");
        }
		?>

  <!--==========================
  Header
  ============================-->
  <header id="header">
    <div id="logo">
        <img style="margin-left: 43%;" src="img/logo.png">
    </div>
  </header><!-- #header -->

  <!--==========================
    Hero Section
  ============================-->
  <section id="hero">
    <div class="hero-container">
      <div id='big' style="width:100%; height:80%;margin-top:7%;">
        <div style='width:100%;height:20%;'>
          <p style="text-align: center;color: black;font-weight: bold;font-size: 30px;">Recuperar Password</p>
        </div>

        <div style="width: 40%;height: 70%;background-color: white;float: left;margin-left: 30%;box-shadow: 0px 7px 17px -1px rgba(158,158,158,0.73);">
          <form action="phpScripts/recoverPasswordScript.php" method="post" style="width: 100%;height: 100%;">
            <?php echo "<input name='token' style='display:none;' value='$token'>"; ?>
            <label style="font-size: 17px;width: 60%;margin-left: 21%;margin-top: 8%;color:black;font-weight:100;"> Nova Password:
              <input type="password" name="password" class='form-control' required>
            </label>
            <label style="font-size: 17px;width: 60%;margin-left: 21%;margin-top: 8%;color:black;font-weight:100;"> Confirmar Nova Password:
              <input type="password" name="passwordConfirm" class='form-control' required>
            </label>
            <?php echo "<input type='submit' name='recover' value='$user' style='width: 40%;height: 20%;border: 2px solid black;color: black;background-color: transparent;margin-top: 7%;margin-left: 30%;'>"; ?>
          </form>
        </div>
        
      </div>
    </div>
  </section><!-- #hero -->

  <!--==========================
    Footer
  ============================-->
  <footer id="footer">
    <div class="footer-top">
      <div class="container">

      </div>
    </div>

    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong>Overlab</strong>. All Rights Reserved
      </div>
      <div class="credits">
        <!--
          All the links in the footer should remain intact.
          You can delete the links only if you purchased the pro version.
          Licensing information: https://bootstrapmade.com/license/
          Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/buy/?theme=Regna
        -->
        <i class="fab fa-facebook-square" style="font-size:20px; margin-left:1%;"></i>
        <i class="fab fa-instagram-square" style="font-size:20px; margin-left:1%;"></i>
        <i class="fab fa-twitter-square" style="font-size:20px; margin-left:1%;"></i>
        <i class="fab fa-pinterest-square" style="font-size:20px; margin-left:1%;"></i>
        <i class="fab fa-youtube-square" style="font-size:20px; margin-left:1%;padding-bottom:1%"></i><br>
        Designed by Overlab</a>
      </div>
    </div>
  </footer><!-- #footer -->

  <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>

  <!-- JavaScript Libraries -->
  <script src="lib/jquery/jquery.min.js"></script>
  <script src="lib/jquery/jquery-migrate.min.js"></script>
  <script src="lib/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="lib/easing/easing.min.js"></script>
  <script src="lib/wow/wow.min.js"></script>
  <script src="lib/waypoints/waypoints.min.js"></script>
  <script src="lib/counterup/counterup.min.js"></script>
  <script src="lib/superfish/hoverIntent.js"></script>
  <script src="lib/superfish/superfish.min.js"></script>


  <!-- Template Main Javascript File -->
  <script type="text/javascript" src="js/aaa.js"></script>

</body>
</html>



