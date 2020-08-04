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
            $updateQuery = "update venda2mao set clicks = clicks + 1 where idProduct='$a'";
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



        $proQuery = "select v.idProduct, v.tamanho, v.preco, v.titulo, v.descricao, v.localizacao, p.brand, p.color, v.idUsername, p.name from venda2mao v, productsu p where v.idProduct='$a' and v.idProduct = p.id";
        $checkPro = mysqli_query($conn, $proQuery);

		if(!$checkPro)
		    die("Error, select query failed:" . $proQuery);

        $row = mysqli_fetch_array($checkPro);

        $idPro = $row[0];
        $tamanho = $row[1];
        $preco = $row[2];
        $titulo = $row[3];
        $descricao = $row[4];
        $localizacao = $row[5];
        $marca = $row[6];
        $cor = $row[7];
        $idPersonSell = $row[8];
        $cate = $row[9];

    ?>
  	<section id="hero">
    	<div class="hero-container" >
			<div class="containerStore">
                <div class='headerStore'>
                    <div class='optionStore' style="width:22%">
                        <a href='' style='text-align:left;color:#666666;'><p style="padding-top: 9%;font-size: 17px;margin-left: 18%;">Loja 2ªMão - <?php echo $idPro; ?></p></a>
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
                                            <p style='font-weight: 100;'>".$sum.",00€</P>
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
                                    <p style="    font-size: 29px;padding-top: 1%;font-weight: bold;"><?php echo $titulo; ?></p>
                                </div>
                                <div id='parteProdPreco'>
                                    <p style="    font-size: 23px;padding-top: 6%;text-align: center;font-weight: 100;"><?php echo $preco; ?>€</p>
                                </div>
                            </div>
                            <div id='parteProdRef'>
                                <p style="    font-size: 10px;"><?php echo $idPro . " - " . $marca; ?></p>
                            </div>
                            <div id='parteProdDescr'>
                                <p style='font-weight:100;'><?php echo $descricao; ?></p>
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
                            <div id='parteProdTamanhoLocal'>
                                <div id='parteProdTamanho'>
                                    <p style='font-weight: 100;float: left;padding-top: 6%;'> Tamanho:</p>
                                    <p style='float: left;margin-left: 5%;font-weight: 500;font-size: 17px;padding-top: 6%;'> <?php echo $tamanho; ?></p>
                                </div>
                                <div id='parteProdLocal'>
                                    <p style='padding-top: 8.5%;font-weight: 100;float: right; margin-right:10%; font-size:12px'> <?php echo $localizacao; ?></p><i class="icofont-location-pin" style='font-size: 19px;float: right;padding-top: 8%;'></i>
                                </div>
                            </div>
                            <div id='parteProdAdicCesto'>
                                <?php echo "<p id='idProduct' style='display:none;'>$idPro</p>"; ?>
                                <?php echo "<p id='idPersonSell' style='display:none;'>$idPersonSell</p>"; ?>
                                <?php
                                    $pecaQuery = "select * from cesto where idProduct = '$idPro' and idUsernameSell = '$idPersonSell'";
                                    $checkPeca = mysqli_query($conn, $pecaQuery);
                                    $valueConj = $idPro . "," . $idPersonSell;

                                    if(mysqli_num_rows($checkPeca)>0) {
                                        echo "<button name='cesto' id='buttonCesto' value='$valueConj' disabled>Adicionar ao Cesto</button>";
                                    }
                                    else{
                                         echo "<button name='cesto' id='buttonCesto' value='$valueConj'> Adicionar ao Cesto</button>";
                                    }
                                ?>
                            </div>
                            <div id='parteProdOutInfo'>
                                <p style='float:left;font-size: 11px;margin-left: 4%;padding-top: 0.2%;font-weight: 100;'>Anúncio de: <?php echo "$idPersonSell"?></p>
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
                    $idProdQuery = "select v.idProduct from venda2mao v, productsu p where p.id = v.idProduct and p.color='$cor' and p.name='$cate' and p.id <> '$idPro' and v.idUsername <> '$name' ";
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

                            $infoProdQuery = "select titulo, preco from venda2mao where idProduct='$idProo'";
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
                    else{
                        $arrayRandom = array();
                        while( count($arrayRandom) < 4 ){
                            $rand = mt_rand(0, (count($arrayProds) - 1 ));
                            array_push($arrayRandom, ($arrayProds[$rand]));
                        }

                        for ($i=0; $i < count($arrayRandom); $i++) {
                            $idProo = $arrayRandom[$i];

                            $infoProdQuery = "select titulo, preco from venda2mao where idProduct='$idProo'";
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
        });
    </script>
	</body>
</html>
