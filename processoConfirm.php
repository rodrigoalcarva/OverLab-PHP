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
  <link href="css/processoCompra.css" rel="stylesheet">
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
        
        if (isset($_GET['pedido'])){
            $numPedido = $_GET["pedido"];
        }
        else{
            header("Location: store.php");
        }

	?>
	<!--==========================
  	Header
  	============================-->
	<!--==========================
    Hero Section
  	============================-->
  	<section id="hero">
    	<div class="hero-container" >
            <div id='cont'>
                <div id = "title">
                    <div id='logoImg'>
                        <img src='img/logo.png'>
                    </div>
                </div>
                <div id = "path">
                    <img style='width: 66%;margin-left: 17%;' src='img/processo3.jpg'>
                </div>

                <div id = "info">
					<div id = esq>
                        <div id='confirmPhoto'>
                            <img style='width: 80%;height: 100%;margin-left: 10%;' src='img/confirm.png'>
                        </div>
                    </div>
                    <div id ="dir">
                        <div id = "nome11">
                            <p style = "font-size: 40px;margin-left: 3%;padding-top: 4%;color: black;font-weight: bold;">Pedido #<?php echo $_GET["pedido"];?></p> 
                        </div>
                        <div id="listPro">
                            <?php
                                 $itemsQuery = "select ps.id, ps.name, ps.brand from productsu ps, products_pedido pp where pp.idPedido ='$numPedido' and ps.id = pp.idProduct";
                                 $getItemPedido = mysqli_query($conn, $itemsQuery);
                                
                                 while  ($row = mysqli_fetch_array($getItemPedido)) {
                                     $id = $row[0];
                                     $name = $row[1];
                                     $brand = $row[2];

                                     echo "<div class='itemCesto_p'>
                                                <div class = 'esq_PR'>
                                                     <img class = 'img_PR' src = 'productsImage/$id.jpg'> 
                                                </div>

                                                <div class = 'dir_PR'>
                                                    <div class = 'nome_PR'>
                                                        <p style = 'margin-left:5%; margin-top:1%'> Nome Produto: $name</p>
                                                    </div>

                                                    <div class = 'id_PR'>
                                                        <p style = 'margin-left:5%; margin-top:1%'> ID Produto: $id</p>
                                                    </div>

                                                    <div class = 'brand_PR'>
                                                        <p style = 'margin-left:5%; margin-top:1%'> Marca Produto: $brand</p>
                                                    </div>
                                                </div>
                                            </div>";

                                 }
                            ?>
                            
                        </div>
                        <div id='letGo'>
                            <div id='dadosEnvio'>
                                <div id='theEnvio'>
                                    <p style="margin: 0;color: black;font-weight: bold;letter-spacing: 3px;padding-left: 4%;margin-bottom: 3%;">Dados de Envio</p>
                                    <p style="margin: 0;font-size: 13px;font-weight: 100;padding-left: 4%;">Praceta David Mourão Ferreira nº644</p>
                                    <p style="margin: 0;font-size: 13px;font-weight: 100;padding-left: 4%;">2785-720</p>
                                    <p style="margin: 0;font-size: 13px;font-weight: 100;padding-left: 4%;">Abóboda</p>
                                </div>
                            </div>
                            <div id='finish'>
                                <a href='mycloset.php' style="width: 40%;background-color: black;color: white;border: 0px;height: 40%;font-size: 19px;font-weight: 100;margin-top: 5%;float: right;padding-top: 4%;text-align: center;">Voltar

                                </a>
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

	</body>
</html>