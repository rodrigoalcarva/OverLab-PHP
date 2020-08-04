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
      <section id="hero" style="height: 230vh !important;">
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
                <div id="titleConta">
                  <p>Conta</p>
                </div>
                <div class="editProfileConta">
                    <div class="editProfileContaTitle">
                      <p>Perfil</p>
                    </div>
                    <div class="editProfileContaContainer">
                      <div class="divEditProfileContainer">
                        <div class="divEditProfileContainerLeft">
                          <p>Email</p>
                        </div>
                        <div class="divEditProfileContainerRight">
                          <?php echo "<p>".$row[2]."</p>";?>
                        </div>

                      </div>
                      <div class="divEditProfileContainer">
                        <div class="divEditProfileContainerLeft">
                          <p>Password</p>
                        </div>
                        <div class="divEditProfileContainerRight">
                          <p>********</p>
                        </div>

                      </div>
                      <div class="divEditProfileContainer">
                        <div class="divEditProfileContainerLeft">
                          <p>Data de Criação</p>
                        </div>
                        <div class="divEditProfileContainerRight">
                          <?php echo "<p>".$row[5]."</p>";?>
                        </div>
                      </div>
                      <div class="divEditProfileContainer">
                        <div class="divEditProfileContainerLeft">
                          <p>País</p>
                        </div>
                        <div class="divEditProfileContainerRight">
                          <?php echo "<p>".$row[6]."</p>";?>
                        </div>

                      </div>
                      <div class="divEditProfileContainer">
                        <div class="divEditProfileContainerLeft">
                          <p>Slogan</p>
                        </div>
                        <div class="divEditProfileContainerRight">
                            <?php echo "<p>".$row[4]."</p>";?>
                        </div>
                      </div>
                    </div>
                    <div class="editProfileContaLink">
                      <a href="storepageEditProfile.php" class='button4'>Editar perfil</a>
                    </div>
                </div>
                <?php
                  if ($row[9] == 'Free'){
                    echo "<div class='editProfileConta'>
                            <div class='editProfileContaTitle'>
                              <p>Teu Plano</p>
                            </div>
                            <div class='editProfileContaContainer' style='border:1px solid gray;border-radius:10px;'>
                              <div class='editPremiumTop'>
                                <p>Overlab Free</p>
                              </div>
                              <div class='editPremiumMiddle'>
                                <p>Sem destaque da loja, nem das peças da loja. O utilizador não tem uma maior probabilidade de encontrar logo as suas peças</p>
                              </div>
                              <div class='editPremiumBottom'>
                                <p>Free</p>
                              </div>
                            </div>
                            <div class='editProfileContaLink'>
                              <a href='storepagePremium.php' class='button4'>Ser Premium</a>
                            </div>
                        </div>";
                  }
                  else{
                    echo "<div class='editProfileConta'>
                            <div class='editProfileContaTitle'>
                              <p>Teu Plano</p>
                            </div>
                            <div class='editProfileContaContainer' style='border:1px solid gray;border-radius:1%;'>
                              <div class='editPremiumTop'>
                                <p>Overlab Premium</p>
                              </div>
                              <div class='editPremiumMiddle'>
                                <p>Com destaque da loja e das peças da loja. O utilizador verá as suas peças em 1ºLugar</p>
                              </div>
                              <div class='editPremiumBottom'>
                                <p>Premium</p>
                              </div>
                            </div>
                            <div class='editProfileContaLink'>
                              <a href='storepagePremium.php' class='button4'>Gerir Premium</a>
                            </div>
                        </div>";
                  }

                ?>
                <div class='editProfileConta' style="height: 17%;">
                  <div class='editProfileContaTitle' style="height: 20%;">
                    <p>Histórico de Vendas</p>
                  </div>
                  <div class='editProfileContaContainer'style="height: 55%;">
                    <div class="textHistoricSales">
                      <p>Número total de Vendas realizadas:</p>
                    </div>
                    <div class="numberHistoricSales">
                      <?php
                        $countPedidos = "select COUNT(pd.idPedido) from pedidosdesigners pd, products_pedidodesigners ppd where pd.idPedido = ppd.idPedido and ppd.idSell='$username'";
                        $checkCount = mysqli_query($conn,$countPedidos);

                        $row = mysqli_fetch_array($checkCount);
                        $num = $row[0];
                        echo "<p>$num</p>";

                      ?>
                    </div>
                  </div>
                  <div class='editProfileContaLink' style="height: 25%;">
                    <a href='storepageHistoricSales.php' class='button4'>Ver histórico</a>
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
