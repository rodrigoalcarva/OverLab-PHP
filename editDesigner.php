<?php
	session_start();
	include "phpScripts/accessBD.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>OverLab - ??? </title>
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

        if (isset($_GET['idProd'])){
            $id = $_GET['idProd'];
        }
        else{
            header("Location: myproducts.php");
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
				<div id='infTheProdd'>
                    <div id='infTheProddImg'>
                        <div id='infTheProddImgImg'>
                            <?php
                                echo "<img src='productsImage/$id.jpg' >";
                            ?>
                        </div>
                    </div>
                    <div id='infTheProddRef'>
                        <?php
                            echo "<p> $id</p>";
                        ?>
                    </div>
                </div>
                <div id='infTheProddStock'>
                    <div id='infTheProddStockTitle'>
                        <p style='text-align: center;font-size: 30px;padding-top: 3%;font-weight: 600;color: black;'>Editar Stock</p>
                    </div>
                    <div id='infTheProddStockCont'>
                        <?php
                            $productsQuery = "select p.category, s.tamanho, s.quantidade from stocksstores s, productsd p where s.idProduct = p. id and s.idProduct='$id'";

                            $getProducts = mysqli_query($conn,$productsQuery);

                            if (!$getProducts)
                                die("Error, select query failed:" . $productsQuery);

                            $arrayTam = array();
                            $arrayQuant = array();
                            while  ($row = mysqli_fetch_array($getProducts)) {
                                $tipo = $row[0];
                                $tam = $row[1];
                                $quant = $row[2];
                                array_push($arrayTam, $tam);
                                array_push($arrayQuant, $quant);
                            }

                            if ($tipo == 'Tshirt' or $tipo =='Top' or $tipo =='Polo' or $tipo =='Camisa' or $tipo =='Vestido' or $tipo =='Macacão' or $tipo =='Casaco' or $tipo =='Blusão' or $tipo =='Camisola' or $tipo =='Malha' or $tipo =='Blazer' or $tipo =='Sweatshirt' or $tipo =='Sobretudo' or $tipo == 'Fato de Banho'){
                                echo "<form style='width:100%;height:100%' action='phpScripts/myproductsScript.php' method='post' enctype='multipart/form-data'>";
                                for ($i=0; $i < count($arrayTam); $i++) {
                                        $tama = $arrayTam[$i];
                                        $quanta = $arrayQuant[$i];
                                        echo "  <div class='form-group' style='width: 90%;margin-left: 5%; margin-top: 2%;'>
                                                    <label style='font-size: 20px;color: black;padding-left: 1%;'>$tama</label>
                                                    <input type='number' class='form-control' name='$tama' value='$quanta' placeholder='$quanta' required>
                                                </div>";
                                }
                                echo "<button style='width: 26%;margin-left: 37%;height: 11%; margin-bottom: 3%;border: 2px solid black;background-color: transparent;' name='editCategory1'>Atualizar</button>";
                                echo "</form>";
                            }
                            else if ($tipo == 'Calças' or $tipo == 'Jeans' or $tipo == "Calções" or $tipo == 'Saia'){
                                echo "<form style='width:100%;height:100%' action='phpScripts/myproductsScript.php' method='post' enctype='multipart/form-data'>";
                                for ($i=0; $i < count($arrayTam); $i++) {
                                        $tama = $arrayTam[$i];
                                        $quanta = $arrayQuant[$i];
                                        echo "  <div class='form-group' style='width: 90%;margin-left: 5%; margin-top: 2%;'>
                                                    <label style='font-size: 20px;color: black;padding-left: 1%;'>$tama</label>
                                                    <input type='number' class='form-control' name='$tama' value='$quanta' placeholder='$quanta' required>
                                                </div>";
                                }
                                echo "<button style='width: 26%;margin-left: 37%;height: 11%; margin-bottom: 3%;border: 2px solid black;background-color: transparent;' name='editCategory2'>Atualizar</button>";
                                echo "</form>";
                            }
                            else if ($tipo == 'Ténis' or $tipo == 'Sapatos Social' or $tipo == 'Botas' or $tipo == 'Sandálias' or $tipo == 'Chinelos' ){
                                echo "<form style='width:100%;height:100%' action='phpScripts/myproductsScript.php' method='post' enctype='multipart/form-data'>";
                                for ($i=0; $i < count($arrayTam); $i++) {
                                        $tama = $arrayTam[$i];
                                        $quanta = $arrayQuant[$i];
                                        echo "  <div class='form-group' style='width: 90%;margin-left: 5%; margin-top: 2%;'>
                                                    <label style='font-size: 20px;color: black;padding-left: 1%;'>$tama</label>
                                                    <input type='number' class='form-control' name='$tama' value='$quanta' placeholder='$quanta' required>
                                                </div>";
                                }
                                echo "<button style='width: 26%;margin-left: 37%;height: 11%; margin-bottom: 3%;border: 2px solid black;background-color: transparent;' name='editCategory3'>Atualizar</button>";
                                echo "</form>";
                            }
                            else{
                                echo "<form style='width:100%;height:100%' action='phpScripts/myproductsScript.php' method='post' enctype='multipart/form-data'>";
                                for ($i=0; $i < count($arrayTam); $i++) {
                                        $tama = $arrayTam[$i];
                                        $quanta = $arrayQuant[$i];
                                        echo "  <div class='form-group' style='width: 90%;margin-left: 5%; margin-top: 2%;'>
                                                    <label style='font-size: 20px;color: black;padding-left: 1%;'>$tama</label>
                                                    <input type='number' class='form-control' name='$tama' value='$quanta' placeholder='$quanta' required>
                                                </div>";
                                }
                                echo "<button style='width: 26%;margin-left: 37%;height: 11%; margin-bottom: 3%;border: 2px solid black;background-color: transparent;' name='editCategory4'>Atualizar</button>";
                                echo "</form>";
                            }
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
	<script type="text/javascript" src="js/aaa1.js"></script>

	</body>
</html>
