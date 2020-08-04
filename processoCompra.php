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
            $id = $_GET["pedido"];
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
                    <img style='width: 66%;margin-left: 17%;' src='img/processo1.jpg'>
                </div>

                <div id = "info">
                    <div id = "cTitle">
                        <p style="text-align: center;text-transform: uppercase;color: black;font-size: 22px;letter-spacing: 8px;">O teu cesto</p>
                    </div>

                    <div id = "table">
                        <div id = "artigo">
                            <p style="text-align: center;padding-top: 4%;font-weight: 100;">Artigo</p>
                        </div>
                        <div id = "nome">
                            <p style="text-align: center;padding-top: 4%;font-weight: 100;">Descrição</p>
                        </div>
                        <div id = "cor">
                            <p style="text-align: center;padding-top: 4%;font-weight: 100;">Cor</p>
                        </div>
                        <div id = "tamanho">
                            <p style="text-align: center;padding-top: 4%;font-weight: 100;">Tamanho</p>
                        </div>
                        <div id = "quantidade">
                            <p style="text-align: center;padding-top: 4%;font-weight: 100;">Quantidade</p>
                        </div>
                        <div id = "preco">
                            <p style="text-align: center;padding-top: 4%;font-weight: 100;">Preço</p>
                        </div>
                    </div>
                    <div id ="itemsCesto">
                        <?php
                            $itemCestoQuery = "select v.titulo, p.color, v.tamanho, c.quantidade, v.preco, c.idProduct from venda2mao v, productsu p, cesto c where c.idProduct = v.idProduct and v.idProduct = p.id and c.idUsername='$name'";
                            $getItemCesto = mysqli_query($conn, $itemCestoQuery);
                            $sum = 0;
                            while  ($row = mysqli_fetch_array($getItemCesto)) {
                                $titulo = $row[0];
                                $cor = $row[1];
                                $tamanho = $row[2];
                                $quantidade = $row[3];
                                $preco = $row[4];
                                $idP = $row[5];

                                $num = floatval($preco);
                                $sum = $sum + $num;



                                echo"<div class='itemCesto'>
                                    <div class='art1'>
                                        <div class='artImg'>
                                            <img src='productsImage/$idP.jpg'>
                                        </div>
                                    </div>
                                    <div class='nom1'>
                                        <p style='padding-top: 8%;font-weight: bold;font-size: 20px; margin:0;color:black'>$titulo</p>
                                        <p style='font-size: 11px;color: gray;'>$idP</p>
                                    </div>
                                    <div class='cor1'>
                                        <p style='padding-top: 8%;text-align: center;font-weight: 500;font-size: 18px;color:black'>$cor</p>
                                    </div>
                                    <div class='tam1'>
                                        <p style='padding-top: 8%;text-align: center;font-weight: 500;font-size: 18px;color:black'>$tamanho</p>
                                    </div>
                                    <div class='qtd1'>
                                        <p style='padding-top: 8%;text-align: center;font-weight: 500;font-size: 18px;color:black'>$quantidade</p>
                                    </div>
                                    <div class='pco1'>
                                        <p style='padding-top: 8%;text-align: center;font-weight: 500;font-size: 18px; color:black'>".$preco."€</p>
                                    </div>
                                </div>";
                            }
                        ?>
                    </div>
                    <div id='moradaEnviar'>
                        <form action='phpScripts/storeScript2mao.php' method='post' enctype='multipart/form-data' style='width:100%;height:100%;'>
                            <div id='morada'>
                                <div id='moradaTitle'>
                                    <p style="text-transform: uppercase;color: black;font-size: 15px;padding-top: 2%;letter-spacing: 5px;font-weight: 500;">Dados de Envio</p>
                                </div>
                                <div id='moradaForm'>
                                    <input type="text" name="morada" placeholder="Morada" style="border: 1px solid black;width: 30%;background-color: #f9fafc;height: 54%;font-size: 13px;margin-top: 3%;padding-left: 2%;">
                                    <input type="text" name="codigoPostal"style="border: 1px solid black;width: 30%;background-color: #f9fafc;height: 54%;font-size: 13px;margin-top: 3%;padding-left: 2%;"placeholder="Código Postal" >
                                    <input type="text" name="local" style="border: 1px solid black;width: 30%;background-color: #f9fafc;height: 54%;font-size: 13px;margin-top: 3%;padding-left: 2%;" placeholder="Cidade">
                                </div>
                            </div>
                            <div id='continuar'>
                                <div id='precoTotal'>
                                    <?php
                                        $planoQuery = "select typeAccount from users where username='$name'";
                                        $getPlano = mysqli_query($conn, $planoQuery);

                                        $rowP =  mysqli_fetch_array($getPlano);

                                        $plano = $rowP[0];
                                        if ($plano == 'Free'){
																						$taxa = floatval($sum) * 0.1;
																						$taxa = floatval($taxa);
                                            echo"<p style='text-transform: uppercase;margin: 0;color: black;font-size: 12px;padding-top: 2%;letter-spacing: 5px;font-weight: 500;float:right;margin-right: 5%;'>Taxas : $taxa"."€ </p>";
                                            $sum = floatval($sum) + floatval($taxa);
                                            echo "<p style='text-transform: uppercase;margin: 0;color: black;font-size: 18px;padding-top: 8%;letter-spacing: 5px;font-weight: 500;float: right;margin-right: -40%;'>Total: $sum" ."€</p>";
                                        }
                                        else{
                                            echo"<p style='text-transform: uppercase;margin: 0;color: black;font-size: 12px;padding-top: 2%;letter-spacing: 5px;font-weight: 500;float:right;margin-right: 5%;'>Taxas : Grátis </p>";
                                            $sum = $sum + 0.00;

                                            echo "<p style='text-transform: uppercase;margin: 0;color: black;font-size: 18px;padding-top: 8%;letter-spacing: 5px;font-weight: 500;float: right;margin-right: -40%;'>Total: $sum €</p>";
                                        }

                                    ?>
                                </div>
                                <div id='continuar1'>
                                    <button type='submit' name='contPag' value='<?php echo $id;?>' style="width: 30%;background-color: black;color: white;border: 0px;height: 64%;font-size: 19px;font-weight: 100;margin-top: 0.7%;float: right;margin-right: 5%;">Continuar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
		</div>
  	</section>
	<!--==========================
    Footer
  	============================-->
      <footer id="footer" style='margin-top:2%;'>
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
