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
  <link href="css/store.css" rel="stylesheet">
  <script src="https://kit.fontawesome.com/a81368914c.js"></script>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
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

        if (isset($_GET['refProduct'])){
            $a = $_GET['refProduct'];
            $updateQuery = "update productsd set clicks = clicks + 1 where id='$a'";
            $checkUpdate = mysqli_query($conn, $updateQuery);
            if(!$checkUpdate)
                die("Error, select query failed:" . $updateQuery);

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
    <?php



        $proQuery = "select * from productsd where id='$a'";
        $checkPro = mysqli_query($conn, $proQuery);

		if(!$checkPro)
		    die("Error, select query failed:" . $proQuery);

        $row = mysqli_fetch_array($checkPro);

        $idPro = $row[0];
        $nameProd = $row[1];
        $category = $row[2];
        $brand = $row[3];
        $descricao = $row[4];
        $cor = $row[5];
        $utilidade = $row[6];
        $price = $row[8];

    ?>
  	<section id="hero">
    	<div class="hero-container" >
			<div class="containerStore">
                <div class='headerStore'>
                    <div class='optionStore' style="width:22%">
                        <a href='' style='text-align:left;color:#666666;'><p style="padding-top: 9%;font-size: 17px;margin-left: 18%;">Loja Designer - <?php echo $idPro; ?></p></a>
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


                    <div id="parteEsq">
                        <div id='parteFoto'>
                            <?php
                                echo "<img src='productsImage/$idPro.jpg'>";
                            ?>
                        </div>
                    </div>
                    <div id="parteDir">
                        <div id='parteTexto'>
                            <div id='parteProdTituloPreco'>
                                <div id='parteProdTitle'>
                                    <p style="    font-size: 29px;padding-top: 1%;font-weight: bold;"><?php echo $nameProd; ?></p>
                                </div>
                                <div id='parteProdPreco'>
                                    <p style="    font-size: 23px;padding-top: 6%;text-align: center;font-weight: 100;"><?php echo $price; ?>€</p>
                                </div>
                            </div>
                            <div id='parteProdRef'>
                                <p style="    font-size: 10px;"><?php echo $idPro . " - " . $brand; ?></p>
                            </div>
                            <div id='parteProdDescr'>
                                <p style='font-weight:100;color: #9c9c9c;font-size: 15px;'><?php echo $descricao; ?></p>
                            </div>
                            <div id='parteProdCor'>
                                <div id='parteQuadCor'>
                                    <?php
                                    echo "<div id='mostraCor' style='background-color:$cor'>

                                    </div>";
                                    ?>
                                </div>
                                <div id='parteTextCor'>
                                    <p style="float: right;margin-right: 10%;font-size: 15px;font-weight: 100;margin-top: 6%;"><?php echo $cor; ?></p>
                                </div>

                            </div>
                            <div id="parteProdTamanhoLocal" style="margin-top: 2%;">
                                <select id='selectTam' style="width: 100%;height: 80%;border: 1px solid #d7d7d8;background-color: #f9fafc;font-size:11px;padding-left:2%;">

                                <?php
                                    $stockQuery = "select * from stocksstores where idProduct='$idPro'";
                                    $getStock = mysqli_query($conn, $stockQuery);

                                    if ($category == 'Tshirt' or $category =='Top' or $category =='Polo' or $category =='Camisa' or $category =='Vestido' or $category =='Macacão' or $category =='Casaco' or $category =='Blusão' or $category =='Camisola' or $category =='Malha' or $category =='Blazer' or $category =='Sweatshirt' or $category =='Sobretudo' or $category == 'Fato de Banho'){
                                        echo "<option style='display:none'>Seleciona o teu tamanho</option>";
                                        while ($rowS = mysqli_fetch_array($getStock)){
                                            $tam = $rowS[1];
                                            $num = $rowS[2];
                                            if ($tam == 'XS' && $num == 0){
                                                echo "<option value='XS' disabled style='color:gray;'>XS - Esgotado</option>";
                                            }
                                            else if ($tam == 'XS' && $num != 0){
                                                echo "<option value='XS'>XS</option>";
                                            }
                                            else if ($tam == 'S' && $num == 0){
                                                echo "<option value='S' disabled style='color:gray;'>S - Esgotado</option>";
                                            }
                                            else if ($tam == 'S' && $num != 0){
                                                echo "<option value='S' >S </option>";
                                            }
                                            else if ($tam == 'M' && $num == 0){
                                                echo "<option value='M' disabled style='color:gray;'>M - Esgotado</option>";
                                            }
                                            else if ($tam == 'M' && $num != 0){
                                                echo "<option value='M' >M </option>";
                                            }
                                            else if ($tam == 'L' && $num == 0){
                                                echo "<option value='L' disabled style='color:gray;'>L - Esgotado</option>";
                                            }
                                            else if ($tam == 'L' && $num != 0){
                                                echo "<option value='L' >L </option>";
                                            }
                                            else if ($tam == 'XL' && $num == 0){
                                                echo "<option value='XL' disabled style='color:gray;'>XL - Esgotado</option>";
                                            }
                                            else {
                                                echo "<option value='XL' >XL </option>";
                                            }
                                        }
                                    }
                                    else if ($category == 'Calças' or $category == 'Jeans' or $category == "Calções" or $category == 'Saia'){
                                        echo "<option style='display:none'>Seleciona o teu tamanho</option>";
                                        while ($rowS = mysqli_fetch_array($getStock)){
                                            $tam = $rowS[1];
                                            $num = $rowS[2];
                                            if ($tam == '32' && $num == 0){
                                                echo "<option value='32' disabled style='color:gray;'>32 - Esgotado</option>";
                                            }
                                            else if ($tam == '32' && $num != 0){
                                                echo "<option value='32'>32</option>";
                                            }
                                            else if ($tam == '34' && $num == 0){
                                                echo "<option value='34' disabled style='color:gray;'>34 - Esgotado</option>";
                                            }
                                            else if ($tam == '34' && $num != 0){
                                                echo "<option value='34' >34 </option>";
                                            }
                                            else if ($tam == '36' && $num == 0){
                                                echo "<option value='36' disabled style='color:gray;'>36 - Esgotado</option>";
                                            }
                                            else if ($tam == '36' && $num != 0){
                                                echo "<option value='36' >36 </option>";
                                            }
                                            else if ($tam == '38' && $num == 0){
                                                echo "<option value='38' disabled style='color:gray;'>38 - Esgotado</option>";
                                            }
                                            else if ($tam == '38' && $num != 0){
                                                echo "<option value='38' >38 </option>";
                                            }
                                            else if ($tam == '40' && $num == 0){
                                                echo "<option value='40' disabled style='color:gray;'>40 - Esgotado</option>";
                                            }
                                            else if ($tam == '40' && $num != 0){
                                                echo "<option value='40' >40 </option>";
                                            }
                                            else if ($tam == '42' && $num == 0){
                                                echo "<option value='42' disabled style='color:gray;'>42 - Esgotado</option>";
                                            }
                                            else if ($tam == '42' && $num != 0){
                                                echo "<option value='42' >42 </option>";
                                            }
                                            else if ($tam == '44' && $num == 0){
                                                echo "<option value='44' disabled style='color:gray;'>44 - Esgotado</option>";
                                            }
                                            else if ($tam == '44' && $num != 0){
                                                echo "<option value='44' >44 </option>";
                                            }
                                            else if ($tam == '46' && $num == 0){
                                                echo "<option value='46' disabled style='color:gray;'>46 - Esgotado</option>";
                                            }
                                            else if ($tam == '46' && $num != 0){
                                                echo "<option value='46' >46 </option>";
                                            }
                                            else if ($tam == '48' && $num == 0){
                                                echo "<option value='48' disabled style='color:gray;'>48 - Esgotado</option>";
                                            }
                                            else if ($tam == '48' && $num != 0){
                                                echo "<option value='48' >48 </option>";
                                            }
                                            else if ($tam == '50' && $num == 0){
                                                echo "<option value='50' disabled style='color:gray;'>50 - Esgotado</option>";
                                            }
                                            else {
                                                echo "<option value='50' >50 </option>";
                                            }
                                        }
                                    }
                                    else if ($category == 'Ténis' or $category == 'Sapatos Social' or $category == 'Botas' or $category == 'Sandálias' or $category == 'Chinelos' ){
                                        echo "<option style='display:none'>Seleciona o teu tamanho</option>";
                                        while ($rowS = mysqli_fetch_array($getStock)){
                                            $tam = $rowS[1];
                                            $num = $rowS[2];
                                            if ($tam == '35' && $num == 0){
                                                echo "<option value='35' disabled style='color:gray;'>35 - Esgotado</option>";
                                            }
                                            else if ($tam == '35' && $num != 0){
                                                echo "<option value='35'>35</option>";
                                            }
                                            else if ($tam == '36' && $num == 0){
                                                echo "<option value='36' disabled style='color:gray;'>36 - Esgotado</option>";
                                            }
                                            else if ($tam == '36' && $num != 0){
                                                echo "<option value='36' >36 </option>";
                                            }
                                            else if ($tam == '37' && $num == 0){
                                                echo "<option value='37' disabled style='color:gray;'>37 - Esgotado</option>";
                                            }
                                            else if ($tam == '37' && $num != 0){
                                                echo "<option value='37' >37 </option>";
                                            }
                                            else if ($tam == '38' && $num == 0){
                                                echo "<option value='38' disabled style='color:gray;'>38 - Esgotado</option>";
                                            }
                                            else if ($tam == '38' && $num != 0){
                                                echo "<option value='38' >38 </option>";
                                            }
                                            else if ($tam == '39' && $num == 0){
                                                echo "<option value='39' disabled style='color:gray;'>39 - Esgotado</option>";
                                            }
                                            else if ($tam == '39' && $num != 0){
                                                echo "<option value='39' >39 </option>";
                                            }
                                            else if ($tam == '40' && $num == 0){
                                                echo "<option value='40' disabled style='color:gray;'>40 - Esgotado</option>";
                                            }
                                            else if ($tam == '40' && $num != 0){
                                                echo "<option value='40' >40 </option>";
                                            }
                                            else if ($tam == '41' && $num == 0){
                                                echo "<option value='41' disabled style='color:gray;'>41 - Esgotado</option>";
                                            }
                                            else if ($tam == '41' && $num != 0){
                                                echo "<option value='41' >41 </option>";
                                            }
                                            else if ($tam == '42' && $num == 0){
                                                echo "<option value='42' disabled style='color:gray;'>42 - Esgotado</option>";
                                            }
                                            else if ($tam == '42' && $num != 0){
                                                echo "<option value='42' >42 </option>";
                                            }
                                            else if ($tam == '43' && $num == 0){
                                                echo "<option value='43' disabled style='color:gray;'>43 - Esgotado</option>";
                                            }
                                            else if ($tam == '43' && $num != 0){
                                                echo "<option value='43' >43 </option>";
                                            }
                                            else if ($tam == '44' && $num == 0){
                                                echo "<option value='44' disabled style='color:gray;'>44 - Esgotado</option>";
                                            }
                                            else if ($tam == '44' && $num != 0){
                                                echo "<option value='44' >44 </option>";
                                            }
                                            else if ($tam == '45' && $num == 0){
                                                echo "<option value='45' disabled style='color:gray;'>45 - Esgotado</option>";
                                            }
                                            else if ($tam == '45' && $num != 0){
                                                echo "<option value='45' >45 </option>";
                                            }
                                            else if ($tam == '46' && $num == 0){
                                                echo "<option value='46' disabled style='color:gray;'>46 - Esgotado</option>";
                                            }
                                            else if ($tam == '46' && $num != 0){
                                                echo "<option value='46' >46 </option>";
                                            }
                                            else if ($tam == '47' && $num == 0){
                                                echo "<option value='47' disabled style='color:gray;'>47 - Esgotado</option>";
                                            }
                                            else {
                                                echo "<option value='47' >47 </option>";
                                            }
                                        }
                                    }
                                    else {
                                        echo "<option style='display:none'>Seleciona o teu tamanho</option>";
                                        if ($tam == 'Tamanho Unico' && $num == 0){
                                            echo "<option value='Tamanho Unico' disabled style='color:gray;'>Tamanho Único - Esgotado</option>";
                                        }
                                        else {
                                            echo "<option value='Tamanho Unico'>Tamanho Único</option>";
                                        }
                                    }
                                    ?>

                                </select>

                            </div>
                            <div id='parteProdAdicCesto'>
                                <?php echo "<p id='idProduct1' style='display:none;'>$idPro</p>"; ?>
                                <?php echo "<p id='idBrand1' style='display:none;'>$brand</p>"; ?>
                                <?php echo "<p id='idTam1' style='display:none;'></p>"; ?>
                                <button name='cesto' id='buttonCesto1' >Adicionar ao Cesto</button>
                            </div>
                            <div id='parteProdOutInfo'>
                                <p style='float:left;font-size: 11px;margin-left: 4%;padding-top: 0.2%;font-weight: 100;'>Peça de: <?php echo "$brand"?></p>
                                <i class="icofont-clock-time" style='float:left;margin-left: 51%;'></i>
                                <p style='font-size: 11px;margin-left: 81%;padding-top: 0.2%;font-weight: 100;'>2-4 Dias Úteis</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
		</div>
      </section>
      <section id="about" style="height: 60vh;width:100%;padding:0;display:inline-block;background-color: #f9fafc;">
        <div id='containerSimilares'>
            <div id='containerSimilaresTitle'>
                <p style="text-align: center;font-size: 13px;margin: 0;font-weight: 100;color: black;padding-top: 1%;text-transform: uppercase;letter-spacing: 2px;">Peças Similares</p>
            </div>
            <div id='containerSimilaresContainer'>
                <?php
                    $idProdQuery = "select id from productsd where color='$cor' and category='$category' and id <> '$idaaa'";
                    $getIdPro = mysqli_query($conn, $idProdQuery);

                    if (!$getIdPro)
						die("Error, select query failed:" . $idProdQuery);

                    $arrayProds = array();
					if(mysqli_num_rows($getIdPro)>0) {
						while  ($rowPr = mysqli_fetch_array($getIdPro)) {
                            $id = $rowPr[0];
                            array_push($arrayProds, $id);
                        }
                    }

                    if (count($arrayProds) < 5){
                        for ($i=0; $i < count($arrayProds); $i++) {
                            $idProo = $arrayProds[$i];

                            $infoProdQuery = "select name, preco from productsd where id='$idProo'";
                            $getInfo = mysqli_query($conn, $infoProdQuery);

                            if (!$getInfo)
                                die("Error, select query failed:" . $infoProdQuery);

                            $rowTes = mysqli_fetch_array($getInfo);
                            $tit = $rowTes[0];
                            $prec = $rowTes[1];



                            echo "<a href='productDesigner.php?refProduct=$idProo' class='theProdSimilar'>
                                <div class='theProdSimilarImg'>
                                    <div class='theProdSimilarImgC'>
                                        <img src='productsImage/$idProo.jpg'>
                                    </div>
                                </div>
                                <div class='theProdSimilarText'>
                                    <p style='float: left;font-size: 16px;margin-left: 17%;font-weight: 100;'>$tit</p>
                                    <p style='float: right;margin: 0;font-size: 16px;margin-right: 17%;font-weight: 100;'>$prec €</p>
                                </div>
                             </a>";
                        }
                    }
                    else{
                        $arrayRandom = array();
                        while( count($arrayRandom) < 4 ){
                            $rand = mt_rand(0, (count($arrayProds) - 1 ));
                            array_push($arrayRandom, ($arrayProds[$rand]));
                        }

                        for ($i=0; $i < count($arrayRandom); $i++) {
                            $idProo = $arrayRandom[$i];

                            $infoProdQuery = "select name, preco from productsd where id='$idProo'";
                            $getInfo = mysqli_query($conn, $infoProdQuery);

                            if (!$getInfo)
                                die("Error, select query failed:" . $infoProdQuery);

                            $rowTes = mysqli_fetch_array($getInfo);
                            $tit = $rowTes[0];
                            $prec = $rowTes[1];



                            echo "<a href='product2mao.php?refProduct=$idProo' class='theProdSimilar'>
                                <div class='theProdSimilarImg'>
                                    <div class='theProdSimilarImgC'>
                                        <img src='productsImage/$idProo.jpg'>
                                    </div>
                                </div>
                                <div class='theProdSimilarText'>
                                    <p style='float: left;font-size: 16px;margin-left: 17%;font-weight: 100;'>$tit</p>
                                    <p style='float: right;margin: 0;font-size: 16px;margin-right: 17%;font-weight: 100;'>$prec €</p>
                                </div>
                             </a>";
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
				var res = myClass.slice(18, numb);
				var classI = "img." + res;
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
            $('#selectTam').click(function() {
                var a = $("#selectTam :selected").val();
                console.log(a);
                $('#idTam1').html('');
                $('#idTam1').html(a)
            });

        });
    </script>
	</body>
</html>
