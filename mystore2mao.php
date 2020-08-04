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
            <li class="menu-active"><a href="mystore2mao.php">My Store</a></li>
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
    	<div class="hero-container" >
			<div class="containerStore">
                <div class='headerStore'>
                    <div class='optionStore' style="width:10%">
                        <a href='#' style='text-align:left;color:#666666;'><p style="padding-top: 20%;font-size: 17px;margin-left: 25%;">Minha Loja</p></a>
                    </div>
                    <div class='optionCategory'>

                    </div>
                    <div class='optionCarrinho'>
                    </div>
                    <div class='optionSearch' id="click">

                    </div>

                </div>


                <div id="rest">
                    <div id='choseOption'>
                        <div id='opt' class="actact" style="margin-left:2%;">
                            <p style="text-align: center;padding-top: 12%;">Produtos</p>
                        </div>
                        <div id='opt1'>
                            <p style="text-align: center;padding-top: 12%;">Para enviar</p>
                        </div>
                        <div id='opt2'>
                            <p style="text-align: center;padding-top: 12%;">Histórico</p>
                        </div>
                    </div>
                    <div id='myProductsSale'>
                        <?php
                            $user = $_SESSION["username"];
							$productsQuery = "select * from venda2mao where idUsername='$user'";

							$getProducts = mysqli_query($conn,$productsQuery);

							if (!$getProducts)
								die("Error, select query failed:" . $productsQuery);

							if(mysqli_num_rows($getProducts)>0) {
								while  ($row = mysqli_fetch_array($getProducts)) {
                                    $idProduct = $row[1];
                                    $title = $row[4];
                                    $clicks = $row[7];

                                    echo "<div class='sItem'>
                                            <div class='sItemLeft'>
                                                <img src='productsImage/$idProduct.jpg' style='width: 60%;height: 90%;margin-left: 32%;margin-top: 3%;'>
                                            </div>
                                            <div class='sItemMiddle'>
                                                <div class='sItemTitle'>
                                                    <p style='font-size: 24px;padding-top: 1%;'>$title</p>
                                                </div>
                                                <div class='sItemRef'>
                                                    <p style='font-size: 12px;'>$idProduct</p>
                                                </div>
                                                <div class='sItemEstati'>
                                                    <div class='estati'>
                                                        <i class='icofont-eye-alt' style='float: left;padding-top: 7%;margin-left: 37%;font-size: 22px;'></i><p style='padding-top: 5.5%;padding-left: 57%;'>$clicks</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class='sItemRight'>
                                                <div class='editButton1'>
                                                    <form action='phpScripts/storeScript2mao.php' method='post' enctype='multipart/form-data'>
                                                        <button type='submit' id='eliminateButton' name='eliminar' value='$idProduct'><i class='icofont-trash' style='color:#8ab1c6;'></i></button>
                                                    </form>
                                                </div>
                                                <div class='editButton'>
                                                    <a href='editar2mao.php?sale=$idProduct' style='color: white;text-align: center;padding-top: 15%;font-size: 19px;'>Editar</a>
                                                </div>
                                            </div>

                                        </div>";
                                }
                            }

                        ?>

                    </div>
                    <div id='mySales'>
                        <?php
                            $entregaQuery = "select pp.idPedido, pp.idProduct, dc.morada, dc.codigo_postal, dc.local, u.firstName, u.lastName from products_pedido pp, dados_envio dc, pedidos2mao pm, users u where pp.idPedido = dc.idPedido and dc.idPedido = pm.idPedido and pp.idSell='$user' and pm.idUsername = u.username and pp.estado_entrega='a_processar'";
                            $getEntrega = mysqli_query($conn,$entregaQuery);

							if (!$getEntrega)
								die("Error, select query failed:" . $entregaQuery);

							if(mysqli_num_rows($getEntrega)>0) {
								while  ($row = mysqli_fetch_array($getEntrega)) {
                                    $idPed = $row[0];
                                    $idPro = $row[1];
                                    $morada = $row[2];
                                    $codigoP = $row[3];
                                    $local = $row[4];
                                    $firstN = $row[5];
                                    $lastN = $row[6];
                                    $valuePass = $idPed . "," . $idPro;

                                    echo "<div class='sItem'>
                                        <div class='enviarImg'>
                                            <div class='imgProdEnvia'>
                                                <img src='productsImage/$idPro.jpg'>
                                            </div>
                                        </div>
                                        <div class='enviarInfo'>
                                            <p style='margin: 0;font-size: 28px;color: black;font-weight: 700;padding-top: 4%;'>$idPro</p>
                                            <p style='margin: 0;font-size: 17px;color: black;font-weight: 100;'>Pedido #$idPed</p>
                                            <p style='margin: 0;font-size: 17px;color: black;font-weight: 100;padding-top: 6%;'>$firstN $lastN</p>
                                        </div>
                                        <div class='enviarDados'>
                                            <p style='margin: 0;font-size: 24px;color: black;padding-top: 9%;font-weight: 500;margin-bottom: 2%;'>Dados de envio</p>
                                            <p style='margin: 0;font-size: 17px;color: black;font-weight: 100;'>$morada</p>
                                            <p style='margin: 0;font-size: 17px;color: black;font-weight: 100;'>$codigoP , $local </p>
                                        </div>
                                        <div class='enviarSubmit'>
                                            <form action='phpScripts/storeScript2mao.php' method='post' enctype='multipart/form-data'>
                                                <button type='submit' name='updateEnvio' value='$valuePass' style='background-color: transparent;width: 60%;height: 40%;border: 0px;margin-top: 20%;margin-left: 17%;outline: none;border-radius: 5px;border: 3px solid #8ab1c6;color: #8ab1c6;'>
                                                    <i class='icofont-fast-delivery'></i>
                                                    <p style='margin:0'>Confirmar Envio</p>
                                                </button>
                                            </form>
                                        </div>
                                    </div>";
                                }
                            }


                        ?>
                    </div>
                    <div id='myHistoricSales'>
                        <?php
                            $user = $_SESSION["username"];
							$pedidQuery = "select pm.idPedido, pm.data, pp.idProduct from pedidos2mao pm, products_pedido pp where pp.idSell='$user' and pp.idPedido = pm.idPedido";

							$getPedid = mysqli_query($conn,$pedidQuery);

							if (!$getPedid)
								die("Error, select query failed:" . $pedidQuery);

							if(mysqli_num_rows($getPedid)>0) {
								while  ($row = mysqli_fetch_array($getPedid)) {
                                    $idPed= $row[0];
                                    $data = $row[1];
                                    $produc = $row[2];

                                    echo "<div class='sItem'>
                                            <div class='sItemEsq'>
                                                <p style='margin: 0;font-size: 35px;font-weight: 400;padding-left: 5%;padding-top: 2%;'>Pedido #1</p>
                                                <p style='font-size: 15px;padding-left: 5%;font-weight: 100;padding-top: 2%;margin: 0;'>Product REF42383</p>
                                                <p style='margin: 0;font-size: 15px;padding-left: 5%;font-weight: 100;padding-top: 1%;'>05/01/2020 03:06:29 pm</p>

                                            </div>
                                            <div class='sItemDir'>
                                            <a href='.\pdfPedidosVendas\pedido".$idPed."_".$name."_".$produc.".pdf' target='_blank' style='width: 25%;border: 3px solid #8aaab9;border-radius: 5px;height: 33%;margin-left: 65%;margin-top: 9%;text-align: center;padding-top: 2%;'>Fatura</a>
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
	<script>
        $(document).ready(function(){

            $('#opt').click(function() {
                $('#opt').addClass("actact");
                $('#opt1').removeClass("actact");
                $('#opt2').removeClass("actact");
                $("#myProductsSale").css('display','inline-block');
                $("#mySales").css('display','none');
                $("#myHistoricSales").css('display','none');
            });

            $('#opt1').click(function() {
                $('#opt1').addClass("actact");
                $('#opt').removeClass("actact");
                $('#opt2').removeClass("actact");
                $("#mySales").css('display','inline-block');
                $("#myProductsSale").css('display','none');
                $("#myHistoricSales").css('display','none');
            });

            $('#opt2').click(function() {
                $('#opt2').addClass("actact");
                $('#opt').removeClass("actact");
                $('#opt1').removeClass("actact");
                $("#mySales").css('display','none');
                $("#myProductsSale").css('display','none');
                $("#myHistoricSales").css('display','inline-block');
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
        });
    </script>
	</body>
</html>
