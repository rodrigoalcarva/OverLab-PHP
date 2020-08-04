<?php
	session_start();
	include "../phpScripts/accessBD.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Cachecóis de Homem</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="keywords">
  <meta content="" name="description">
  <link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet">


  <!-- Favicons -->
  <link href="../img/favicon.png" rel="icon">
  <link href="../img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Poppins:300,400,500,700" rel="stylesheet">

  <!-- Bootstrap CSS File -->
  <link href="../lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- JavaScript CSS File -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" rel="stylesheet">

  <!-- Libraries CSS Files -->
  <link href="../lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="../lib/animate/animate.min.css" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../vendor/icofont/icofont.min.css" rel="stylesheet">
  <link href="../vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="../vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="../vendor/venobox/venobox.css" rel="stylesheet">
  <link href="../vendor/aos/aos.css" rel="stylesheet">

  <!-- Main Stylesheet File -->
  <link href="../css/style.css" rel="stylesheet">
  <link href="../css/navbar.css" rel="stylesheet">
  <link href="../css/store.css" rel="stylesheet">
  <script src="https://kit.fontawesome.com/a81368914c.js"></script>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

</head>
<body>
	<?php
		if (isset($_SESSION["messageReceived"])) {
			echo "<script>alert('". $_SESSION["messageReceived"] ."');</script>";
			unset($_SESSION["messageReceived"]);
		}


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
			<a href="../mycloset.php">
				<img src="../img/logo.png" alt="" title="" /></img>
			</a>
		</div>

		<nav id="nav-menu-container">
			<ul class="nav-menu">
			<li><a href="../mycloset.php">My Closet</a></li>
			<li><a href="../followers.php">Friends</a></li>
            <li><a href="../wishlist.php">Wishlist</a></li>
            <li><a href="../mystore2mao.php">My Store</a></li>
			<li class="menu-active"><a href="../store.php">Store</a></li>
			<li><a href="../contacts.php">Company</a></li>
			<li><a href="../help.php"><i class="icofont-question-circle"></i></a></li>
			<li style="margin-left:11%"><a href="../userpage.php">Conta - <?php echo $_SESSION['username'] ?></a></li>
			<li><a href="../phpScripts/logout.php">Logout</a></li>
			</ul>
		</nav><!-- #nav-menu-container -->
  	</header><!-- #header -->
	<!--==========================
    Hero Section
  	============================-->
  	<section id="hero" >
    	<div class="hero-container" >
            <div class="containerStore">
                <div class='headerStore'>
                    <div class='optionStore'>
                        <a href='../storeStores.php' style='text-align:left;color:#666666;'><p style="padding-top: 33%;font-size: 17px;margin-left: 25%;">Lojas</p></a>
                    </div>
                    <div class='optionCategory'>
                        <p class='clickCategories' id='clickDrop' style="padding-top: 20%;font-size: 17px;">Categorias</p>
                    </div>
                    <div class='optionCarrinho'>
                        <div id="cesto">
                            <i style = "font-size:20px; margin-left: 39%;"class="icofont-bag"></i>
                            <p style = "font-size:12px; text-align:center; cursor:pointer;">Cesto</p>
                        </div>
                    </div>
                    <div class='optionSearch' id="click">
                        <div class='writeSearch'>
                            <input style = "font-size: 12px;margin-top: 7%;margin-left: 3%;border: 0px;background-color: transparent;border-bottom: 1px solid black;width: 80%; float:left;"type="text" id="pesquisa" name="pesquisa" placeholder="Introduza o nome da loja">
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
                <div id='categories'>
                        <div id='parteMulher'>
                            <div class='parteRoupa'>
                                <p style='font-size: 16px;font-weight: bold;padding-left: 8%;padding-top: 4%;margin: 0;'>Mulher</p>
                                <p style='padding-left: 8%;font-size: 12px;padding-top: 4%;text-decoration: underline;font-weight: 500;margin: 0;padding-bottom: 5%;'>Roupa</p>
                                <a href='../mulher/tshirts.php' style='text-align:left' ><p style='margin: 0;font-size: 11px;padding-left: 8%;'>Tshirts</p></a>
                                <a href='../mulher/tops.php' style='text-align:left' ><p style='margin: 0;font-size: 11px;padding-left: 8%;'>Tops</p></a>
                                <a href='../mulher/polos.php' style='text-align:left' ><p style='margin: 0;font-size: 11px;padding-left: 8%;'>Polos</p></a>
                                <a href='../mulher/camisas.php' style='text-align:left' ><p style='margin: 0;font-size: 11px;padding-left: 8%;'>Camisas</p></a>
                                <a href='../mulher/vestidos.php' style='text-align:left' ><p style='margin: 0;font-size: 11px;padding-left: 8%;'>Vestidos</p></a>
                                <a href='../mulher/macacoes.php' style='text-align:left' ><p style='margin: 0;font-size: 11px;padding-left: 8%;'>Macacões</P></a>
                                <a href='../mulher/casacos.php' style='text-align:left' ><p style='margin: 0;font-size: 11px;padding-left: 8%;'>Casacos</p></a>
                                <a href='../mulher/blusoes.php' style='text-align:left' ><p style='margin: 0;font-size: 11px;padding-left: 8%;'>Blusões</p></a>
                                <a href='../mulher/camisolas.php' style='text-align:left' ><p style='margin: 0;font-size: 11px;padding-left: 8%;'>Camisolas</p></a>
                                <a href='../mulher/malhas.php' style='text-align:left' ><p style='margin: 0;font-size: 11px;padding-left: 8%;'>Malhas</p></a>
                                <a href='../mulher/blazers.php' style='text-align:left' ><p style='margin: 0;font-size: 11px;padding-left: 8%;'>Blazers</p></a>
                                <a href='../mulher/calcas.php' style='text-align:left' ><p style='margin: 0;font-size: 11px;padding-left: 8%;'>Calças</p></a>
                                <a href='../mulher/jeans.php' style='text-align:left' ><p style='margin: 0;font-size: 11px;padding-left: 8%;'>Jeans</p></a>
                                <a href='../mulher/calcoes.php' style='text-align:left' ><p style='margin: 0;font-size: 11px;padding-left: 8%;'>Calções</p></a>
                                <a href='../mulher/saias.php' style='text-align:left' ><p style='margin: 0;font-size: 11px;padding-left: 8%;'>Saias</P></a>
                                <a href='../mulher/fatosdebanho.php' style='text-align:left' ><p style='margin: 0;font-size: 11px;padding-left: 8%;'>Fatos de Banho</p></a>
                            </div>
                            <div class='parteCalçado'>
                                <p style='padding-left: 8%;font-size: 12px;padding-top: 49%;text-decoration: underline;font-weight: 500;margin: 0;padding-bottom: 5%;'>Calçado</p>
                                <a href='../mulher/tenis.php' style='text-align:left' ><p style='margin: 0;font-size: 11px;padding-left: 8%;'>Ténis</p></a>
                                <a href='../mulher/sapatosociais.php' style='text-align:left' ><p style='margin: 0;font-size: 11px;padding-left: 8%;'>Sociais</p></a>
                                <a href='../mulher/botas.php' style='text-align:left' ><p style='margin: 0;font-size: 11px;padding-left: 8%;'>Botas</p></a>
                                <a href='../mulher/sandalias.php' style='text-align:left' ><p style='margin: 0;font-size: 11px;padding-left: 8%;'>Sandálias</p></a>
                                <a href='../mulher/chinelos.php' style='text-align:left' ><p style='margin: 0;font-size: 11px;padding-left: 8%;'>Chinelos</p></a>

                            </div>
                            <div class='parteAcessorios'>
                                <p style='padding-left: 8%;font-size: 12px;padding-top: 41%;text-decoration: underline;font-weight: 500;margin: 0;padding-bottom: 5%;'>Acessórios</p>
                                <a href='../mulher/brincos.php' style='text-align:left' ><p style='margin: 0;font-size: 11px;padding-left: 8%;'>Brincos</p></a>
                                <a href='../mulher/aneis.php' style='text-align:left' ><p style='margin: 0;font-size: 11px;padding-left: 8%;'>Anéis</p></a>
                                <a href='../mulher/colares.php' style='text-align:left' ><p style='margin: 0;font-size: 11px;padding-left: 8%;'>Colares</p></a>
                                <a href='../mulher/pulseiras.php' style='text-align:left' ><p style='margin: 0;font-size: 11px;padding-left: 8%;'>Pulseiras</p></a>
                                <a href='../mulher/relogios.php' style='text-align:left' ><p style='margin: 0;font-size: 11px;padding-left: 8%;'>Relógios</p></a>
                                <a href='../mulher/oculos.php' style='text-align:left' ><p style='margin: 0;font-size: 11px;padding-left: 8%;'>Óculos</p></a>
                                <a href='../mulher/malas.php' style='text-align:left' ><p style='margin: 0;font-size: 11px;padding-left: 8%;'>Malas</p></a>
                                <a href='../mulher/chapeus.php' style='text-align:left'><p style='margin: 0;font-size: 11px;padding-left: 8%;'>Chapeús</p></a>
                                <a href='../mulher/cintos.php' style='text-align:left' ><p style='margin: 0;font-size: 11px;padding-left: 8%;'>Cintos</p></a>
                                <a href='../mulher/lacos.php' style='text-align:left' ><p style='margin: 0;font-size: 11px;padding-left: 8%;'>Laços</p></a>
                                <a href='../mulher/cachecois.php' style='text-align:left' ><p style='margin: 0;font-size: 11px;padding-left: 8%;'>Cachecóis</p></a>
                            </div>
                        </div>
                        <div id='parteHomem'>
                            <div class='parteRoupa'>
                                <p style='font-size: 16px;font-weight: bold;padding-left: 8%;padding-top: 4%;margin: 0;'>Homem</p>
                                <p style='padding-left: 8%;font-size: 12px;padding-top: 4%;text-decoration: underline;font-weight: 500;margin: 0;padding-bottom: 5%;'>Roupa</p>
                                <a href='../homem/tshirts.php' style='text-align:left' ><p style='margin: 0;font-size: 11px;padding-left: 8%;'>Tshirts</p></a>
                                <a href='../homem/polos.php' style='text-align:left' ><p style='margin: 0;font-size: 11px;padding-left: 8%;'>Polos</p></a>
                                <a href='../homem/camisas.php' style='text-align:left' ><p style='margin: 0;font-size: 11px;padding-left: 8%;'>Camisas</p></a>
                                <a href='../homem/casacos.php' style='text-align:left' ><p style='margin: 0;font-size: 11px;padding-left: 8%;'>Casacos</p></a>
                                <a href='../homem/sweatshirts.php' style='text-align:left' ><p style='margin: 0;font-size: 11px;padding-left: 8%;'>Sweatshirts</p></a>
                                <a href='../homem/blusoes.php' style='text-align:left' ><p style='margin: 0;font-size: 11px;padding-left: 8%;'>Blusões</p></a>
                                <a href='../homem/sobretudos.php' style='text-align:left' ><p style='margin: 0;font-size: 11px;padding-left: 8%;'>Sobretudos</p></a>
                                <a href='../homem/camisolas.php' style='text-align:left' ><p style='margin: 0;font-size: 11px;padding-left: 8%;'>Camisolas</p></a>
                                <a href='../homem/malhas.php' style='text-align:left' ><p style='margin: 0;font-size: 11px;padding-left: 8%;'>Malhas</p></a>
                                <a href='../homem/blazers.php' style='text-align:left' ><p style='margin: 0;font-size: 11px;padding-left: 8%;'>Blazers</p></a>
                                <a href='../homem/calcas.php' style='text-align:left' ><p style='margin: 0;font-size: 11px;padding-left: 8%;'>Calças</p></a>
                                <a href='../homem/jeans.php' style='text-align:left' ><p style='margin: 0;font-size: 11px;padding-left: 8%;'>Jeans</p></a>
                                <a href='../homem/calcoes.php' style='text-align:left' ><p style='margin: 0;font-size: 11px;padding-left: 8%;'>Calções</p></a>
                                <a href='../homem/saias.php' style='text-align:left' ><p style='margin: 0;font-size: 11px;padding-left: 8%;'>Saias</P></a>
                                <a href='../homem/fatosdebanho.php' style='text-align:left' ><p style='margin: 0;font-size: 11px;padding-left: 8%;'>Fatos de Banho</p></a>
                            </div>
                            <div class='parteCalçado'>
                                <p style='padding-left: 8%;font-size: 12px;padding-top: 49%;text-decoration: underline;font-weight: 500;margin: 0;padding-bottom: 5%;'>Calçado</p>
                                <a href='../homem/tenis.php' style='text-align:left' ><p style='margin: 0;font-size: 11px;padding-left: 8%;'>Ténis</p></a>
                                <a href='../homem/sapatossociais.php' style='text-align:left' ><p style='margin: 0;font-size: 11px;padding-left: 8%;'>Sociais</p></a>
                                <a href='../homem/botas.php' style='text-align:left' ><p style='margin: 0;font-size: 11px;padding-left: 8%;'>Botas</p></a>
                                <a href='../homem/sandalias.php' style='text-align:left' ><p style='margin: 0;font-size: 11px;padding-left: 8%;'>Sandálias</p></a>
                                <a href='../homem/chinelos.php' style='text-align:left' ><p style='margin: 0;font-size: 11px;padding-left: 8%;'>Chinelos</p></a>

                            </div>
                            <div class='parteAcessorios'>
                                <p style='padding-left: 8%;font-size: 12px;padding-top: 41%;text-decoration: underline;font-weight: 500;margin: 0;padding-bottom: 5%;'>Acessórios</p>
                                <a href='../homem/pulseiras.php' style='text-align:left' ><p style='margin: 0;font-size: 11px;padding-left: 8%;'>Pulseiras</p></a>
                                <a href='../homem/relogios.php' style='text-align:left'><p style='margin: 0;font-size: 11px;padding-left: 8%;'>Relógios</p></a>
                                <a href='../homem/oculos.php' style='text-align:left' ><p style='margin: 0;font-size: 11px;padding-left: 8%;'>Óculos</p></a>
                                <a href='../homem/malas.php' style='text-align:left' ><p style='margin: 0;font-size: 11px;padding-left: 8%;'>Malas</p></a>
                                <a href='../homem/gravatas.php' style='text-align:left'><p style='margin: 0;font-size: 11px;padding-left: 8%;'>Gravatas</p></a>
                                <a href='../homem/chapeus.php' style='text-align:left' ><p style='margin: 0;font-size: 11px;padding-left: 8%;'>Chapeús</p></a>
                                <a href='../homem/cintos.php' style='text-align:left' ><p style='margin: 0;font-size: 11px;padding-left: 8%;'>Cintos</p></a>
                                <a href='../homem/lacos.php' style='text-align:left'><p style='margin: 0;font-size: 11px;padding-left: 8%;'>Laços</p></a>
                                <a href='../homem/cachecois.php' style='text-align:left' ><p style='margin: 0;font-size: 11px;padding-left: 8%;'>Cachecóis</p></a>
                            </div>
                        </div>
                    </div>
                    <?php
                            $cestoQuery = "select * from cestodesigners where idUsername='$name'";
                            $checkCesto = mysqli_query($conn, $cestoQuery);

                            if(!$checkCesto)
									die("Error, select query failed:" . $cestoQuery);

							if(mysqli_num_rows($checkCesto)>0) {
                                $cestoCountQuery = "select count(*) from cestodesigners where idUsername='$name'";
                                $checkCestoCount = mysqli_query($conn, $cestoCountQuery);

                                $row2 =mysqli_fetch_array($checkCestoCount);
                                $num = $row2[0];
                                echo "<div id='cesta'><div class='cestoHeader'>
                                    <p>Cesto ($num)</p>
                                </div>";
                                echo "<div class='cestoContainer'>";

                                    $sum = 0;

                                    while ($row = mysqli_fetch_array($checkCesto)) {
                                        $idaaa = $row[1];

                                        $selectSelect = "select * from cestodesigners where idProduct ='$idaaa'";
                                        $checkSelect = mysqli_query($conn, $selectSelect);

                                        $rowA = mysqli_fetch_array($checkSelect);

                                        $a = $rowA["tamanho"];
                                        $b = $rowA["quant"];

                                        $selectSelect1 = "select * from productsd where id ='$idaaa'";
                                        $checkSelect1 = mysqli_query($conn, $selectSelect1);

                                        $rowB = mysqli_fetch_array($checkSelect1);

                                        $c = $rowB["name"];
                                        $d = $rowB["color"];
                                        $e = $rowB[8];

                                        $sum = $sum + ($b * $e);

																				$conj = $idaaa . "," . $a;
                                        echo "<div class='itemCesto'>
                                            <div class='itemCestoLeft'>
                                                <div class='itemCestoImg'>
                                                    <img src='productsImage/$idaaa.jpg' style='width: 100%;height: 100%;'>
                                                </div>
                                            </div>
                                            <div class='itemCestoMiddle'>
                                                <p style='margin: 0;font-size: 16px;padding-top: 7%;font-weight: bold;'>$c</p>
                                                <p style='margin: 0;font-size: 10px;font-weight: 100;'>Cor: $d</p>
                                                <p style='margin: 0;font-size: 10px;font-weight: 100;'>Tam: $a</p>
                                                <p style='margin: 0;font-size: 10px;font-weight: 100;'>Quant.: $b</p>
                                            </div>
                                            <div class='itemCestoRight'>
                                                <div class='itemCestoPrice'>
                                                    <p style='padding-top: 24%; font-size: 13px; font-weight: bold; float:right;'>".$e."€ </p>
                                                </div>
                                                <div class='itemCestoDelete'>
																									<form action='phpScripts/storeScriptDesigner.php' method='post' enctype='multipart/form-data'  style='width:100%;height:100%;'>
                                                    <button name='deleteCesto' value='$conj' style='background-color: transparent;border: 0px;color: black;float: right;'><i class='icofont-trash' style='font-size: 12px;float: right; margin-right: 13%;'></i></button>
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
                                            <form action='phpScripts/storeScriptDesigner.php' method='post' enctype='multipart/form-data' style='width:100%;height:100%;'>
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
                            <div id='listProductsTitle'>

                                   <p style='text-align: center;font-size: 30px;font-weight: bold;padding-top: 2%;color: black;'>Cachecóis</p>
                            </div>
                            <div id='listProductsCont'>
                            <?php
                                    $prodQuery = "select * from productsd d, stores s where d.category='Cachecol' and (d.gender='M' or d.gender='U') and d.brand = s.storename and s.plano='Premium'";
                                    $getProd = mysqli_query($conn, $prodQuery);

                                    if(mysqli_num_rows($getProd)>0) {
                                        while  ($row = mysqli_fetch_array($getProd)) {
                                            $idPro = $row[0];
                                            $namePro = $row[1];
                                            $categoryPro = $row[2];
                                            $pricePro =$row[8];
                                            echo "<div class='thePr'>
                                                    <div class='thePrImage' id='$idPro'>
                                                        <a class='$idPro' style='width:100%;height:100%;'>
                                                            <img src='../productsImage/$idPro.jpg' class='$idPro' style='width:100%;height:100%;'>
                                                        </a>
                                                        <div class='clickIcon1'>
                                                            <form action='../phpScripts/storeScriptDesigner.php' method='post' enctype='multipart/form-data'>
                                                                <div class='addwishTitle'>
                                                                    <p style='font-size:15px;'>Adicionar a uma wishlist</p>
                                                                </div>
                                                                <div class='addwishButtons'>";
                                                                    $wishQuery = "select * FROM wishlists where idUser ='$name'";
                                                                    $getWish = mysqli_query($conn, $wishQuery);

                                                                    if(!$getWish)
                                                                        die("Error, select query failed:" . $wishQuery);

                                                                    if(mysqli_num_rows($getWish)>0) {
                                                                        while  ($row1 = mysqli_fetch_array($getWish)) {
                                                                            $idWish = $row1[0];
                                                                            $nameWish = $row1[2];
                                                                            $value = $idPro . "," . $idWish;
                                                                            echo "<button type='submit' class='ButtonOption' name='addWishD' value='$value'>Wishlist $nameWish</button>";
                                                                        }
                                                                    }

                                                                echo "</div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                    <div class='thePrInfo'>
                                                        <div class='thePrInfoName'>
                                                            <p style='margin: 0;font-size: 16px;color: black;font-weight: 100;padding-left: 2%;'>$namePro - $categoryPro</p>
                                                            <p style='font-weight: 600;color: black;padding-left: 2%;'>$pricePro €</p>
                                                        </div>
                                                        <div class='thePrInfoOptions'>
                                                            <i id='icon' class='fas fa-star $idPro' style='cursor: pointer;font-size: 30px;text-align: center;padding-left: 27%;padding-top: 20%;'></i>
                                                        </div>
                                                    </div>
                                                </div>";
                                        }
                                    }

                                    $prodQuery = "select * from productsd d, stores s where d.category='Cachecol' and (d.gender='M' or d.gender='U') and d.brand = s.storename and s.plano='Free'";
                                    $getProd = mysqli_query($conn, $prodQuery);

                                    if(mysqli_num_rows($getProd)>0) {
                                        while  ($row2 = mysqli_fetch_array($getProd)) {
                                            $idPro = $row2[0];
                                            $namePro = $row2[1];
                                            $categoryPro = $row2[2];
                                            $pricePro =$row2[8];
                                            echo "<div class='thePr'>
                                                    <div class='thePrImage' id='$idPro'>
                                                        <a class='$idPro' style='width:100%;height:100%;'>
                                                            <img src='../productsImage/$idPro.jpg' class='$idPro' style='width:100%;height:100%;'>
                                                        </a>
                                                        <div class='clickIcon1'>
                                                            <form action='../phpScripts/storeScriptDesigner.php' method='post' enctype='multipart/form-data'>
                                                                <div class='addwishTitle'>
                                                                    <p style='font-size:15px;'>Adicionar a uma wishlist</p>
                                                                </div>
                                                                <div class='addwishButtons'>";
                                                                    $wishQuery = "select * FROM wishlists where idUser ='$name'";
                                                                    $getWish = mysqli_query($conn, $wishQuery);

                                                                    if(!$getWish)
                                                                        die("Error, select query failed:" . $wishQuery);

                                                                    if(mysqli_num_rows($getWish)>0) {
                                                                        while  ($row3 = mysqli_fetch_array($getWish)) {
                                                                            $idWish = $row3[0];
                                                                            $nameWish = $row3[2];
                                                                            $value = $idPro . "," . $idWish;
                                                                            echo "<button type='submit' class='ButtonOption' name='addWishD' value='$value'>Wishlist $nameWish</button>";
                                                                        }
                                                                    }

                                                                echo "</div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                    <div class='thePrInfo'>
                                                        <div class='thePrInfoName'>
                                                            <p style='margin: 0;font-size: 16px;color: black;font-weight: 100;padding-left: 2%;'>$namePro - $categoryPro</p>
                                                            <p style='font-weight: 600;color: black;padding-left: 2%;'>$pricePro €</p>
                                                        </div>
                                                        <div class='thePrInfoOptions'>
                                                            <i id='icon' class='fas fa-star $idPro' style='cursor: pointer;font-size: 30px;text-align: center;padding-left: 27%;padding-top: 20%;'></i>
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
	<script src="../lib/jquery/jquery.min.js"></script>
	<script src="../lib/jquery/jquery-migrate.min.js"></script>
	<script src="../lib/bootstrap/js/bootstrap.bundle.min.js"></script>
	<script src="../lib/easing/easing.min.js"></script>
	<script src="../lib/wow/wow.min.js"></script>
	<script src="../lib/waypoints/waypoints.min.js"></script>
	<script src="../lib/counterup/counterup.min.js"></script>
	<script src="../lib/superfish/hoverIntent.js"></script>
	<script src="../lib/superfish/superfish.min.js"></script>


	<!-- Template Main Javascript File -->
	<script type="text/javascript" src="../js/aaa.js"></script>
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
            $('.clickCategories').click(function() {
                if ( $('.clickCategories').attr('id') == 'clickDrop')
                {
                    $("#categories").css('display','block');
                    $('.clickCategories').attr('id', 'notclickDrop');
                }
                else
                {
                    $("#categories").css('display','none');
                    $('.clickCategories').attr('id', 'clickDrop');
                }
            });
            $(".fas").on("click", function(){
				var myClass = $(this).attr("class");
				var numb =myClass.length;
				var res = myClass.slice(12, numb);
				var classI = "a." + res;
                var idId = "#" + res;
                console.log(myClass);

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
