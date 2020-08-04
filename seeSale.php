<?php
	session_start();
	include "phpScripts/accessBD.php";
	$ss = $_GET['val'];
	$array = explode("_",$ss);
	$idPedido = $array[0];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>OverLab - Store</title>
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
  <link href="css/storeDesigner.css" rel="stylesheet">
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
		$userQuery ="select * from stores where storename ='$name'";
		$checkUser = mysqli_query($conn, $userQuery);


		if (!isset($_SESSION['username'])) {
			header('Location: index.php');
			$_SESSION['messageReceived'] = "Necessário conta para entrar";
		}

		elseif(mysqli_num_rows($checkUser)==0) {
			header('Location: mycloset.php');
			$_SESSION['messageReceived'] = "Necessário conta para entrar";
    }

    if (isset($_GET['val'])){
      $ss = $_GET['val'];
    }
    else{
      header("Location: store1.php");
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
			<li class="menu-active"><a href="#">Store</a></li>
			<li><a href="contacts1.php">Company</a></li>
			<li><a href="help1.php"><i class="icofont-question-circle"></i></a></li>
			<li style="margin-left:11%"><a href="storepage.php">Conta - <?php echo $_SESSION['username'] ?></a></li>
			<li><a href="phpScripts/logout.php">Logout</a></li>
			</ul>
		</nav><!-- #nav-menu-container -->
  	</header><!-- #header -->
	<!--==========================
    Hero Section
  	============================-->
  	<section id="hero">
    	<div class="hero-container">
            <div id='enviar' style="width:70%">
				<div id='peçasEnviar' style="margin-top:10%;margin-left:4%">
					<div id='enviarTitle'>
						<?php echo "<p style='text-align: center;padding-top: 3%;font-size: 30px;font-weight: bold;color: black;''>Produtos - Encomenda #$idPedido</p>"; ?>
					</div>
					<div id='enviarContainer'>
                        <?php

                            $enviaQuery = "select p.name, p.preco, pd.idProduct, pd.tamanho FROM productsd p, products_pedidodesigners pd WHERE pd.idPedido = $idPedido and pd.idProduct = p.id and idSell='$name'";
                            $getEnvia = mysqli_query($conn,$enviaQuery);

                            if(mysqli_num_rows($getEnvia)>0) {
                              while  ($row = mysqli_fetch_array($getEnvia)) {
                                    $nameP = $row[0];
                                    $preco = $row[1];
                                    $idProd = $row[2];
                                    $tam = $row[3];
                                    echo "<div class='theSend' style='height: 35%;margin-top: 1%;'>
                                    <div class='enviaLeft' style='width:60%'>
                                        <div class='parteImgaa' style='width:50%;height:100%;float:left;'>
                                            <div class='imgProd' style='width: 50%;margin-left: 35%;height: 90%;margin-top: 3%;'>
                                                <img src='productsImage/$idProd.jpg' style='width:100%;height:100%'>

                                            </div>
                                        </div>
                                        <div class='parteTextaa' style='width:50%;height:100%;float:left;'>
                                            <p style='margin: 0;font-weight: 100;font-size: 35px;color: white;padding-top: 3%;'>$nameP</p>
                                            <p style='margin: 0;color: white;font-size: 17px;padding-bottom: 2%;'>$idProd</p>
                                            <p style='margin: 0;color: white;font-size: 17px;padding-bottom: 2%;'>Tamanho: $tam</p>
                                            <p style='margin: 0;color: white;font-size: 17px;'>Preço: $preco €</p>
                                        </div>
                                    </div>
                                    <div class='enviaRight' style='width:40%'>

                                    </div>
                                </div>";
                                }
                            }
                        ?>
					</div>
                </div>
            </div>
            <div id='confirmEnvio' style="width:30%;height: 100%;float: left;">
                <div id='divEnvio' style="width: 90%;height: 80%;margin-top: 23.5%;background-color: white;box-shadow: 0px 7px 17px -1px rgba(158,158,158,0.73);border-radius: 15px;">
                <div id="moradaLook" style="width: 100%;height:50%">
                        <?php
                        $dadosQuery = "select u.firstName, u.lastName, u.email, d.morada, d.codigo_postal, d.local from users u, dados_enviodesigners d, pedidosdesigners p where d.idPedido=$idPedido and p.idUsername = u.username";
                        $getDados = mysqli_query($conn,$dadosQuery);

                        $row1 = mysqli_fetch_array($getDados);
                        $firstname = $row1[0];
                        $lastname = $row1[1];
                        $email = $row1[2];
                        $morada = $row1[3];
                        $codigoP = $row1[4];
                        $local = $row1[5];

                        echo "<p style='margin: 0;font-size: 25px;font-weight: 600;padding-left: 8%;padding-top: 7%;padding-bottom: 5%;color: black;'>Dados do Comprador:</p>";
                        echo "<p style='margin: 0;font-size: 17px;font-weight: 100;padding-left: 8%;padding-bottom: 2%;color: black;'>$firstname $lastname</p>";
                        echo "<p style='margin: 0;font-size: 17px;font-weight: 100;padding-left: 8%;color: black;'>$email</p>";
                        echo "<p style='margin: 0;font-size: 25px;font-weight: 600;padding-left: 8%;padding-top: 7%;padding-bottom: 5%;color: black;'>Dados de Envio:</p>";
                        echo "<p style='margin: 0;font-size: 17px;font-weight: 100;padding-left: 8%;padding-bottom: 2%;color: black;'>$morada</p>";
                        echo "<p style='margin: 0;font-size: 17px;font-weight: 100;padding-left: 8%;padding-bottom: 2%;color: black;'>$codigoP</p>";
                        echo "<p style='margin: 0;font-size: 17px;font-weight: 100;padding-left: 8%;padding-bottom: 2%;color: black;'>$local</p>";
                        ?>
                    </div>
                    <div id='confirmar' style="width: 100%;height:50%">
                        <form action="<?=htmlspecialchars(stripslashes(trim("phpScripts/storeScriptDesigner.php")));?>" method="post" enctype="multipart/form-data">

                            <?php
                                $valuePass = $idPedido .",".$name;
                                echo "<button type='submit' name='updateEnvio' value='$valuePass' style='background-color: transparent;width: 60%;height: 40%;border: 0px;margin-top: 40%;margin-left: 20%;outline: none;border-radius: 5px;border: 3px solid #8ab1c6;color: #8ab1c6;'>
                                                    <i class='icofont-fast-delivery'></i>
                                                    <p style='margin:0'>Confirmar Envio</p>
                            </button>";
                            ?>
                        </form>
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
