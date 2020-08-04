<?php
	session_start();
	include "phpScripts/accessBD.php";
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
			<div id='enviar'>
				<div id='peçasEnviar'>
					<div id='enviarTitle'>
						<p style="text-align: center;padding-top: 7%;font-size: 30px;font-weight: bold;color: black;">Para envio</p>
					</div>
					<div id='enviarContainer'>
						<?php
							$encomendaQuery = "select DISTINCT pd.idPedido, pd.idUsername from pedidosdesigners pd, products_pedidodesigners ppd where pd.idPedido = ppd.idPedido and ppd.idSell='$name' and ppd.estado_entrega='a_processar'";
							$getEncomenda = mysqli_query($conn,$encomendaQuery);

							if(mysqli_num_rows($getEncomenda)>0) {
								while  ($row = mysqli_fetch_array($getEncomenda)) {
									$idP = $row[0];
									$nameP = $row[1];
									$value_conj = $idP."_".$nameP;
									echo "<div class='theSend'>
										<div class='enviaLeft'>
											<p style='margin: 0;font-weight: 100;font-size: 24px;padding-left: 8%;color: white;padding-top: 3%;'>Encomenda #$idP</p>
											<p style='margin: 0;padding-left: 8%;color: white;font-size: 13px;'>Pessoa: $nameP</p>
										</div>
										<div class='enviaRight'>
											<a href='seeSale.php?val=$value_conj' class='verE'>
												<i class='icofont-eye-alt'></i>
												<p>Ver</p>
											</a>
										</div>
									</div>";
								}
							}
						?>
					</div>
				</div>
			</div>
			<div id='alerts'>
				<div id='alertStocks'>
					<div id='alertTitle'>
						<p style="text-align: center;padding-top: 9%;font-size: 30px;font-weight: bold;color: black;">Alertas stock</p>
					</div>
					<div id='alertContainer'>
						<?php
							$alertQuery ="select * from productsd where brand='$name'";
							$getAlert = mysqli_query($conn, $alertQuery);

							if(mysqli_num_rows($getAlert)>0) {
								while  ($row = mysqli_fetch_array($getAlert)) {
									$id = $row[0];
									$namePeca = $row[1];

									$countQuery = "select SUM(quantidade) from stocksstores where idProduct='$id'";
									$getCount = mysqli_query($conn,$countQuery);

									if (!$getCount)
										die("Error, select query failed:" . $countQuery);

									$row2 = mysqli_fetch_array($getCount);

									$stock = $row2[0];

									if ($stock < 6){
										echo "<div class='theAlert'>
										<div class='alertEsq'>
											<p style='margin: 0;font-weight: 100;font-size: 24px;padding-left: 8%;color: white;padding-top: 3%;'>$namePeca</p>
											<p style='margin: 0;padding-left: 8%;color: white;font-size: 11px;'>$id</p>
										</div>
										<div class='alertMid'>
											<p style='margin: 0;text-align: center;font-size: 45px;color: white;font-weight: 700;height: 59%;'>$stock</p>
											<p style='margin: 0;text-align: center;color: white;font-weight: 100;'>Stock</p>
										</div>
										<div class='alertDir'>
											<a href='editDesigner.php?idProd=$id' class='gerirP'>
												<i class='icofont-edit'></i>
												<p>Gerir</p>
											</a>
										</div>
									</div>";
									}


								}
							}
						?>
					</div>
				</div>
			</div>
			<div id='total'>
				<div id='totalSales'>
					<div class='salesInfo'>
						<?php
						$countPedidos = "select COUNT(pd.idPedido) from pedidosdesigners pd, products_pedidodesigners ppd where pd.idPedido = ppd.idPedido and ppd.idSell='$name'";
                        $checkCount = mysqli_query($conn,$countPedidos);

                        $row = mysqli_fetch_array($checkCount);
						$num = $row[0];

						$total = 0;
						$priceTotalQuery = "select p.preco from productsd p, products_pedidodesigners ppd where p.id = ppd.idProduct and ppd.idSell='$name'";
						$getPrice = mysqli_query($conn,$priceTotalQuery);

						while  ($row1 = mysqli_fetch_array($getPrice)) {
							$price = $row1[0];
							$total = $total + $price;
						}
						echo "<p style='margin: 0;font-weight: bold;font-size: 26px;padding-left: 10%;padding-top: 11%;color: black;'>Total vendas</p>";
						echo "<p style='font-size: 50px;margin: 0;padding-left: 10%;font-weight: bold;padding-top: 7%;color: black;'>$total €</p>";
						echo "<p style='padding-left: 10%;padding-top: 3%;font-weight: 100;'>(Nº $num vendas)</p>";
						?>
					</div>
					<div class='salesInfo'>
						<img src='img/graph.png' style=" width: 65%; margin-top: 18%;margin-left: 19%;">
					</div>
				</div>
				<div id='monthSales'>
					<div class='salesInfo'>
						<?php
						$totalMonth = 0;
						$sum = 0;
						$priceMonthQuery = "select p.preco, pd.data from productsd p, products_pedidodesigners ppd , pedidosdesigners pd where p.id = ppd.idProduct and ppd.idSell='$name'";
						$getPriceMonth = mysqli_query($conn,$priceMonthQuery);

						while  ($row2 = mysqli_fetch_array($getPriceMonth)) {
							$priceA = $row2[0];
							$data  = $row2[1];
							$array = explode("/",$data);
							$mes = $array[0];
							$mesAtual = date('m');
							echo("<script>console.log('PHP: " . $data . "');</script>");
							echo("<script>console.log('PHP: " . $mes . "');</script>");
							echo("<script>console.log('PHP: " . $mesAtual . "');</script>");
							if ($mes == $mesAtual){
								$totalMonth = $totalMonth + $priceA;
								$sum++;
							}
						}
						echo "<p style='margin: 0;font-weight: bold;font-size: 26px;padding-left: 10%;padding-top: 11%;color: black;'>Vendas mês</p>";
						echo "<p style='font-size: 50px;margin: 0;padding-left: 10%;font-weight: bold;padding-top: 7%;color: black;'>$totalMonth €</p>";
						echo "<p style='padding-left: 10%;padding-top: 3%;font-weight: 100;'>(Nº $sum vendas)</p>";

						?>
					</div>
					<div class='salesInfo'>
						<img src='img/graph.png' style=" width: 65%; margin-top: 18%;margin-left: 19%;">
					</div>
				</div>
				<div id='clicksProducts'>
					<p style="margin: 0;font-weight: bold;font-size: 26px;padding-left: 5%;padding-top: 5%;color: black;">Total cliques</p>
					<?php

					$clicksQuery = "select sum(clicks) from productsd where brand='$name'";
					$getClicks = mysqli_query($conn, $clicksQuery);

					$rowC = mysqli_fetch_array($getClicks);

					$clicks = $rowC[0];

					echo "<p style='font-size: 50px;margin: 0;padding-left: 6%;font-weight: bold;padding-top: 0%;color: black;'>$clicks</p>";
					?>
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
