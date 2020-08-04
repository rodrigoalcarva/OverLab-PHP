<?php
	session_start();
	include "phpScripts/accessBD.php";
    $user = $_SESSION['username'];
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
  <link href="css/store.css" rel="stylesheet">
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
			<li><a href="mycloset.php">My Closet</a></li>
			<li><a href="followers.php">Friends</a></li>
			<li><a href="wishlist.php">Wishlist</a></li>
			<li><a href="mystore2mao.php">My Store</a></li>
			<li class="menu-active"><a href="store.php">Store</a></li>
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
    	<div class="hero-container" >
			<div class="containerStore">
                <div class='headerStore'>
                    <div class='optionStore' style="width:10%">
                        <a href='#' style='text-align:left;color:#666666;'><p style="padding-top: 20%;font-size: 17px;margin-left: 25%;">Loja 2ªMão</p></a>
                    </div>
                    <div class='optionCategory'>

                    </div>
                    <div class='optionCarrinho'>
                        <div id="cesto">
                            <i style = "font-size:20px; margin-left: 39%;"class="icofont-bag"></i>
                            <p style = "font-size:12px; text-align:center; cursor:pointer;">Cesto</p>
                        </div>
                    </div>
                    <div class='optionSearch' id="click">
                        <div class='writeSearch'>
                            <input style = "font-size: 12px;margin-top: 7%;margin-left: 3%;border: 0px;background-color: transparent;border-bottom: 1px solid black;width: 80%; float:left;"type="text" id="pesquisa" name="pesquisa" placeholder="Introduza o nome da peça">
                            <i style = "margin-left: 6%;margin-top: 7%;float: left;" class="icofont-rounded-right"></i>
                        </div>
                        <div class='clickToSearch'>
                            <i style = "font-size:20px; margin-left: 39%;"class="icofont-search"></i>
                            <p style = "font-size:12px; text-align:center; cursor:pointer;">Pesquisar</p>
                        </div>
                        <div class='clickToSearch1'>
                            <i style = "font-size:20px; margin-left: 39%;"class="icofont-close-line"></i>
                            <p style = "font-size:12px; text-align:center; cursor:pointer;">Cancelar</p>
                        </div>
                    </div>

                </div>


                <div id="rest">
				<?php
                            $cestoQuery = "select * from cesto where idUsername='$name'";
                            $checkCesto = mysqli_query($conn, $cestoQuery);

                            if(!$checkCesto)
									die("Error, select query failed:" . $cestoQuery);

							if(mysqli_num_rows($checkCesto)>0) {
                                $cestoCountQuery = "select count(*) from cesto where idUsername='$name'";
                                $checkCestoCount = mysqli_query($conn, $cestoCountQuery);

                                $row2 =mysqli_fetch_array($checkCestoCount);
                                $num = $row2[0];
                                echo "<div id='cesta'><div class='cestoHeader'>
                                    <p>Cesto ($num)</p>
                                </div>";
                                echo "<div class='cestoContainer'>";

                                    $sum = 0;

                                    while  ($row = mysqli_fetch_array($checkCesto)) {
                                        $idProd = $row[1];

                                        $cestoItemQuery = "select v.titulo, p.color, v.tamanho, c.quantidade, v.preco, c.idProduct from venda2mao v, productsu p, cesto c where c.idProduct = v.idProduct and v.idProduct = p.id and c.idProduct='$idProd'";
                                        $checkCestoItem = mysqli_query($conn, $cestoItemQuery);

                                        if(!$checkCestoItem)
                                                die("Error, select query failed:" . $cestoItemQuery);

                                        $row1 = mysqli_fetch_array($checkCestoItem);

                                        $titulo = $row1[0];
                                        $cor = $row1[1];
                                        $tamanho = $row1[2];
                                        $quantidade = $row1[3];
                                        $preco = $row1[4];
                                        $id = $row1[5];

                                        $num = floatval($preco);
                                        $sum = $sum + $num;

                                        echo "<div class='itemCesto'>
                                            <div class='itemCestoLeft'>
                                                <div class='itemCestoImg'>
                                                    <img src='productsImage/$id.jpg' style='width: 100%;height: 100%;'>
                                                </div>
                                            </div>
                                            <div class='itemCestoMiddle'>
                                                <p style='margin: 0;font-size: 16px;padding-top: 7%;font-weight: bold;'>$titulo</p>
                                                <p style='margin: 0;font-size: 10px;font-weight: 100;'>Cor: $cor</p>
                                                <p style='margin: 0;font-size: 10px;font-weight: 100;'>Tam: $tamanho</p>
                                                <p style='margin: 0;font-size: 10px;font-weight: 100;'>Quant.: ".$quantidade."</p>
                                            </div>
                                            <div class='itemCestoRight'>
                                                <div class='itemCestoPrice'>
                                                    <p style='padding-top: 24%; font-size: 13px; font-weight: bold; float:right;'>$preco". "€</p>
                                                </div>
                                                <div class='itemCestoDelete'>
																									<form action='phpScripts/storeScript2mao.php' method='post' enctype='multipart/form-data'  style='width:100%;height:100%;'>
																										<button name='deleteCesto' value='$idProd' style='background-color: transparent;border: 0px;color: black;float: right;'><i class='icofont-trash' style='font-size: 12px;float: right; margin-right: 13%;'></i></button>
																									</form>
                                                </div>
                                            </div>
                                        </div>";
                                    }
                                echo "</div>
                                <div class='cestoFooter'>
                                        <div class='cestoFooterPrice'>
                                            <p style='font-size: 17px;font-weight: bolder;margin: 0;margin-top: 8%;'>Total:</p>
                                            <p style='font-weight: 100;'>".$sum."€</P>
                                        </div>
										<div class='cestoFooterButton'>
											<form action='phpScripts/storeScript2mao.php' method='post' enctype='multipart/form-data' style='width:100%;height:100%;'>
                                            	<button type='submit' name='iniProcesso' style='width: 100%;background-color: black;color: white;border: 0px;height: 60%;font-size: 12px;font-weight: 100;margin-top: 9%;'>Iniciar Pedido</button>
											</form>
										</div>
                                    </div></div>";
                            }
                            else{
                                echo "<div id='cesta' style='height: 13% !important;'><p>O cesto está vazio.</p></div>";
                            }
                        ?>
                    <div id='d'>
						<div id='categoriesProducts'>
							<div class='pCategorie' style="margin-top:10%; margin-bottom:5%;">
								<p style="font-weight: bold; font-size:14px;">Categoria</p>
							</div>
							<div class='pCategorie'>
								<p class='act' id='option0' style="text-decoration: underline;">Tudo</p>
							</div>
							<div class='pCategorie' style="margin-left: 12%;">
								<p id="option1">Tshirts,Tops e Polos</p>
							</div>
							<div class='pCategorie' style="margin-left: 12%;">
								<p id="option2">Camisas</p>
							</div>
							<div class='pCategorie' style="margin-left: 12%;">
								<p id="option3">Camisolas e Malhas</p>
							</div>
							<div class='pCategorie' style="margin-left: 12%;">
								<p id="option4">Sweatshirts</p>
							</div>
							<div class='pCategorie' style="margin-left: 12%;">
								<p id="option5">Vestidos e Macacões</p>
							</div>
							<div class='pCategorie' style="margin-left: 12%;">
								<p id="option6">Casacos e Blusões</p>
							</div>
							<div class='pCategorie' style="margin-left: 12%;">
								<p id="option7">Blazers</p>
							</div>
							<div class='pCategorie' style="margin-left: 12%;">
								<p id="option8">Sobretudos</p>
							</div>
							<div class='pCategorie' style="margin-left: 12%;">
								<p id="option9">Calças, Jeans</p>
							</div>
							<div class='pCategorie' style="margin-left: 12%;">
								<p id="option10">Saias e Calções</p>
							</div>
							<div class='pCategorie' style="margin-left: 12%;">
								<p id="option11">Calçado</p>
							</div>
							<div class='pCategorie' style="margin-left: 12%;">
								<p id="option12">Acessórios</p>
							</div>
						</div>
						<div class='theProducts2Mao' id='option00'>
							<?php
								$prod2maoQuery = "select v.idProduct, v.tamanho, v.preco, v.titulo, v.descricao, v.localizacao, p.brand FROM venda2mao v, productsu p WHERE p.id = v.idProduct and v.idUsername <> '$user'";
								$getprod2mao = mysqli_query($conn, $prod2maoQuery);

								if(!$getprod2mao)
									die("Error, select query failed:" . $prod2maoQuery);

								if(mysqli_num_rows($getprod2mao)>0) {
									while  ($row = mysqli_fetch_array($getprod2mao)) {
										$idProduc = $row[0];
										$tamanho = $row[1];
										$preco = $row[2];
										$titulo = $row[3];
										$descricao = $row[4];
										$localizacao = $row[5];
										$brand = $row[6];

										echo "<div class='produc'>
											<div class='producImage' id='$idProduc'>
											<a class='$idProduc' href='product2mao.php?refProduct=$idProduc' style='width:100%;height:100%;'>
												<img src='productsImage/$idProduc.jpg' class='$idProduc' style='width:100%;height:100%;'>
											</a>
											<div class='clickIcon1'>
												<form action='phpScripts/storeScript2mao.php' method='post' enctype='multipart/form-data'>
													<div class='addwishTitle'>
														<p>Adicionar a uma wishlist</p>
													</div>
													<div class='addwishButtons'>";
														$wishWishQuery ="select * from venda2mao where idProduct='$idProduc'";
														$checkWishWish = mysqli_query($conn, $wishWishQuery);

														$row222 = mysqli_fetch_array($checkWishWish);

														$uu = $row222[0];

														if ($uu != $name){

															$wishQuery = "select * FROM wishlists where idUser ='$user'";
															$getWish = mysqli_query($conn, $wishQuery);

															if(!$getWish)
																die("Error, select query failed:" . $wishQuery);

															if(mysqli_num_rows($getWish)>0) {
																while  ($row1 = mysqli_fetch_array($getWish)) {
																	$idWish = $row1[0];
																	$nameWish = $row1[2];
																	$value = $idProduc . "," . $idWish;
																	echo "<button type='submit' class='ButtonOption' name='addWish' value='$value'>Wishlist $nameWish</button>";
																}
															}
														}
														else{
															echo "<p style='text-align: center;padding-top: 36%;'>Este produto é seu</p>";
														}


													echo "</div>
												</form>
											</div>
										</div>
										<div class='producText'>
											<div class='producInfo'>
												<div class='producLeft'>
													<div class='producTitle'>
														<p style='padding-top: 5%;font-size: 16px;font-weight: bold;margin-left: 5%;'>$titulo</p>
													</div>
													<div class='producBrand'>
														<p style='font-size: 11px;margin-left: 5%;padding-top: 5%;'>$brand</p>
													</div>
													<div class='producSize'>
														<p style='font-size: 11px;margin-left: 5%;font-weight: 600;padding-top: 5%;'>$tamanho</p>
													</div>
												</div>
												<div class='producRight'>
													<div class='producPrice'>
														<p style='font-size: 22px;text-align: center;padding-top: 6%;'>$preco"."€</p>
													</div>
													<div class='producLocal'>
														<p style='font-size:11px; text-align:center;'>$localizacao </p>
													</div>
												</div>
											</div>
											<div class='producOption'>
												<i id='icon' class='fas fa-star $idProduc' style='cursor: pointer;font-size: 30px;text-align: center;padding-left: 27%;padding-top: 31%;'></i>
											</div>
										</div>
									</div>";
									}
								}
							?>

						</div>
						<div class='theProducts2Mao' id='option01'>
						<?php
								$prod2maoQuery = "select v.idProduct, v.tamanho, v.preco, v.titulo, v.descricao, v.localizacao, p.brand FROM venda2mao v, productsu p WHERE p.id = v.idProduct and v.idUsername <> '$user' and (p.name = 'Tshirt' or p.name = 'Top' or p.name = 'Polo')";
								$getprod2mao = mysqli_query($conn, $prod2maoQuery);

								if(!$getprod2mao)
									die("Error, select query failed:" . $prod2maoQuery);

								if(mysqli_num_rows($getprod2mao)>0) {
									while  ($row = mysqli_fetch_array($getprod2mao)) {
										$idProduc = $row[0];
										$tamanho = $row[1];
										$preco = $row[2];
										$titulo = $row[3];
										$descricao = $row[4];
										$localizacao = $row[5];
										$brand = $row[6];

										echo "<div class='produc'>
											<div class='producImage' id='$idProduc'>
											<a href='product2mao.php?refProduct=$idProduc' style='width:100%;height:100%;'>
												<img src='productsImage/$idProduc.jpg' class='$idProduc' style='width:100%;height:100%;'>
											</a>
											<div class='clickIcon1'>
												<form action='phpScripts/storeScript2mao.php' method='post' enctype='multipart/form-data'>
													<div class='addwishTitle'>
														<p>Adicionar a uma wishlist</p>
													</div>
													<div class='addwishButtons'>";
														$wishWishQuery ="select * from venda2mao where idProduct='$idProduc'";
														$checkWishWish = mysqli_query($conn, $wishWishQuery);

														$row222 = mysqli_fetch_array($checkWishWish);

														$uu = $row222[0];

														if ($uu != $name){

															$wishQuery = "select * FROM wishlists where idUser ='$user'";
															$getWish = mysqli_query($conn, $wishQuery);

															if(!$getWish)
																die("Error, select query failed:" . $wishQuery);

															if(mysqli_num_rows($getWish)>0) {
																while  ($row1 = mysqli_fetch_array($getWish)) {
																	$idWish = $row1[0];
																	$nameWish = $row1[2];
																	$value = $idProduc . "," . $idWish;
																	echo "<button type='submit' class='ButtonOption' name='addWish' value='$value'>Wishlist $nameWish</button>";
																}
															}
														}
														else{
															echo "<p style='text-align: center;padding-top: 36%;'>Este produto é seu</p>";
														}


													echo "</div>
												</form>
											</div>
										</div>
										<div class='producText'>
											<div class='producInfo'>
												<div class='producLeft'>
													<div class='producTitle'>
														<p style='padding-top: 5%;font-size: 16px;font-weight: bold;margin-left: 5%;'>$titulo</p>
													</div>
													<div class='producBrand'>
														<p style='font-size: 11px;margin-left: 5%;padding-top: 5%;'>$brand</p>
													</div>
													<div class='producSize'>
														<p style='font-size: 11px;margin-left: 5%;font-weight: 600;padding-top: 5%;'>$tamanho</p>
													</div>
												</div>
												<div class='producRight'>
													<div class='producPrice'>
														<p style='font-size: 22px;text-align: center;padding-top: 6%;'>$preco"."€</p>
													</div>
													<div class='producLocal'>
														<p style='font-size:11px; text-align:center;'>$localizacao </p>
													</div>
												</div>
											</div>
											<div class='producOption'>
												<i id='icon' class='fas fa-star $idProduc' style='cursor: pointer;font-size: 30px;text-align: center;padding-left: 27%;padding-top: 31%;'></i>
											</div>
										</div>
									</div>";
									}
								}
							?>
						</div>
						<div class='theProducts2Mao' id='option02'>
						<?php
								$prod2maoQuery = "select v.idProduct, v.tamanho, v.preco, v.titulo, v.descricao, v.localizacao, p.brand FROM venda2mao v, productsu p WHERE p.id = v.idProduct and v.idUsername <> '$user' and (p.name = 'Camisa')";
								$getprod2mao = mysqli_query($conn, $prod2maoQuery);

								if(!$getprod2mao)
									die("Error, select query failed:" . $prod2maoQuery);

								if(mysqli_num_rows($getprod2mao)>0) {
									while  ($row = mysqli_fetch_array($getprod2mao)) {
										$idProduc = $row[0];
										$tamanho = $row[1];
										$preco = $row[2];
										$titulo = $row[3];
										$descricao = $row[4];
										$localizacao = $row[5];
										$brand = $row[6];

										echo "<div class='produc'>
											<div class='producImage' id='$idProduc'>
											<a href='product2mao.php?refProduct=$idProduc' style='width:100%;height:100%;'>
												<img src='productsImage/$idProduc.jpg' class='$idProduc' style='width:100%;height:100%;'>
											</a>
											<div class='clickIcon1'>
												<form action='phpScripts/storeScript2mao.php' method='post' enctype='multipart/form-data'>
													<div class='addwishTitle'>
														<p>Adicionar a uma wishlist</p>
													</div>
													<div class='addwishButtons'>";
														$wishWishQuery ="select * from venda2mao where idProduct='$idProduc'";
														$checkWishWish = mysqli_query($conn, $wishWishQuery);

														$row222 = mysqli_fetch_array($checkWishWish);

														$uu = $row222[0];

														if ($uu != $name){

															$wishQuery = "select * FROM wishlists where idUser ='$user'";
															$getWish = mysqli_query($conn, $wishQuery);

															if(!$getWish)
																die("Error, select query failed:" . $wishQuery);

															if(mysqli_num_rows($getWish)>0) {
																while  ($row1 = mysqli_fetch_array($getWish)) {
																	$idWish = $row1[0];
																	$nameWish = $row1[2];
																	$value = $idProduc . "," . $idWish;
																	echo "<button type='submit' class='ButtonOption' name='addWish' value='$value'>Wishlist $nameWish</button>";
																}
															}
														}
														else{
															echo "<p style='text-align: center;padding-top: 36%;'>Este produto é seu</p>";
														}


													echo "</div>
												</form>
											</div>
										</div>
										<div class='producText'>
											<div class='producInfo'>
												<div class='producLeft'>
													<div class='producTitle'>
														<p style='padding-top: 5%;font-size: 16px;font-weight: bold;margin-left: 5%;'>$titulo</p>
													</div>
													<div class='producBrand'>
														<p style='font-size: 11px;margin-left: 5%;padding-top: 5%;'>$brand</p>
													</div>
													<div class='producSize'>
														<p style='font-size: 11px;margin-left: 5%;font-weight: 600;padding-top: 5%;'>$tamanho</p>
													</div>
												</div>
												<div class='producRight'>
													<div class='producPrice'>
														<p style='font-size: 22px;text-align: center;padding-top: 6%;'>$preco"."€</p>
													</div>
													<div class='producLocal'>
														<p style='font-size:11px; text-align:center;'>$localizacao </p>
													</div>
												</div>
											</div>
											<div class='producOption'>
												<i id='icon' class='fas fa-star $idProduc' style='cursor: pointer;font-size: 30px;text-align: center;padding-left: 27%;padding-top: 31%;'></i>
											</div>
										</div>
									</div>";
									}
								}
							?>
						</div>
						<div class='theProducts2Mao' id='option03'>
						<?php
								$prod2maoQuery = "select v.idProduct, v.tamanho, v.preco, v.titulo, v.descricao, v.localizacao, p.brand FROM venda2mao v, productsu p WHERE p.id = v.idProduct and v.idUsername <> '$user' and (p.name = 'Camisola' or p.name = 'Malha' )";
								$getprod2mao = mysqli_query($conn, $prod2maoQuery);

								if(!$getprod2mao)
									die("Error, select query failed:" . $prod2maoQuery);

								if(mysqli_num_rows($getprod2mao)>0) {
									while  ($row = mysqli_fetch_array($getprod2mao)) {
										$idProduc = $row[0];
										$tamanho = $row[1];
										$preco = $row[2];
										$titulo = $row[3];
										$descricao = $row[4];
										$localizacao = $row[5];
										$brand = $row[6];

										echo "<div class='produc'>
											<div class='producImage' id='$idProduc'>
											<a href='product2mao.php?refProduct=$idProduc' style='width:100%;height:100%;'>
												<img src='productsImage/$idProduc.jpg' class='$idProduc' style='width:100%;height:100%;'>
											</a>
											<div class='clickIcon1'>
												<form action='phpScripts/storeScript2mao.php' method='post' enctype='multipart/form-data'>
													<div class='addwishTitle'>
														<p>Adicionar a uma wishlist</p>
													</div>
													<div class='addwishButtons'>";
														$wishWishQuery ="select * from venda2mao where idProduct='$idProduc'";
														$checkWishWish = mysqli_query($conn, $wishWishQuery);

														$row222 = mysqli_fetch_array($checkWishWish);

														$uu = $row222[0];

														if ($uu != $name){

															$wishQuery = "select * FROM wishlists where idUser ='$user'";
															$getWish = mysqli_query($conn, $wishQuery);

															if(!$getWish)
																die("Error, select query failed:" . $wishQuery);

															if(mysqli_num_rows($getWish)>0) {
																while  ($row1 = mysqli_fetch_array($getWish)) {
																	$idWish = $row1[0];
																	$nameWish = $row1[2];
																	$value = $idProduc . "," . $idWish;
																	echo "<button type='submit' class='ButtonOption' name='addWish' value='$value'>Wishlist $nameWish</button>";
																}
															}
														}
														else{
															echo "<p style='text-align: center;padding-top: 36%;'>Este produto é seu</p>";
														}


													echo "</div>
												</form>
											</div>
										</div>
										<div class='producText'>
											<div class='producInfo'>
												<div class='producLeft'>
													<div class='producTitle'>
														<p style='padding-top: 5%;font-size: 16px;font-weight: bold;margin-left: 5%;'>$titulo</p>
													</div>
													<div class='producBrand'>
														<p style='font-size: 11px;margin-left: 5%;padding-top: 5%;'>$brand</p>
													</div>
													<div class='producSize'>
														<p style='font-size: 11px;margin-left: 5%;font-weight: 600;padding-top: 5%;'>$tamanho</p>
													</div>
												</div>
												<div class='producRight'>
													<div class='producPrice'>
														<p style='font-size: 22px;text-align: center;padding-top: 6%;'>$preco"."€</p>
													</div>
													<div class='producLocal'>
														<p style='font-size:11px; text-align:center;'>$localizacao </p>
													</div>
												</div>
											</div>
											<div class='producOption'>
												<i id='icon' class='fas fa-star $idProduc' style='cursor: pointer;font-size: 30px;text-align: center;padding-left: 27%;padding-top: 31%;'></i>
											</div>
										</div>
									</div>";
									}
								}
							?>
						</div>
						<div class='theProducts2Mao' id='option04'>
						<?php
								$prod2maoQuery = "select v.idProduct, v.tamanho, v.preco, v.titulo, v.descricao, v.localizacao, p.brand FROM venda2mao v, productsu p WHERE p.id = v.idProduct and v.idUsername <> '$user' and (p.name = 'Sweatshirt')";
								$getprod2mao = mysqli_query($conn, $prod2maoQuery);

								if(!$getprod2mao)
									die("Error, select query failed:" . $prod2maoQuery);

								if(mysqli_num_rows($getprod2mao)>0) {
									while  ($row = mysqli_fetch_array($getprod2mao)) {
										$idProduc = $row[0];
										$tamanho = $row[1];
										$preco = $row[2];
										$titulo = $row[3];
										$descricao = $row[4];
										$localizacao = $row[5];
										$brand = $row[6];

										echo "<div class='produc'>
											<div class='producImage' id='$idProduc'>
											<a href='product2mao.php?refProduct=$idProduc' style='width:100%;height:100%;'>
												<img src='productsImage/$idProduc.jpg' class='$idProduc' style='width:100%;height:100%;'>
											</a>
											<div class='clickIcon1'>
												<form action='phpScripts/storeScript2mao.php' method='post' enctype='multipart/form-data'>
													<div class='addwishTitle'>
														<p>Adicionar a uma wishlist</p>
													</div>
													<div class='addwishButtons'>";
														$wishWishQuery ="select * from venda2mao where idProduct='$idProduc'";
														$checkWishWish = mysqli_query($conn, $wishWishQuery);

														$row222 = mysqli_fetch_array($checkWishWish);

														$uu = $row222[0];

														if ($uu != $name){

															$wishQuery = "select * FROM wishlists where idUser ='$user'";
															$getWish = mysqli_query($conn, $wishQuery);

															if(!$getWish)
																die("Error, select query failed:" . $wishQuery);

															if(mysqli_num_rows($getWish)>0) {
																while  ($row1 = mysqli_fetch_array($getWish)) {
																	$idWish = $row1[0];
																	$nameWish = $row1[2];
																	$value = $idProduc . "," . $idWish;
																	echo "<button type='submit' class='ButtonOption' name='addWish' value='$value'>Wishlist $nameWish</button>";
																}
															}
														}
														else{
															echo "<p style='text-align: center;padding-top: 36%;'>Este produto é seu</p>";
														}


													echo "</div>
												</form>
											</div>
										</div>
										<div class='producText'>
											<div class='producInfo'>
												<div class='producLeft'>
													<div class='producTitle'>
														<p style='padding-top: 5%;font-size: 16px;font-weight: bold;margin-left: 5%;'>$titulo</p>
													</div>
													<div class='producBrand'>
														<p style='font-size: 11px;margin-left: 5%;padding-top: 5%;'>$brand</p>
													</div>
													<div class='producSize'>
														<p style='font-size: 11px;margin-left: 5%;font-weight: 600;padding-top: 5%;'>$tamanho</p>
													</div>
												</div>
												<div class='producRight'>
													<div class='producPrice'>
														<p style='font-size: 22px;text-align: center;padding-top: 6%;'>$preco"."€</p>
													</div>
													<div class='producLocal'>
														<p style='font-size:11px; text-align:center;'>$localizacao </p>
													</div>
												</div>
											</div>
											<div class='producOption'>
												<i id='icon' class='fas fa-star $idProduc' style='cursor: pointer;font-size: 30px;text-align: center;padding-left: 27%;padding-top: 31%;'></i>
											</div>
										</div>
									</div>";
									}
								}
							?>
						</div>
						<div class='theProducts2Mao' id='option05'>
						<?php
								$prod2maoQuery = "select v.idProduct, v.tamanho, v.preco, v.titulo, v.descricao, v.localizacao, p.brand FROM venda2mao v, productsu p WHERE p.id = v.idProduct and v.idUsername <> '$user' and (p.name = 'Vestido' or p.name = 'Macacão')";
								$getprod2mao = mysqli_query($conn, $prod2maoQuery);

								if(!$getprod2mao)
									die("Error, select query failed:" . $prod2maoQuery);

								if(mysqli_num_rows($getprod2mao)>0) {
									while  ($row = mysqli_fetch_array($getprod2mao)) {
										$idProduc = $row[0];
										$tamanho = $row[1];
										$preco = $row[2];
										$titulo = $row[3];
										$descricao = $row[4];
										$localizacao = $row[5];
										$brand = $row[6];

										echo "<div class='produc'>
											<div class='producImage' id='$idProduc'>
											<a href='product2mao.php?refProduct=$idProduc' style='width:100%;height:100%;'>
												<img src='productsImage/$idProduc.jpg' class='$idProduc' style='width:100%;height:100%;'>
											</a>
											<div class='clickIcon1'>
												<form action='phpScripts/storeScript2mao.php' method='post' enctype='multipart/form-data'>
													<div class='addwishTitle'>
														<p>Adicionar a uma wishlist</p>
													</div>
													<div class='addwishButtons'>";
														$wishWishQuery ="select * from venda2mao where idProduct='$idProduc'";
														$checkWishWish = mysqli_query($conn, $wishWishQuery);

														$row222 = mysqli_fetch_array($checkWishWish);

														$uu = $row222[0];

														if ($uu != $name){

															$wishQuery = "select * FROM wishlists where idUser ='$user'";
															$getWish = mysqli_query($conn, $wishQuery);

															if(!$getWish)
																die("Error, select query failed:" . $wishQuery);

															if(mysqli_num_rows($getWish)>0) {
																while  ($row1 = mysqli_fetch_array($getWish)) {
																	$idWish = $row1[0];
																	$nameWish = $row1[2];
																	$value = $idProduc . "," . $idWish;
																	echo "<button type='submit' class='ButtonOption' name='addWish' value='$value'>Wishlist $nameWish</button>";
																}
															}
														}
														else{
															echo "<p style='text-align: center;padding-top: 36%;'>Este produto é seu</p>";
														}


													echo "</div>
												</form>
											</div>
										</div>
										<div class='producText'>
											<div class='producInfo'>
												<div class='producLeft'>
													<div class='producTitle'>
														<p style='padding-top: 5%;font-size: 16px;font-weight: bold;margin-left: 5%;'>$titulo</p>
													</div>
													<div class='producBrand'>
														<p style='font-size: 11px;margin-left: 5%;padding-top: 5%;'>$brand</p>
													</div>
													<div class='producSize'>
														<p style='font-size: 11px;margin-left: 5%;font-weight: 600;padding-top: 5%;'>$tamanho</p>
													</div>
												</div>
												<div class='producRight'>
													<div class='producPrice'>
														<p style='font-size: 22px;text-align: center;padding-top: 6%;'>$preco"."€</p>
													</div>
													<div class='producLocal'>
														<p style='font-size:11px; text-align:center;'>$localizacao </p>
													</div>
												</div>
											</div>
											<div class='producOption'>
												<i id='icon' class='fas fa-star $idProduc' style='cursor: pointer;font-size: 30px;text-align: center;padding-left: 27%;padding-top: 31%;'></i>
											</div>
										</div>
									</div>";
									}
								}
							?>
						</div>
						<div class='theProducts2Mao' id='option06'>
						<?php
								$prod2maoQuery = "select v.idProduct, v.tamanho, v.preco, v.titulo, v.descricao, v.localizacao, p.brand FROM venda2mao v, productsu p WHERE p.id = v.idProduct and v.idUsername <> '$user' and (p.name = 'Casaco' or p.name = 'Blusão')";
								$getprod2mao = mysqli_query($conn, $prod2maoQuery);

								if(!$getprod2mao)
									die("Error, select query failed:" . $prod2maoQuery);

								if(mysqli_num_rows($getprod2mao)>0) {
									while  ($row = mysqli_fetch_array($getprod2mao)) {
										$idProduc = $row[0];
										$tamanho = $row[1];
										$preco = $row[2];
										$titulo = $row[3];
										$descricao = $row[4];
										$localizacao = $row[5];
										$brand = $row[6];

										echo "<div class='produc'>
											<div class='producImage' id='$idProduc'>
											<a href='product2mao.php?refProduct=$idProduc' style='width:100%;height:100%;'>
												<img src='productsImage/$idProduc.jpg' class='$idProduc' style='width:100%;height:100%;'>
											</a>
											<div class='clickIcon1'>
												<form action='phpScripts/storeScript2mao.php' method='post' enctype='multipart/form-data'>
													<div class='addwishTitle'>
														<p>Adicionar a uma wishlist</p>
													</div>
													<div class='addwishButtons'>";
														$wishWishQuery ="select * from venda2mao where idProduct='$idProduc'";
														$checkWishWish = mysqli_query($conn, $wishWishQuery);

														$row222 = mysqli_fetch_array($checkWishWish);

														$uu = $row222[0];

														if ($uu != $name){

															$wishQuery = "select * FROM wishlists where idUser ='$user'";
															$getWish = mysqli_query($conn, $wishQuery);

															if(!$getWish)
																die("Error, select query failed:" . $wishQuery);

															if(mysqli_num_rows($getWish)>0) {
																while  ($row1 = mysqli_fetch_array($getWish)) {
																	$idWish = $row1[0];
																	$nameWish = $row1[2];
																	$value = $idProduc . "," . $idWish;
																	echo "<button type='submit' class='ButtonOption' name='addWish' value='$value'>Wishlist $nameWish</button>";
																}
															}
														}
														else{
															echo "<p style='text-align: center;padding-top: 36%;'>Este produto é seu</p>";
														}


													echo "</div>
												</form>
											</div>
										</div>
										<div class='producText'>
											<div class='producInfo'>
												<div class='producLeft'>
													<div class='producTitle'>
														<p style='padding-top: 5%;font-size: 16px;font-weight: bold;margin-left: 5%;'>$titulo</p>
													</div>
													<div class='producBrand'>
														<p style='font-size: 11px;margin-left: 5%;padding-top: 5%;'>$brand</p>
													</div>
													<div class='producSize'>
														<p style='font-size: 11px;margin-left: 5%;font-weight: 600;padding-top: 5%;'>$tamanho</p>
													</div>
												</div>
												<div class='producRight'>
													<div class='producPrice'>
														<p style='font-size: 22px;text-align: center;padding-top: 6%;'>$preco"."€</p>
													</div>
													<div class='producLocal'>
														<p style='font-size:11px; text-align:center;'>$localizacao </p>
													</div>
												</div>
											</div>
											<div class='producOption'>
												<i id='icon' class='fas fa-star $idProduc' style='cursor: pointer;font-size: 30px;text-align: center;padding-left: 27%;padding-top: 31%;'></i>
											</div>
										</div>
									</div>";
									}
								}
							?>
						</div>
						<div class='theProducts2Mao' id='option07'>
						<?php
								$prod2maoQuery = "select v.idProduct, v.tamanho, v.preco, v.titulo, v.descricao, v.localizacao, p.brand FROM venda2mao v, productsu p WHERE p.id = v.idProduct and v.idUsername <> '$user' and (p.name = 'Blazer')";
								$getprod2mao = mysqli_query($conn, $prod2maoQuery);

								if(!$getprod2mao)
									die("Error, select query failed:" . $prod2maoQuery);

								if(mysqli_num_rows($getprod2mao)>0) {
									while  ($row = mysqli_fetch_array($getprod2mao)) {
										$idProduc = $row[0];
										$tamanho = $row[1];
										$preco = $row[2];
										$titulo = $row[3];
										$descricao = $row[4];
										$localizacao = $row[5];
										$brand = $row[6];

										echo "<div class='produc'>
											<div class='producImage' id='$idProduc'>
											<a href='product2mao.php?refProduct=$idProduc' style='width:100%;height:100%;'>
												<img src='productsImage/$idProduc.jpg' class='$idProduc' style='width:100%;height:100%;'>
											</a>
											<div class='clickIcon1'>
												<form action='phpScripts/storeScript2mao.php' method='post' enctype='multipart/form-data'>
													<div class='addwishTitle'>
														<p>Adicionar a uma wishlist</p>
													</div>
													<div class='addwishButtons'>";
														$wishWishQuery ="select * from venda2mao where idProduct='$idProduc'";
														$checkWishWish = mysqli_query($conn, $wishWishQuery);

														$row222 = mysqli_fetch_array($checkWishWish);

														$uu = $row222[0];

														if ($uu != $name){

															$wishQuery = "select * FROM wishlists where idUser ='$user'";
															$getWish = mysqli_query($conn, $wishQuery);

															if(!$getWish)
																die("Error, select query failed:" . $wishQuery);

															if(mysqli_num_rows($getWish)>0) {
																while  ($row1 = mysqli_fetch_array($getWish)) {
																	$idWish = $row1[0];
																	$nameWish = $row1[2];
																	$value = $idProduc . "," . $idWish;
																	echo "<button type='submit' class='ButtonOption' name='addWish' value='$value'>Wishlist $nameWish</button>";
																}
															}
														}
														else{
															echo "<p style='text-align: center;padding-top: 36%;'>Este produto é seu</p>";
														}


													echo "</div>
												</form>
											</div>
										</div>
										<div class='producText'>
											<div class='producInfo'>
												<div class='producLeft'>
													<div class='producTitle'>
														<p style='padding-top: 5%;font-size: 16px;font-weight: bold;margin-left: 5%;'>$titulo</p>
													</div>
													<div class='producBrand'>
														<p style='font-size: 11px;margin-left: 5%;padding-top: 5%;'>$brand</p>
													</div>
													<div class='producSize'>
														<p style='font-size: 11px;margin-left: 5%;font-weight: 600;padding-top: 5%;'>$tamanho</p>
													</div>
												</div>
												<div class='producRight'>
													<div class='producPrice'>
														<p style='font-size: 22px;text-align: center;padding-top: 6%;'>$preco"."€</p>
													</div>
													<div class='producLocal'>
														<p style='font-size:11px; text-align:center;'>$localizacao </p>
													</div>
												</div>
											</div>
											<div class='producOption'>
												<i id='icon' class='fas fa-star $idProduc' style='cursor: pointer;font-size: 30px;text-align: center;padding-left: 27%;padding-top: 31%;'></i>
											</div>
										</div>
									</div>";
									}
								}
							?>
						</div>
						<div class='theProducts2Mao' id='option08'>
						<?php
								$prod2maoQuery = "select v.idProduct, v.tamanho, v.preco, v.titulo, v.descricao, v.localizacao, p.brand FROM venda2mao v, productsu p WHERE p.id = v.idProduct and v.idUsername <> '$user' and (p.name = 'Sobretudo')";
								$getprod2mao = mysqli_query($conn, $prod2maoQuery);

								if(!$getprod2mao)
									die("Error, select query failed:" . $prod2maoQuery);

								if(mysqli_num_rows($getprod2mao)>0) {
									while  ($row = mysqli_fetch_array($getprod2mao)) {
										$idProduc = $row[0];
										$tamanho = $row[1];
										$preco = $row[2];
										$titulo = $row[3];
										$descricao = $row[4];
										$localizacao = $row[5];
										$brand = $row[6];

										echo "<div class='produc'>
											<div class='producImage' id='$idProduc'>
											<a href='product2mao.php?refProduct=$idProduc' style='width:100%;height:100%;'>
												<img src='productsImage/$idProduc.jpg' class='$idProduc' style='width:100%;height:100%;'>
											</a>
											<div class='clickIcon1'>
												<form action='phpScripts/storeScript2mao.php' method='post' enctype='multipart/form-data'>
													<div class='addwishTitle'>
														<p>Adicionar a uma wishlist</p>
													</div>
													<div class='addwishButtons'>";
														$wishWishQuery ="select * from venda2mao where idProduct='$idProduc'";
														$checkWishWish = mysqli_query($conn, $wishWishQuery);

														$row222 = mysqli_fetch_array($checkWishWish);

														$uu = $row222[0];

														if ($uu != $name){

															$wishQuery = "select * FROM wishlists where idUser ='$user'";
															$getWish = mysqli_query($conn, $wishQuery);

															if(!$getWish)
																die("Error, select query failed:" . $wishQuery);

															if(mysqli_num_rows($getWish)>0) {
																while  ($row1 = mysqli_fetch_array($getWish)) {
																	$idWish = $row1[0];
																	$nameWish = $row1[2];
																	$value = $idProduc . "," . $idWish;
																	echo "<button type='submit' class='ButtonOption' name='addWish' value='$value'>Wishlist $nameWish</button>";
																}
															}
														}
														else{
															echo "<p style='text-align: center;padding-top: 36%;'>Este produto é seu</p>";
														}


													echo "</div>
												</form>
											</div>
										</div>
										<div class='producText'>
											<div class='producInfo'>
												<div class='producLeft'>
													<div class='producTitle'>
														<p style='padding-top: 5%;font-size: 16px;font-weight: bold;margin-left: 5%;'>$titulo</p>
													</div>
													<div class='producBrand'>
														<p style='font-size: 11px;margin-left: 5%;padding-top: 5%;'>$brand</p>
													</div>
													<div class='producSize'>
														<p style='font-size: 11px;margin-left: 5%;font-weight: 600;padding-top: 5%;'>$tamanho</p>
													</div>
												</div>
												<div class='producRight'>
													<div class='producPrice'>
														<p style='font-size: 22px;text-align: center;padding-top: 6%;'>$preco"."€</p>
													</div>
													<div class='producLocal'>
														<p style='font-size:11px; text-align:center;'>$localizacao </p>
													</div>
												</div>
											</div>
											<div class='producOption'>
												<i id='icon' class='fas fa-star $idProduc' style='cursor: pointer;font-size: 30px;text-align: center;padding-left: 27%;padding-top: 31%;'></i>
											</div>
										</div>
									</div>";
									}
								}
							?>
						</div>
						<div class='theProducts2Mao' id='option09'>
						<?php
								$prod2maoQuery = "select v.idProduct, v.tamanho, v.preco, v.titulo, v.descricao, v.localizacao, p.brand FROM venda2mao v, productsu p WHERE p.id = v.idProduct and v.idUsername <> '$user' and (p.name = 'Calças' or p.name = 'Jeans')";
								$getprod2mao = mysqli_query($conn, $prod2maoQuery);

								if(!$getprod2mao)
									die("Error, select query failed:" . $prod2maoQuery);

								if(mysqli_num_rows($getprod2mao)>0) {
									while  ($row = mysqli_fetch_array($getprod2mao)) {
										$idProduc = $row[0];
										$tamanho = $row[1];
										$preco = $row[2];
										$titulo = $row[3];
										$descricao = $row[4];
										$localizacao = $row[5];
										$brand = $row[6];

										echo "<div class='produc'>
											<div class='producImage' id='$idProduc'>
											<a href='product2mao.php?refProduct=$idProduc' style='width:100%;height:100%;'>
												<img src='productsImage/$idProduc.jpg' class='$idProduc' style='width:100%;height:100%;'>
											</a>
											<div class='clickIcon1'>
												<form action='phpScripts/storeScript2mao.php' method='post' enctype='multipart/form-data'>
													<div class='addwishTitle'>
														<p>Adicionar a uma wishlist</p>
													</div>
													<div class='addwishButtons'>";
														$wishWishQuery ="select * from venda2mao where idProduct='$idProduc'";
														$checkWishWish = mysqli_query($conn, $wishWishQuery);

														$row222 = mysqli_fetch_array($checkWishWish);

														$uu = $row222[0];

														if ($uu != $name){

															$wishQuery = "select * FROM wishlists where idUser ='$user'";
															$getWish = mysqli_query($conn, $wishQuery);

															if(!$getWish)
																die("Error, select query failed:" . $wishQuery);

															if(mysqli_num_rows($getWish)>0) {
																while  ($row1 = mysqli_fetch_array($getWish)) {
																	$idWish = $row1[0];
																	$nameWish = $row1[2];
																	$value = $idProduc . "," . $idWish;
																	echo "<button type='submit' class='ButtonOption' name='addWish' value='$value'>Wishlist $nameWish</button>";
																}
															}
														}
														else{
															echo "<p style='text-align: center;padding-top: 36%;'>Este produto é seu</p>";
														}


													echo "</div>
												</form>
											</div>
										</div>
										<div class='producText'>
											<div class='producInfo'>
												<div class='producLeft'>
													<div class='producTitle'>
														<p style='padding-top: 5%;font-size: 16px;font-weight: bold;margin-left: 5%;'>$titulo</p>
													</div>
													<div class='producBrand'>
														<p style='font-size: 11px;margin-left: 5%;padding-top: 5%;'>$brand</p>
													</div>
													<div class='producSize'>
														<p style='font-size: 11px;margin-left: 5%;font-weight: 600;padding-top: 5%;'>$tamanho</p>
													</div>
												</div>
												<div class='producRight'>
													<div class='producPrice'>
														<p style='font-size: 22px;text-align: center;padding-top: 6%;'>$preco"."€</p>
													</div>
													<div class='producLocal'>
														<p style='font-size:11px; text-align:center;'>$localizacao </p>
													</div>
												</div>
											</div>
											<div class='producOption'>
												<i id='icon' class='fas fa-star $idProduc' style='cursor: pointer;font-size: 30px;text-align: center;padding-left: 27%;padding-top: 31%;'></i>
											</div>
										</div>
									</div>";
									}
								}
							?>
						</div>
						<div class='theProducts2Mao' id='option010'>
						<?php
								$prod2maoQuery = "select v.idProduct, v.tamanho, v.preco, v.titulo, v.descricao, v.localizacao, p.brand FROM venda2mao v, productsu p WHERE p.id = v.idProduct and v.idUsername <> '$user' and (p.name = 'Saia' or p.name = 'Calções')";
								$getprod2mao = mysqli_query($conn, $prod2maoQuery);

								if(!$getprod2mao)
									die("Error, select query failed:" . $prod2maoQuery);

								if(mysqli_num_rows($getprod2mao)>0) {
									while  ($row = mysqli_fetch_array($getprod2mao)) {
										$idProduc = $row[0];
										$tamanho = $row[1];
										$preco = $row[2];
										$titulo = $row[3];
										$descricao = $row[4];
										$localizacao = $row[5];
										$brand = $row[6];

										echo "<div class='produc'>
											<div class='producImage' id='$idProduc'>
											<a href='product2mao.php?refProduct=$idProduc' style='width:100%;height:100%;'>
												<img src='productsImage/$idProduc.jpg' class='$idProduc' style='width:100%;height:100%;'>
											</a>
											<div class='clickIcon1'>
												<form action='phpScripts/storeScript2mao.php' method='post' enctype='multipart/form-data'>
													<div class='addwishTitle'>
														<p>Adicionar a uma wishlist</p>
													</div>
													<div class='addwishButtons'>";
														$wishWishQuery ="select * from venda2mao where idProduct='$idProduc'";
														$checkWishWish = mysqli_query($conn, $wishWishQuery);

														$row222 = mysqli_fetch_array($checkWishWish);

														$uu = $row222[0];

														if ($uu != $name){

															$wishQuery = "select * FROM wishlists where idUser ='$user'";
															$getWish = mysqli_query($conn, $wishQuery);

															if(!$getWish)
																die("Error, select query failed:" . $wishQuery);

															if(mysqli_num_rows($getWish)>0) {
																while  ($row1 = mysqli_fetch_array($getWish)) {
																	$idWish = $row1[0];
																	$nameWish = $row1[2];
																	$value = $idProduc . "," . $idWish;
																	echo "<button type='submit' class='ButtonOption' name='addWish' value='$value'>Wishlist $nameWish</button>";
																}
															}
														}
														else{
															echo "<p style='text-align: center;padding-top: 36%;'>Este produto é seu</p>";
														}


													echo "</div>
												</form>
											</div>
										</div>
										<div class='producText'>
											<div class='producInfo'>
												<div class='producLeft'>
													<div class='producTitle'>
														<p style='padding-top: 5%;font-size: 16px;font-weight: bold;margin-left: 5%;'>$titulo</p>
													</div>
													<div class='producBrand'>
														<p style='font-size: 11px;margin-left: 5%;padding-top: 5%;'>$brand</p>
													</div>
													<div class='producSize'>
														<p style='font-size: 11px;margin-left: 5%;font-weight: 600;padding-top: 5%;'>$tamanho</p>
													</div>
												</div>
												<div class='producRight'>
													<div class='producPrice'>
														<p style='font-size: 22px;text-align: center;padding-top: 6%;'>$preco"."€</p>
													</div>
													<div class='producLocal'>
														<p style='font-size:11px; text-align:center;'>$localizacao </p>
													</div>
												</div>
											</div>
											<div class='producOption'>
												<i id='icon' class='fas fa-star $idProduc' style='cursor: pointer;font-size: 30px;text-align: center;padding-left: 27%;padding-top: 31%;'></i>
											</div>
										</div>
									</div>";
									}
								}
							?>
						</div>
						<div class='theProducts2Mao' id='option011'>
						<?php
								$prod2maoQuery = "select v.idProduct, v.tamanho, v.preco, v.titulo, v.descricao, v.localizacao, p.brand FROM venda2mao v, productsu p WHERE p.id = v.idProduct and v.idUsername <> '$user' and (p.name = 'Calçado')";
								$getprod2mao = mysqli_query($conn, $prod2maoQuery);

								if(!$getprod2mao)
									die("Error, select query failed:" . $prod2maoQuery);

								if(mysqli_num_rows($getprod2mao)>0) {
									while  ($row = mysqli_fetch_array($getprod2mao)) {
										$idProduc = $row[0];
										$tamanho = $row[1];
										$preco = $row[2];
										$titulo = $row[3];
										$descricao = $row[4];
										$localizacao = $row[5];
										$brand = $row[6];

										echo "<div class='produc'>
											<div class='producImage' id='$idProduc'>
											<a href='product2mao.php?refProduct=$idProduc' style='width:100%;height:100%;'>
												<img src='productsImage/$idProduc.jpg' class='$idProduc' style='width:100%;height:100%;'>
											</a>
											<div class='clickIcon1'>
												<form action='phpScripts/storeScript2mao.php' method='post' enctype='multipart/form-data'>
													<div class='addwishTitle'>
														<p>Adicionar a uma wishlist</p>
													</div>
													<div class='addwishButtons'>";
														$wishWishQuery ="select * from venda2mao where idProduct='$idProduc'";
														$checkWishWish = mysqli_query($conn, $wishWishQuery);

														$row222 = mysqli_fetch_array($checkWishWish);

														$uu = $row222[0];

														if ($uu != $name){

															$wishQuery = "select * FROM wishlists where idUser ='$user'";
															$getWish = mysqli_query($conn, $wishQuery);

															if(!$getWish)
																die("Error, select query failed:" . $wishQuery);

															if(mysqli_num_rows($getWish)>0) {
																while  ($row1 = mysqli_fetch_array($getWish)) {
																	$idWish = $row1[0];
																	$nameWish = $row1[2];
																	$value = $idProduc . "," . $idWish;
																	echo "<button type='submit' class='ButtonOption' name='addWish' value='$value'>Wishlist $nameWish</button>";
																}
															}
														}
														else{
															echo "<p style='text-align: center;padding-top: 36%;'>Este produto é seu</p>";
														}


													echo "</div>
												</form>
											</div>
										</div>
										<div class='producText'>
											<div class='producInfo'>
												<div class='producLeft'>
													<div class='producTitle'>
														<p style='padding-top: 5%;font-size: 16px;font-weight: bold;margin-left: 5%;'>$titulo</p>
													</div>
													<div class='producBrand'>
														<p style='font-size: 11px;margin-left: 5%;padding-top: 5%;'>$brand</p>
													</div>
													<div class='producSize'>
														<p style='font-size: 11px;margin-left: 5%;font-weight: 600;padding-top: 5%;'>$tamanho</p>
													</div>
												</div>
												<div class='producRight'>
													<div class='producPrice'>
														<p style='font-size: 22px;text-align: center;padding-top: 6%;'>$preco"."€</p>
													</div>
													<div class='producLocal'>
														<p style='font-size:11px; text-align:center;'>$localizacao </p>
													</div>
												</div>
											</div>
											<div class='producOption'>
												<i id='icon' class='fas fa-star $idProduc' style='cursor: pointer;font-size: 30px;text-align: center;padding-left: 27%;padding-top: 31%;'></i>
											</div>
										</div>
									</div>";
									}
								}
							?>
						</div>
						<div class='theProducts2Mao' id='option012'>
						<?php
								$prod2maoQuery = "select v.idProduct, v.tamanho, v.preco, v.titulo, v.descricao, v.localizacao, p.brand FROM venda2mao v, productsu p WHERE p.id = v.idProduct and v.idUsername <> '$user' and (p.name = 'Acessórios')";
								$getprod2mao = mysqli_query($conn, $prod2maoQuery);

								if(!$getprod2mao)
									die("Error, select query failed:" . $prod2maoQuery);

								if(mysqli_num_rows($getprod2mao)>0) {
									while  ($row = mysqli_fetch_array($getprod2mao)) {
										$idProduc = $row[0];
										$tamanho = $row[1];
										$preco = $row[2];
										$titulo = $row[3];
										$descricao = $row[4];
										$localizacao = $row[5];
										$brand = $row[6];

										echo "<div class='produc'>
											<div class='producImage' id='$idProduc'>
											<a href='product2mao.php?refProduct=$idProduc' style='width:100%;height:100%;'>
												<img src='productsImage/$idProduc.jpg' class='$idProduc' style='width:100%;height:100%;'>
											</a>
											<div class='clickIcon1'>
												<form action='phpScripts/storeScript2mao.php' method='post' enctype='multipart/form-data'>
													<div class='addwishTitle'>
														<p>Adicionar a uma wishlist</p>
													</div>
													<div class='addwishButtons'>";
														$wishWishQuery ="select * from venda2mao where idProduct='$idProduc'";
														$checkWishWish = mysqli_query($conn, $wishWishQuery);

														$row222 = mysqli_fetch_array($checkWishWish);

														$uu = $row222[0];

														if ($uu != $name){

															$wishQuery = "select * FROM wishlists where idUser ='$user'";
															$getWish = mysqli_query($conn, $wishQuery);

															if(!$getWish)
																die("Error, select query failed:" . $wishQuery);

															if(mysqli_num_rows($getWish)>0) {
																while  ($row1 = mysqli_fetch_array($getWish)) {
																	$idWish = $row1[0];
																	$nameWish = $row1[2];
																	$value = $idProduc . "," . $idWish;
																	echo "<button type='submit' class='ButtonOption' name='addWish' value='$value'>Wishlist $nameWish</button>";
																}
															}
														}
														else{
															echo "<p style='text-align: center;padding-top: 36%;'>Este produto é seu</p>";
														}


													echo "</div>
												</form>
											</div>
										</div>
										<div class='producText'>
											<div class='producInfo'>
												<div class='producLeft'>
													<div class='producTitle'>
														<p style='padding-top: 5%;font-size: 16px;font-weight: bold;margin-left: 5%;'>$titulo</p>
													</div>
													<div class='producBrand'>
														<p style='font-size: 11px;margin-left: 5%;padding-top: 5%;'>$brand</p>
													</div>
													<div class='producSize'>
														<p style='font-size: 11px;margin-left: 5%;font-weight: 600;padding-top: 5%;'>$tamanho</p>
													</div>
												</div>
												<div class='producRight'>
													<div class='producPrice'>
														<p style='font-size: 22px;text-align: center;padding-top: 6%;'>$preco"."€</p>
													</div>
													<div class='producLocal'>
														<p style='font-size:11px; text-align:center;'>$localizacao </p>
													</div>
												</div>
											</div>
											<div class='producOption'>
												<i id='icon' class='fas fa-star $idProduc' style='cursor: pointer;font-size: 30px;text-align: center;padding-left: 27%;padding-top: 31%;'></i>
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
	<script type="text/javascript" src="js/cesto.js"></script>
	<script>
        $(document).ready(function(){
            $(".clickToSearch").click(function() {
                $('.writeSearch > input').css('display','block');
                $('.writeSearch > i').css('display','block');
                $('.clickToSearch').css('display','none');
                $('.clickToSearch1').css('display','block');
            });
            $(".clickToSearch1").click(function() {
                $('.writeSearch > input').css('display','none');
                $('.writeSearch > i').css('display','none');
                $('.clickToSearch1').css('display','none');
                $('.clickToSearch').css('display','block');
            });
            $('.optionCarrinho').click(function() {
                if ( $('.optionCarrinho').attr('id') == 'click')
                {
                    $("#cesta").css('display','block');
                    $('.optionCarrinho').attr('id', 'notclick');
                }
                else
                {
                    $("#cesta").css('display','none');
                    $('.optionCarrinho').attr('id', 'click');
                }
			});

			$(".fas").on("click", function(){
				var myClass = $(this).attr("class");
				var numb =myClass.length;
				var res = myClass.slice(12, numb);
				var classI = "a." + res;
				var idId = "#" + res;

				if ($(idId + ' > .clickIcon1').css('display') == 'none'){
					$(classI).css("display","none");
					$(idId + ' > .clickIcon1').css("display","inline-block");
					$(classI).css("margin","0");
					$(idId + ' > .clickIcon1 > form').css("display","inline-block");
				}
				else{
					$(classI).css("display","block");
					$(idId + ' > .clickIcon1').css("display","none");
					$(idId + ' > .clickIcon1 > form').css("display","none");
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
