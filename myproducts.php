<?php
	session_start();
	include "phpScripts/accessBD.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>OverLab - My Products </title>
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
  <link href="css/myproducts.css" rel="stylesheet">
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
			<li class="menu-active"><a href="#">My Products</a></li>
			<li><a href="store1.php">Store</a></li>
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
			<div id="warehouse">
				<div id="menuWarehouse">
					<div class='itemMenu'>
								<a class='hItem' id='click01' style='border-bottom: 1px solid #52727d; width: 35%;'>
									<p id='div1' class='active'>Tudo</p>
								</a>
							</div>
							<div class='itemMenu'>
								<a class='hItem' id='click02'>
									<p id='div2' >Tshirts, Tops e Polos</p>
								</a>
							</div>
							<div class='itemMenu'>
								<a class='hItem' id='click03'>
									<p id='div3' >Camisas</p>
								</a>
							</div>
							<div class='itemMenu'>
								<a class='hItem' id='click04'>
									<p id='div4' >Camisolas e Malhas</p>
								</a>
							</div>
							<div class='itemMenu'>
								<a class='hItem' id='click05'>
									<p id='div5' >Sweatshirts</p>
								</a>
							</div>
							<div class='itemMenu'>
								<a class='hItem' id='click06'>
									<p id='div6' >Vestidos e Macacões</p>
								</a>
							</div>
							<div class='itemMenu'>
								<a class='hItem' id='click07'>
									<p id='div7' >Casacos e Blusões</p>
								</a>
							</div>
							<div class='itemMenu'>
								<a class='hItem' id='click08'>
									<p id='div8' >Blazers e Sobretudos</p>
								</a>
							</div>
							<div class='itemMenu'>
								<a class='hItem' id='click09'>
								<p id='div9' >Calças, Jeans</p>
								</a>
							</div>
							<div class='itemMenu'>
								<a class='hItem' id='click010'>
									<p id='div10' >Saias e Calções</p>
								</a>
							</div>
							<div class='itemMenu'>
								<a class='hItem' id='click011'>
									<p id='div11' >Fatos de Banho</p>
								</a>
							</div>
							<div class='itemMenu' style='margin-bottom:8%'>
								<a class='hItem' id='click012'>
									<p id='div12' >Calçado</p>
								</a>
							</div>
							<div class='itemMenu' style='margin-bottom:8%'>
								<a class='hItem' id='click013'>
									<p id='div13' >Acessórios</p>
								</a>
							</div>
				</div>
				<div id="theWarehouse">
					<div id='searchWarehouse'>
						<div id="filters">
							<div class="dropdown1" style="float:left; width:18%; margin:0%;padding:0%; height:100%; margin-left:10%;">
								<li class="dropdown" style="list-style-type: none; position: relative; float: left; margin-top: 21%;"><a class="dropdown-toggle" data-toggle="dropdown" href="#" style="font-size:13px; color:#58727d;"><i style="margin-right:8%;" class="icofont-paint"></i>Cor <span class="caret"></span></a>
									<ul class="dropdown-menu" style="width: 0% !important; ">
									<input class="form-control" id="myInput1" type="text" placeholder="Search.." style="width: 90%; margin-left: 5%;">
									<li style="width: 70%; margin-left: 6%; margin-top: 5%;"><a style="text-align:left" href="#">Todas</a></li>
									<li style="width: 70%; margin-left: 6%;"><a style="text-align:left" href="#">Pretos</a></li>
									<li style="width: 70%; margin-left: 6%;"><a style="text-align:left" href="#">Brancos</a></li>
									<li style="width: 70%; margin-left: 6%;"><a style="text-align:left" href="#">Beges</a></li>
									<li style="width: 70%; margin-left: 6%;"><a style="text-align:left" href="#">Cinzentos</a></li>
									<li style="width: 70%; margin-left: 6%;"><a style="text-align:left" href="#">Vermelhos</a></li>
									<li style="width: 70%; margin-left: 6%;"><a style="text-align:left" href="#">Azuis</a></li>
									<li style="width: 70%; margin-left: 6%;"><a style="text-align:left" href="#">Verdes</a></li>
									<li style="width: 70%; margin-left: 6%;"><a style="text-align:left" href="#">Rosas</a></li>
									<li style="width: 70%; margin-left: 6%;"><a style="text-align:left" href="#">Amarelos</a></li>
									<li style="width: 70%; margin-left: 6%;"><a style="text-align:left" href="#">Laranjas</a></li>
									<li style="width: 70%; margin-left: 6%;"><a style="text-align:left" href="#">Roxos</a></li>
									<li style="width: 70%; margin-left: 6%;"><a style="text-align:left" href="#">Castanhos</a></li>
									<li style="width: 70%; margin-left: 6%;"><a style="text-align:left" href="#">Dourados</a></li>
									<li style="width: 70%; margin-left: 6%;"><a style="text-align:left" href="#">Prateados</a></li>
									</ul>
								</li>
							</div>

							<div class="dropdown2" style="float:left; width:18%; margin:0%;padding:0%; height:100%;">
								<li class="dropdown" style="list-style-type: none; position: relative; float: left; margin-top: 21%;"><a class="dropdown-toggle" data-toggle="dropdown" href="#" style="font-size:13px; color:#58727d;"><i style="margin-right:8%;" class="icofont-opposite"></i>Utilidade <span class="caret"></span></a>
									<ul class="dropdown-menu" style="width: 0% !important;">
										<input class="form-control" id="myInput2" type="text" placeholder="Search.." style="width: 90%; margin-left: 5%;">
										<li style="width: 70%; margin-left: 6%; margin-top: 5%;"><a style="text-align:left" href="#">Todas</a></li>
										<li style="width: 70%; margin-left: 6%;"><a style="text-align:left" href="#">Casual</a></li>
										<li style="width: 70%; margin-left: 6%;"><a style="text-align:left" href="#">Formal</a></li>
										<li style="width: 70%; margin-left: 6%;"><a style="text-align:left" href="#">Festa</a></li>
										<li style="width: 70%; margin-left: 6%;"><a style="text-align:left" href="#">Desporto</a></li>
									</ul>
								</li>
							</div>
						</div>
						<div id="add">
							<a id="myBtn" class="btn" ><i style="float:left; padding: 3px;" class="icofont-hanger"></i><p style="float:left;">Adicionar Peça</p></a>
						</div>
					</div>
					<div class='theProductsWarehouse' id='div001'>
						<?php

							$user = $_SESSION["username"];
							$productQuery = "select * FROM productsd WHERE brand='$user'";

							$getProducts = mysqli_query($conn,$productQuery);

							if (!$getProducts)
								die("Error, select query failed:" . $productQuery);

							if(mysqli_num_rows($getProducts)>0) {
								while  ($row = mysqli_fetch_array($getProducts)) {
									$id = $row['id'];
									$name = $row['name'];
									$color = $row['color'];
									$clicks = $row['clicks'];

									$countQuery = "select SUM(quantidade) from stocksstores where idProduct='$id'";
									$getCount = mysqli_query($conn,$countQuery);

									if (!$getCount)
										die("Error, select query failed:" . $countQuery);

									$row2 = mysqli_fetch_array($getCount);

									$stock = $row2[0];

									echo "<div class='theProduct'>
										<div class='theProductImage' id='$id'>
											<img class='$id' src='productsImage/$id.jpg'>
											<div class='clickIcon'>
												<div class='viewClicks'>
													<div class='viewClicksTitle'>
														<p style='margin: 0;font-size: 26px;color: black;font-weight: 700;padding-left: 6%;padding-top: 3%;'>Clicks</p>
													</div>
													<div class='viewClicksCont'>
														<p style='font-size: 66px;padding-left: 6%;color: black;font-weight: 100;'>$clicks</p>
													</div>

												</div>
												<div class='editProd'>
													<a style='width:100%;height:100%;text-align: center;font-size: 18px;padding-top: 8%;color: black;' href='editDesigner.php?idProd=$id'>
														Editar Stock
													</a>
												</div>
											</div>
										</div>
										<div class='theProductInfo'>
											<div class='info'>
												<p style='margin: 0;color: black; font-weight: 400;text-transform: uppercase;font-size: 18px;padding-top: 5%;padding-left:7%;'>$name</p>
												<div style = 'background-color: $color; margin-left:7%;' class='color'>

												</div>
											</div>
											<div class='stock'>
												<p style='text-align: center;font-size: 29px;margin: 0;color: black;font-weight: 500;'>$stock</p>
												<p style='text-align: center;margin: 0;font-size: 12px;font-weight: 100;color: black;'>Em stock</p>
											</div>
											<div class='options'>
												<i id='icon' class='fas fa-ellipsis-h $id' style='cursor:pointer'></i>
											</div>
										</div>
									</div>";
								}
							}

						?>
					</div>
					<div class='theProductsWarehouse' id='div002'>
						<?php

							$user = $_SESSION["username"];
							$productQuery = "select * FROM productsd WHERE brand='$user' and (category = 'Tshirt' or category = 'Top' or category='Polo')";

							$getProducts = mysqli_query($conn,$productQuery);

							if (!$getProducts)
								die("Error, select query failed:" . $productQuery);

							if(mysqli_num_rows($getProducts)>0) {
								while  ($row = mysqli_fetch_array($getProducts)) {
									$id = $row['id'];
									$name = $row['name'];
									$color = $row['color'];

									$countQuery = "select SUM(quantidade) from stocksstores where idProduct='$id'";
									$getCount = mysqli_query($conn,$countQuery);

									if (!$getCount)
										die("Error, select query failed:" . $countQuery);

									$row2 = mysqli_fetch_array($getCount);

									$stock = $row2[0];

									echo "<div class='theProduct'>
										<div class='theProductImage'>
											<img src='productsImage/$id.jpg'>
											<div class='clickIcon'>


											</div>
										</div>
										<div class='theProductInfo'>
											<div class='info'>
												<p style='margin: 0;color: black;font-family: 'Poppins', sans-serif;font-weight: 400;text-transform: uppercase;font-size: 18px;padding-top: 5%;'>$name</p>
												<div style = 'background-color: $color' class='color'>

												</div>
											</div>
											<div class='stock'>
												<p style='text-align: center;font-size: 29px;margin: 0;color: black;font-weight: 500;'>$stock</p>
												<p style='text-align: center;margin: 0;font-size: 12px;font-weight: 100;color: black;'>Em stock</p>
											</div>
											<div class='options'>
												<i id='icon' class='fas fa-ellipsis-h $id' style='cursor:pointer'></i>
											</div>
										</div>
									</div>";
								}
							}

						?>
					</div>
					<div class='theProductsWarehouse' id='div003'>
					<?php

						$user = $_SESSION["username"];
						$productQuery = "select * FROM productsd WHERE brand='$user' and (category = 'Camisa')";

						$getProducts = mysqli_query($conn,$productQuery);

						if (!$getProducts)
							die("Error, select query failed:" . $productQuery);

						if(mysqli_num_rows($getProducts)>0) {
							while  ($row = mysqli_fetch_array($getProducts)) {
								$id = $row['id'];
								$name = $row['name'];
								$color = $row['color'];

								$countQuery = "select SUM(quantidade) from stocksstores where idProduct='$id'";
								$getCount = mysqli_query($conn,$countQuery);

								if (!$getCount)
									die("Error, select query failed:" . $countQuery);

								$row2 = mysqli_fetch_array($getCount);

								$stock = $row2[0];

								echo "<div class='theProduct'>
									<div class='theProductImage'>
										<img src='productsImage/$id.jpg'>
										<div class='clickIcon'>


										</div>
									</div>
									<div class='theProductInfo'>
										<div class='info'>
											<p style='margin: 0;color: black;font-family: 'Poppins', sans-serif;font-weight: 400;text-transform: uppercase;font-size: 18px;padding-top: 5%;'>$name</p>
											<div style = 'background-color: $color' class='color'>

											</div>
										</div>
										<div class='stock'>
											<p style='text-align: center;font-size: 29px;margin: 0;color: black;font-weight: 500;'>$stock</p>
											<p style='text-align: center;margin: 0;font-size: 12px;font-weight: 100;color: black;'>Em stock</p>
										</div>
										<div class='options'>
											<i id='icon' class='fas fa-ellipsis-h $id' style='cursor:pointer'></i>
										</div>
									</div>
								</div>";
							}
						}

						?>
					</div>
					<div class='theProductsWarehouse' id='div004'>
						<?php

						$user = $_SESSION["username"];
						$productQuery = "select * FROM productsd WHERE brand='$user' and (category = 'Camisola' or category='Malha')";

						$getProducts = mysqli_query($conn,$productQuery);

						if (!$getProducts)
							die("Error, select query failed:" . $productQuery);

						if(mysqli_num_rows($getProducts)>0) {
							while  ($row = mysqli_fetch_array($getProducts)) {
								$id = $row['id'];
								$name = $row['name'];
								$color = $row['color'];

								$countQuery = "select SUM(quantidade) from stocksstores where idProduct='$id'";
								$getCount = mysqli_query($conn,$countQuery);

								if (!$getCount)
									die("Error, select query failed:" . $countQuery);

								$row2 = mysqli_fetch_array($getCount);

								$stock = $row2[0];

								echo "<div class='theProduct'>
									<div class='theProductImage'>
										<img src='productsImage/$id.jpg'>
										<div class='clickIcon'>


										</div>
									</div>
									<div class='theProductInfo'>
										<div class='info'>
											<p style='margin: 0;color: black;font-family: 'Poppins', sans-serif;font-weight: 400;text-transform: uppercase;font-size: 18px;padding-top: 5%;'>$name</p>
											<div style = 'background-color: $color' class='color'>

											</div>
										</div>
										<div class='stock'>
											<p style='text-align: center;font-size: 29px;margin: 0;color: black;font-weight: 500;'>$stock</p>
											<p style='text-align: center;margin: 0;font-size: 12px;font-weight: 100;color: black;'>Em stock</p>
										</div>
										<div class='options'>
											<i id='icon' class='fas fa-ellipsis-h $id' style='cursor:pointer'></i>
										</div>
									</div>
								</div>";
							}
						}

						?>
					</div>
					<div class='theProductsWarehouse' id='div005'>
						<?php

						$user = $_SESSION["username"];
						$productQuery = "select * FROM productsd WHERE brand='$user' and (category = 'Sweatshirt')";

						$getProducts = mysqli_query($conn,$productQuery);

						if (!$getProducts)
							die("Error, select query failed:" . $productQuery);

						if(mysqli_num_rows($getProducts)>0) {
							while  ($row = mysqli_fetch_array($getProducts)) {
								$id = $row['id'];
								$name = $row['name'];
								$color = $row['color'];

								$countQuery = "select SUM(quantidade) from stocksstores where idProduct='$id'";
								$getCount = mysqli_query($conn,$countQuery);

								if (!$getCount)
									die("Error, select query failed:" . $countQuery);

								$row2 = mysqli_fetch_array($getCount);

								$stock = $row2[0];

								echo "<div class='theProduct'>
									<div class='theProductImage'>
										<img src='productsImage/$id.jpg'>
										<div class='clickIcon'>


										</div>
									</div>
									<div class='theProductInfo'>
										<div class='info'>
											<p style='margin: 0;color: black;font-family: 'Poppins', sans-serif;font-weight: 400;text-transform: uppercase;font-size: 18px;padding-top: 5%;'>$name</p>
											<div style = 'background-color: $color' class='color'>

											</div>
										</div>
										<div class='stock'>
											<p style='text-align: center;font-size: 29px;margin: 0;color: black;font-weight: 500;'>$stock</p>
											<p style='text-align: center;margin: 0;font-size: 12px;font-weight: 100;color: black;'>Em stock</p>
										</div>
										<div class='options'>
											<i id='icon' class='fas fa-ellipsis-h $id' style='cursor:pointer'></i>
										</div>
									</div>
								</div>";
							}
						}

						?>
					</div>
					<div class='theProductsWarehouse' id='div006'>
						<?php

						$user = $_SESSION["username"];
						$productQuery = "select * FROM productsd WHERE brand='$user' and (category = 'Vestido' or category='Macacão')";

						$getProducts = mysqli_query($conn,$productQuery);

						if (!$getProducts)
							die("Error, select query failed:" . $productQuery);

						if(mysqli_num_rows($getProducts)>0) {
							while  ($row = mysqli_fetch_array($getProducts)) {
								$id = $row['id'];
								$name = $row['name'];
								$color = $row['color'];

								$countQuery = "select SUM(quantidade) from stocksstores where idProduct='$id'";
								$getCount = mysqli_query($conn,$countQuery);

								if (!$getCount)
									die("Error, select query failed:" . $countQuery);

								$row2 = mysqli_fetch_array($getCount);

								$stock = $row2[0];

								echo "<div class='theProduct'>
									<div class='theProductImage'>
										<img src='productsImage/$id.jpg'>
										<div class='clickIcon'>


										</div>
									</div>
									<div class='theProductInfo'>
										<div class='info'>
											<p style='margin: 0;color: black;font-family: 'Poppins', sans-serif;font-weight: 400;text-transform: uppercase;font-size: 18px;padding-top: 5%;'>$name</p>
											<div style = 'background-color: $color' class='color'>

											</div>
										</div>
										<div class='stock'>
											<p style='text-align: center;font-size: 29px;margin: 0;color: black;font-weight: 500;'>$stock</p>
											<p style='text-align: center;margin: 0;font-size: 12px;font-weight: 100;color: black;'>Em stock</p>
										</div>
										<div class='options'>
											<i id='icon' class='fas fa-ellipsis-h $id' style='cursor:pointer'></i>
										</div>
									</div>
								</div>";
							}
						}

						?>
					</div>
					<div class='theProductsWarehouse' id='div007'>
						<?php

						$user = $_SESSION["username"];
						$productQuery = "select * FROM productsd WHERE brand='$user' and (category = 'Casaco' or category='Blusão')";

						$getProducts = mysqli_query($conn,$productQuery);

						if (!$getProducts)
							die("Error, select query failed:" . $productQuery);

						if(mysqli_num_rows($getProducts)>0) {
							while  ($row = mysqli_fetch_array($getProducts)) {
								$id = $row['id'];
								$name = $row['name'];
								$color = $row['color'];

								$countQuery = "select SUM(quantidade) from stocksstores where idProduct='$id'";
								$getCount = mysqli_query($conn,$countQuery);

								if (!$getCount)
									die("Error, select query failed:" . $countQuery);

								$row2 = mysqli_fetch_array($getCount);

								$stock = $row2[0];

								echo "<div class='theProduct'>
									<div class='theProductImage'>
										<img src='productsImage/$id.jpg'>
										<div class='clickIcon'>


										</div>
									</div>
									<div class='theProductInfo'>
										<div class='info'>
											<p style='margin: 0;color: black;font-family: 'Poppins', sans-serif;font-weight: 400;text-transform: uppercase;font-size: 18px;padding-top: 5%;'>$name</p>
											<div style = 'background-color: $color' class='color'>

											</div>
										</div>
										<div class='stock'>
											<p style='text-align: center;font-size: 29px;margin: 0;color: black;font-weight: 500;'>$stock</p>
											<p style='text-align: center;margin: 0;font-size: 12px;font-weight: 100;color: black;'>Em stock</p>
										</div>
										<div class='options'>
											<i id='icon' class='fas fa-ellipsis-h $id' style='cursor:pointer'></i>
										</div>
									</div>
								</div>";
							}
						}

						?>
					</div>
					<div class='theProductsWarehouse' id='div008'>
						<?php

						$user = $_SESSION["username"];
						$productQuery = "select * FROM productsd WHERE brand='$user' and (category = 'Blazer' or category = 'Sobretudo')";

						$getProducts = mysqli_query($conn,$productQuery);

						if (!$getProducts)
							die("Error, select query failed:" . $productQuery);

						if(mysqli_num_rows($getProducts)>0) {
							while  ($row = mysqli_fetch_array($getProducts)) {
								$id = $row['id'];
								$name = $row['name'];
								$color = $row['color'];

								$countQuery = "select SUM(quantidade) from stocksstores where idProduct='$id'";
								$getCount = mysqli_query($conn,$countQuery);

								if (!$getCount)
									die("Error, select query failed:" . $countQuery);

								$row2 = mysqli_fetch_array($getCount);

								$stock = $row2[0];

								echo "<div class='theProduct'>
									<div class='theProductImage'>
										<img src='productsImage/$id.jpg'>
										<div class='clickIcon'>


										</div>
									</div>
									<div class='theProductInfo'>
										<div class='info'>
											<p style='margin: 0;color: black;font-family: 'Poppins', sans-serif;font-weight: 400;text-transform: uppercase;font-size: 18px;padding-top: 5%;'>$name</p>
											<div style = 'background-color: $color' class='color'>

											</div>
										</div>
										<div class='stock'>
											<p style='text-align: center;font-size: 29px;margin: 0;color: black;font-weight: 500;'>$stock</p>
											<p style='text-align: center;margin: 0;font-size: 12px;font-weight: 100;color: black;'>Em stock</p>
										</div>
										<div class='options'>
											<i id='icon' class='fas fa-ellipsis-h $id' style='cursor:pointer'></i>
										</div>
									</div>
								</div>";
							}
						}

						?>
					</div>
					<div class='theProductsWarehouse' id='div009'>
						<?php

						$user = $_SESSION["username"];
						$productQuery = "select * FROM productsd WHERE brand='$user' and (category = 'Calças' or category='Jeans')";

						$getProducts = mysqli_query($conn,$productQuery);

						if (!$getProducts)
							die("Error, select query failed:" . $productQuery);

						if(mysqli_num_rows($getProducts)>0) {
							while  ($row = mysqli_fetch_array($getProducts)) {
								$id = $row['id'];
								$name = $row['name'];
								$color = $row['color'];

								$countQuery = "select SUM(quantidade) from stocksstores where idProduct='$id'";
								$getCount = mysqli_query($conn,$countQuery);

								if (!$getCount)
									die("Error, select query failed:" . $countQuery);

								$row2 = mysqli_fetch_array($getCount);

								$stock = $row2[0];

								echo "<div class='theProduct'>
									<div class='theProductImage'>
										<img src='productsImage/$id.jpg'>
										<div class='clickIcon'>


										</div>
									</div>
									<div class='theProductInfo'>
										<div class='info'>
											<p style='margin: 0;color: black;font-family: 'Poppins', sans-serif;font-weight: 400;text-transform: uppercase;font-size: 18px;padding-top: 5%;'>$name</p>
											<div style = 'background-color: $color' class='color'>

											</div>
										</div>
										<div class='stock'>
											<p style='text-align: center;font-size: 29px;margin: 0;color: black;font-weight: 500;'>$stock</p>
											<p style='text-align: center;margin: 0;font-size: 12px;font-weight: 100;color: black;'>Em stock</p>
										</div>
										<div class='options'>
											<i id='icon' class='fas fa-ellipsis-h $id' style='cursor:pointer'></i>
										</div>
									</div>
								</div>";
							}
						}

						?>
					</div>
					<div class='theProductsWarehouse' id='div0010'>
						<?php

						$user = $_SESSION["username"];
						$productQuery = "select * FROM productsd WHERE brand='$user' and (category = 'Calções' or category='Saia')";

						$getProducts = mysqli_query($conn,$productQuery);

						if (!$getProducts)
							die("Error, select query failed:" . $productQuery);

						if(mysqli_num_rows($getProducts)>0) {
							while  ($row = mysqli_fetch_array($getProducts)) {
								$id = $row['id'];
								$name = $row['name'];
								$color = $row['color'];

								$countQuery = "select SUM(quantidade) from stocksstores where idProduct='$id'";
								$getCount = mysqli_query($conn,$countQuery);

								if (!$getCount)
									die("Error, select query failed:" . $countQuery);

								$row2 = mysqli_fetch_array($getCount);

								$stock = $row2[0];

								echo "<div class='theProduct'>
									<div class='theProductImage'>
										<img src='productsImage/$id.jpg'>
										<div class='clickIcon'>


										</div>
									</div>
									<div class='theProductInfo'>
										<div class='info'>
											<p style='margin: 0;color: black;font-family: 'Poppins', sans-serif;font-weight: 400;text-transform: uppercase;font-size: 18px;padding-top: 5%;'>$name</p>
											<div style = 'background-color: $color' class='color'>

											</div>
										</div>
										<div class='stock'>
											<p style='text-align: center;font-size: 29px;margin: 0;color: black;font-weight: 500;'>$stock</p>
											<p style='text-align: center;margin: 0;font-size: 12px;font-weight: 100;color: black;'>Em stock</p>
										</div>
										<div class='options'>
											<i id='icon' class='fas fa-ellipsis-h $id' style='cursor:pointer'></i>
										</div>
									</div>
								</div>";
							}
						}

						?>
					</div>
					<div class='theProductsWarehouse' id='div0011'>
						<?php

						$user = $_SESSION["username"];
						$productQuery = "select * FROM productsd WHERE brand='$user' and (category = 'Fato de Banho')";

						$getProducts = mysqli_query($conn,$productQuery);

						if (!$getProducts)
							die("Error, select query failed:" . $productQuery);

						if(mysqli_num_rows($getProducts)>0) {
							while  ($row = mysqli_fetch_array($getProducts)) {
								$id = $row['id'];
								$name = $row['name'];

								$countQuery = "select SUM(quantidade) from stocksstores where idProduct='$id'";
								$getCount = mysqli_query($conn,$countQuery);

								if (!$getCount)
									die("Error, select query failed:" . $countQuery);

								$row2 = mysqli_fetch_array($getCount);

								$stock = $row2[0];

								echo "<div class='theProduct'>
									<div class='theProductImage'>
										<img src='productsImage/$id.jpg'>
										<div class='clickIcon'>


										</div>
									</div>
									<div class='theProductInfo'>
										<div class='info'>
											<p style='margin: 0;color: black;font-family: 'Poppins', sans-serif;font-weight: 400;text-transform: uppercase;font-size: 18px;padding-top: 5%;'>$name</p>
											<div style = 'background-color: $color' class='color'>

											</div>
										</div>
										<div class='stock'>
											<p style='text-align: center;font-size: 29px;margin: 0;color: black;font-weight: 500;'>$stock</p>
											<p style='text-align: center;margin: 0;font-size: 12px;font-weight: 100;color: black;'>Em stock</p>
										</div>
										<div class='options'>
											<i id='icon' class='fas fa-ellipsis-h $id' style='cursor:pointer'></i>
										</div>
									</div>
								</div>";
							}
						}

						?>
					</div>
					<div class='theProductsWarehouse' id='div0012'>
						<?php

						$user = $_SESSION["username"];
						$productQuery = "select * FROM productsd WHERE brand='$user' and (category = 'Ténis' or category = 'Sapatos Social' or category = 'Botas' or category = 'Sandálias' or category = 'Chinelos')";

						$getProducts = mysqli_query($conn,$productQuery);

						if (!$getProducts)
							die("Error, select query failed:" . $productQuery);

						if(mysqli_num_rows($getProducts)>0) {
							while  ($row = mysqli_fetch_array($getProducts)) {
								$id = $row['id'];
								$name = $row['name'];

								$countQuery = "select SUM(quantidade) from stocksstores where idProduct='$id'";
								$getCount = mysqli_query($conn,$countQuery);

								if (!$getCount)
									die("Error, select query failed:" . $countQuery);

								$row2 = mysqli_fetch_array($getCount);

								$stock = $row2[0];




								echo "<div class='theProduct'>
									<div class='theProductImage'>
										<img src='productsImage/$id.jpg'>
										<div class='clickIcon'>


										</div>
									</div>
									<div class='theProductInfo'>
										<div class='info'>
											<p style='margin: 0;color: black;font-family: 'Poppins', sans-serif;font-weight: 400;text-transform: uppercase;font-size: 18px;padding-top: 5%;'>$name</p>
											<div style = 'background-color: $color' class='color'>

											</div>
										</div>
										<div class='stock'>
											<p style='text-align: center;font-size: 29px;margin: 0;color: black;font-weight: 500;'>$stock</p>
											<p style='text-align: center;margin: 0;font-size: 12px;font-weight: 100;color: black;'>Em stock</p>
										</div>
										<div class='options'>
											<i id='icon' class='fas fa-ellipsis-h $id' style='cursor:pointer'></i>
										</div>
									</div>
								</div>";
							}
						}

						?>
					</div>
					<div class='theProductsWarehouse' id='div0013'>
						<?php

						$user = $_SESSION["username"];
						$productQuery = "select * FROM productsd WHERE brand='$user' and (category = 'Brincos' or category = 'Anél' or category = 'Colar' or category = 'Pulseira' or category = 'Relógio' or category = 'Óculos' or category = 'Mala' or category = 'Gravata' or category = 'Chapeu' or category = 'Cinto' or category = 'Laço' or category = 'Cachecol')";

						$getProducts = mysqli_query($conn,$productQuery);

						if (!$getProducts)
							die("Error, select query failed:" . $productQuery);

						if(mysqli_num_rows($getProducts)>0) {
							while  ($row = mysqli_fetch_array($getProducts)) {
								$id = $row['id'];
								$name = $row['name'];
								$color = $row['color'];

								$countQuery = "select SUM(quantidade) from stocksstores where idProduct='$id'";
								$getCount = mysqli_query($conn,$countQuery);

								if (!$getCount)
									die("Error, select query failed:" . $countQuery);

								$row2 = mysqli_fetch_array($getCount);

								$stock = $row2[0];

								echo "<div class='theProduct'>
									<div class='theProductImage'>
										<img src='productsImage/$id.jpg'>
										<div class='clickIcon'>


										</div>
									</div>
									<div class='theProductInfo'>
										<div class='info'>
											<p style='margin: 0;color: black;font-family: 'Poppins', sans-serif;font-weight: 400;text-transform: uppercase;font-size: 18px;padding-top: 5%;'>$name</p>
											<div style = 'background-color: $color' class='color'>

											</div>
										</div>
										<div class='stock'>
											<p style='text-align: center;font-size: 29px;margin: 0;color: black;font-weight: 500;'>$stock</p>
											<p style='text-align: center;margin: 0;font-size: 12px;font-weight: 100;color: black;'>Em stock</p>
										</div>
										<div class='options'>
											<i id='icon' class='fas fa-ellipsis-h $id' style='cursor:pointer'></i>
										</div>
									</div>
								</div>";
							}
						}

						?>
					</div>
				</div>
			</div>
		</div>
		<div id="myModal" class="modal">

			<!-- Modal content -->
			<div class="modal-content" style="overflow: hidden">
				<span class="close" style = "margin-left:95%;">&times;</span>
				<div id="cont">
					<div id='insert'>
						<div id='addTitle'>
							<p style="margin:0;font-size: 25px;font-weight: 100;">Adicionar Peça</p>
						</div>
						<div id='addForm'>
							<form style="width: 100%;height:100%;" action="<?=htmlspecialchars(stripslashes(trim("phpScripts/myproductsScript.php")));?>" method="post" enctype="multipart/form-data">
								<div id='addEsq'>
									<div class="input-div two">
										<div class="i">
											<i class="fas fa-copyright"></i>
										</div>
										<div>
											<h5>Nome Peça</h5>
											<input class="input" name="name" type="text" required>
										</div>
									</div>
									<div class="input-div one" id="div1">
										<div class="i">
											<i class="fas fa-signature"></i>
										</div>
										<div>
											<select class="form-control" name="category" id="questionSelect" style='width: 90%;margin-left: 5%;' required>
											<option selected disabled>Categoria...</option>
												<option value='Tshirt'>Tshirt</option>
												<option value='Top'>Top</option>
												<option value='Polo'>Polo</option>
												<option value='Camisa'>Camisa</option>
												<option value='Vestido'>Vestido</option>
												<option value='Macacão'>Macacão</option>
												<option value='Casaco'>Casaco</option>
												<option value='Sweatshirt'>Sweatshirt</option>
												<option value='Blusão'>Blusão</option>
												<option value='Sobretudo'>Sobretudo</option>
												<option value='Camisola'>Camisola</option>
												<option value='Malha'>Malhas</option>
												<option value='Blazer'>Blazer</option>
												<option value='Calças'>Calças</option>
												<option value='Jeans'>Jeans</option>
												<option value='Calções'>Calções</option>
												<option value='Saia'>Saia</option>
												<option value='Fato de Banho'>Fato de Banho</option>
												<option value='Ténis'>Calçado - Ténis</option>
												<option value='Sapatos Social'>Calçado - Social</option>
												<option value='Botas'>Calçado - Bota</option>
												<option value='Sandálias'>Calçado - Sandálias</option>
												<option value='Chinelos'>Calçado - Chinelos</option>
												<option value='Brincos'>Acessórios - Brincos</option>
												<option value='Anél'>Acessórios - Anéis</option>
												<option value='Colar'>Acessórios - Colares</option>
												<option value='Pulseira'>Acessórios - Pulseiras</option>
												<option value='Relógio'>Acessórios - Relógios</option>
												<option value='Óculos'>Acessórios - Óculos</option>
												<option value='Mala'>Acessórios - Malas</option>
												<option value='Gravata'>Acessórios - Gravatas</option>
												<option value='Chapeu'>Acessórios - Chapéus</option>
												<option value='Cinto'>Acessórios - Cintos</option>
												<option value='Laço'>Acessórios - Laços</option>
												<option value='Cachecol'>Acessórios - Cachecóis</option>
											</select>
										</div>
									</div>
									<div class="input-div three">
										<div class="i">
											<i class="fas fa-palette"></i>
										</div>
										<div>
											<select class="form-control" name="color" id="questionSelect2" style='width: 90%;margin-left: 5%;' required>
												<option selected disabled>Cor...</option>
												<option value="black">Preto</option>
												<option value="white">Branco</option>
												<option value="beige">Bege</option>
												<option value="gray">Cinzento</option>
												<option value="red">Vermelho</option>
												<option value="blue">Azul</option>
												<option value="green">Verde</option>
												<option value="rose">Rosa</option>
												<option value="yellow">Amarelo</option>
												<option value="orange">Laranja</option>
												<option value="purple">Roxo</option>
												<option value="brown">Castanho</option>
												<option value="gold">Dourado</option>
												<option value="silver">Prateado</option>
											</select>
										</div>
									</div>
									<div class="input-div two">
										<div class="i">
											<i class="fas fa-copyright"></i>
										</div>
										<div>
											<h5>Descrição Peça</h5>
											<input class="input" name="descricao" type="text" required>
										</div>
									</div>

								</div>
								<div id='addDir'>
									<div class="input-div four">
										<div class="i">
											<i class="fas fa-clipboard-list"></i>
										</div>
										<div>
											<select class="form-control" name="gender" id="questionSelect3" style='width: 90%;margin-left: 5%;' required>
												<option selected disabled>Género...</option>
												<option value="M">Masculino</option>
												<option value="F">Feminino</option>
												<option value="U">Unisexo</option>
											</select>
										</div>
									</div>
									<div class="input-div four">
										<div class="i">
											<i class="fas fa-clipboard-list"></i>
										</div>
										<div>
											<select class="form-control" name="utility" id="questionSelect4" style='width: 90%;margin-left: 5%;' required>
												<option selected disabled>Utilidade...</option>
												<option value="Casual">Casual</option>
												<option value="Formal">Formal</option>
												<option value="Party">Festa</option>
												<option value="Sport">Desporto</option>
											</select>
										</div>
									</div>
									<div class="input-div two">
										<div class="i">
											<i class="fas fa-euro-sign"></i>
										</div>
										<div>
											<h5>Preço</h5>
											<input class="input" name="price" type="number" required>
										</div>
									</div>
									<div class="input-div nine" style="font-size:12px;">
										<div class="i">
											<i class="fas fa-camera"></i>
										</div>
										<div>
											<input id="file" type="file" accept=".jpg" name="avatar" style="margin-top: 2.5%; margin-left: 3%;">
										</div>
									</div>
									<input style="width: 40%; height: 2.5em; margin-left: 30%;margin-top:4%;" id='type1' type="submit" class="btn" name="adicionar1" value="Adicionar">
									<input style="width: 40%; height: 2.5em; margin-left: 30%;margin-top:4%;" id='type2' type="submit" class="btn" name="adicionar2" value="Adicionar">
									<input style="width: 40%; height: 2.5em; margin-left: 30%;margin-top:4%;" id='type3' type="submit" class="btn" name="adicionar3" value="Adiciona">
									<input style="width: 40%; height: 2.5em; margin-left: 30%;margin-top:4%;" id='type4' type="submit" class="btn" name="adicionar4" value="Adicionar">
								</div>
								<div id='addStocks'>
									<div id='addStockTitle'>
										<p style='margin:0%;'>Stocks</p>
									</div>
									<div id='addStockContainer'>
										<div id='addStockLeft'>
											<div class='tamLen'>
												<p style="margin: 0%;text-align: center;font-weight: 100;color: black;padding-top: 0%;">XS</p>
											</div>
											<div class='tamLen'>
												<p style="margin: 0%;text-align: center;font-weight: 100;color: black;padding-top: 0%;">S</p>
											</div>
											<div class='tamLen'>
												<p style="margin: 0%;text-align: center;font-weight: 100;color: black;padding-top:0%;">M</p>
											</div>
											<div class='tamLen'>
												<p style="margin: 0%;text-align: center;font-weight: 100;color: black;padding-top: 0%;">L</p>
											</div>
											<div class='tamLen'>
												<p style="margin: 0%;text-align: center;font-weight: 100;color: black;padding-top: 0%;">XL</p>
											</div>
										</div>
										<div id='addStockRight'>
											<div class='tamLen'>
												<input type="number" name='stockXS' class="form-control" placeholder="Inserir Qtd.">
											</div>
											<div class='tamLen'>
												<input type="number" name='stockS' class="form-control" placeholder="Inserir Qtd.">
											</div>
											<div class='tamLen'>
												<input type="number" name='stockM' class="form-control" placeholder="Inserir Qtd.">
											</div>
											<div class='tamLen'>
												<input type="number" name='stockL' class="form-control" placeholder="Inserir Qtd.">
											</div>
											<div class='tamLen'>
												<input type="number" name='stockXL' class="form-control" placeholder="Inserir Qtd.">
											</div>
										</div>
									</div>
									<div id='addStockContainer1'>
										<div id='addStockLeft'>
											<div class='tamLen'>
												<p style="margin: 0%;text-align: center;font-weight: 100;color: black;padding-top: 0%;">32</p>
											</div>
											<div class='tamLen'>
												<p style="margin: 0%;text-align: center;font-weight: 100;color: black;padding-top: 0%;">34</p>
											</div>
											<div class='tamLen'>
												<p style="margin: 0%;text-align: center;font-weight: 100;color: black;padding-top: 0%;">36</p>
											</div>
											<div class='tamLen'>
												<p style="margin: 0%;text-align: center;font-weight: 100;color: black;padding-top: 0%;">38</p>
											</div>
											<div class='tamLen'>
												<p style="margin: 0%;text-align: center;font-weight: 100;color: black;padding-top: 0%;">40</p>
											</div>
											<div class='tamLen'>
												<p style="margin: 0%;text-align: center;font-weight: 100;color: black;padding-top: 0%;">42</p>
											</div>
											<div class='tamLen'>
												<p style="margin: 0%;text-align: center;font-weight: 100;color: black;padding-top: 0%;">44</p>
											</div>
											<div class='tamLen'>
												<p style="margin: 0%;text-align: center;font-weight: 100;color: black;padding-top: 0%;">46</p>
											</div>
											<div class='tamLen'>
												<p style="margin: 0%;text-align: center;font-weight: 100;color: black;padding-top: 0%;">48</p>
											</div>
											<div class='tamLen'>
												<p style="margin: 0%;text-align: center;font-weight: 100;color: black;padding-top: 0%;">50</p>
											</div>
										</div>
										<div id='addStockRight'>
											<div class='tamLen'>
												<input type="number" name='stock32' class="form-control" placeholder="Inserir Qtd.">
											</div>
											<div class='tamLen'>
												<input type="number" name='stock34' class="form-control" placeholder="Inserir Qtd.">
											</div>
											<div class='tamLen'>
												<input type="number" name='stock36' class="form-control" placeholder="Inserir Qtd.">
											</div>
											<div class='tamLen'>
												<input type="number" name='stock38' class="form-control" placeholder="Inserir Qtd.">
											</div>
											<div class='tamLen'>
												<input type="number" name='stock40' class="form-control" placeholder="Inserir Qtd.">
											</div>
											<div class='tamLen'>
												<input type="number" name='stock42' class="form-control" placeholder="Inserir Qtd.">
											</div>
											<div class='tamLen'>
												<input type="number" name='stock44' class="form-control" placeholder="Inserir Qtd.">
											</div>
											<div class='tamLen'>
												<input type="number" name='stock46' class="form-control" placeholder="Inserir Qtd.">
											</div>
											<div class='tamLen'>
												<input type="number" name='stock48' class="form-control" placeholder="Inserir Qtd.">
											</div>
											<div class='tamLen'>
												<input type="number" name='stock50' class="form-control" placeholder="Inserir Qtd.">
											</div>
										</div>
									</div>
									<div id='addStockContainer2'>
										<div id='addStockLeft'>
											<div class='tamLen'>
												<p style="margin: 0%;text-align: center;font-weight: 100;color: black;padding-top: 0%;">34</p>
											</div>
											<div class='tamLen'>
												<p style="margin: 0%;text-align: center;font-weight: 100;color: black;padding-top: 0%;">35</p>
											</div>
											<div class='tamLen'>
												<p style="margin: 0%;text-align: center;font-weight: 100;color: black;padding-top: 0%;">36</p>
											</div>
											<div class='tamLen'>
												<p style="margin: 0%;text-align: center;font-weight: 100;color: black;padding-top: 0%;">37</p>
											</div>
											<div class='tamLen'>
												<p style="margin: 0%;text-align: center;font-weight: 100;color: black;padding-top: 0%;">38</p>
											</div>
											<div class='tamLen'>
												<p style="margin: 0%;text-align: center;font-weight: 100;color: black;padding-top: 0%;">39</p>
											</div>
											<div class='tamLen'>
												<p style="margin: 0%;text-align: center;font-weight: 100;color: black;padding-top: 0%;">40</p>
											</div>
											<div class='tamLen'>
												<p style="margin: 0%;text-align: center;font-weight: 100;color: black;padding-top: 0%;">41</p>
											</div>
											<div class='tamLen'>
												<p style="margin: 0%;text-align: center;font-weight: 100;color: black;padding-top: 0%;">42</p>
											</div>
											<div class='tamLen'>
												<p style="margin: 0%;text-align: center;font-weight: 100;color: black;padding-top: 0%;">43</p>
											</div>
											<div class='tamLen'>
												<p style="margin: 0%;text-align: center;font-weight: 100;color: black;padding-top: 0%;">44</p>
											</div>
											<div class='tamLen'>
												<p style="margin: 0%;text-align: center;font-weight: 100;color: black;padding-top: 0%;">45</p>
											</div>
											<div class='tamLen'>
												<p style="margin: 0%;text-align: center;font-weight: 100;color: black;padding-top: 0%;">46</p>
											</div>
											<div class='tamLen'>
												<p style="margin: 0%;text-align: center;font-weight: 100;color: black;padding-top: 0%;">47</p>
											</div>
										</div>
										<div id='addStockRight'>
											<div class='tamLen'>
												<input type="number" name='stock34' class="form-control" placeholder="Inserir Qtd.">
											</div>
											<div class='tamLen'>
												<input type="number" name='stock35' class="form-control" placeholder="Inserir Qtd.">
											</div>
											<div class='tamLen'>
												<input type="number" name='stock36' class="form-control" placeholder="Inserir Qtd.">
											</div>
											<div class='tamLen'>
												<input type="number" name='stock37' class="form-control" placeholder="Inserir Qtd.">
											</div>
											<div class='tamLen'>
												<input type="number" name='stock38' class="form-control" placeholder="Inserir Qtd.">
											</div>
											<div class='tamLen'>
												<input type="number" name='stock39' class="form-control" placeholder="Inserir Qtd.">
											</div>
											<div class='tamLen'>
												<input type="number" name='stock40' class="form-control" placeholder="Inserir Qtd.">
											</div>
											<div class='tamLen'>
												<input type="number" name='stock41' class="form-control" placeholder="Inserir Qtd.">
											</div>
											<div class='tamLen'>
												<input type="number" name='stock42' class="form-control" placeholder="Inserir Qtd.">
											</div>
											<div class='tamLen'>
												<input type="number" name='stock43' class="form-control" placeholder="Inserir Qtd.">
											</div>
											<div class='tamLen'>
												<input type="number" name='stock44' class="form-control" placeholder="Inserir Qtd.">
											</div>
											<div class='tamLen'>
												<input type="number" name='stock45' class="form-control" placeholder="Inserir Qtd.">
											</div>
											<div class='tamLen'>
												<input type="number" name='stock46' class="form-control" placeholder="Inserir Qtd.">
											</div>
											<div class='tamLen'>
												<input type="number" name='stock47' class="form-control" placeholder="Inserir Qtd.">
											</div>
										</div>
									</div>
									<div id='addStockContainer3'>
										<div id='addStockLeft'>
											<div class='tamLen'>
												<p style="margin: 0%;text-align: center;font-weight: 100;color: black;padding-top: 0%;">Tam. Único</p>
											</div>
										</div>
										<div id='addStockRight'>
											<div class='tamLen'>
												<input type="number" name='stockUnico' class="form-control" style='margin-top: 0%;' placeholder="Inserir Qtd.">
											</div>
										</div>
									</div>
								</div>
							</form>
						</div>
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
	<script>
		// Get the modal
		var modal = document.getElementById("myModal");

		// Get the button that opens the modal
		var btn = document.getElementById("myBtn");

		// Get the <span> element that closes the modal
		var span = document.getElementsByClassName("close")[0];

		// When the user clicks the button, open the modal
		btn.onclick = function() {
			modal.style.display = "block";
		}

		// When the user clicks on <span> (x), close the modal
		span.onclick = function() {
			modal.style.display = "none";
		}

		// When the user clicks anywhere outside of the modal, close it
		window.onclick = function(event) {
			if (event.target == modal) {
				modal.style.display = "none";
			}
		}
	</script>
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
	<script type="text/javascript" src="js/aaa1.js"></script>
	<script>
	$(document).ready(function(){
        $("#questionSelect").change(function(){
            $( "#questionSelect option:selected").each(function(){
                if($(this).attr("value")=='Tshirt' || $(this).attr("value")=='Top' || $(this).attr("value")=='Polo' || $(this).attr("value")=='Camisa' || $(this).attr("value")=='Vestido' || $(this).attr("value")=='Macacão' || $(this).attr("value")=='Casaco' || $(this).attr("value")=='Blusão' ||  $(this).attr("value")=='Sobretudo' || $(this).attr("value")=='Camisola' || $(this).attr("value")=='Malha' || $(this).attr("value")=='Blazer' || $(this).attr("value")=='Sweatshirt' || $(this).attr("value")== 'Fato de Banho'){
					$("#addStockContainer3").hide();
					$("#addStockContainer2").hide();
					$("#addStockContainer1").hide();
					$("#addStockContainer").show();
					$("#type4").hide();
					$("#type3").hide();
					$("#type2").hide();
                    $("#type1").show();
                }
                if($(this).attr("value")=="Calças" || $(this).attr("value")=="Jeans" || $(this).attr("value")=="Calções" || $(this).attr("value")=="Saia"){
					$("#addStockContainer3").hide();
					$("#addStockContainer2").hide();
					$("#addStockContainer").hide();
					$("#addStockContainer1").show();
					$("#type4").hide();
					$("#type3").hide();
					$("#type1").hide();
                    $("#type2").show();
                }
                if($(this).attr("value")=="Ténis" || $(this).attr("value")=="Sapatos Social" || $(this).attr("value")=="Botas" || $(this).attr("value")=="Sandálias" || $(this).attr("value")=="Chinelos"){
					$("#addStockContainer3").hide();
					$("#addStockContainer").hide();
					$("#addStockContainer1").hide();
					$("#addStockContainer2").show();
					$("#type4").hide();
					$("#type1").hide();
					$("#type2").hide();
                    $("#type3").show();
                }
                if($(this).attr("value")=='Brincos' || $(this).attr("value")=='Anél' || $(this).attr("value")=='Colar' || $(this).attr("value")=='Pulseira' || $(this).attr("value")=='Relógio' || $(this).attr("value")=='Óculos' || $(this).attr("value")=='Mala' || $(this).attr("value")=='Gravata' || $(this).attr("value")=='Chapeu' || $(this).attr("value")=='Cinto' || $(this).attr("value")=='Laço' || $(this).attr("value")=='Cachecol'){
					$("#addStockContainer").hide();
					$("#addStockContainer2").hide();
					$("#addStockContainer1").hide();
					$("#addStockContainer3").show();
					$("#type1").hide();
					$("#type3").hide();
					$("#type2").hide();
                    $("#type4").show();
                }
            });
		}).change();

		$(".fas").on("click", function(){
			var myClass = $(this).attr("class");
			var numb =myClass.length;
			var res = myClass.slice(18, numb);
			var classI = "img." + res;
			var idId = "#" + res;
			console.log("pau");

			if ($(idId + ' > .clickIcon').css('display') == 'none'){
				$(classI).css("display","none");
				$(idId + ' > .clickIcon').css("display","inline-block");
				$(classI).css("margin","0");
				$(idId + ' > .clickIcon > form').css("display","inline-block");
				$(idId + ' > .clickIcon > form >.ButtonOption').css("display","inline-block");
				$('.theProductInfo.'+ res).css("margin-top","2%");
			}
			else{
				$(classI).css("display","block");
				$(idId + ' > .clickIcon').css("display","none");
				$(idId + ' > .clickIcon > form').css("display","none");
				$(idId + ' > .clickIcon > .ButtonOption').css("display","none");
				$('.theProductInfo.'+ res).css("margin-top","0%");
				myClass = "";
				numb = "";
				res = "";
				classI = "";
				idId = "";
			}

		});
    });
	</script>
	</body>
</html>
