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
      <section id="hero" >
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
            <div id='listPedidosContainer'>
                  <div id='pedidosContainerTitle'>
                    <p style="font-size: 29px;padding-top: 4%;color: black;font-weight: 500;">Histórico de Vendas</p>
                  </div>
                  <div id='pedidosContainerItems'>
                    <?php
                      $pedQuery = "select DISTINCT pd.idPedido, pd.data , ppd.idProduct from pedidosdesigners pd, products_pedidodesigners ppd where pd.idPedido = ppd.idPedido and ppd.idSell='$username'";
                      $getPed = mysqli_query($conn, $pedQuery);

                      if(mysqli_num_rows($getPed)>0) {
                        while  ($row = mysqli_fetch_array($getPed)) {
                          $idPed = $row[0];
                          $data = $row[1];
                          $idProd = $row[2];

                          echo "<div class='itemss'>
                                  <div class='itemssEsq'>
                                    <p style='margin: 0;font-size: 35px;font-weight: 400;padding-left: 5%;padding-top: 2%;'>Pedido #$idPed</p>
                                    <p style='margin: 0;font-size: 12px;padding-left: 5%;font-weight: 100;'>$data</p>
                                  </div>
                                  <div class='itemssMid'>
                                    <div class='listItemsPedi'>
                                      <p style='margin: 0;font-size: 13px;font-weight: 100;'>Produto:</p>
                                      <p style='font-size: 13px;'> - $idProd </p>
                                    </div>
                                  </div>
                                  <div class='itemssDir'>
                                    <a href='.\pdfPedidosVendasDesigners\pedido".$idPed."_".$username ."_".$idProd .".pdf' target='_blank' style='    width: 75%;
                                    border: 3px solid #8aaab9;
                                    border-radius: 5px;
                                    height: 45%;
                                    /* margin-left: 60%; */
                                    margin-top: 22%;
                                    text-align: center;
                                    padding-top: 7%;'>Fatura</a>
                                  </div>
                                </div>";
                        }
                      }

                    ?>
                  </div>
                </div>
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
