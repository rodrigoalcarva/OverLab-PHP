<?php
	session_start();
	include "phpScripts/accessBD.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>OverLab - MyCloset</title>
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
  <link href="css/homepage.css" rel="stylesheet">
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
		$userQuery ="select * from users where username ='$name'";
		$checkUser = mysqli_query($conn, $userQuery);


		if (!isset($_SESSION['username'])) {
			header('Location: index.php');
			$_SESSION['messageReceived'] = "Necessário conta para entrar";
		}

		elseif(mysqli_num_rows($checkUser)==0) {
			header('Location: myproducts.php');
			$_SESSION['messageReceived'] = "Necessário conta para entrar";
		}

	?>
	<!--==========================
  	Header
  	============================-->
	  <header id="header">
		<div id="logo" class="pull-left">
			<a href="mycloset.php">
				<img src="img/logo.png" alt="" title="" /></img>
			</a>
		</div>

		<nav id="nav-menu-container">
			<ul class="nav-menu">
			<li class="menu-active"><a href="mycloset.php">My Closet</a></li>
			<li><a href="followers.php">Friends</a></li>
			<li><a href="wishlist.php">Wishlist</a></li>
			<li><a href="mystore2mao.php">My Store</a></li>
			<li><a href="store.php">Store</a></li>
			<li><a href="contacts.php">Company</a></li>
			<li><a href="help.php"><i class="icofont-question-circle"></i></a></li>
			<li style="margin-left:11%"><a href="userpage.php">Conta - <?php echo $_SESSION['username'] ?></a></li>
			<li><a href="phpScripts/logout.php">Logout</a></li>
			</ul>
		</nav><!-- #nav-menu-container -->
  	</header><!-- #header -->
	<!--==========================
    Hero Section
  	============================-->
  	<section id="hero">
    	<div class="hero-container">
			<div id="closet">
				<div id="menuCloset">
					<?php
						$user = $_SESSION["username"];
						$userGenderQuery ="select * from users where username='$user'";
						$checkGenderUser = mysqli_query($conn, $userGenderQuery);

						$row = mysqli_fetch_array($checkGenderUser);
						$gender = $row[5];
						echo("<script>console.log('PHP: " . $gender . "');</script>");
						if ($gender == 'F'){
							echo "<div class='itemMenu'>
								<a class='hItem' id='click1' style='border-bottom: 1px solid #52727d; width: 35%;'>
									<p id='div1' class='active'>Tudo</p>
								</a>
							</div>
							<div class='itemMenu'>
								<a class='hItem' id='click2'>
									<p id='div2' >Tshirts, Tops e Polos</p>
								</a>
							</div>
							<div class='itemMenu'>
								<a class='hItem' id='click3'>
									<p id='div3' >Camisas</p>
								</a>
							</div>
							<div class='itemMenu'>
								<a class='hItem' id='click4'>
									<p id='div4' >Vestidos e Macacões</p>
								</a>
							</div>
							<div class='itemMenu'>
								<a class='hItem' id='click5'>
									<p id='div5' >Casacos e Blusões</p>
								</a>
							</div>
							<div class='itemMenu'>
								<a class='hItem' id='click6'>
									<p id='div6' >Malhas</p>
								</a>
							</div>
							<div class='itemMenu'>
								<a class='hItem' id='click7'>
									<p id='div7' >Blazers</p>
								</a>
							</div>
							<div class='itemMenu'>
								<a class='hItem' id='click8'>
									<p id='div8' >Calças e Jeans</p>
								</a>
							</div>
							<div class='itemMenu'>
								<a class='hItem' id='click9'>
									<p id='div9' >Saias e Calções</p>
								</a>
							</div>
							<div class='itemMenu'>
								<a class='hItem' id='click10'>
									<p id='div10' >Fatos de Banho</p>
								</a>
							</div>
							<div class='itemMenu'>
								<a class='hItem' id='click11'>
									<p id='div11' >Calçado</p>
								</a>
							</div>
							<div class='itemMenu' style='margin-bottom:8%'>
								<a class='hItem' id='click12'>
									<p id='div12' >Acessórios</p>
								</a>
							</div>
							<div class='itemMenu' style='margin-bottom:8%'>
								<a class='hItem' id='click25'>
									<p id='div25' >Produtos Designer</p>
								</a>
							</div>";

						}
						else{
							echo "<div class='itemMenu'>
								<a class='hItem' id='click13' style='border-bottom: 1px solid #52727d; width: 35%;'>
									<p id='div13' class='active'>Tudo</p>
								</a>
							</div>
							<div class='itemMenu'>
								<a class='hItem' id='click14'>
									<p id='div14' >Tshirts e Polos</p>
								</a>
							</div>
							<div class='itemMenu'>
								<a class='hItem' id='click15'>
									<p id='div15' >Camisas</p>
								</a>
							</div>
							<div class='itemMenu'>
								<a class='hItem' id='click16'>
									<p id='div16' >Camisolas e Malhas</p>
								</a>
							</div>
							<div class='itemMenu'>
								<a class='hItem' id='click17'>
									<p id='div17' >Sweatshirts</p>
								</a>
							</div>
							<div class='itemMenu'>
								<a class='hItem' id='click18'>
									<p id='div18' >Casacos e Blusões</p>
								</a>
							</div>
							<div class='itemMenu'>
								<a class='hItem' id='click19'>
									<p id='div19' >Blazers</p>
								</a>
							</div>
							<div class='itemMenu'>
								<a class='hItem' id='click20'>
									<p id='div20' >Sobretudos</p>
								</a>
							</div>
							<div class='itemMenu'>
								<a class='hItem' id='click21'>
									<p id='div21' >Calças, Jeans e Calções</p>
								</a>
							</div>
							<div class='itemMenu'>
								<a class='hItem' id='click22'>
									<p id='div22' >Fatos de Banho</p>
								</a>
							</div>
							<div class='itemMenu'>
								<a class='hItem' id='click23'>
									<p id='div23' >Calçado</p>
								</a>
							</div>
							<div class='itemMenu' style='margin-bottom:8%'>
								<a class='hItem' id='click24'>
									<p id='div24' >Acessórios</p>
								</a>
							</div>
							<div class='itemMenu' style='margin-bottom:8%'>
								<a class='hItem' id='click26'>
									<p id='div26' >Produtos Designer</p>
								</a>
							</div>";
						}
					?>



				</div>
				<div id="theCloset">
					<div id="searchCloset">
						<div id="filters">
							<div class="dropdown" style="float:left; width:20%; margin:0%;padding:0%; height:100%; margin-left:4%;">
								<li class="dropdown" style="list-style-type: none; position: relative; float: left; margin-top: 24%;"><a class="dropdown-toggle" data-toggle="dropdown" href="#" style="font-size:13px; color:#58727d;"><i style="margin-right:8%;" class="icofont-cc"></i>Marca <span class="caret"></span></a>
									<ul class="dropdown-menu" style="width: 0% !important; ">
									<input class="form-control" id="myInput" type="text" placeholder="Search.." style="width: 90%; margin-left: 5%;">
									<li style='width: 70%; margin-left: 6%; margin-top: 5%;'><a style='text-align:left' href='#'>Todas</a></li>
									<?php

										$user = $_SESSION["username"];
										$brandQuery = "select DISTINCT p.brand
																FROM productsu p, storage s
																WHERE p.id = s.idStore AND s.idUtilizador='$user' ";

										$getBrands = mysqli_query($conn,$brandQuery);

										if (!$getBrands)
											die("Error, select query failed:" . $brandQuery);

										if(mysqli_num_rows($getBrands)>0) {
											while  ($row = mysqli_fetch_array($getBrands)) {
												$brand = $row['brand'];
												echo "<li style='width: 70%; margin-left: 6%;'><a style='text-align:left' href='#'>$brand</a></li>";
											}
										}
									?>
									</ul>
								</li>
							</div>
							<div class="dropdown1" style="float:left; width:20%; margin:0%;padding:0%; height:100%; margin-left:10%;">
								<li class="dropdown" style="list-style-type: none; position: relative; float: left; margin-top: 24%;"><a class="dropdown-toggle" data-toggle="dropdown" href="#" style="font-size:13px; color:#58727d;"><i style="margin-right:8%;" class="icofont-paint"></i>Cor <span class="caret"></span></a>
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

							<div class="dropdown2" style="float:left; width:20%; margin:0%;padding:0%; height:100%; margin-left:6%;">
								<li class="dropdown" style="list-style-type: none; position: relative; float: left; margin-top: 24%;"><a class="dropdown-toggle" data-toggle="dropdown" href="#" style="font-size:13px; color:#58727d;"><i style="margin-right:8%;" class="icofont-opposite"></i>Utilidade <span class="caret"></span></a>
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
							<a id="myBtn" class="btn" style="font-size: 13px;text-align: center; margin-top: 10%;margin-left: 27%;color: #58727d;"><i style="float:left; padding: 3px;" class="icofont-hanger"></i><p style="float:left;">Adicionar Peça</p></a>
						</div>
					</div>
					<?php

					if ($gender == 'F'){

						echo "<div class='theRealPart' id='div01'>";

							$user = $_SESSION["username"];
							$productQuery = "select p.id, p.category, p.brand, p.color, p.utility from (select id,category, brand, color, utility from productsd UNION select id, name, brand, color, utility from productsu) p, storage s where p.id = s.idStore and s.idUtilizador='$user'";

							$getProducts = mysqli_query($conn,$productQuery);

							if (!$getProducts)
								die("Error, select query failed:" . $productQuery);

							if(mysqli_num_rows($getProducts)>0) {
								while  ($row = mysqli_fetch_array($getProducts)) {
									$ref = $row['id'];
									$productName = $row['category'];
									$brand = $row['brand'];
									$color = $row['color'];
									$utility = $row['utility'];
									$link =" onclick='location.href='addProductSale.php?val=$ref';";
									echo "<div class='theProduct'>
											<div class='theProductImage'>
												<div class='theImage' id='$ref'>
													<img id='teste' class='$ref' src='productsImage/$ref.jpg'>
													<div class='clickIcon'>
													<form style='width:100%;height:50%;'>";

													$prodQuery = "select * from venda2mao where idProduct='$ref'";

													$getProd = mysqli_query($conn,$prodQuery);

													if(mysqli_num_rows($getProd)>0) {
														echo "<button class='ButtonOption' formaction='' name='sale' value='$ref' style='opacity: 0.5;' disabled><i class='fas fa-hand-holding-usd' style='margin-right: 5%;'></i>Já se encontra à venda</button>";
													}
													else{
														echo "<button class='ButtonOption' formaction='addProductSale.php?value=$ref' name='sale' value='$ref' ><i class='fas fa-hand-holding-usd' style='margin-right: 5%;'></i>Vender Peça</button>";
													}

													echo "</form>
													<form action='phpScripts/myclosetScript.php' method='POST' style='width:100%;height:50%;'>
														<button class='ButtonOption' name='delete' value='$ref'><i class='fas fa-trash' style='margin-right: 5%;'></i>Apagar Peça</button>
													</form>
													</div>
												</div>
											</div>
											<div class='theProductInfo $ref'>
												<div class='inf'>
													<div class='infTitle'>
														<p>$productName</p>
													</div>
													<div class='infInf'>
														<div class='brand'>
															<p>$brand</p>
														</div>
													<div class='color'>
														<div class='colorCircle' style='background-color:$color';>

														</div>
													</div>
												</div>
											</div>
											<div id='options' class='dropdown'>
												<i id='icon' class='fas fa-ellipsis-h $ref' style='cursor:pointer'></i>
											</div>
										</div>
									</div>";
								}
							}

						echo "</div>";
						echo "<div class='theRealPart' id='div02'>";

							$user = $_SESSION["username"];
							$productQuery = "select p.id, p.category, p.brand, p.color, p.utility from (select id,category, brand, color, utility from productsd UNION select id, name, brand, color, utility from productsu) p, storage s where p.id = s.idStore and s.idUtilizador='$user' AND (p.category='Tshirt' OR p.category='Top' OR p.category='Polo')";

							$getProducts = mysqli_query($conn,$productQuery);

							if (!$getProducts)
								die("Error, select query failed:" . $productQuery);

							if(mysqli_num_rows($getProducts)>0) {
								while  ($row = mysqli_fetch_array($getProducts)) {
									$ref = $row['id'];
									$productName = $row['category'];
									$brand = $row['brand'];
									$color = $row['color'];
									$utility = $row['utility'];

									echo "<div class='theProduct'>
											<div class='theProductImage'>
												<div class='theImage' id='$ref'>
													<img id='teste' class='$ref' src='productsImage/$ref.jpg'>
													<div class='clickIcon'>
													<form style='width:100%;height:50%;'>";

													$prodQuery = "select * from venda2mao where idProduct='$ref'";

													$getProd = mysqli_query($conn,$prodQuery);

													if(mysqli_num_rows($getProd)>0) {
														echo "<button class='ButtonOption' formaction='' name='sale' value='$ref' style='opacity: 0.5;' disabled><i class='fas fa-hand-holding-usd' style='margin-right: 5%;'></i>Já se encontra à venda</button>";
													}
													else{
														echo "<button class='ButtonOption' formaction='addProductSale.php?value=$ref' name='sale' value='$ref' ><i class='fas fa-hand-holding-usd' style='margin-right: 5%;'></i>Vender Peça</button>";
													}

													echo "</form>
													<form action='phpScripts/myclosetScript.php' method='POST' style='width:100%;height:50%;'>
														<button class='ButtonOption' name='delete' value='$ref'><i class='fas fa-trash' style='margin-right: 5%;'></i>Apagar Peça</button>
													</form>
													</div>
												</div>
											</div>
											<div class='theProductInfo'>
												<div class='inf'>
													<div class='infTitle'>
														<p>$productName</p>
													</div>
													<div class='infInf'>
														<div class='brand'>
															<p>$brand</p>
														</div>
													<div class='color'>
														<div class='colorCircle' style='background-color:$color';>

														</div>
													</div>
												</div>
											</div>
											<div id='options' class='dropdown'>
												<i class='fas fa-ellipsis-h $ref' style='cursor:pointer'></i>
											</div>
										</div>
									</div>";
								}
							}

						echo "</div>";
						echo "<div class='theRealPart' id='div03'>";

							$user = $_SESSION["username"];
							$productQuery = "select p.id, p.category, p.brand, p.color, p.utility from (select id,category, brand, color, utility from productsd UNION select id, name, brand, color, utility from productsu) p, storage s where p.id = s.idStore and s.idUtilizador='$user' AND p.category='Camisa' ";

							$getProducts = mysqli_query($conn,$productQuery);

							if (!$getProducts)
								die("Error, select query failed:" . $productQuery);

							if(mysqli_num_rows($getProducts)>0) {
								while  ($row = mysqli_fetch_array($getProducts)) {
									$ref = $row['id'];
									$productName = $row['category'];
									$brand = $row['brand'];
									$color = $row['color'];
									$utility = $row['utility'];

									echo "<div class='theProduct'>
											<div class='theProductImage'>
												<div class='theImage' id='$ref'>
													<img id='teste' class='$ref' src='productsImage/$ref.jpg'>
													<div class='clickIcon'>
													<form style='width:100%;height:50%;'>";

													$prodQuery = "select * from venda2mao where idProduct='$ref'";

													$getProd = mysqli_query($conn,$prodQuery);

													if(mysqli_num_rows($getProd)>0) {
														echo "<button class='ButtonOption' formaction='' name='sale' value='$ref' style='opacity: 0.5;' disabled><i class='fas fa-hand-holding-usd' style='margin-right: 5%;'></i>Já se encontra à venda</button>";
													}
													else{
														echo "<button class='ButtonOption' formaction='addProductSale.php?value=$ref' name='sale' value='$ref' ><i class='fas fa-hand-holding-usd' style='margin-right: 5%;'></i>Vender Peça</button>";
													}

													echo "</form>
													<form action='phpScripts/myclosetScript.php' method='POST' style='width:100%;height:50%;'>
														<button class='ButtonOption' name='delete' value='$ref'><i class='fas fa-trash' style='margin-right: 5%;'></i>Apagar Peça</button>
													</form>
													</div>
												</div>
											</div>
											<div class='theProductInfo'>
												<div class='inf'>
													<div class='infTitle'>
														<p>$productName</p>
													</div>
													<div class='infInf'>
														<div class='brand'>
															<p>$brand</p>
														</div>
													<div class='color'>
														<div class='colorCircle' style='background-color:$color';>

														</div>
													</div>
												</div>
											</div>
											<div id='options' class='dropdown'>
												<i class='fas fa-ellipsis-h $ref'></i>
											</div>
										</div>
									</div>";
								}
							}

						echo '</div>';
						echo "<div class='theRealPart' id='div04'>";

							$user = $_SESSION["username"];
							$productQuery = "select p.id, p.category, p.brand, p.color, p.utility from (select id,category, brand, color, utility from productsd UNION select id, name, brand, color, utility from productsu) p, storage s where p.id = s.idStore and s.idUtilizador='$user' AND (p.category='Vestido' OR p.category='Macacão')";

							$getProducts = mysqli_query($conn,$productQuery);

							if (!$getProducts)
								die("Error, select query failed:" . $productQuery);

							if(mysqli_num_rows($getProducts)>0) {
								while  ($row = mysqli_fetch_array($getProducts)) {
									$ref = $row['id'];
									$productName = $row['category'];
									$brand = $row['brand'];
									$color = $row['color'];
									$utility = $row['utility'];

									echo "<div class='theProduct'>
											<div class='theProductImage'>
												<div class='theImage' id='$ref'>
													<img id='teste' class='$ref' src='productsImage/$ref.jpg'>
													<div class='clickIcon'>
														<form style='width:100%;height:50%;'>";

														$prodQuery = "select * from venda2mao where idProduct='$ref'";

														$getProd = mysqli_query($conn,$prodQuery);

														if(mysqli_num_rows($getProd)>0) {
															echo "<button class='ButtonOption' formaction='' name='sale' value='$ref' style='opacity: 0.5;' disabled><i class='fas fa-hand-holding-usd' style='margin-right: 5%;'></i>Já se encontra à venda</button>";
														}
														else{
															echo "<button class='ButtonOption' formaction='addProductSale.php?value=$ref' name='sale' value='$ref' ><i class='fas fa-hand-holding-usd' style='margin-right: 5%;'></i>Vender Peça</button>";
														}

														echo "</form>
														<form action='phpScripts/myclosetScript.php' method='POST' style='width:100%;height:50%;'>
															<button class='ButtonOption' name='delete' value='$ref'><i class='fas fa-trash' style='margin-right: 5%;'></i>Apagar Peça</button>
														</form>
													</div>
												</div>
											</div>
											<div class='theProductInfo'>
												<div class='inf'>
													<div class='infTitle'>
														<p>$productName</p>
													</div>
													<div class='infInf'>
														<div class='brand'>
															<p>$brand</p>
														</div>
													<div class='color'>
														<div class='colorCircle' style='background-color:$color';>

														</div>
													</div>
												</div>
											</div>
											<div id='options' class='dropdown'>
												<i class='fas fa-ellipsis-h $ref'></i>
											</div>
										</div>
									</div>";
								}
							}

						echo "</div>";
						echo "<div class='theRealPart' id='div05'>";

							$user = $_SESSION["username"];
							$productQuery = "select p.id, p.category, p.brand, p.color, p.utility from (select id,category, brand, color, utility from productsd UNION select id, name, brand, color, utility from productsu) p, storage s where p.id = s.idStore and s.idUtilizador='$user' AND (p.category='Casaco' OR p.category='Blusão')";

							$getProducts = mysqli_query($conn,$productQuery);

							if (!$getProducts)
								die("Error, select query failed:" . $productQuery);

							if(mysqli_num_rows($getProducts)>0) {
								while  ($row = mysqli_fetch_array($getProducts)) {
									$ref = $row['id'];
									$productName = $row['category'];
									$brand = $row['brand'];
									$color = $row['color'];
									$utility = $row['utility'];

									echo "<div class='theProduct'>
											<div class='theProductImage'>
												<div class='theImage' id='$ref'>
													<img id='teste' class='$ref' src='productsImage/$ref.jpg'>
													<div class='clickIcon'>
														<form style='width:100%;height:50%;'>";

														$prodQuery = "select * from venda2mao where idProduct='$ref'";

														$getProd = mysqli_query($conn,$prodQuery);

														if(mysqli_num_rows($getProd)>0) {
															echo "<button class='ButtonOption' formaction='' name='sale' value='$ref' style='opacity: 0.5;' disabled><i class='fas fa-hand-holding-usd' style='margin-right: 5%;'></i>Já se encontra à venda</button>";
														}
														else{
															echo "<button class='ButtonOption' formaction='addProductSale.php?value=$ref' name='sale' value='$ref' ><i class='fas fa-hand-holding-usd' style='margin-right: 5%;'></i>Vender Peça</button>";
														}

														echo "</form>
														<form action='phpScripts/myclosetScript.php' method='POST' style='width:100%;height:50%;'>
															<button class='ButtonOption' name='delete' value='$ref'><i class='fas fa-trash' style='margin-right: 5%;'></i>Apagar Peça</button>
														</form>
													</div>
												</div>
											</div>
											<div class='theProductInfo'>
												<div class='inf'>
													<div class='infTitle'>
														<p>$productName</p>
													</div>
													<div class='infInf'>
														<div class='brand'>
															<p>$brand</p>
														</div>
													<div class='color'>
														<div class='colorCircle' style='background-color:$color';>

														</div>
													</div>
												</div>
											</div>
											<div id='options' class='dropdown'>
												<i class='fas fa-ellipsis-h $ref'></i>
											</div>
										</div>
									</div>";
								}
							}

						echo "</div>";
						echo "<div class='theRealPart' id='div06'>";

								$user = $_SESSION["username"];
								$productQuery = "select p.id, p.category, p.brand, p.color, p.utility from (select id,category, brand, color, utility from productsd UNION select id, name, brand, color, utility from productsu) p, storage s where p.id = s.idStore and s.idUtilizador='$user' AND p.category='Malha'";

								$getProducts = mysqli_query($conn,$productQuery);

								if (!$getProducts)
									die("Error, select query failed:" . $productQuery);

								if(mysqli_num_rows($getProducts)>0) {
									while  ($row = mysqli_fetch_array($getProducts)) {
										$ref = $row['id'];
										$productName = $row['category'];
										$brand = $row['brand'];
										$color = $row['color'];
										$utility = $row['utility'];

										echo "<div class='theProduct'>
												<div class='theProductImage'>
													<div class='theImage' id='$ref'>
														<img id='teste' class='$ref' src='productsImage/$ref.jpg'>
														<div class='clickIcon'>
															<form style='width:100%;height:50%;'>";

															$prodQuery = "select * from venda2mao where idProduct='$ref'";

															$getProd = mysqli_query($conn,$prodQuery);

															if(mysqli_num_rows($getProd)>0) {
																echo "<button class='ButtonOption' formaction='' name='sale' value='$ref' style='opacity: 0.5;' disabled><i class='fas fa-hand-holding-usd' style='margin-right: 5%;'></i>Já se encontra à venda</button>";
															}
															else{
																echo "<button class='ButtonOption' formaction='addProductSale.php?value=$ref' name='sale' value='$ref' ><i class='fas fa-hand-holding-usd' style='margin-right: 5%;'></i>Vender Peça</button>";
															}

															echo "</form>
															<form action='phpScripts/myclosetScript.php' method='POST' style='width:100%;height:50%;'>
																<button class='ButtonOption' name='delete' value='$ref'><i class='fas fa-trash' style='margin-right: 5%;'></i>Apagar Peça</button>
															</form>
														</div>
													</div>
												</div>
												<div class='theProductInfo'>
													<div class='inf'>
														<div class='infTitle'>
															<p>$productName</p>
														</div>
														<div class='infInf'>
															<div class='brand'>
																<p>$brand</p>
															</div>
														<div class='color'>
															<div class='colorCircle' style='background-color:$color';>

															</div>
														</div>
													</div>
												</div>
												<div id='options' class='dropdown'>
													<i class='fas fa-ellipsis-h $ref'></i>
												</div>
											</div>
										</div>";
									}
								}

						echo "</div>";
						echo "<div class='theRealPart' id='div07'>";

							$user = $_SESSION["username"];
							$productQuery = "select p.id, p.category, p.brand, p.color, p.utility from (select id,category, brand, color, utility from productsd UNION select id, name, brand, color, utility from productsu) p, storage s where p.id = s.idStore and s.idUtilizador='$user' AND p.category='Blazer'";

							$getProducts = mysqli_query($conn,$productQuery);

							if (!$getProducts)
								die("Error, select query failed:" . $productQuery);

							if(mysqli_num_rows($getProducts)>0) {
								while  ($row = mysqli_fetch_array($getProducts)) {
									$ref = $row['id'];
									$productName = $row['category'];
									$brand = $row['brand'];
									$color = $row['color'];
									$utility = $row['utility'];

									echo "<div class='theProduct'>
											<div class='theProductImage'>
												<div class='theImage' id='$ref'>
													<img id='teste' class='$ref' src='productsImage/$ref.jpg'>
													<div class='clickIcon'>
														<form style='width:100%;height:50%;'>";

														$prodQuery = "select * from venda2mao where idProduct='$ref'";

														$getProd = mysqli_query($conn,$prodQuery);

														if(mysqli_num_rows($getProd)>0) {
															echo "<button class='ButtonOption' formaction='' name='sale' value='$ref' style='opacity: 0.5;' disabled><i class='fas fa-hand-holding-usd' style='margin-right: 5%;'></i>Já se encontra à venda</button>";
														}
														else{
															echo "<button class='ButtonOption' formaction='addProductSale.php?value=$ref' name='sale' value='$ref' ><i class='fas fa-hand-holding-usd' style='margin-right: 5%;'></i>Vender Peça</button>";
														}

														echo "</form>
														<form action='phpScripts/myclosetScript.php' method='POST' style='width:100%;height:50%;'>
															<button class='ButtonOption' name='delete' value='$ref'><i class='fas fa-trash' style='margin-right: 5%;'></i>Apagar Peça</button>
														</form>
													</div>
												</div>
											</div>
											<div class='theProductInfo'>
												<div class='inf'>
													<div class='infTitle'>
														<p>$productName</p>
													</div>
													<div class='infInf'>
														<div class='brand'>
															<p>$brand</p>
														</div>
													<div class='color'>
														<div class='colorCircle' style='background-color:$color';>

														</div>
													</div>
												</div>
											</div>
											<div id='options' class='dropdown'>
												<i class='fas fa-ellipsis-h $ref'></i>
											</div>
										</div>
									</div>";
								}
							}

						echo "</div>";
						echo "<div class='theRealPart' id='div08'>";

							$user = $_SESSION["username"];
							$productQuery = "select p.id, p.category, p.brand, p.color, p.utility from (select id,category, brand, color, utility from productsd UNION select id, name, brand, color, utility from productsu) p, storage s where p.id = s.idStore and s.idUtilizador='$user' AND (p.category='Calças' OR p.category='Jeans')";

							$getProducts = mysqli_query($conn,$productQuery);

							if (!$getProducts)
								die("Error, select query failed:" . $productQuery);

							if(mysqli_num_rows($getProducts)>0) {
								while  ($row = mysqli_fetch_array($getProducts)) {
									$ref = $row['id'];
									$productName = $row['category'];
									$brand = $row['brand'];
									$color = $row['color'];
									$utility = $row['utility'];

									echo "<div class='theProduct'>
											<div class='theProductImage'>
												<div class='theImage' id='$ref'>
													<img id='teste' class='$ref' src='productsImage/$ref.jpg'>
													<div class='clickIcon'>
														<form style='width:100%;height:50%;'>";

														$prodQuery = "select * from venda2mao where idProduct='$ref'";

														$getProd = mysqli_query($conn,$prodQuery);

														if(mysqli_num_rows($getProd)>0) {
															echo "<button class='ButtonOption' formaction='' name='sale' value='$ref' style='opacity: 0.5;' disabled><i class='fas fa-hand-holding-usd' style='margin-right: 5%;'></i>Já se encontra à venda</button>";
														}
														else{
															echo "<button class='ButtonOption' formaction='addProductSale.php?value=$ref' name='sale' value='$ref' ><i class='fas fa-hand-holding-usd' style='margin-right: 5%;'></i>Vender Peça</button>";
														}

														echo "</form>
														<form action='phpScripts/myclosetScript.php' method='POST' style='width:100%;height:50%;'>
															<button class='ButtonOption' name='delete' value='$ref'><i class='fas fa-trash' style='margin-right: 5%;'></i>Apagar Peça</button>
														</form>
													</div>
												</div>
											</div>
											<div class='theProductInfo'>
												<div class='inf'>
													<div class='infTitle'>
														<p>$productName</p>
													</div>
													<div class='infInf'>
														<div class='brand'>
															<p>$brand</p>
														</div>
													<div class='color'>
														<div class='colorCircle' style='background-color:$color';>

														</div>
													</div>
												</div>
											</div>
											<div id='options' class='dropdown'>
												<i class='fas fa-ellipsis-h $ref'></i>
											</div>
										</div>
									</div>";
								}
							}

						echo "</div>";
						echo "<div class='theRealPart' id='div09'>";

								$user = $_SESSION["username"];
								$productQuery = "select p.id, p.category, p.brand, p.color, p.utility from (select id,category, brand, color, utility from productsd UNION select id, name, brand, color, utility from productsu) p, storage s where p.id = s.idStore and s.idUtilizador='$user' AND (p.category='Calções' OR p.category='Saia')";

								$getProducts = mysqli_query($conn,$productQuery);

								if (!$getProducts)
									die("Error, select query failed:" . $productQuery);

								if(mysqli_num_rows($getProducts)>0) {
									while  ($row = mysqli_fetch_array($getProducts)) {
										$ref = $row['id'];
										$productName = $row['category'];
										$brand = $row['brand'];
										$color = $row['color'];
										$utility = $row['utility'];

										echo "<div class='theProduct'>
												<div class='theProductImage'>
													<div class='theImage' id='$ref'>
														<img id='teste' class='$ref' src='productsImage/$ref.jpg'>
														<div class='clickIcon'>
														<form style='width:100%;height:50%;'>";

														$prodQuery = "select * from venda2mao where idProduct='$ref'";

														$getProd = mysqli_query($conn,$prodQuery);

														if(mysqli_num_rows($getProd)>0) {
															echo "<button class='ButtonOption' formaction='' name='sale' value='$ref' style='opacity: 0.5;' disabled><i class='fas fa-hand-holding-usd' style='margin-right: 5%;'></i>Já se encontra à venda</button>";
														}
														else{
															echo "<button class='ButtonOption' formaction='addProductSale.php?value=$ref' name='sale' value='$ref' ><i class='fas fa-hand-holding-usd' style='margin-right: 5%;'></i>Vender Peça</button>";
														}

														echo "</form>
														<form action='phpScripts/myclosetScript.php' method='POST' style='width:100%;height:50%;'>
															<button class='ButtonOption' name='delete' value='$ref'><i class='fas fa-trash' style='margin-right: 5%;'></i>Apagar Peça</button>
														</form>
														</div>
													</div>
												</div>
												<div class='theProductInfo'>
													<div class='inf'>
														<div class='infTitle'>
															<p>$productName</p>
														</div>
														<div class='infInf'>
															<div class='brand'>
																<p>$brand</p>
															</div>
														<div class='color'>
															<div class='colorCircle' style='background-color:$color';>

															</div>
														</div>
													</div>
												</div>
												<div id='options' class='dropdown'>
													<i class='fas fa-ellipsis-h $ref'></i>
												</div>
											</div>
										</div>";
									}
								}

						echo "</div>";
						echo "<div class='theRealPart' id='div010'>";

							$user = $_SESSION["username"];
							$productQuery = "select p.id, p.category, p.brand, p.color, p.utility from (select id,category, brand, color, utility from productsd UNION select id, name, brand, color, utility from productsu) p, storage s where p.id = s.idStore and s.idUtilizador='$user' AND p.category='Fato de Banho'";

							$getProducts = mysqli_query($conn,$productQuery);

							if (!$getProducts)
								die("Error, select query failed:" . $productQuery);

							if(mysqli_num_rows($getProducts)>0) {
								while  ($row = mysqli_fetch_array($getProducts)) {
									$ref = $row['id'];
									$productName = $row['category'];
									$brand = $row['brand'];
									$color = $row['color'];
									$utility = $row['utility'];

									echo "<div class='theProduct'>
											<div class='theProductImage'>
												<div class='theImage' id='$ref'>
													<img id='teste' class='$ref' src='productsImage/$ref.jpg'>
													<div class='clickIcon'>
														<form style='width:100%;height:50%;'>";

														$prodQuery = "select * from venda2mao where idProduct='$ref'";

														$getProd = mysqli_query($conn,$prodQuery);

														if(mysqli_num_rows($getProd)>0) {
															echo "<button class='ButtonOption' formaction='' name='sale' value='$ref' style='opacity: 0.5;' disabled><i class='fas fa-hand-holding-usd' style='margin-right: 5%;'></i>Já se encontra à venda</button>";
														}
														else{
															echo "<button class='ButtonOption' formaction='addProductSale.php?value=$ref' name='sale' value='$ref' ><i class='fas fa-hand-holding-usd' style='margin-right: 5%;'></i>Vender Peça</button>";
														}

														echo "</form>
														<form action='phpScripts/myclosetScript.php' method='POST' style='width:100%;height:50%;'>
															<button class='ButtonOption' name='delete' value='$ref'><i class='fas fa-trash' style='margin-right: 5%;'></i>Apagar Peça</button>
														</form>
													</div>
												</div>
											</div>
											<div class='theProductInfo'>
												<div class='inf'>
													<div class='infTitle'>
														<p>$productName</p>
													</div>
													<div class='infInf'>
														<div class='brand'>
															<p>$brand</p>
														</div>
													<div class='color'>
														<div class='colorCircle' style='background-color:$color';>

														</div>
													</div>
												</div>
											</div>
											<div id='options' class='dropdown'>
												<i class='fas fa-ellipsis-h $ref'></i>
											</div>
										</div>
									</div>";
								}
							}

						echo "</div>";
						echo "<div class='theRealPart' id='div011'>";

								$user = $_SESSION["username"];
								$productQuery = "select p.id, p.category, p.brand, p.color, p.utility from (select id,category, brand, color, utility from productsd UNION select id, name, brand, color, utility from productsu) p, storage s where p.id = s.idStore and s.idUtilizador='$user' AND (p.category='Ténis' OR p.category='Sapatos Social' OR p.category='Botas' OR p.category='Sandálias' OR p.category='Chinelos')";

								$getProducts = mysqli_query($conn,$productQuery);

								if (!$getProducts)
									die("Error, select query failed:" . $productQuery);

								if(mysqli_num_rows($getProducts)>0) {
									while  ($row = mysqli_fetch_array($getProducts)) {
										$ref = $row['id'];
										$productName = $row['category'];
										$brand = $row['brand'];
										$color = $row['color'];
										$utility = $row['utility'];

										echo "<div class='theProduct'>
												<div class='theProductImage'>
													<div class='theImage' id='$ref'>
														<img id='teste' class='$ref' src='productsImage/$ref.jpg'>
														<div class='clickIcon'>
														<form style='width:100%;height:50%;'>";

														$prodQuery = "select * from venda2mao where idProduct='$ref'";

														$getProd = mysqli_query($conn,$prodQuery);

														if(mysqli_num_rows($getProd)>0) {
															echo "<button class='ButtonOption' formaction='' name='sale' value='$ref' style='opacity: 0.5;' disabled><i class='fas fa-hand-holding-usd' style='margin-right: 5%;'></i>Já se encontra à venda</button>";
														}
														else{
															echo "<button class='ButtonOption' formaction='addProductSale.php?value=$ref' name='sale' value='$ref' ><i class='fas fa-hand-holding-usd' style='margin-right: 5%;'></i>Vender Peça</button>";
														}

														echo "</form>
														<form action='phpScripts/myclosetScript.php' method='POST' style='width:100%;height:50%;'>
															<button class='ButtonOption' name='delete' value='$ref'><i class='fas fa-trash' style='margin-right: 5%;'></i>Apagar Peça</button>
														</form>
														</div>
													</div>
												</div>
												<div class='theProductInfo'>
													<div class='inf'>
														<div class='infTitle'>
															<p>$productName</p>
														</div>
														<div class='infInf'>
															<div class='brand'>
																<p>$brand</p>
															</div>
														<div class='color'>
															<div class='colorCircle' style='background-color:$color';>

															</div>
														</div>
													</div>
												</div>
												<div id='options' class='dropdown'>
													<i class='fas fa-ellipsis-h $ref'></i>
												</div>
											</div>
										</div>";
									}
								}

						echo "</div>";
						echo "<div class='theRealPart' id='div012'>";

								$user = $_SESSION["username"];
								$productQuery = "select p.id, p.category, p.brand, p.color, p.utility from (select id,category, brand, color, utility from productsd UNION select id, name, brand, color, utility from productsu) p, storage s where p.id = s.idStore and s.idUtilizador='$user' AND (p.category='Brincos' OR p.category='Anél' OR p.category='Colar' OR p.category='Pulseira' OR p.category='Relógio' OR p.category='Óculos' OR p.category='Mala' OR p.category='Chapeu' OR p.category='Cinto' OR p.category='Laço' OR p.category='Cachecol')";

								$getProducts = mysqli_query($conn,$productQuery);

								if (!$getProducts)
									die("Error, select query failed:" . $productQuery);

								if(mysqli_num_rows($getProducts)>0) {
									while  ($row = mysqli_fetch_array($getProducts)) {
										$ref = $row['id'];
										$productName = $row['category'];
										$brand = $row['brand'];
										$color = $row['color'];
										$utility = $row['utility'];

										echo "<div class='theProduct'>
												<div class='theProductImage'>
													<div class='theImage' id='$ref'>
														<img id='teste' class='$ref' src='productsImage/$ref.jpg'>
														<div class='clickIcon'>
														<form style='width:100%;height:50%;'>";

														$prodQuery = "select * from venda2mao where idProduct='$ref'";

														$getProd = mysqli_query($conn,$prodQuery);

														if(mysqli_num_rows($getProd)>0) {
															echo "<button class='ButtonOption' formaction='' name='sale' value='$ref' style='opacity: 0.5;' disabled><i class='fas fa-hand-holding-usd' style='margin-right: 5%;'></i>Já se encontra à venda</button>";
														}
														else{
															echo "<button class='ButtonOption' formaction='addProductSale.php?value=$ref' name='sale' value='$ref' ><i class='fas fa-hand-holding-usd' style='margin-right: 5%;'></i>Vender Peça</button>";
														}

														echo "</form>
														<form action='phpScripts/myclosetScript.php' method='POST' style='width:100%;height:50%;'>
															<button class='ButtonOption' name='delete' value='$ref'><i class='fas fa-trash' style='margin-right: 5%;'></i>Apagar Peça</button>
														</form>
														</div>
													</div>
												</div>
												<div class='theProductInfo'>
													<div class='inf'>
														<div class='infTitle'>
															<p>$productName</p>
														</div>
														<div class='infInf'>
															<div class='brand'>
																<p>$brand</p>
															</div>
														<div class='color'>
															<div class='colorCircle' style='background-color:$color';>

															</div>
														</div>
													</div>
												</div>
												<div id='options' class='dropdown'>
													<i class='fas fa-ellipsis-h $ref'></i>
												</div>
											</div>
										</div>";

									}
								}

						echo "</div>";
						echo "<div class='theRealPart' id='div025'>";

								$user = $_SESSION["username"];
								$productQuery = "select prd.id, prd.name, prd.category, prd.brand, prd.color, prd.utility from productsd prd, storage s where prd.id = s.idStore and s.idUtilizador = '$user'";

								$getProducts = mysqli_query($conn,$productQuery);

								if (!$getProducts)
									die("Error, select query failed:" . $productQuery);

								if(mysqli_num_rows($getProducts)>0) {
									while  ($row = mysqli_fetch_array($getProducts)) {
										$ref = $row['id'];
										$productName = $row['name'];
										$brand = $row['brand'];
										$color = $row['color'];
										$utility = $row['utility'];

										echo "<div class='theProduct'>
												<div class='theProductImage'>
													<div class='theImage' id='$ref'>
														<img id='teste' class='$ref' src='productsImage/$ref.jpg'>
														<div class='clickIcon'>
														<form style='width:100%;height:50%;'>";

														$prodQuery = "select * from venda2mao where idProduct='$ref'";

														$getProd = mysqli_query($conn,$prodQuery);

														if(mysqli_num_rows($getProd)>0) {
															echo "<button class='ButtonOption' formaction='' name='sale' value='$ref' style='opacity: 0.5;' disabled><i class='fas fa-hand-holding-usd' style='margin-right: 5%;'></i>Já se encontra à venda</button>";
														}
														else{
															echo "<button class='ButtonOption' formaction='addProductSale.php?value=$ref' name='sale' value='$ref' ><i class='fas fa-hand-holding-usd' style='margin-right: 5%;'></i>Vender Peça</button>";
														}

														echo "</form>
														<form action='phpScripts/myclosetScript.php' method='POST' style='width:100%;height:50%;'>
															<button class='ButtonOption' name='delete' value='$ref'><i class='fas fa-trash' style='margin-right: 5%;'></i>Apagar Peça</button>
														</form>
														</div>
													</div>
												</div>
												<div class='theProductInfo'>
													<div class='inf'>
														<div class='infTitle'>
															<p>$productName</p>
														</div>
														<div class='infInf'>
															<div class='brand'>
																<p>$brand</p>
															</div>
														<div class='color'>
															<div class='colorCircle' style='background-color:$color';>

															</div>
														</div>
													</div>
												</div>
												<div id='options' class='dropdown'>
													<i class='fas fa-ellipsis-h $ref'></i>
												</div>
											</div>
										</div>";
									}
								}

						echo "</div>";
					}
					else{
							echo "<div class='theRealPart' id='div013'>";

							$user = $_SESSION["username"];
							$productQuery = "select p.id, p.category, p.brand, p.color, p.utility from (select id,category, brand, color, utility from productsd UNION select id, name, brand, color, utility from productsu) p, storage s where p.id = s.idStore and s.idUtilizador='$user'";

							$getProducts = mysqli_query($conn,$productQuery);

							if (!$getProducts)
								die("Error, select query failed:" . $productQuery);

							if(mysqli_num_rows($getProducts)>0) {
								while  ($row = mysqli_fetch_array($getProducts)) {
									$ref = $row['id'];
									$productName = $row['category'];
									$brand = $row['brand'];
									$color = $row['color'];
									$utility = $row['utility'];

									echo "<div class='theProduct'>
											<div class='theProductImage'>
												<div class='theImage' id='$ref'>
													<img id='teste' class='$ref' src='productsImage/$ref.jpg'>
													<div class='clickIcon'>
														<form style='width:100%;height:50%;'>";

														$prodQuery = "select * from venda2mao where idProduct='$ref'";

														$getProd = mysqli_query($conn,$prodQuery);

														if(mysqli_num_rows($getProd)>0) {
															echo "<button class='ButtonOption' formaction='' name='sale' value='$ref' style='opacity: 0.5;' disabled><i class='fas fa-hand-holding-usd' style='margin-right: 5%;'></i>Já se encontra à venda</button>";
														}
														else{
															echo "<button class='ButtonOption' formaction='addProductSale.php?value=$ref' name='sale' value='$ref' ><i class='fas fa-hand-holding-usd' style='margin-right: 5%;'></i>Vender Peça</button>";
														}

														echo "</form>
														<form action='phpScripts/myclosetScript.php' method='POST' style='width:100%;height:50%;'>
															<button class='ButtonOption' name='delete' value='$ref'><i class='fas fa-trash' style='margin-right: 5%;'></i>Apagar Peça</button>
														</form>
													</div>
												</div>
											</div>
											<div class='theProductInfo $ref'>
												<div class='inf'>
													<div class='infTitle'>
														<p>$productName</p>
													</div>
													<div class='infInf'>
														<div class='brand'>
															<p>$brand</p>
														</div>
													<div class='color'>
														<div class='colorCircle' style='background-color:$color';>

														</div>
													</div>
												</div>
											</div>
											<div id='options' class='dropdown'>
												<i id='icon' class='fas fa-ellipsis-h $ref' style='cursor:pointer'></i>
											</div>
										</div>
									</div>";
								}
							}

						echo "</div>";
						echo "<div class='theRealPart' id='div014'>";


							$user = $_SESSION["username"];
							$productQuery = "select p.id, p.category, p.brand, p.color, p.utility from (select id,category, brand, color, utility from productsd UNION select id, name, brand, color, utility from productsu) p, storage s where p.id = s.idStore and s.idUtilizador='$user' and (p.category='Tshirt' OR p.category='Polo')";

							$getProducts = mysqli_query($conn,$productQuery);

							if (!$getProducts)
								die("Error, select query failed:" . $productQuery);

							if(mysqli_num_rows($getProducts)>0) {
								while  ($row = mysqli_fetch_array($getProducts)) {
									$ref = $row['id'];
									$productName = $row['category'];
									$brand = $row['brand'];
									$color = $row['color'];
									$utility = $row['utility'];

									echo "<div class='theProduct'>
											<div class='theProductImage'>
												<div class='theImage' id='$ref'>
													<img id='teste' class='$ref' src='productsImage/$ref.jpg'>
													<div class='clickIcon'>
													<form style='width:100%;height:50%;'>";

													$prodQuery = "select * from venda2mao where idProduct='$ref'";

													$getProd = mysqli_query($conn,$prodQuery);

													if(mysqli_num_rows($getProd)>0) {
														echo "<button class='ButtonOption' formaction='' name='sale' value='$ref' style='opacity: 0.5;' disabled><i class='fas fa-hand-holding-usd' style='margin-right: 5%;'></i>Já se encontra à venda</button>";
													}
													else{
														echo "<button class='ButtonOption' formaction='addProductSale.php?value=$ref' name='sale' value='$ref' ><i class='fas fa-hand-holding-usd' style='margin-right: 5%;'></i>Vender Peça</button>";
													}

													echo "</form>
													<form action='phpScripts/myclosetScript.php' method='POST' style='width:100%;height:50%;'>
														<button class='ButtonOption' name='delete' value='$ref'><i class='fas fa-trash' style='margin-right: 5%;'></i>Apagar Peça</button>
													</form>
													</div>
												</div>
											</div>
											<div class='theProductInfo'>
												<div class='inf'>
													<div class='infTitle'>
														<p>$productName</p>
													</div>
													<div class='infInf'>
														<div class='brand'>
															<p>$brand</p>
														</div>
													<div class='color'>
														<div class='colorCircle' style='background-color:$color';>

														</div>
													</div>
												</div>
											</div>
											<div id='options' class='dropdown'>
												<i class='fas fa-ellipsis-h $ref' style='cursor:pointer'></i>
											</div>
										</div>
									</div>";
								}
							}

						echo "</div>";
						echo "<div class='theRealPart' id='div015'>";

							$user = $_SESSION["username"];
							$productQuery = "select p.id, p.category, p.brand, p.color, p.utility from (select id,category, brand, color, utility from productsd UNION select id, name, brand, color, utility from productsu) p, storage s where p.id = s.idStore and s.idUtilizador='$user' AND (p.category='Camisa') ";

							$getProducts = mysqli_query($conn,$productQuery);

							if (!$getProducts)
								die("Error, select query failed:" . $productQuery);

							if(mysqli_num_rows($getProducts)>0) {
								while  ($row = mysqli_fetch_array($getProducts)) {
									$ref = $row['id'];
									$productName = $row['category'];
									$brand = $row['brand'];
									$color = $row['color'];
									$utility = $row['utility'];

									echo "<div class='theProduct'>
											<div class='theProductImage'>
												<div class='theImage' id='$ref'>
													<img id='teste' class='$ref' src='productsImage/$ref.jpg'>
													<div class='clickIcon'>
													<form style='width:100%;height:50%;'>";

													$prodQuery = "select * from venda2mao where idProduct='$ref'";

													$getProd = mysqli_query($conn,$prodQuery);

													if(mysqli_num_rows($getProd)>0) {
														echo "<button class='ButtonOption' formaction='' name='sale' value='$ref' style='opacity: 0.5;' disabled><i class='fas fa-hand-holding-usd' style='margin-right: 5%;'></i>Já se encontra à venda</button>";
													}
													else{
														echo "<button class='ButtonOption' formaction='addProductSale.php?value=$ref' name='sale' value='$ref' ><i class='fas fa-hand-holding-usd' style='margin-right: 5%;'></i>Vender Peça</button>";
													}

													echo "</form>
													<form action='phpScripts/myclosetScript.php' method='POST' style='width:100%;height:50%;'>
														<button class='ButtonOption' name='delete' value='$ref'><i class='fas fa-trash' style='margin-right: 5%;'></i>Apagar Peça</button>
													</form>
													</div>
												</div>
											</div>
											<div class='theProductInfo'>
												<div class='inf'>
													<div class='infTitle'>
														<p>$productName</p>
													</div>
													<div class='infInf'>
														<div class='brand'>
															<p>$brand</p>
														</div>
													<div class='color'>
														<div class='colorCircle' style='background-color:$color';>

														</div>
													</div>
												</div>
											</div>
											<div id='options' class='dropdown'>
												<i class='fas fa-ellipsis-h $ref'></i>
											</div>
										</div>
									</div>";
								}
							}

						echo "</div>";
						echo "<div class='theRealPart' id='div016'>";

							$user = $_SESSION["username"];
							$productQuery = "select p.id, p.category, p.brand, p.color, p.utility from (select id,category, brand, color, utility from productsd UNION select id, name, brand, color, utility from productsu) p, storage s where p.id = s.idStore and s.idUtilizador='$user' AND (p.category='Camisola'OR p.category='Malha')";

							$getProducts = mysqli_query($conn,$productQuery);

							if (!$getProducts)
								die("Error, select query failed:" . $productQuery);

							if(mysqli_num_rows($getProducts)>0) {
								while  ($row = mysqli_fetch_array($getProducts)) {
									$ref = $row['id'];
									$productName = $row['category'];
									$brand = $row['brand'];
									$color = $row['color'];
									$utility = $row['utility'];

									echo "<div class='theProduct'>
											<div class='theProductImage'>
												<div class='theImage' id='$ref'>
													<img id='teste' class='$ref' src='productsImage/$ref.jpg'>
													<div class='clickIcon'>
													<form style='width:100%;height:50%;'>";

													$prodQuery = "select * from venda2mao where idProduct='$ref'";

													$getProd = mysqli_query($conn,$prodQuery);

													if(mysqli_num_rows($getProd)>0) {
														echo "<button class='ButtonOption' formaction='' name='sale' value='$ref' style='opacity: 0.5;' disabled><i class='fas fa-hand-holding-usd' style='margin-right: 5%;'></i>Já se encontra à venda</button>";
													}
													else{
														echo "<button class='ButtonOption' formaction='addProductSale.php?value=$ref' name='sale' value='$ref' ><i class='fas fa-hand-holding-usd' style='margin-right: 5%;'></i>Vender Peça</button>";
													}

													echo "</form>
													<form action='phpScripts/myclosetScript.php' method='POST' style='width:100%;height:50%;'>
														<button class='ButtonOption' name='delete' value='$ref'><i class='fas fa-trash' style='margin-right: 5%;'></i>Apagar Peça</button>
													</form>
													</div>
												</div>
											</div>
											<div class='theProductInfo'>
												<div class='inf'>
													<div class='infTitle'>
														<p>$productName</p>
													</div>
													<div class='infInf'>
														<div class='brand'>
															<p>$brand</p>
														</div>
													<div class='color'>
														<div class='colorCircle' style='background-color:$color';>

														</div>
													</div>
												</div>
											</div>
											<div id='options' class='dropdown'>
												<i class='fas fa-ellipsis-h $ref'></i>
											</div>
										</div>
									</div>";
								}
							}

						echo "</div>";
						echo "<div class='theRealPart' id='div017'>";

							$user = $_SESSION["username"];
							$productQuery = "select p.id, p.category, p.brand, p.color, p.utility from (select id,category, brand, color, utility from productsd UNION select id, name, brand, color, utility from productsu) p, storage s where p.id = s.idStore and s.idUtilizador='$user' AND p.category='Sweatshirt'";

							$getProducts = mysqli_query($conn,$productQuery);

							if (!$getProducts)
								die("Error, select query failed:" . $productQuery);

							if(mysqli_num_rows($getProducts)>0) {
								while  ($row = mysqli_fetch_array($getProducts)) {
									$ref = $row['id'];
									$productName = $row['category'];
									$brand = $row['brand'];
									$color = $row['color'];
									$utility = $row['utility'];

									echo "<div class='theProduct'>
											<div class='theProductImage'>
												<div class='theImage' id='$ref'>
													<img id='teste' class='$ref' src='productsImage/$ref.jpg'>
													<div class='clickIcon'>
													<form style='width:100%;height:50%;'>";

													$prodQuery = "select * from venda2mao where idProduct='$ref'";

													$getProd = mysqli_query($conn,$prodQuery);

													if(mysqli_num_rows($getProd)>0) {
														echo "<button class='ButtonOption' formaction='' name='sale' value='$ref' style='opacity: 0.5;' disabled><i class='fas fa-hand-holding-usd' style='margin-right: 5%;'></i>Já se encontra à venda</button>";
													}
													else{
														echo "<button class='ButtonOption' formaction='addProductSale.php?value=$ref' name='sale' value='$ref' ><i class='fas fa-hand-holding-usd' style='margin-right: 5%;'></i>Vender Peça</button>";
													}

													echo "</form>
													<form action='phpScripts/myclosetScript.php' method='POST' style='width:100%;height:50%;'>
														<button class='ButtonOption' name='delete' value='$ref'><i class='fas fa-trash' style='margin-right: 5%;'></i>Apagar Peça</button>
													</form>
													</div>
												</div>
											</div>
											<div class='theProductInfo'>
												<div class='inf'>
													<div class='infTitle'>
														<p>$productName</p>
													</div>
													<div class='infInf'>
														<div class='brand'>
															<p>$brand</p>
														</div>
													<div class='color'>
														<div class='colorCircle' style='background-color:$color';>

														</div>
													</div>
												</div>
											</div>
											<div id='options' class='dropdown'>
												<i class='fas fa-ellipsis-h $ref'></i>
											</div>
										</div>
									</div>";
								}
							}

						echo "</div>";
						echo "<div class='theRealPart' id='div018'>";

							$user = $_SESSION["username"];
							$productQuery = "select p.id, p.category, p.brand, p.color, p.utility from (select id,category, brand, color, utility from productsd UNION select id, name, brand, color, utility from productsu) p, storage s where p.id = s.idStore and s.idUtilizador='$user' and (p.category='Casaco' OR p.category='Blusão')";

							$getProducts = mysqli_query($conn,$productQuery);

							if (!$getProducts)
								die("Error, select query failed:" . $productQuery);

							if(mysqli_num_rows($getProducts)>0) {
								while  ($row = mysqli_fetch_array($getProducts)) {
									$ref = $row['id'];
									$productName = $row['category'];
									$brand = $row['brand'];
									$color = $row['color'];
									$utility = $row['utility'];

									echo "<div class='theProduct'>
											<div class='theProductImage'>
												<div class='theImage' id='$ref'>
													<img id='teste' class='$ref' src='productsImage/$ref.jpg'>
													<div class='clickIcon'>
													<form style='width:100%;height:50%;'>";

													$prodQuery = "select * from venda2mao where idProduct='$ref'";

													$getProd = mysqli_query($conn,$prodQuery);

													if(mysqli_num_rows($getProd)>0) {
														echo "<button class='ButtonOption' formaction='' name='sale' value='$ref' style='opacity: 0.5;' disabled><i class='fas fa-hand-holding-usd' style='margin-right: 5%;'></i>Já se encontra à venda</button>";
													}
													else{
														echo "<button class='ButtonOption' formaction='addProductSale.php?value=$ref' name='sale' value='$ref' ><i class='fas fa-hand-holding-usd' style='margin-right: 5%;'></i>Vender Peça</button>";
													}

													echo "</form>
													<form action='phpScripts/myclosetScript.php' method='POST' style='width:100%;height:50%;'>
														<button class='ButtonOption' name='delete' value='$ref'><i class='fas fa-trash' style='margin-right: 5%;'></i>Apagar Peça</button>
													</form>
													</div>
												</div>
											</div>
											<div class='theProductInfo'>
												<div class='inf'>
													<div class='infTitle'>
														<p>$productName</p>
													</div>
													<div class='infInf'>
														<div class='brand'>
															<p>$brand</p>
														</div>
													<div class='color'>
														<div class='colorCircle' style='background-color:$color';>

														</div>
													</div>
												</div>
											</div>
											<div id='options' class='dropdown'>
												<i class='fas fa-ellipsis-h $ref'></i>
											</div>
										</div>
									</div>";
								}
							}

						echo "</div>";
						echo "<div class='theRealPart' id='div019'>";

							$user = $_SESSION["username"];
							$productQuery = "select p.id, p.category, p.brand, p.color, p.utility from (select id,category, brand, color, utility from productsd UNION select id, name, brand, color, utility from productsu) p, storage s where p.id = s.idStore and s.idUtilizador='$user' AND p.category='Blazer'";

							$getProducts = mysqli_query($conn,$productQuery);

							if (!$getProducts)
								die("Error, select query failed:" . $productQuery);

							if(mysqli_num_rows($getProducts)>0) {
								while  ($row = mysqli_fetch_array($getProducts)) {
									$ref = $row['id'];
									$productName = $row['category'];
									$brand = $row['brand'];
									$color = $row['color'];
									$utility = $row['utility'];

									echo "<div class='theProduct'>
											<div class='theProductImage'>
												<div class='theImage' id='$ref'>
													<img id='teste' class='$ref' src='productsImage/$ref.jpg'>
													<div class='clickIcon'>
													<form style='width:100%;height:50%;'>";

													$prodQuery = "select * from venda2mao where idProduct='$ref'";

													$getProd = mysqli_query($conn,$prodQuery);

													if(mysqli_num_rows($getProd)>0) {
														echo "<button class='ButtonOption' formaction='' name='sale' value='$ref' style='opacity: 0.5;' disabled><i class='fas fa-hand-holding-usd' style='margin-right: 5%;'></i>Já se encontra à venda</button>";
													}
													else{
														echo "<button class='ButtonOption' formaction='addProductSale.php?value=$ref' name='sale' value='$ref' ><i class='fas fa-hand-holding-usd' style='margin-right: 5%;'></i>Vender Peça</button>";
													}

													echo "</form>
													<form action='phpScripts/myclosetScript.php' method='POST' style='width:100%;height:50%;'>
														<button class='ButtonOption' name='delete' value='$ref'><i class='fas fa-trash' style='margin-right: 5%;'></i>Apagar Peça</button>
													</form>
													</div>
												</div>
											</div>
											<div class='theProductInfo'>
												<div class='inf'>
													<div class='infTitle'>
														<p>$productName</p>
													</div>
													<div class='infInf'>
														<div class='brand'>
															<p>$brand</p>
														</div>
													<div class='color'>
														<div class='colorCircle' style='background-color:$color';>

														</div>
													</div>
												</div>
											</div>
											<div id='options' class='dropdown'>
												<i class='fas fa-ellipsis-h $ref'></i>
											</div>
										</div>
									</div>";
								}
							}

						echo "</div>";
						echo "<div class='theRealPart' id='div020'>";

							$user = $_SESSION["username"];
							$productQuery = "select p.id, p.category, p.brand, p.color, p.utility from (select id,category, brand, color, utility from productsd UNION select id, name, brand, color, utility from productsu) p, storage s where p.id = s.idStore and s.idUtilizador='$user' AND p.category='Sobretudo'";

							$getProducts = mysqli_query($conn,$productQuery);

							if (!$getProducts)
								die("Error, select query failed:" . $productQuery);

							if(mysqli_num_rows($getProducts)>0) {
								while  ($row = mysqli_fetch_array($getProducts)) {
									$ref = $row['id'];
									$productName = $row['category'];
									$brand = $row['brand'];
									$color = $row['color'];
									$utility = $row['utility'];

									echo "<div class='theProduct'>
											<div class='theProductImage'>
												<div class='theImage' id='$ref'>
													<img id='teste' class='$ref' src='productsImage/$ref.jpg'>
													<div class='clickIcon'>
													<form style='width:100%;height:50%;'>";

													$prodQuery = "select * from venda2mao where idProduct='$ref'";

													$getProd = mysqli_query($conn,$prodQuery);

													if(mysqli_num_rows($getProd)>0) {
														echo "<button class='ButtonOption' formaction='' name='sale' value='$ref' style='opacity: 0.5;' disabled><i class='fas fa-hand-holding-usd' style='margin-right: 5%;'></i>Já se encontra à venda</button>";
													}
													else{
														echo "<button class='ButtonOption' formaction='addProductSale.php?value=$ref' name='sale' value='$ref' ><i class='fas fa-hand-holding-usd' style='margin-right: 5%;'></i>Vender Peça</button>";
													}

													echo "</form>
													<form action='phpScripts/myclosetScript.php' method='POST' style='width:100%;height:50%;'>
														<button class='ButtonOption' name='delete' value='$ref'><i class='fas fa-trash' style='margin-right: 5%;'></i>Apagar Peça</button>
													</form>
													</div>
												</div>
											</div>
											<div class='theProductInfo'>
												<div class='inf'>
													<div class='infTitle'>
														<p>$productName</p>
													</div>
													<div class='infInf'>
														<div class='brand'>
															<p>$brand</p>
														</div>
													<div class='color'>
														<div class='colorCircle' style='background-color:$color';>

														</div>
													</div>
												</div>
											</div>
											<div id='options' class='dropdown'>
												<i class='fas fa-ellipsis-h $ref'></i>
											</div>
										</div>
									</div>";
								}
							}

						echo "</div>";
						echo "<div class='theRealPart' id='div021'>";

							$user = $_SESSION["username"];
							$productQuery = "select p.id, p.category, p.brand, p.color, p.utility from (select id,category, brand, color, utility from productsd UNION select id, name, brand, color, utility from productsu) p, storage s where p.id = s.idStore and s.idUtilizador='$user' AND (p.category='Calças' OR p.category='Jeans' OR p.category='Calções')";

							$getProducts = mysqli_query($conn,$productQuery);

							if (!$getProducts)
								die("Error, select query failed:" . $productQuery);

							if(mysqli_num_rows($getProducts)>0) {
								while  ($row = mysqli_fetch_array($getProducts)) {
									$ref = $row['id'];
									$productName = $row['category'];
									$brand = $row['brand'];
									$color = $row['color'];
									$utility = $row['utility'];

									echo "<div class='theProduct'>
											<div class='theProductImage'>
												<div class='theImage' id='$ref'>
													<img id='teste' class='$ref' src='productsImage/$ref.jpg'>
													<div class='clickIcon'>
													<form style='width:100%;height:50%;'>";

													$prodQuery = "select * from venda2mao where idProduct='$ref'";

													$getProd = mysqli_query($conn,$prodQuery);

													if(mysqli_num_rows($getProd)>0) {
														echo "<button class='ButtonOption' formaction='' name='sale' value='$ref' style='opacity: 0.5;' disabled><i class='fas fa-hand-holding-usd' style='margin-right: 5%;'></i>Já se encontra à venda</button>";
													}
													else{
														echo "<button class='ButtonOption' formaction='addProductSale.php?value=$ref' name='sale' value='$ref' ><i class='fas fa-hand-holding-usd' style='margin-right: 5%;'></i>Vender Peça</button>";
													}

													echo "</form>
													<form action='phpScripts/myclosetScript.php' method='POST' style='width:100%;height:50%;'>
														<button class='ButtonOption' name='delete' value='$ref'><i class='fas fa-trash' style='margin-right: 5%;'></i>Apagar Peça</button>
													</form>
													</div>
												</div>
											</div>
											<div class='theProductInfo'>
												<div class='inf'>
													<div class='infTitle'>
														<p>$productName</p>
													</div>
													<div class='infInf'>
														<div class='brand'>
															<p>$brand</p>
														</div>
													<div class='color'>
														<div class='colorCircle' style='background-color:$color';>

														</div>
													</div>
												</div>
											</div>
											<div id='options' class='dropdown'>
												<i class='fas fa-ellipsis-h $ref'></i>
											</div>
										</div>
									</div>";
								}
							}

						echo "</div>";
						echo "<div class='theRealPart' id='div022'>";

							$user = $_SESSION["username"];
							$productQuery = "select p.id, p.category, p.brand, p.color, p.utility from (select id,category, brand, color, utility from productsd UNION select id, name, brand, color, utility from productsu) p, storage s where p.id = s.idStore and s.idUtilizador='$user' AND p.category='Fato de Banho'";

							$getProducts = mysqli_query($conn,$productQuery);

							if (!$getProducts)
								die("Error, select query failed:" . $productQuery);

							if(mysqli_num_rows($getProducts)>0) {
								while  ($row = mysqli_fetch_array($getProducts)) {
									$ref = $row['id'];
									$productName = $row['category'];
									$brand = $row['brand'];
									$color = $row['color'];
									$utility = $row['utility'];

									echo "<div class='theProduct'>
											<div class='theProductImage'>
												<div class='theImage' id='$ref'>
													<img id='teste' class='$ref' src='productsImage/$ref.jpg'>
													<div class='clickIcon'>
													<form style='width:100%;height:50%;'>";

													$prodQuery = "select * from venda2mao where idProduct='$ref'";

													$getProd = mysqli_query($conn,$prodQuery);

													if(mysqli_num_rows($getProd)>0) {
														echo "<button class='ButtonOption' formaction='' name='sale' value='$ref' style='opacity: 0.5;' disabled><i class='fas fa-hand-holding-usd' style='margin-right: 5%;'></i>Já se encontra à venda</button>";
													}
													else{
														echo "<button class='ButtonOption' formaction='addProductSale.php?value=$ref' name='sale' value='$ref' ><i class='fas fa-hand-holding-usd' style='margin-right: 5%;'></i>Vender Peça</button>";
													}

													echo "</form>
													<form action='phpScripts/myclosetScript.php' method='POST' style='width:100%;height:50%;'>
														<button class='ButtonOption' name='delete' value='$ref'><i class='fas fa-trash' style='margin-right: 5%;'></i>Apagar Peça</button>
													</form>
													</div>
												</div>
											</div>
											<div class='theProductInfo'>
												<div class='inf'>
													<div class='infTitle'>
														<p>$productName</p>
													</div>
													<div class='infInf'>
														<div class='brand'>
															<p>$brand</p>
														</div>
													<div class='color'>
														<div class='colorCircle' style='background-color:$color';>

														</div>
													</div>
												</div>
											</div>
											<div id='options' class='dropdown'>
												<i class='fas fa-ellipsis-h $ref'></i>
											</div>
										</div>
									</div>";
								}
							}

						echo "</div>";
						echo "<div class='theRealPart' id='div023'>";

								$user = $_SESSION["username"];
								$productQuery = "select p.id, p.category, p.brand, p.color, p.utility from (select id,category, brand, color, utility from productsd UNION select id, name, brand, color, utility from productsu) p, storage s where p.id = s.idStore and s.idUtilizador='$user' AND (p.category='Ténis' OR p.category='Sapatos Social' OR p.category='Botas' OR p.category='Sandálias' OR p.category='Chinelos')";

								$getProducts = mysqli_query($conn,$productQuery);

								if (!$getProducts)
									die("Error, select query failed:" . $productQuery);

								if(mysqli_num_rows($getProducts)>0) {
									while  ($row = mysqli_fetch_array($getProducts)) {
										$ref = $row['id'];
										$productName = $row['category'];
										$brand = $row['brand'];
										$color = $row['color'];
										$utility = $row['utility'];

										echo "<div class='theProduct'>
												<div class='theProductImage'>
													<div class='theImage' id='$ref'>
														<img id='teste' class='$ref' src='productsImage/$ref.jpg'>
														<div class='clickIcon'>
														<form style='width:100%;height:50%;'>";

														$prodQuery = "select * from venda2mao where idProduct='$ref'";

														$getProd = mysqli_query($conn,$prodQuery);

														if(mysqli_num_rows($getProd)>0) {
															echo "<button class='ButtonOption' formaction='' name='sale' value='$ref' style='opacity: 0.5;' disabled><i class='fas fa-hand-holding-usd' style='margin-right: 5%;'></i>Já se encontra à venda</button>";
														}
														else{
															echo "<button class='ButtonOption' formaction='addProductSale.php?value=$ref' name='sale' value='$ref' ><i class='fas fa-hand-holding-usd' style='margin-right: 5%;'></i>Vender Peça</button>";
														}

														echo "</form>
														<form action='phpScripts/myclosetScript.php' method='POST' style='width:100%;height:50%;'>
															<button class='ButtonOption' name='delete' value='$ref'><i class='fas fa-trash' style='margin-right: 5%;'></i>Apagar Peça</button>
														</form>
														</div>
													</div>
												</div>
												<div class='theProductInfo'>
													<div class='inf'>
														<div class='infTitle'>
															<p>$productName</p>
														</div>
														<div class='infInf'>
															<div class='brand'>
																<p>$brand</p>
															</div>
														<div class='color'>
															<div class='colorCircle' style='background-color:$color';>

															</div>
														</div>
													</div>
												</div>
												<div id='options' class='dropdown'>
													<i class='fas fa-ellipsis-h $ref'></i>
												</div>
											</div>
										</div>";
									}
								}

						echo "</div>";
						echo "<div class='theRealPart' id='div024'>";

								$user = $_SESSION["username"];
								$productQuery = "select p.id, p.category, p.brand, p.color, p.utility from (select id,category, brand, color, utility from productsd UNION select id, name, brand, color, utility from productsu) p, storage s where p.id = s.idStore and s.idUtilizador='$user' AND (p.category='Pulseira' OR p.category='Relógio' OR p.category='Óculos' OR p.category='Mala' OR p.category='Gravata' OR p.category='Chapeu' OR p.category='Cinto' OR p.category='Laço' OR p.category='Cachecol')";

								$getProducts = mysqli_query($conn,$productQuery);

								if (!$getProducts)
									die("Error, select query failed:" . $productQuery);

								if(mysqli_num_rows($getProducts)>0) {
									while  ($row = mysqli_fetch_array($getProducts)) {
										$ref = $row['id'];
										$productName = $row['category'];
										$brand = $row['brand'];
										$color = $row['color'];
										$utility = $row['utility'];

										echo "<div class='theProduct'>
												<div class='theProductImage'>
													<div class='theImage' id='$ref'>
														<img id='teste' class='$ref' src='productsImage/$ref.jpg'>
														<div class='clickIcon'>
														<form style='width:100%;height:50%;'>";

														$prodQuery = "select * from venda2mao where idProduct='$ref'";

														$getProd = mysqli_query($conn,$prodQuery);

														if(mysqli_num_rows($getProd)>0) {
															echo "<button class='ButtonOption' formaction='' name='sale' value='$ref' style='opacity: 0.5;' disabled><i class='fas fa-hand-holding-usd' style='margin-right: 5%;'></i>Já se encontra à venda</button>";
														}
														else{
															echo "<button class='ButtonOption' formaction='addProductSale.php?value=$ref' name='sale' value='$ref' ><i class='fas fa-hand-holding-usd' style='margin-right: 5%;'></i>Vender Peça</button>";
														}

														echo "</form>
														<form action='phpScripts/myclosetScript.php' method='POST' style='width:100%;height:50%;'>
															<button class='ButtonOption' name='delete' value='$ref'><i class='fas fa-trash' style='margin-right: 5%;'></i>Apagar Peça</button>
														</form>
														</div>
													</div>
												</div>
												<div class='theProductInfo'>
													<div class='inf'>
														<div class='infTitle'>
															<p>$productName</p>
														</div>
														<div class='infInf'>
															<div class='brand'>
																<p>$brand</p>
															</div>
														<div class='color'>
															<div class='colorCircle' style='background-color:$color';>

															</div>
														</div>
													</div>
												</div>
												<div id='options' class='dropdown'>
													<i class='fas fa-ellipsis-h $ref'></i>
												</div>
											</div>
										</div>";
									}
								}

						echo "</div>";
						echo "<div class='theRealPart' id='div026'>";

								$user = $_SESSION["username"];
								$productQuery = "select prd.id, prd.name, prd.category, prd.brand, prd.color, prd.utility from productsd prd, storage s where prd.id = s.idStore and s.idUtilizador = '$user'";

								$getProducts = mysqli_query($conn,$productQuery);

								if (!$getProducts)
									die("Error, select query failed:" . $productQuery);

								if(mysqli_num_rows($getProducts)>0) {
									while  ($row = mysqli_fetch_array($getProducts)) {
										$ref = $row['id'];
										$productName = $row['category'];
										$brand = $row['brand'];
										$color = $row['color'];
										$utility = $row['utility'];

										echo "<div class='theProduct'>
												<div class='theProductImage'>
													<div class='theImage' id='$ref'>
														<img id='teste' class='$ref' src='productsImage/$ref.jpg'>
														<div class='clickIcon'>
														<form style='width:100%;height:50%;'>";

														$prodQuery = "select * from venda2mao where idProduct='$ref'";

														$getProd = mysqli_query($conn,$prodQuery);

														if(mysqli_num_rows($getProd)>0) {
															echo "<button class='ButtonOption' formaction='' name='sale' value='$ref' style='opacity: 0.5;' disabled><i class='fas fa-hand-holding-usd' style='margin-right: 5%;'></i>Já se encontra à venda</button>";
														}
														else{
															echo "<button class='ButtonOption' formaction='addProductSale.php?value=$ref' name='sale' value='$ref' ><i class='fas fa-hand-holding-usd' style='margin-right: 5%;'></i>Vender Peça</button>";
														}

														echo "</form>
														<form action='phpScripts/myclosetScript.php' method='POST' style='width:100%;height:50%;'>
															<button class='ButtonOption' name='delete' value='$ref'><i class='fas fa-trash' style='margin-right: 5%;'></i>Apagar Peça</button>
														</form>
														</div>
													</div>
												</div>
												<div class='theProductInfo'>
													<div class='inf'>
														<div class='infTitle'>
															<p>$productName</p>
														</div>
														<div class='infInf'>
															<div class='brand'>
																<p>$brand</p>
															</div>
														<div class='color'>
															<div class='colorCircle' style='background-color:$color';>

															</div>
														</div>
													</div>
												</div>
												<div id='options' class='dropdown'>
													<i class='fas fa-ellipsis-h $ref'></i>
												</div>
											</div>
										</div>";
									}
								}

						echo "</div>";
					}
					?>
				</div>
			</div>
			<div id="looks">
				<div id="theLooks">
					<div id="searchCloset">
						<div id="divA">
							<a id="insideA" class="Acc"><i style="margin-right:3%;" class="icofont-plus"></i>Criar Look</a>
							<a id="insideB"><i style="margin-right:3%;" class="icofont-search-2"></i>Visualizar Looks</a>
						</div>
					</div>
					<div id="theRealLook1" class="Acc1">
						<div id="lookN">
							<div id="looknSelect">
								<select class="form-control" name="numberPeças" id="npecas" required>
									<option selected disabled>Nº de peças</option>
									<option value="3pecas">3 peças</option>
									<option value="4pecas">4 peças</option>
									<option value="5pecas">5 peças</option>
									<option value="6pecas">6 peças</option>
								</select>
							</div>
						</div>
						<div id="lookConstruct">
							<div id="div3images">
								<form class="formLook" action="<?=htmlspecialchars(stripslashes(trim("phpScripts/myclosetScript.php")));?>" method="post" enctype="multipart/form-data">
									<div class="imagesClick">
										<div class="divImagem3" id="div1_divImagem3">
											<input type="text" id="div1_divImagem3_input" name="value1_3" value="">
										</div>
										<div class="divImagem3" id="div2_divImagem3">
											<input type="text" id="div2_divImagem3_input" name="value2_3" value="">
										</div>
										<div class="divImagem3" id="div3_divImagem3">
											<input type="text" id="div3_divImagem3_input" name="value3_3" value="">
										</div>
									</div>
									<div class="submitClick">
										<div class="ladoEsquerdo">
											<input type="text" class="form-control" name="nameLook1" placeholder="Nome do Look">
											<select class="form-control" name="typeLook1" id="npecas" required>
												<option selected disabled>Tipo</option>
												<option value="Dia-a-Dia">Dia-a-Dia</option>
												<option value="Festa">Festa</option>
												<option value="Formal">Formal</option>
												<option value="Desporto">Desporto</option>
											</select>
										</div>
										<div class="ladoDireito">
											<input style="width: 40%; height: 2.5em; margin-left: 30%; margin-top:9%;" type="submit" class="btn" name="adicionarLook3" value="Adicionar">
										</div>
									</div>
								<form>
							</div>
							<div id="div4images">
								<form class="formLook" action="<?=htmlspecialchars(stripslashes(trim("phpScripts/myclosetScript.php")));?>" method="post" enctype="multipart/form-data">
									<div class="imagesClick">
										<div class="divImagem4" id="div1_divImagem4">
											<input type="text" id="div1_divImagem4_input" name="value1_4" value="">
										</div>
										<div class="divImagem4" id="div2_divImagem4">
											<input type="text" id="div2_divImagem4_input" name="value2_4" value="">
										</div>
										<div class="divImagem4" id="div3_divImagem4">
											<input type="text" id="div3_divImagem3_input" name="value3_4" value="">
										</div>
										<div class="divImagem4" id="div4_divImagem4">
											<input type="text" id="div4_divImagem3_input" name="value4_4" value="">
										</div>
									</div>
									<div class="submitClick">
									<div class="ladoEsquerdo">
											<input type="text" class="form-control" name="nameLook2" placeholder="Nome do Look">
											<select class="form-control" name="typeLook2" id="npecas" required>
												<option selected disabled>Tipo</option>
												<option value="Dia-a-Dia">Dia-a-Dia</option>
												<option value="Festa">Festa</option>
												<option value="Formal">Formal</option>
												<option value="Desporto">Desporto</option>
											</select>
										</div>
										<div class="ladoDireito">
											<input style="width: 40%; height: 2.5em; margin-left: 30%; margin-top:9%;" type="submit" class="btn" name="adicionarLook4" value="Adicionar">
										</div>
									</div>
								</form>
							</div>
							<div id="div5images">
								<form class="formLook" action="<?=htmlspecialchars(stripslashes(trim("phpScripts/myclosetScript.php")));?>" method="post" enctype="multipart/form-data">
									<div class="imagesClick">
										<div class="parteCima">
											<div class="divImagem5" id="div1_divImagem5">
												<input type="text" id="div1_divImagem5_input" name="value1_5" value="">
											</div>
											<div class="divImagem5" id="div2_divImagem5">
												<input type="text" id="div2_divImagem5_input" name="value2_5" value="">
											</div>
											<div class="divImagem5" id="div3_divImagem5">
												<input type="text" id="div3_divImagem5_input" name="value3_5" value="">
											</div>
										</div>
										<div class="parteBaixo">
											<div class="divImagem5" id="div4_divImagem5">
												<input type="text" id="div4_divImagem5_input" name="value4_5" value="">
											</div>
											<div class="divImagem5" id="div5_divImagem5">
												<input type="text" id="div5_divImagem5_input" name="value5_5" value="">
											</div>
										</div>
									</div>
									<div class="submitClick">
									<div class="ladoEsquerdo">
											<input type="text" class="form-control" name="nameLook3" placeholder="Nome do Look">
											<select class="form-control" name="typeLook3" id="npecas" required>
												<option selected disabled>Tipo</option>
												<option value="Dia-a-Dia">Dia-a-Dia</option>
												<option value="Festa">Festa</option>
												<option value="Formal">Formal</option>
												<option value="Desporto">Desporto</option>
											</select>
										</div>
										<div class="ladoDireito">
											<input style="width: 40%; height: 2.5em; margin-left: 30%; margin-top:9%;" type="submit" class="btn" name="adicionarLook5" value="Adicionar">
										</div>
									</div>
								</form>
							</div>
							<div id="div6images">
								<form class="formLook" action="<?=htmlspecialchars(stripslashes(trim("phpScripts/myclosetScript.php")));?>" method="post" enctype="multipart/form-data">
									<div class="imagesClick">
										<div class="parteCima">
											<div class="divImagem6" id="div1_divImagem6">
												<input type="text" id="div1_divImagem6_input" name="value1_6" value="">
											</div>
											<div class="divImagem6" id="div2_divImagem6">
												<input type="text" id="div2_divImagem6_input" name="value2_6" value="">
											</div>
											<div class="divImagem6" id="div3_divImagem6">
												<input type="text" id="div3_divImagem6_input" name="value3_6" value="">
											</div>
										</div>
										<div class="parteBaixo">
											<div class="divImagem6" id="div4_divImagem6">
												<input type="text" id="div4_divImagem6_input" name="value4_6" value="">
											</div>
											<div class="divImagem6" id="div5_divImagem6">
												<input type="text" id="div5_divImagem6_input" name="value5_6" value="">
											</div>
											<div class="divImagem6" id="div6_divImagem6">
												<input type="text" id="div6_divImagem6_input" name="value6_6" value="">
											</div>
										</div>
									</div>
									<div class="submitClick">
									<div class="ladoEsquerdo">
											<input type="text" class="form-control" name="nameLook4" placeholder="Nome do Look">
											<select class="form-control" name="typeLook4" id="npecas" required>
												<option selected disabled>Tipo</option>
												<option value="Dia-a-Dia">Dia-a-Dia</option>
												<option value="Festa">Festa</option>
												<option value="Formal">Formal</option>
												<option value="Desporto">Desporto</option>
											</select>
										</div>
										<div class="ladoDireito">
											<input style="width: 40%; height: 2.5em; margin-left: 30%; margin-top:9%;" type="submit" class="btn" name="adicionarLook6" value="Adicionar">
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
					<div id="theRealLook2">
						<div class="divType" id="parteDiaDia">
							<img src="img/diaadia.png">
						</div>
						<div class="divType" id="parteFesta">
							<img src="img/party.png">
						</div>
						<div class="divType" id="parteFormal">
							<img src="img/formal.png">
						</div>
						<div class="divType" id="parteDesporto">
							<img src="img/desporto.png">
						</div>
					</div>
					<div id="looksDiaDia">
						<div class="parteCimaCont">
							<div class="parteVoltar">
								<div class="parteVoltarI">
									<i class="icofont-thin-left"></i><p>Voltar</p>
								</div>
							</div>
							<div class="parteImagem">
								<div class="parteImagemI">
									<img src="img/diaadia.png">
								</div>
							</div>
						</div>
						<div class="parteBaixoCont">
						<?php
								$user = $_SESSION["username"];
								$lookQuery = "select * from looks where idUtilizador ='$user' and typeLook='Dia-a-Dia'";

								$getLooks = mysqli_query($conn,$lookQuery);


								if (!$getLooks)
									die("Error, select query failed:" . $lookQuery);

								if(mysqli_num_rows($getLooks)>0) {
									while  ($row = mysqli_fetch_array($getLooks)) {
											if (empty($row[7]) && empty($row[8]) && empty($row[9])){
												echo "<div class='theLook'>
													<div class='nameLook'>
														<p style='margin: 0;font-weight: 100;color: black;text-align: center;padding-top: 2%;'>Look name: ".$row[2]."</p>
													</div>
													<div class='lookContainer'>
														<div class='lookLook1' >
															<img src='".$row[4]."'>
														</div>
														<div class='lookLook1'>
															<img src='".$row[5]."'>
														</div>
														<div class='lookLook1'>
															<img src='".$row[6]."'>
														</div>
													</div>
												</div>";
											}
											else if (empty($row[8]) && empty($row[9])){
												echo "<div class='theLook'>
													<div class='nameLook'>
														<p style='margin: 0;font-weight: 100;color: black;text-align: center;padding-top: 2%;'>Look name: ".$row[2]."</p>
													</div>
													<div class='lookContainer'>
														<div class='lookLook2' >
															<img src='".$row[4]."'>
														</div>
														<div class='lookLook2'>
															<img src='".$row[5]."'>
														</div>
														<div class='lookLook2'>
															<img src='".$row[6]."'>
														</div>
														<div class='lookLook2'>
															<img src='".$row[7]."'>
														</div>
													</div>
												</div>";
											}
											else if (empty($row[9])){
												echo "<div class='theLook'>
												<div class='nameLook'>
													<p style='margin: 0;font-weight: 100;color: black;text-align: center;padding-top: 2%;'>Look name: ".$row[2]."</p>
												</div>
												<div class='lookContainer'>
													<div class='lookLook3' >
														<img src='".$row[4]."'>
													</div>
													<div class='lookLook3'>
														<img src='".$row[5]."'>
													</div>
													<div class='lookLook3'>
														<img src='".$row[6]."'>
													</div>
													<div class='lookLook3'>
														<img src='".$row[7]."'>
													</div>
													<div class='lookLook3'>
														<img src='".$row[8]."'>
													</div>
												</div>
											</div>";
											}
											else{
												echo "<div class='theLook'>
												<div class='nameLook'>
													<p style='margin: 0;font-weight: 100;color: black;text-align: center;padding-top: 2%;'>Look name: ".$row[2]."</p>
												</div>
												<div class='lookContainer'>
													<div class='lookLook4' >
														<img src='".$row[4]."'>
													</div>
													<div class='lookLook4'>
														<img src='".$row[5]."'>
													</div>
													<div class='lookLook4'>
														<img src='".$row[6]."'>
													</div>
													<div class='lookLook4'>
														<img src='".$row[7]."'>
													</div>
													<div class='lookLook4'>
														<img src='".$row[8]."'>
													</div>
													<div class='lookLook4'>
														<img src='".$row[9]."'>
													</div>
												</div>
											</div>";
											}
									}
								}
							?>
						</div>
					</div>
					<div id="looksFesta">
					<div class="parteCimaCont">
							<div class="parteVoltar">
								<div class="parteVoltarI">
									<i class="icofont-thin-left"></i><p>Voltar</p>
								</div>
							</div>
							<div class="parteImagem">
								<div class="parteImagemI">
									<img src="img/party.png">
								</div>
							</div>
						</div>
						<div class="parteBaixoCont">
							<?php
								$user = $_SESSION["username"];
								$lookQuery = "select * from looks where idUtilizador ='$user' and typeLook='Festa'";

								$getLooks = mysqli_query($conn,$lookQuery);


								if (!$getLooks)
									die("Error, select query failed:" . $lookQuery);

								if(mysqli_num_rows($getLooks)>0) {
									while  ($row = mysqli_fetch_array($getLooks)) {
											if (empty($row[7]) && empty($row[8]) && empty($row[9])){
												echo "<div class='theLook'>
													<div class='nameLook'>
														<p style='margin: 0;font-weight: 100;color: black;text-align: center;padding-top: 2%;'>Look name: ".$row[2]."</p>
													</div>
													<div class='lookContainer'>
														<div class='lookLook1' >
															<img src='".$row[4]."'>
														</div>
														<div class='lookLook1'>
															<img src='".$row[5]."'>
														</div>
														<div class='lookLook1'>
															<img src='".$row[6]."'>
														</div>
													</div>
												</div>";
											}
											else if (empty($row[8]) && empty($row[9])){
												echo "<div class='theLook'>
													<div class='nameLook'>
														<p style='margin: 0;font-weight: 100;color: black;text-align: center;padding-top: 2%;'>Look name: ".$row[2]."</p>
													</div>
													<div class='lookContainer'>
														<div class='lookLook2' >
															<img src='".$row[4]."'>
														</div>
														<div class='lookLook2'>
															<img src='".$row[5]."'>
														</div>
														<div class='lookLook2'>
															<img src='".$row[6]."'>
														</div>
														<div class='lookLook2'>
															<img src='".$row[7]."'>
														</div>
													</div>
												</div>";
											}
											else if (empty($row[9])){
												echo "<div class='theLook'>
												<div class='nameLook'>
													<p style='margin: 0;font-weight: 100;color: black;text-align: center;padding-top: 2%;'>Look name: ".$row[2]."</p>
												</div>
												<div class='lookContainer'>
													<div class='lookLook3' >
														<img src='".$row[4]."'>
													</div>
													<div class='lookLook3'>
														<img src='".$row[5]."'>
													</div>
													<div class='lookLook3'>
														<img src='".$row[6]."'>
													</div>
													<div class='lookLook3'>
														<img src='".$row[7]."'>
													</div>
													<div class='lookLook3'>
														<img src='".$row[8]."'>
													</div>
												</div>
											</div>";
											}
											else{
												echo "<div class='theLook'>
												<div class='nameLook'>
													<p style='margin: 0;font-weight: 100;color: black;text-align: center;padding-top: 2%;'>Look name: ".$row[2]."</p>
												</div>
												<div class='lookContainer'>
													<div class='lookLook4' >
														<img src='".$row[4]."'>
													</div>
													<div class='lookLook4'>
														<img src='".$row[5]."'>
													</div>
													<div class='lookLook4'>
														<img src='".$row[6]."'>
													</div>
													<div class='lookLook4'>
														<img src='".$row[7]."'>
													</div>
													<div class='lookLook4'>
														<img src='".$row[8]."'>
													</div>
													<div class='lookLook4'>
														<img src='".$row[9]."'>
													</div>
												</div>
											</div>";
											}
									}
								}
							?>
						</div>
					</div>
					<div id="looksFormal">
					<div class="parteCimaCont">
							<div class="parteVoltar">
								<div class="parteVoltarI">
									<i class="icofont-thin-left"></i><p>Voltar</p>
								</div>
							</div>
							<div class="parteImagem">
								<div class="parteImagemI">
									<img src="img/formal.png">
								</div>
							</div>
						</div>
						<div class="parteBaixoCont">
						<?php
								$user = $_SESSION["username"];
								$lookQuery = "select * from looks where idUtilizador ='$user' and typeLook='Formal'";

								$getLooks = mysqli_query($conn,$lookQuery);


								if (!$getLooks)
									die("Error, select query failed:" . $lookQuery);

								if(mysqli_num_rows($getLooks)>0) {
									while  ($row = mysqli_fetch_array($getLooks)) {
											if (empty($row[7]) && empty($row[8]) && empty($row[9])){
												echo "<div class='theLook'>
													<div class='nameLook'>
														<p style='margin: 0;font-weight: 100;color: black;text-align: center;padding-top: 2%;'>Look name: ".$row[2]."</p>
													</div>
													<div class='lookContainer'>
														<div class='lookLook1' >
															<img src='".$row[4]."'>
														</div>
														<div class='lookLook1'>
															<img src='".$row[5]."'>
														</div>
														<div class='lookLook1'>
															<img src='".$row[6]."'>
														</div>
													</div>
												</div>";
											}
											else if (empty($row[8]) && empty($row[9])){
												echo "<div class='theLook'>
													<div class='nameLook'>
														<p style='margin: 0;font-weight: 100;color: black;text-align: center;padding-top: 2%;'>Look name: ".$row[2]."</p>
													</div>
													<div class='lookContainer'>
														<div class='lookLook2' >
															<img src='".$row[4]."'>
														</div>
														<div class='lookLook2'>
															<img src='".$row[5]."'>
														</div>
														<div class='lookLook2'>
															<img src='".$row[6]."'>
														</div>
														<div class='lookLook2'>
															<img src='".$row[7]."'>
														</div>
													</div>
												</div>";
											}
											else if (empty($row[9])){
												echo "<div class='theLook'>
												<div class='nameLook'>
													<p style='margin: 0;font-weight: 100;color: black;text-align: center;padding-top: 2%;'>Look name: ".$row[2]."</p>
												</div>
												<div class='lookContainer'>
													<div class='lookLook3' >
														<img src='".$row[4]."'>
													</div>
													<div class='lookLook3'>
														<img src='".$row[5]."'>
													</div>
													<div class='lookLook3'>
														<img src='".$row[6]."'>
													</div>
													<div class='lookLook3'>
														<img src='".$row[7]."'>
													</div>
													<div class='lookLook3'>
														<img src='".$row[8]."'>
													</div>
												</div>
											</div>";
											}
											else{
												echo "<div class='theLook'>
												<div class='nameLook'>
													<p style='margin: 0;font-weight: 100;color: black;text-align: center;padding-top: 2%;'>Look name: ".$row[2]."</p>
												</div>
												<div class='lookContainer'>
													<div class='lookLook4' >
														<img src='".$row[4]."'>
													</div>
													<div class='lookLook4'>
														<img src='".$row[5]."'>
													</div>
													<div class='lookLook4'>
														<img src='".$row[6]."'>
													</div>
													<div class='lookLook4'>
														<img src='".$row[7]."'>
													</div>
													<div class='lookLook4'>
														<img src='".$row[8]."'>
													</div>
													<div class='lookLook4'>
														<img src='".$row[9]."'>
													</div>
												</div>
											</div>";
											}
									}
								}
							?>
						</div>
					</div>
					<div id="looksDesporto">
					<div class="parteCimaCont">
							<div class="parteVoltar">
								<div class="parteVoltarI">
									<i class="icofont-thin-left"></i><p>Voltar</p>
								</div>
							</div>
							<div class="parteImagem">
								<div class="parteImagemI">
									<img src="img/desporto.png">
								</div>
							</div>
						</div>
						<div class="parteBaixoCont">
						<?php
								$user = $_SESSION["username"];
								$lookQuery = "select * from looks where idUtilizador ='$user' and typeLook='Desporto'";

								$getLooks = mysqli_query($conn,$lookQuery);


								if (!$getLooks)
									die("Error, select query failed:" . $lookQuery);

								if(mysqli_num_rows($getLooks)>0) {
									while  ($row = mysqli_fetch_array($getLooks)) {
											if (empty($row[7]) && empty($row[8]) && empty($row[9])){
												echo "<div class='theLook'>
													<div class='nameLook'>
														<p style='margin: 0;font-weight: 100;color: black;text-align: center;padding-top: 2%;'>Look name: ".$row[2]."</p>
													</div>
													<div class='lookContainer'>
														<div class='lookLook1' >
															<img src='".$row[4]."'>
														</div>
														<div class='lookLook1'>
															<img src='".$row[5]."'>
														</div>
														<div class='lookLook1'>
															<img src='".$row[6]."'>
														</div>
													</div>
												</div>";
											}
											else if (empty($row[8]) && empty($row[9])){
												echo "<div class='theLook'>
													<div class='nameLook'>
														<p style='margin: 0;font-weight: 100;color: black;text-align: center;padding-top: 2%;'>Look name: ".$row[2]."</p>
													</div>
													<div class='lookContainer'>
														<div class='lookLook2' >
															<img src='".$row[4]."'>
														</div>
														<div class='lookLook2'>
															<img src='".$row[5]."'>
														</div>
														<div class='lookLook2'>
															<img src='".$row[6]."'>
														</div>
														<div class='lookLook2'>
															<img src='".$row[7]."'>
														</div>
													</div>
												</div>";
											}
											else if (empty($row[9])){
												echo "<div class='theLook'>
												<div class='nameLook'>
													<p style='margin: 0;font-weight: 100;color: black;text-align: center;padding-top: 2%;'>Look name: ".$row[2]."</p>
												</div>
												<div class='lookContainer'>
													<div class='lookLook3' >
														<img src='".$row[4]."'>
													</div>
													<div class='lookLook3'>
														<img src='".$row[5]."'>
													</div>
													<div class='lookLook3'>
														<img src='".$row[6]."'>
													</div>
													<div class='lookLook3'>
														<img src='".$row[7]."'>
													</div>
													<div class='lookLook3'>
														<img src='".$row[8]."'>
													</div>
												</div>
											</div>";
											}
											else{
												echo "<div class='theLook'>
												<div class='nameLook'>
													<p style='margin: 0;font-weight: 100;color: black;text-align: center;padding-top: 2%;'>Look name: ".$row[2]."</p>
												</div>
												<div class='lookContainer'>
													<div class='lookLook4' >
														<img src='".$row[4]."'>
													</div>
													<div class='lookLook4'>
														<img src='".$row[5]."'>
													</div>
													<div class='lookLook4'>
														<img src='".$row[6]."'>
													</div>
													<div class='lookLook4'>
														<img src='".$row[7]."'>
													</div>
													<div class='lookLook4'>
														<img src='".$row[8]."'>
													</div>
													<div class='lookLook4'>
														<img src='".$row[9]."'>
													</div>
												</div>
											</div>";
											}
									}
								}
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div id="myModal" class="modal">

			<!-- Modal content -->
			<div class="modal-content">
				<span class="close"style="width: 3%; margin-left: 98%;">&times;</span>
				<div id="cont">
					<div id="imgCool">
						<img src="img/fashion3.jpeg">
					</div>
					<div id="manual">
						<div id="titleManual">
							<p>Adicionar Manualmente:</p>
						</div>
						<div id="formRoupa">
							<form id="registerForm" class="Active" action="<?=htmlspecialchars(stripslashes(trim("phpScripts/myclosetScript.php")));?>" method="post" enctype="multipart/form-data">
								<div class="input-div one" id="div1">
									<div class="i">
										<i class="fas fa-signature"></i>
									</div>
									<div>
										<select class="form-control" name="name" id="questionSelect" required>
											<?php
												if ($gender == 'F'){
													echo "<option selected disabled>Categoria...</option>
														<option value='Tshirt'>Tshirt</option>
														<option value='Top'>Top</option>
														<option value='Polo'>Polo</option>
														<option value='Camisa'>Camisa</option>
														<option value='Vestido'>Vestido</option>
														<option value='Macacão'>Macacão</option>
														<option value='Casaco'>Casaco</option>
														<option value='Blusão'>Blusão</option>
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
														<option value='Chapeu'>Acessórios - Chapéus</option>
														<option value='Cinto'>Acessórios - Cintos</option>
														<option value='Laço'>Acessórios - Laços</option>
														<option value='Cachecol'>Acessórios - Cachecóis</option>";
												}
												else{
													echo "<option selected disabled>Categoria...</option>
														<option value='Tshirt'>Tshirt</option>
														<option value='Polo'>Polo</option>
														<option value='Camisa'>Camisa</option>
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
														<option value='Fato de Banho'>Fato de Banho</option>
														<option value='Ténis'>Calçado - Ténis</option>
														<option value='Sapatos Social'>Calçado - Social</option>
														<option value='Botas'>Calçado - Bota</option>
														<option value='Sandálias'>Calçado - Sandálias</option>
														<option value='Chinelos'>Calçado - Chinelos</option>
														<option value='Pulseira'>Acessórios - Pulseiras</option>
														<option value='Relógio'>Acessórios - Relógios</option>
														<option value='Óculos'>Acessórios - Óculos</option>
														<option value='Mala'>Acessórios - Malas</option>
														<option value='Gravata'>Acessórios - Gravatas</option>
														<option value='Chapeu'>Acessórios - Chapéus</option>
														<option value='Cinto'>Acessórios - Cintos</option>
														<option value='Laço'>Acessórios - Laços</option>
														<option value='Cachecol'>Acessórios - Cachecóis</option>";
												}
											?>
										</select>
									</div>
								</div>
								<div class="input-div three">
									<div class="i">
										<i class="fas fa-palette"></i>
									</div>
									<div>
										<select class="form-control" name="color" id="questionSelect" required>
											<option selected disabled>Cor...</option>
											<option value="black">Preto</option>
											<option value="white">Branco</option>
											<option value="beige">Bege</option>
											<option value="gray">Cinzento</option>
											<option value="red">Vermelho</option>
											<option value="blue">Azul</option>
											<option value="green">Verde</option>
											<option value="pink">Rosa</option>
											<option value="yellow">Amarelo</option>
											<option value="orange">Laranja</option>
											<option value="purple">Roxo</option>
											<option value="brown">Castanho</option>
											<option value="gold">Dourado</option>
											<option value="silver">Prateado</option>
										</select>
									</div>
								</div>
								<div class="input-div four">
									<div class="i">
										<i class="fas fa-clipboard-list"></i>
									</div>
									<div>
										<select class="form-control" name="utility" id="questionSelect" required>
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
										<i class="fas fa-copyright"></i>
									</div>
									<div>
										<h5>Marca</h5>
										<input class="input" name="brand" type="text" required>
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

								<input style="width: 40%; height: 2.5em; margin-left: 30%;" type="submit" class="btn" name="adicionar" value="Adicionar">
							</form>
						</div>
					</div>
					<div id="automatic">
						<div id="titleManual">
							<p>Adicionar Automaticamente:</p>
						</div>
						<div id="passos">
							<div id="verticalEsq">
								<div class="passosAuto">
									<div class="autoTitle">
										<p>Passo 1: Loja</p>
									</div>
									<div class="paragraAuto">
										<p>Comprar a roupa preferida da loja, e ter atenção se tem a referência</p>
									</div>
								</div>
								<div class="imgAuto">
									<img src="img/fa1.jpg">
								</div>
							</div>
							<div id="verticalDir">
								<div class="imgAuto">
									<img src="img/fa.jfif">
								</div>
								<div class="passosAuto">
									<div class="autoTitle">
										<p style="text-align: right">Passo 2: Etiqueta</p>
									</div>
									<div class="paragraAuto" style="float: right">
										<p style="text-align: right">Ao chegar a casa, não deves tirar logo a etiqueta, ve a referencia e coloca aqui para adicionar ao teu armário</p>
									</div>
								</div>
							</div>
						</div>
						<div id="formRoupa">
							<form id="registerForm" class="Active" action="<?=htmlspecialchars(stripslashes(trim("phpScripts/myclosetScript.php")));?>" method="post" enctype="multipart/form-data">
								<div class="input-div two">
									<div class="i">
										<i class="fas fa-barcode"></i>
									</div>
									<div>
										<h5>Referência</h5>
										<input class="input" name="referencia" type="text" required>
									</div>
								</div>
								<input style="width: 40%; height: 2.5em; margin-left: 30%;" type="submit" class="btn" name="adicionar1" value="Adicionar">
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

	<script>
		var value1;
		var value2;
		var value3;
		var value4;
		var value5;
		var value6;
		function a(x){
			var lista = [];
			var i = 0;
			if (x ==3){
				$(".theImage > img").on("click", function(){
					console.log(i);
					var value = $(this).attr('src');
					if (i < 3){
						if (lista.includes(value)){
							console.log("Pau__" + value);
							var div3 = $('#div3_divImagem3').children('img').attr('src');
							var div2 = $('#div2_divImagem3').children('img').attr('src');
							var div1 = $('#div1_divImagem3').children('img').attr('src');

							if (value === div3){
								$("#div3_divImagem3 > img").remove();
								value3 = "";
								$("#div3_divImagem3_input").val(value3);

							}
							else{
								if (value === div2){
									$("#div2_divImagem3 > img").remove();
									value2 = "";
									$("#div2_divImagem3_input").val(value2);
								}
								else{
									if (value === div1){
										$("#div1_divImagem3 > img").remove();
										value1 = "";
										$("#div1_divImagem3_input").val(value1);
									}
								}
							}
							lista.splice( lista.indexOf(value), 1 );
							console.log(lista);
							$(this).css("border","");
							i--;
						}
						else{
							lista.push(value);
							console.log(lista);
							$(".theImage").css("border","");
							$(this).css("border","10px solid #a5e1a5");
							i++;
							if ($("#div1_divImagem3 > img").length == 0){
								var condition = "<img id='teste' class="+value+" src=" + value+ ">";
								$("#div1_divImagem3").append(condition);
								value1 = value;
								console.log("Value 1: "+ value1 );
								$("#div1_divImagem3_input").val(value1);
							}
							else{
								if ($("#div2_divImagem3 > img").length == 0){
									var condition = "<img id='teste' class="+value+" src=" + value+ ">";
									$("#div2_divImagem3").append(condition);
									value2 = value;
									console.log("Value 2: "+ value2 );
									$("#div2_divImagem3_input").val(value2);
								}
								else{
									if ($("#div3_divImagem3 > img").length == 0){
										var condition = "<img id='teste' class="+value+" src=" + value+ ">";
										$("#div3_divImagem3").append(condition);
										value3 = value;
										console.log("Value 3: "+ value3 );
										$("#div3_divImagem3_input").val(value3);
									}
								}
							}
						}
					}
					else if(i == x && lista.includes(value)){
						console.log("Pau__" + value);
						var div3 = $('#div3_divImagem3').children('img').attr('src');
						var div2 = $('#div2_divImagem3').children('img').attr('src');
						var div1 = $('#div1_divImagem3').children('img').attr('src');

						if (value === div3){
								$("#div3_divImagem3 > img").remove();
								value3 = "";
								console.log("Value 3: "+ value3 );
								$("#div3_divImagem3_input").val(value3);
						}
						else{
							if (value === div2){
								$("#div2_divImagem3 > img").remove();
								value2 = "";
								$("#div2_divImagem3_input").val(value2);
							}
							else{
								if (value === div1){
									$("#div1_divImagem3 > img").remove();
									value1 = "";
									$("#div1_divImagem3_input").val(value1);
								}
							}
						}
						lista.splice( lista.indexOf(value), 1 );
						console.log(lista);
						$(this).css("border","");
						i--;
					}
					else{
						alert("Chegou ao limite");
					}
				});
			}

			else if (x ==4){
				$(".theImage > img").on("click", function(){
					console.log(i);
					var value = $(this).attr('src');
					if (i < 4){
						if (lista.includes(value)){
							var div4 = $('#div4_divImagem4').children('img').attr('src');
							var div3 = $('#div3_divImagem4').children('img').attr('src');
							var div2 = $('#div2_divImagem4').children('img').attr('src');
							var div1 = $('#div1_divImagem4').children('img').attr('src');
							if (value === div4){
								$("#div4_divImagem4 > img").remove();
								value4 = "";
								$("#div4_divImagem4_input").val(value4);
							}
							else{
								if (value === div3){
									$("#div3_divImagem4 > img").remove();
									value3 = "";
									$("#div3_divImagem4_input").val(value3);
								}
								else{
									if (value === div2){
										$("#div2_divImagem4 > img").remove();
										value2 = "";
										$("#div2_divImagem4_input").val(value2);
									}
									else{
										if (value === div1){
											$("#div1_divImagem4").empty();
											value1 = "";
											console.log("Value 1: "+ value1 );
											$("#div1_divImagem4_input").val(value1);
										}
									}
								}
							}
							lista.splice( lista.indexOf(value), 1 );
							console.log(lista);
							$(this).css("border","");
							i--;
						}
						else{
							lista.push(value);
							console.log(lista);
							$(".theImage").css("border","");
							$(this).css("border","10px solid #a5e1a5");
							i++;
							if ($("#div1_divImagem4 > img").length == 0){
								var condition = "<img id='teste' class="+value+" src=" + value+ ">";
								$("#div1_divImagem4").append(condition);
								value1 = value;
								console.log("Value 1: "+ value1 );
								$("#div1_divImagem4_input").val(value1);
							}
							else{
								if ($("#div2_divImagem4 > img").length == 0){
									var condition = "<img id='teste' class="+value+" src=" + value+ ">";
									$("#div2_divImagem4").append(condition);
									value2 = value;
									console.log("Value 2: "+ value2 );
									$("#div2_divImagem4_input").val(value2);
								}
								else{
									if ($("#div3_divImagem4 > img").length == 0){
										var condition = "<img id='teste' class="+value+" src=" + value+ ">";
										$("#div3_divImagem4").append(condition);
										value3 = value;
										console.log("Value 3: "+ value3 );
										$("#div3_divImagem4_input").val(value3);
									}
									else{
										if ($("#div4_divImagem4 > img").length == 0){
											var condition = "<img id='teste' class="+value+" src=" + value+ ">";
											$("#div4_divImagem4").append(condition);
											value4 = value;
											console.log("Value 4: "+ value4 );
											$("#div4_divImagem4_input").val(value4);
										}
									}
								}
							}
						}
					}
					else if(i == x && lista.includes(value)){
						var div4 = $('#div4_divImagem4').children('img').attr('src');
						var div3 = $('#div3_divImagem4').children('img').attr('src');
						var div2 = $('#div2_divImagem4').children('img').attr('src');
						var div1 = $('#div1_divImagem4').children('img').attr('src');

						if (value === div4){
							$("#div4_divImagem4 > img").remove();
							value4 = "";
							$("#div4_divImagem4_input").val(value4);
						}
						else{
							if (value === div3){
								$("#div3_divImagem4 > img").remove();
								value3 = "";
								console.log("Value 3: "+ value3 );
								$("#div3_divImagem4_input").val(value3);
							}
							else{
								if (value === div2){
									$("#div2_divImagem4 > img").remove();
									value2 = "";
									console.log("Value 2: "+ value2 );
									$("#div2_divImagem4_input").val(value2);
								}
								else{
									if (value === div1){
										$("#div1_divImagem4 > img").remove();
										value1 = "";
										console.log("Value 1: "+ value1 );
										$("#div1_divImagem4_input").val(value1);
									}
								}
							}
						}
						lista.splice( lista.indexOf(value), 1 );
						console.log(lista);
						$(this).css("border","");
						i--;
					}
					else{
						alert("Chegou ao limite");
					}
				});
			}
			else if (x ==5){
				$(".theImage > img").on("click", function(){
					console.log(i);
					var value = $(this).attr('src');
					if (i < x){
						if (lista.includes(value)){
							var div5 = $('#div5_divImagem5').children('img').attr('src');
							var div4 = $('#div4_divImagem5').children('img').attr('src');
							var div3 = $('#div3_divImagem5').children('img').attr('src');
							var div2 = $('#div2_divImagem5').children('img').attr('src');
							var div1 = $('#div1_divImagem5').children('img').attr('src');

							if (value === div5){
								$("#div5_divImagem5 > img").remove();
								value5 = "";
								console.log("Value 5: "+ value5 );
								$("#div5_divImagem5_input").val(value5);
							}
							else{
								if (value === div4){
									$("#div4_divImagem5 > img").remove();
									value4 = "";
									console.log("Value 4: "+ value4 );
									$("#div4_divImagem5_input").val(value4);
								}
								else{
									if (value === div3){
										$("#div3_divImagem5 > img").remove();
										value3 = "";
										console.log("Value 3: "+ value3 );
										$("#div3_divImagem5_input").val(value3);
									}
									else{
										if (value === div2){
											$("#div2_divImagem5 > img").remove();
											value2 = "";
											console.log("Value 2: "+ value2 );
											$("#div2_divImagem5_input").val(value2);
										}
										else{
											if (value === div1){
												$("#div1_divImagem5 > img").remove();
												value1 = "";
												console.log("Value 1: "+ value1 );
												$("#div1_divImagem5_input").val(value1);
											}
										}
									}
								}
							}
							lista.splice( lista.indexOf(value), 1 );
							console.log(lista);
							$(this).css("border","");
							i--;
						}
						else{
							lista.push(value);
							console.log(lista);
							$(".theImage").css("border","");
							$(this).css("border","10px solid #a5e1a5");
							i++;
							if ($("#div1_divImagem5 > img").length == 0){
								var condition = "<img id='teste' class="+value+" src=" + value+ ">";
								$("#div1_divImagem5").append(condition);
								value1 = value;
								console.log("Value 1: "+ value1 );
								$("#div1_divImagem5_input").val(value1);
							}
							else{
								if ($("#div2_divImagem5 > img").length == 0){
									var condition = "<img id='teste' class="+value+" src=" + value+ ">";
									$("#div2_divImagem5").append(condition);
									value2 = value;
									console.log("Value 2: "+ value2 );
									$("#div2_divImagem5_input").val(value2);
								}
								else{
									if ($("#div3_divImagem5 > img").length == 0){
										var condition = "<img id='teste' class="+value+" src=" + value+ ">";
										$("#div3_divImagem5").append(condition);
										value3 = value;
										console.log("Value 3: "+ value3 );
										$("#div3_divImagem5_input").val(value3);
									}
									else{
										if ($("#div4_divImagem5 > img").length == 0){
											var condition = "<img id='teste' class="+value+" src=" + value+ ">";
											$("#div4_divImagem5").append(condition);
											value4 = value;
											console.log("Value 4: "+ value4 );
											$("#div4_divImagem5_input").val(value4);
										}
										else{
											if ($("#div5_divImagem5 > img").length == 0){
												var condition = "<img id='teste' class="+value+" src=" + value+ ">";
												$("#div5_divImagem5").append(condition);
												value5 = value;
												console.log("Value 5: "+ value5 );
												$("#div5_divImagem5_input").val(value5);
											}
										}
									}
								}
							}
						}
					}
					else if(i == x && lista.includes(value)){
						var div5 = $('#div5_divImagem5').children('img').attr('src');
						var div4 = $('#div4_divImagem5').children('img').attr('src');
						var div3 = $('#div3_divImagem5').children('img').attr('src');
						var div2 = $('#div2_divImagem5').children('img').attr('src');
						var div1 = $('#div1_divImagem5').children('img').attr('src');
						if (value === div5){
							$("#div5_divImagem5 > img").remove();
							value5 = "";
							console.log("Value 5: "+ value5 );
							$("#div5_divImagem5_input").val(value5);
						}
						else{
							if (value === div4){
								$("#div4_divImagem5 > img").remove();
								value4 = "";
								console.log("Value 4: "+ value4 );
								$("#div4_divImagem5_input").val(value4);
							}
							else{
								if (value === div3){
									$("#div3_divImagem5 > img").remove();
									value3 = "";
									console.log("Value 3: "+ value3 );
									$("#div3_divImagem5_input").val(value3);
								}
								else{
									if (value === div2){
										$("#div2_divImagem5 > img").remove();
										value2 = "";
										console.log("Value 2: "+ value2 );
										$("#div2_divImagem5_input").val(value2);
									}
									else{
										if (value === div1){
											$("#div1_divImagem5 > img").remove();
											value1 = "";
											console.log("Value 1: "+ value1 );
											$("#div1_divImagem5_input").val(value1);
										}
									}
								}
							}
						}
						lista.splice( lista.indexOf(value), 1 );
						console.log(lista);
						$(this).css("border","");
						i--;
					}
					else{
						alert("Chegou ao limite");
					}
				});
			}
			else if (x ==6){
				$(".theImage > img").on("click", function(){
					console.log(i);
					var value = $(this).attr('src');
					if (i < 6){
						if (lista.includes(value)){
							var div6 = $('#div6_divImagem6').children('img').attr('src');
							var div5 = $('#div5_divImagem6').children('img').attr('src');
							var div4 = $('#div4_divImagem6').children('img').attr('src');
							var div3 = $('#div3_divImagem6').children('img').attr('src');
							var div2 = $('#div2_divImagem6').children('img').attr('src');
							var div1 = $('#div1_divImagem6').children('img').attr('src');
							if (value === div6){
								$("#div6_divImagem6 > img").remove();
								value6 = "";
								console.log("Value 6: "+ value6 );
								$("#div6_divImagem6_input").val(value6);
							}
							else{
								if (value === div5){
									$("#div5_divImagem6 > img").remove();
									value5 = "";
									console.log("Value 5: "+ value5 );
									$("#div5_divImagem6_input").val(value5);
								}
								else{
									if (value === div4){
										$("#div4_divImagem6 > img").remove();
										value4 = "";
										console.log("Value 4: "+ value4 );
										$("#div4_divImagem6_input").val(value4);
									}
									else{
										if (value === div3){
											$("#div3_divImagem6 > img").remove();
											value3 = "";
											console.log("Value 3: "+ value3 );
											$("#div3_divImagem6_input").val(value3);
										}
										else{
											if (value === div2){
												$("#div2_divImagem6 > img").remove();
												value2 = "";
												console.log("Value 2: "+ value2 );
												$("#div2_divImagem6_input").val(value2);
											}
											else{
												if (value === div1){
													$("#div1_divImagem6 > img").remove();
													value1 = "";
													console.log("Value 1: "+ value1 );
													$("#div1_divImagem6_input").val(value1);
												}
											}
										}
									}
								}
							}
							lista.splice( lista.indexOf(value), 1 );
							console.log(lista);
							$(this).css("border","");
							i--;
						}
						else{
							lista.push(value);
							console.log(lista);
							$(".theImage").css("border","");
							$(this).css("border","10px solid #a5e1a5");
							i++;
							if ($("#div1_divImagem6 > img").length == 0){
								var condition = "<img id='teste' class="+value+" src=" + value+ ">";
								$("#div1_divImagem6").append(condition);
								value1 = value;
								console.log("Value 1: "+ value1 );
								$("#div1_divImagem6_input").val(value1);
							}
							else{
								if ($("#div2_divImagem6 > img").length == 0){
									var condition = "<img id='teste' class="+value+" src=" + value+ ">";
									$("#div2_divImagem6").append(condition);
									value2 = value;
									console.log("Value 2: "+ value2 );
									$("#div2_divImagem6_input").val(value2);
								}
								else{
									if ($("#div3_divImagem6 > img").length == 0){
										var condition = "<img id='teste' class="+value+" src=" + value+ ">";
										$("#div3_divImagem6").append(condition);
										value3 = value;
										console.log("Value 3: "+ value3 );
										$("#div3_divImagem6_input").val(value3);
									}
									else{
										if ($("#div4_divImagem6 > img").length == 0){
											var condition = "<img id='teste' class="+value+" src=" + value+ ">";
											$("#div4_divImagem6").append(condition);
											value4 = value;
											console.log("Value 4: "+ value4 );
											$("#div4_divImagem6_input").val(value4);
										}
										else{
											if ($("#div5_divImagem6 > img").length == 0){
												var condition = "<img id='teste' class="+value+" src=" + value+ ">";
												$("#div5_divImagem6").append(condition);
												value5 = value;
												console.log("Value 5: "+ value5 );
												$("#div5_divImagem6_input").val(value5);
											}
											else{
												if ($("#div6_divImagem6 > img").length == 0){
													var condition = "<img id='teste' class="+value+" src=" + value+ ">";
													$("#div6_divImagem6").append(condition);
													value6 = value;
													console.log("Value 6: "+ value6 );
													$("#div6_divImagem6_input").val(value6);
												}
											}
										}
									}
								}
							}
						}
					}
					else if(i == x && lista.includes(value)){
						var div6 = $('#div6_divImagem6').children('img').attr('src');
						var div5 = $('#div5_divImagem6').children('img').attr('src');
						var div4 = $('#div4_divImagem6').children('img').attr('src');
						var div3 = $('#div3_divImagem6').children('img').attr('src');
						var div2 = $('#div2_divImagem6').children('img').attr('src');
						var div1 = $('#div1_divImagem6').children('img').attr('src');
						if (value === div6){
							$("#div6_divImagem6 > img").remove();
							value6 = "";
							console.log("Value 6: "+ value6 );
							$("#div6_divImagem6_input").val(value6);
						}
						else{
							if (value === div5){
								$("#div5_divImagem6 > img").remove();
								value5 = "";
								console.log("Value 5: "+ value5 );
								$("#div5_divImagem6_input").val(value5);
							}
							else{
								if (value === div4){
									$("#div4_divImagem6 > img").remove();
									value4 = "";
									console.log("Value 4: "+ value4 );
									$("#div4_divImagem6_input").val(value4);
								}
								else{
									if (value === div3){
										$("#div3_divImagem6 > img").remove();
										value3 = "";
										console.log("Value 3: "+ value3 );
										$("#div3_divImagem6_input").val(value3);
									}
									else{
										if (value === div2){
											$("#div2_divImagem6 > img").remove();
											value2 = "";
											console.log("Value 2: "+ value2 );
											$("#div2_divImagem6_input").val(value2);
										}
										else{
											if (value === div1){
												$("#div1_divImagem6 > img").remove();
												value1 = "";
												console.log("Value 1: "+ value1 );
												$("#div1_divImagem6_input").val(value1);
											}
										}
									}
								}
							}
						}
						lista.splice( lista.indexOf(value), 1 );
						console.log(lista);
						$(this).css("border","");
						i--;
					}
					else{
						alert("Chegou ao limite");
					}
				});
			}
		}

		$(document).ready(function(){
			$('#npecas').on('change', function() {
      			if ( $('#npecas').val() == '3pecas'){
					a(3);
				}
				else if ( $('#npecas').val() == '4pecas'){
					a(4);
				}
				else if ( $('#npecas').val() == '5pecas'){
					a(5);
				}
				else{
					a(6);
				}
			});

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
