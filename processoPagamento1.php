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
                    <img style='width: 66%;margin-left: 17%;' src='img/processo2.jpg'>
                </div>

                <div id = "info">
					<form action='phpScripts/storeScriptDesigner.php' method='post' enctype='multipart/form-data' style='width:100%;height:100%;'>
						<div id='titlePagamento'>
							<p style="text-align: center;text-transform: uppercase;color: black;font-size: 22px;letter-spacing: 8px;padding-top: 0.2%;">Forma de Pagamento</p>
						</div>
						<div id='escolherPagamento'>
							<div id='visa'>
								<input class='pag' type="radio" id="visaI" name="tipo" value="visa" style="float: left;margin-top: 21%;margin-left: 9%;" required>
								<img src="https://st0.mngbcn.com/images/paymentMethods/c/999/visa@2x.png" class="" style="width: 60%;margin-top: 11%;margin-left: 5%;">
							</div>
							<div id='mastercard'>
								<input class='pag' type="radio" id="mastercardI" name="tipo" value="mastercard" style="float: left;margin-top: 14%;margin-left: 9%;">
								<img src="https://st0.mngbcn.com/images/paymentMethods/c/999/mc@2x.png" class="" style="width: 70%;margin-top: 10%;margin-left: 5%;">
							</div>
							<div id='americanexpress'>
								<input class='pag' type="radio" id="americanexpressI" name="tipo" value="americanexpress" style="float: left;margin-top: 21%;margin-left: 9%;">
								<img src="https://st0.mngbcn.com/images/paymentMethods/c/999/amex@2x.png" class="" style="width: 57%;margin-top: 11%;margin-left: 8%;">
							</div>
							<div id='paypal'>
								<input class='pag' type="radio" id="paypalI" name="tipo" value="paypal" style="float: left;margin-top: 18%;margin-left: 9%;">
								<img src="https://st0.mngbcn.com/images/paymentMethods/c/999/paypal@2x.png" class="" style="width: 69%;margin-top: 11%;margin-left: 5%;">
							</div>
							<div id='multibanco'>
								<input class='pag' type="radio" id="multibancoI" name="tipo" value="multibanco" style="float: left;margin-top: 18%;margin-left: 9%;">
								<img src="https://st0.mngbcn.com/images/paymentMethods/c/999/03_otros/multibanco@2x.png" class="" style="width: 70%;margin-top: 12%;margin-left: 5%;">
							</div>
						</div>
						<div id='theMethod'>
							<div id='visaD'>
								<div id="visaForm">
									<input type='text' value='visa' name='metodo' style='display:none'>
									<div class='numeroCC'>
										<label style="margin:0%;float: left;font-size: 14px;padding-left: 4%;padding-top: 5%;">Número</label>
										<input style="margin-top: 3.5%;margin-left: 9%;width: 65%;border: 1px solid black;background-color: #f9fafc;height: 55%;font-size: 13px;padding-left: 4%;" id='ccn' type='tel' name='numeroCartao' inputmode='numeric' autocomplete='cc-number' maxlength='19' placeholder='xxxx-xxxx-xxxx-xxxx' >
									</div>
									<div class='titularCC'>
										<label style="margin:0%;float: left;font-size: 14px;padding-left: 4%;padding-top: 5%;">Titular</label>
										<input style="margin-top: 3.5%;margin-left: 13%;width: 65%;border: 1px solid black;background-color: #f9fafc;height: 55%;font-size: 13px;padding-left: 4%;" name='titular' type="text" >
									</div>
									<div class='dataCC'>
										<label style="margin:0%;float: left;font-size: 14px;padding-left: 4%;padding-top: 5%;">Validade</label>
										<select name="expirationMonth" notselectedlabel="Mês" style='margin-top: 3.5%;margin-left: 7%;width: 32%;border: 1px solid black;background-color: #f9fafc;height: 55%;font-size: 13px;padding-left: 4%;'  >
											<option value="">Mês</option><option value="01">01</option>
											<option value="02">02</option><option value="03">03</option>
											<option value="04">04</option><option value="05">05</option>
											<option value="06">06</option><option value="07">07</option>
											<option value="08">08</option><option value="09">09</option>
											<option value="10">10</option><option value="11">11</option>
											<option value="12">12</option>
										</select>
										<select name="expirationYear" notselectedlabel="Ano" style='margin-top: 3.5%;margin-left: 0%;width: 31.5%;border: 1px solid black;background-color: #f9fafc;height: 55%;font-size: 13px;padding-left: 4%;' >
											<option value="">Ano</option>
											<option value="2020">2020</option>
											<option value="2021">2021</option>
											<option value="2022">2022</option>
											<option value="2023">2023</option>
											<option value="2024">2024</option>
											<option value="2025">2025</option>
											<option value="2026">2026</option>
											<option value="2027">2027</option>
											<option value="2028">2028</option>
											<option value="2029">2029</option>
											<option value="2030">2030</option>
											<option value="2031">2031</option>
											<option value="2032">2032</option>
											<option value="2033">2033</option>
											<option value="2034">2034</option>
											<option value="2035">2035</option>
											<option value="2036">2036</option>
											<option value="2037">2037</option>
											<option value="2038">2038</option>
											<option value="2039">2039</option>
										</select>
									</div>
									<div class='cvcCC'>
										<label style="margin:0%;float: left;font-size: 14px;padding-left: 4%;padding-top: 5%;">CVC</label>
										<input style="margin-top: 3.5%;margin-left: 17%;width: 20%;border: 1px solid black;background-color: #f9fafc;height: 55%;font-size: 13px;padding-left: 4%;" maxlength='3' name="cvc" >
									</div>
								</div>
							</div>
							<div id='masterD'>
								<div id="masterForm">
									<input type='text' value='mastercard' name='metodo' style='display:none'>
									<div class='numeroCC'>
										<label style="margin:0%;float: left;font-size: 14px;padding-left: 4%;padding-top: 5%;">Número</label>
										<input style="margin-top: 3.5%;margin-left: 9%;width: 65%;border: 1px solid black;background-color: #f9fafc;height: 55%;font-size: 13px;padding-left: 4%;" id='ccn' type='tel' name='numeroCartao' inputmode='numeric' autocomplete='cc-number' maxlength='19' placeholder='xxxx-xxxx-xxxx-xxxx' >
									</div>
									<div class='titularCC'>
										<label style="margin:0%;float: left;font-size: 14px;padding-left: 4%;padding-top: 5%;">Titular</label>
										<input style="margin-top: 3.5%;margin-left: 13%;width: 65%;border: 1px solid black;background-color: #f9fafc;height: 55%;font-size: 13px;padding-left: 4%;"  name='titular' type="text" >
									</div>
									<div class='dataCC'>
										<label style="margin:0%;float: left;font-size: 14px;padding-left: 4%;padding-top: 5%;">Validade</label>
										<select name="expirationMonth" notselectedlabel="Mês" style='margin-top: 3.5%;margin-left: 7%;width: 32%;border: 1px solid black;background-color: #f9fafc;height: 55%;font-size: 13px;padding-left: 4%;'  >
											<option value="">Mês</option><option value="01">01</option>
											<option value="02">02</option><option value="03">03</option>
											<option value="04">04</option><option value="05">05</option>
											<option value="06">06</option><option value="07">07</option>
											<option value="08">08</option><option value="09">09</option>
											<option value="10">10</option><option value="11">11</option>
											<option value="12">12</option>
										</select>
										<select name="expirationYear" notselectedlabel="Ano" style='margin-top: 3.5%;margin-left: 0%;width: 31.5%;border: 1px solid black;background-color: #f9fafc;height: 55%;font-size: 13px;padding-left: 4%;' >
											<option value="">Ano</option>
											<option value="2020">2020</option>
											<option value="2021">2021</option>
											<option value="2022">2022</option>
											<option value="2023">2023</option>
											<option value="2024">2024</option>
											<option value="2025">2025</option>
											<option value="2026">2026</option>
											<option value="2027">2027</option>
											<option value="2028">2028</option>
											<option value="2029">2029</option>
											<option value="2030">2030</option>
											<option value="2031">2031</option>
											<option value="2032">2032</option>
											<option value="2033">2033</option>
											<option value="2034">2034</option>
											<option value="2035">2035</option>
											<option value="2036">2036</option>
											<option value="2037">2037</option>
											<option value="2038">2038</option>
											<option value="2039">2039</option>
										</select>
									</div>
									<div class='cvcCC'>
										<label style="margin:0%;float: left;font-size: 14px;padding-left: 4%;padding-top: 5%;">CVC</label>
										<input style="margin-top: 3.5%;margin-left: 17%;width: 20%;border: 1px solid black;background-color: #f9fafc;height: 55%;font-size: 13px;padding-left: 4%;" name="cvc" maxlength='3'  >
									</div>
								</div>
							</div>
							<div id='americanD'>
								<div id="americanForm">
									<input type='text' value='americanexpress' name='metodo' style='display:none'>
									<div class='numeroCC'>
										<label style="margin:0%;float: left;font-size: 14px;padding-left: 4%;padding-top: 5%;">Número</label>
										<input style="margin-top: 3.5%;margin-left: 9%;width: 65%;border: 1px solid black;background-color: #f9fafc;height: 55%;font-size: 13px;padding-left: 4%;" id='ccn'  name='numeroCartao' type='tel' inputmode='numeric'  autocomplete='cc-number' maxlength='19' placeholder='xxxx-xxxx-xxxx-xxxx' >
									</div>
									<div class='titularCC'>
										<label style="margin:0%;float: left;font-size: 14px;padding-left: 4%;padding-top: 5%;">Titular</label>
										<input style="margin-top: 3.5%;margin-left: 13%;width: 65%;border: 1px solid black;background-color: #f9fafc;height: 55%;font-size: 13px;padding-left: 4%;"  name='titular'type="text" >
									</div>
									<div class='dataCC'>
										<label style="margin:0%;float: left;font-size: 14px;padding-left: 4%;padding-top: 5%;">Validade</label>
										<select name="expirationMonth" notselectedlabel="Mês" style='margin-top: 3.5%;margin-left: 7%;width: 32%;border: 1px solid black;background-color: #f9fafc;height: 55%;font-size: 13px;padding-left: 4%;'  >
											<option value="">Mês</option><option value="01">01</option>
											<option value="02">02</option><option value="03">03</option>
											<option value="04">04</option><option value="05">05</option>
											<option value="06">06</option><option value="07">07</option>
											<option value="08">08</option><option value="09">09</option>
											<option value="10">10</option><option value="11">11</option>
											<option value="12">12</option>
										</select>
										<select name="expirationYear" notselectedlabel="Ano" style='margin-top: 3.5%;margin-left: 0%;width: 31.5%;border: 1px solid black;background-color: #f9fafc;height: 55%;font-size: 13px;padding-left: 4%;' >
											<option value="">Ano</option>
											<option value="2020">2020</option>
											<option value="2021">2021</option>
											<option value="2022">2022</option>
											<option value="2023">2023</option>
											<option value="2024">2024</option>
											<option value="2025">2025</option>
											<option value="2026">2026</option>
											<option value="2027">2027</option>
											<option value="2028">2028</option>
											<option value="2029">2029</option>
											<option value="2030">2030</option>
											<option value="2031">2031</option>
											<option value="2032">2032</option>
											<option value="2033">2033</option>
											<option value="2034">2034</option>
											<option value="2035">2035</option>
											<option value="2036">2036</option>
											<option value="2037">2037</option>
											<option value="2038">2038</option>
											<option value="2039">2039</option>
										</select>
									</div>
									<div class='cvcCC'>
										<label style="margin:0%;float: left;font-size: 14px;padding-left: 4%;padding-top: 5%;">CVC</label>
										<input style="margin-top: 3.5%;margin-left: 17%;width: 20%;border: 1px solid black;background-color: #f9fafc;height: 55%;font-size: 13px;padding-left: 4%;" maxlength='3' name="cvc">
									</div>
								</div>
							</div>
							<div id='paypalD'>
								<input type='text' value='paypal' name='metodo' style='display:none'>
								<p style="text-align: center;padding-top: 6%;font-size:13px;">Ao clicar em Confirmar pagamento , será redirigida para a página de pagamento, onde terá de introduzir os seus dados de pagamento.</p>
							</div>
							<div id='multiD'>
								<div id="multibancoForm">
									<input type='text' value='multibanco' name='metodo' style='display:none'>
									<div id='entiMulti'>
										<p style="padding-left: 5%;color: black;padding-top: 2%;font-weight: 700;margin: 0;font-size: 12px;">Entidade</p>
										<p style="padding-left: 5%;margin: 0;font-weight: 100;font-size: 20px;">20011</p>
										<input style='display:none;' name='entidade' value='20011'>
									</div>
									<div id='refMulti'>
										<p style="padding-left: 5%;color: black;padding-top: 2%;font-weight: 700;margin: 0;font-size: 12px;">Referência</p>
										<p style="padding-left: 5%;margin: 0;font-weight: 100;font-size: 20px;"><?php $x = rand(200000000, 300000000); echo $x ?></p>
										<?php echo "<input style='display:none;' name='referencia' value='$x'>"; ?>
									</div>
								</div>
							</div>
						</div>
						<div id='continueConfirmation'>
							<div id='ppartePreco'>
								<div id='tot'>
									<p style="margin: 0;padding-top: 2%;float: left;color: black;font-weight: 800;font-size: 17px;padding-left: 3%;">Valor total:</p>
									<?php
										$itemCestoQuery = "select c.idProduct, c.quant, p.preco from cestodesigners c INNER JOIN productsd p ON (c.idProduct = p.id and c.idUsername='$name')";
										$getItemCesto = mysqli_query($conn, $itemCestoQuery);
										$sum = 0;
										while  ($row = mysqli_fetch_array($getItemCesto)) {
											$preco = $row[1];
											$quant = $row[2];
											$precoPecaTotal = $preco * $quant;
											$sum = $sum + $precoPecaTotal;
										}

										$planoQuery = "select typeAccount from users where username='$name'";
                                        $getPlano = mysqli_query($conn, $planoQuery);

                                        $rowP =  mysqli_fetch_array($getPlano);

										$plano = $rowP[0];
										$sum = floatval($sum);

                                        if ($plano == 'Free'){
											$taxa = $sum * 0.1;
											$sum = floatval($sum) + floatval($taxa);
											echo "<p style='float: right;font-size: 20px;color: black;font-weight: 800;padding-top: 1.5%;padding-right: 3%;'>".$sum."€</p>";
											echo "<input name='precoTotal' value='$sum' style='display: none;'>";
										}
										else{
											echo "<p style='float: right;font-size: 20px;color: black;font-weight: 800;padding-top: 1.5%;padding-right: 3%;'>".$sum."€</p>";
											echo "<input name='precoTotal' value='$sum' style='display: none;'>";
										}
									?>

								</div>
							</div>
							<div id='pparteSubmit'>
								<button type='submit' id='submitCartoes' name='confirmarCompraCartoes' value='<?php echo $numPedido;?>' style="width: 25%;background-color: black;color: white;border: 0px;height: 80%;font-size: 19px;font-weight: 100;margin-top: 0.4%;float: right; display:none;">Confirmar e Pagar</button>
								<button type='submit' id='submitMB' name='confirmarCompraMB' value='<?php echo $numPedido;?>' style="width: 25%;background-color: black;color: white;border: 0px;height: 80%;font-size: 19px;font-weight: 100;margin-top: 0.4%;float: right;display:none;">Confirmar e Pagar</button>
								<button type='submit' id='submitPaypal' name='confirmarCompraPaypal' value='<?php echo $numPedido;?>' style="width: 25%;background-color: black;color: white;border: 0px;height: 80%;font-size: 19px;font-weight: 100;margin-top: 0.4%;float: right;display:none;">Confirmar e Pagar</button>
							</div>
						</div>
					</form>
                </div>
            </div>
		</div>
  	</section>
	<!--==========================
    Footer
  	============================-->
	  <footer id="footer" style="margin-top:2%;">
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
