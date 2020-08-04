<?php
	session_start();
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
        <div style="width: 40%;height: 60%;background-color: white;float: left;margin-left: 7.5%;box-shadow: 0px 7px 17px -1px rgba(158,158,158,0.73);">
          <form action="" method="post" style="width: 100%;height: 100%;">
            <label style="font-size: 17px;width: 60%;margin-left: 21%;margin-top: 8%;color:black;font-weight:100;"> Nome de utilizador:
              <input type="text" name="username" class='form-control' required>
            </label>
            <input type="submit" name="recover" style='width: 40%;height: 20%;border: 2px solid black;color: black;background-color: transparent;margin-top: 7%;margin-left: 30%;'>
          </form>
        </div>
        <?php
          include "phpScripts/accessBD.php";
          if (isset($_POST["recover"])) {
            $username = $_POST['username'];
            $_SESSION['recoverUsername'] = $username;

            $searchQuery = "select *
                            FROM users
                            WHERE username = '$username'";

            $search = mysqli_query($conn, $searchQuery);

            if(!$search)
              die("Error, select query failed:" . $searchQuery);

            $row = mysqli_fetch_array($search);

            $_SESSION['recoverAnswer'] = $row["answer"];

            if ($row['question'] == "1animal") {
              $question = "Qual é o nome do seu 1º animal de estimação ?";
            }

            else if ($row['question'] == "localNascimento") {
              $question = "Qual é o local de nascimento da sua mãe ?";
            }
            else if ($row['question'] == "escolaPrimaria") {
              $question = "Qual é o nome da sua escola primária ?";
            }
            else if ($row['question'] == "desportoFavorito") {
              $question = "Qual é o seu desporto favorito?";
            }

            echo "<div style='width: 40%;height: 60%;background-color: white;float: left;margin-left: 5%;box-shadow: 0px 7px 17px -1px rgba(158,158,158,0.73);'>
                    <p style='text-align: center;font-size: 19px;font-weight: 600;padding-top: 12%; margin:0;'>Pergunta de segurança: " . $question ."</p>
                    <form action='' method='post'>
                      <label style='font-size: 17px; width: 60%;margin-left: 10%;margin-top: 0%;color: black;font-weight: 100;'> Resposta:
                        <input type='text' name='answer' class='form-control'>
                      </label>
                      <input type='submit' name='submitQuestion' style='padding: 15px;border: 2px solid black;color: black;background-color: transparent;margin-top: 7%;margin-left: 1%;'>";

                    "</form>
                  </div>";
          }

          if (isset($_POST["submitQuestion"])) {
            if ($_POST['answer'] == $_SESSION['recoverAnswer']) {

              function crypto_rand_secure($min,$max){
                $range = $max - $min;
                if ($range < 0) return $min;
                $log = log($range,2);
                $bytes = (int) ($log/8) + 1;
                $bits = (int) $log + 1;
                $filter = (int) (1 << $bits) - 1;
                do{
                  $rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes)));
                  $rnd = $rnd & $filter;
                } while ($rnd >= $range);
                return $min + $rnd;
              }

              function getToken($length=32){
                $token = '';
                $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
                $codeAlphabet .= "abcdefghijklmopqrstuvwxyz";
                $codeAlphabet .= "0123456789";
                for ($i=0; $i < $length; $i++) {
                  $token .= $codeAlphabet[crypto_rand_secure(0,strlen($codeAlphabet))];
                }
                return $token;
              }

              $username =  $_SESSION['recoverUsername'];
              $resetQuery = "select email from users where username='$username'";
              $getReset = mysqli_query($conn, $resetQuery);

              $rowE = mysqli_fetch_array($getReset);
              $email = $rowE[0];

              if (mysqli_num_rows($getReset)>0){
                $token = getToken();

                $tokenQuery = "insert into reset_token values ('$username','$token');";
                mysqli_query($conn, $tokenQuery);

                $msg ="Ola $username,<br>
											 Foi enviado neste email um link para para redefinir uma nova password<br>
											 Clique neste link:<br>
                       <a href='http://cemapre1.iseg.ulisboa.pt/~grupo4/recoverPassword_token.php?key=$token'>Link recuperar password</a><br>
											 Obrigado,<br>
											 Overlab Support";

                $msg = wordwrap($msg,70);
                $headers = "From: overlab@gmail.com;" . "\r\n".
                          "Content-Type: text/html;\r\n";

                mail($email,'Recuperacao Password OverLab  ', $msg, $headers);
              }
              echo "
              <div style='width: 40%;height: 60%;background-color: white;float: left;margin-left: 5%;box-shadow: 0px 7px 17px -1px rgba(158,158,158,0.73);'>
                <p style='text-align: center;padding-top: 18%;font-size: 30px;color: #79da79;font-weight: bold;'>Correto! </>
                <p style='text-align: center;color: black;font-size: 15px;font-weight: 100;'>Foi enviado para o seu email um link para redefinir a password</p>
                <a style='text-align: center;width: 20%;height: 15%;margin-left: 40%;padding-top: 7%;' href='index.php'>Voltar</a>
              </div>";

            }
            else{
              echo "
              <div style='width: 40%;height: 60%;background-color: white;float: left;margin-left: 5%;box-shadow: 0px 7px 17px -1px rgba(158,158,158,0.73);'>
                <p style='text-align: center;padding-top: 18%;font-size: 30px;color: #e06464;font-weight: bold;'>Errado! </>
                <p style='text-align: center;color: black;font-size: 15px;font-weight: 100;'>Tente novamente</p>
              </div>";
            }
          }

          mysqli_close($conn);
        ?>
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
