<?php
	session_start();
  include "phpScripts/accessBD.php";

	$username = $_SESSION['username'];

	$searchQuery = "select * from stores where storename = '$username'";

	$search = mysqli_query($conn, $searchQuery);

	if(!$search)
		 die("Error, select query failed:" . $searchQuery);

	$row = mysqli_fetch_array($search);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>OverLab - Userpage</title>
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

  <!-- Vendor CSS Files -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="vendor/icofont/icofont.min.css" rel="stylesheet">
  <link href="vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="vendor/venobox/venobox.css" rel="stylesheet">
  <link href="vendor/aos/aos.css" rel="stylesheet">

  <!-- Main Stylesheet File -->
  <link href="css/style.css" rel="stylesheet">
  <link href="css/navbar.css" rel="stylesheet">
  <link href="css/navbar1.css" rel="stylesheet">
  <link href="css/userpage.css" rel="stylesheet">
  <link href="css/userpageOthers.css" rel="stylesheet">

  <script src="https://kit.fontawesome.com/a81368914c.js"></script>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

</head>
<body>
    <?php
		if (isset($_SESSION["messageReceived"])) {
			echo "<script>alert('". $_SESSION["messageReceived"] ."');</script>";
			unset($_SESSION["messageReceived"]);
		}

		include "phpScripts/accessBD.php";

		$name = $_SESSION['username'];
		$userQuery="select * from stores WHERE storename ='$name'";
		$checkUser = mysqli_query($conn, $userQuery);


		if (!isset($_SESSION['username'])) {
			header('Location: index.php');
			$_SESSION['messageReceived'] = "Necessário conta para entrar";
		}

		elseif(mysqli_num_rows($checkUser)==0) {
			header('Location: mycloset.php');
			$_SESSION['messageReceived'] = "Necessário conta para entrar";
		}

	?>
	<!--==========================
  	Header
  	============================-->
	  <header id="header">
		<div id="logo" class="pull-left">
			<a href="myproducts.php">
				<img src="img/logo.png" alt="" title="" /></img>
			</a>
		</div>

		<nav id="nav-menu-container">
			<ul class="nav-menu">
			<li><a href="myproducts.php">My Products</a></li>
			<li><a href="store1.php">Store</a></li>
			<li><a href="contacts1.php">Company</a></li>
			<li><a href="help1.php"><i class="icofont-question-circle"></i></a></li>
			<li  class="menu-active" style="margin-left:11%"><a href="storepage.php">Conta - <?php echo $_SESSION['username'] ?></a></li>
			<li><a href="phpScripts/logout.php">Logout</a></li>
			</ul>
		</nav><!-- #nav-menu-container -->
  	</header><!-- #header -->
	  <!--==========================
    Hero Section
      ============================-->
      <section id="hero">
    	  <div class="hero-container">
          <div class="row" style="width:44%">
                <div class="col-lg-12 " style="margin-top:26%;">
                    <div id="a">
                      <div id="infoImgName">
                        <div id="img">
                          <div id="theImage">
                            <div id="firstCircle">
                              <div id="secondCircle">
                                <?php echo "<img src='storeImages/".$username.".jpg'>" ?>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div id="username">
                          <div id="theImage">
                            <?php echo "<h1>". $_SESSION['username']."<h1>" ?>
                          </div>
                        </div>
                      </div>
                      <div id="otherInfo">
                        <div id="theImage1">

                        </div>
                        <div id="theImage2">
                          <?php echo "<p style='font-size: 13px;font-weight:100;padding-top:0px;'>". $row['slogan'] ." </p>";?>
                        </div>
                        <div id="theImage3">

                        </div>
                      </div>
                    </div>
                </div>
            </div>
            <div id="menuUserpage">
                <div id="containerPremium">
                    <div id="addPremium">
                        <?php
                          if ($row[9] =='Free'){
                            echo "<div id='messageCima'>
                                    <p>Obtêm o Premium</p>
                                  </div>";
                          }
                          else{
                            echo "<div id='messageCima' style='width: 88%;height: 40%;margin-left: 6%;margin-top: 4%;'>
                                    <p>Obrigado por aderir ao Premium</p>
                                  </div>";
                          }
                        ?>
                        <div id="messageBaixo">
                            <i class="fas fa-check" style="    float: left;margin-left: 4%;color: white;"></i><p style="font-size: 12px;float: left;margin-left: 1%;color: white;" >Compra produtos sem taxas adicionais</p><i class="fas fa-check" style="float: left;margin-left: 5%;color: white;"></i><p style="float: left;font-size: 12px;margin-left: 1%;color: white;">Recebe todos os meses uma mystery box</p>
                        </div>
                    </div>
                    <div id="planPremium">
                        <div class="planPremiumText">
                            <p style="font-weight: bold; margin-left: 5%;"> OverLab Premium</p>
                        </div>
                        <div class="planPremiumText">
                            <p style="font-weight: 400; margin-left: 5%;">5.99 EUR/ mês</p>
                        </div>
                        <div class="planPremiumText">
                            <p style="font-size: 10px;margin-left: 5%;">Cancela a qualquer momento. Termos e condições</p>
                        </div>
                    </div>
                    <?php
                      if ($row[9] =='Free'){
                        echo "<div id='paymentPremium'>
                                <div id='selectPayment'>
                                    <div class='input-div five' style='width: 90%;margin-left: 5%;border: 0px solid white;margin-top: 3%;margin-bottom: 0%;'>
                                            <div class='i'>
                                                <i class='fas fa-money-check'></i>
                                            </div>
                                            <div>
                                                <select class='form-control' id='paymentMethod' id='questionSelect' style='margin-left: 4%;width: 96%;' >
                                                    <option selected value='paypal'>Paypal</option>
                                                    <option value='creditCard'>Cartão de Crédito</option>
                                                </select>
                                            </div>
                                    </div>
                                </div>
                                <div id='paymentPaypal'>
                                    <div class='imagePayment'>
                                        <div class='theimagePayment'>
                                            <img alt='' src='//www.scdn.co/bundles/spotifycheckout/svg/providers/paypal.svg' class='sc-fzXfMz clukrQ'>

                                        </div>
                                    </div>
                                    <form class='theForm' action='phpScripts/userpageScript.php' method='post' enctype='multipart/form-data'>
                                        <input type='text' name='metodo' value='paypal' style='display:none;'>
                                        <input type='text' name='price' value='5.99' style='display:none;'>
                                        <div class='infoPayment'>
                                            <p>Clique no botão abaixo para fazer login e pagar com sua conta Paypal.<br><br>
                                            Você autoriza a OverLab a cobrar automaticamente todos os meses, até você cancelar sua assinatura.</p>
                                        </div>
                                        <div class='submitPayment'>
                                            <input type='submit' class='btn' name='overlabPremiumStorePP' value='Subscrever Premium' style='width: 70%;margin: 0;margin-left: 15%;height: 70%;margin-right: 2%;'>
                                        </div>
                                    </form>
                                </div>
                                <div id='paymentCard'>
                                    <div class='imagePayment'>
                                        <div class='theimagePayment'>
                                            <img alt='' src='//www.scdn.co/bundles/spotifycheckout/svg/cards/visa.svg' class='sc-fzXfMz clukrQ'>
                                        </div>
                                        <div class='theimagePayment' style='margin-left: 0%'>
                                            <img alt='' src='//www.scdn.co/bundles/spotifycheckout/svg/cards/mastercard.svg' class='sc-fzXfMz clukrQ'>
                                        </div>
                                        <div class='theimagePayment' style='margin-left: 0%'>
                                            <img alt='' src='//www.scdn.co/bundles/spotifycheckout/svg/cards/amex.svg' class='sc-fzXfMz clukrQ'>
                                        </div>
                                    </div>
                                    <form class='theForm' action='phpScripts/userpageScript.php' method='post' enctype='multipart/form-data'>
                                        <input type='text' name='metodo' value='Credit Card' style='display:none;'>
                                        <input type='text' name='price' value='5.99' style='display:none;'>
                                        <div class='infoPayment'>
                                            <div id='numberCard'>
                                                <label for='ccn' style='font-size: 10px;color: black;margin-left: 16%;'>Número cartão de crédito:</label><br>
                                                <input style='font-size: 10px;width: 68%;margin-left: 16%;' name='cc' id='ccn' class='form-control' type='tel' inputmode='numeric' pattern='[0-9\s]{13,19}' autocomplete='cc-number' maxlength='19' placeholder='xxxx-xxxx-xxxx-xxxx'>
                                            </div>
                                            <div id='otherCard'>
                                                <div class='form-group' id='expiration-date' style='width: 50%;height: 55%;float: left;'>
                                                    <label style='font-size: 10px;color: black;margin-left: 33%;'>Expiration Date</label>
                                                    <select style='font-size: 10px;margin-left: 33%;width: 35%;' name='mes'>
                                                        <option value='01'>January</option>
                                                        <option value='02'>February </option>
                                                        <option value='03'>March</option>
                                                        <option value='04'>April</option>
                                                        <option value='05'>May</option>
                                                        <option value='06'>June</option>
                                                        <option value='07'>July</option>
                                                        <option value='08'>August</option>
                                                        <option value='09'>September</option>
                                                        <option value='10'>October</option>
                                                        <option value='11'>November</option>
                                                        <option value='12'>December</option>
                                                    </select>
                                                    <select style='font-size: 10px;' name='ano'>
                                                        <option value='2020> 2020</option>
                                                        <option value='2021'> 2021</option>
                                                        <option value='2022'> 2022</option>
                                                        <option value='2023'> 2023</option>
                                                        <option value='2024'> 2024</option>
                                                        <option value='2025'> 2025</option>
                                                        <option value='2026'> 2026</option>
                                                        <option value='2027'> 2027</option>
                                                        <option value='2028'> 2028</option>
                                                        <option value='2029'> 2029</option>
                                                        <option value='2030'> 2030</option>
                                                        <option value='2031'> 2031</option>
                                                        <option value='2032'> 2032</option>
                                                        <option value='2033'> 2033</option>
                                                    </select>
                                                </div>
                                                <div class='form-group CVV' style='width: 45%;height: 100%;float: left;'>
                                                    <label for='cvv' style='font-size: 10px;color: black;margin-left: 12%;'>CVV</label>
                                                    <input type='text' class='form-control' id='cvv' name='cvc'style='font-size: 10px;height: 36%;width: 63%;margin-left: 12%;'>
                                                </div>
                                            </div>
                                        </div>
                                        <div class='submitPayment'>
                                            <input type='submit' class='btn' name='overlabPremiumStoreCC' value='Subscrever Premium' style='width: 70%;margin: 0;margin-left: 15%;height: 70%;margin-right: 2%;'>
                                        </div>
                                    </form>
                                </div>
                            </div>";
                      }
                      else{
                        echo "<div id='paymentPremium'>
                                <div class='headerPremium'>
                                  <div class='headerPremiumImg'>
                                    <img src='img/correct.png'>
                                  </div>
                                  <div class='headerPremiumText'>
                                    <p>Overlab Premium</p>
                                  </div>
                                </div>
                                <div class='containerPremium'>
                                  <p style='text-align: center;margin: 0;font-weight: bold;'>Teu plano</p>
                                  <p style='margin: 0;text-align: center;font-size: 13px;'>O teu plano será renovado dia 1/05/2020</p>
                                  <p style='margin: 0;text-align: center;margin-top: 5%;font-weight: bold;'>Método de pagamento</p>
                                  <div class='theimagePayment' style='width: 16%;height: 31%;margin-left: 42%;display: inline-block;'>
                                    <img alt='' src='//www.scdn.co/bundles/spotifycheckout/svg/providers/paypal.svg' class='sc-fzXfMz clukrQ'>
                                  </div>
                                </div>
                                <div class='submitPremium'>
																	<form style='width:100%;height:100%;' action='phpScripts/userpageScript.php' method='post' enctype='multipart/form-data'>
                                  	<input type='submit' class='btn' name='overlabFreeStore' value='Cancelar Premium' style='width: 70%;margin: 0;margin-left: 15%;height: 64%;margin-top: 3%;'>
																	</form>
                                </div>
                              </div>";
                      }
                    ?>

                </div>
            </div>
        </div>
    </section>
    <section id="hero1" style="width: 100%;height: 100vh;background-size: cover;position: relative;background-color: #f9fafc;">
        <div id='historicSubs' style="width:56%;height:100%;margin-left:44%;">
            <div id='historicSubsTitle'>
                <p style="font-size: 30px;font-weight: 600;padding-top: 7%;color: black;">Histórico de Subscrições</p>
            </div>
            <div id='historicSubsContainer'>
                <?php
                    $subsQuery = "select * from subscriptionstores where idStore='$username'";
                    $getsSubs = mysqli_query($conn, $subsQuery);

                    if(!$getsSubs)
                        die("Error, select query failed:" . $subsQuery);

                    if(mysqli_num_rows($getsSubs)>0) {
                        while  ($row = mysqli_fetch_array($getsSubs)) {
                            $idSub = $row[0];
                            $mes = $row[7];
                            $ano = $row[8];

                            echo"<div class='theFact'>
                                <div class='theFactEsq'>
                                    <p style='font-size: 30px;color: black;font-weight: 100;padding-top: 15%;padding-left:6%;'>Subscrição #$idSub</p>
                                </div>
                                <div class='theFactMid'>
                                    <p style='float: left;font-size: 17px;padding-top: 17%;padding-left: 12%;color: black;font-weight: 700;'>Mês: $mes</p>
                                    <p style='float: left;font-size: 17px;padding-top: 17%;padding-left: 12%;color: black;font-weight: 700;'>Ano: $ano</p>
                                </div>
                                <div class='theFactDir'>
                                    <a href='.\pdfSubsStores\sub".$idSub."_".$mes."_"."$ano"."_".$username.".pdf' target='_blank' style='    width: 75%;
                                                border: 3px solid #8aaab9;
                                                border-radius: 5px;
                                                height: 45%;
                                                margin-top: 19%;
                                                text-align: center;
                                                padding-top: 7%;'>Fatura</a>
                                </div>
                            </div>";
                        }
                    }
                ?>
            </div>
        </div>
    </section>
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
