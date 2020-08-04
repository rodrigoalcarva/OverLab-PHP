<?php
	session_start();
	include "phpScripts/accessBD.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>OverLab - Followers</title>
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
  <link href="css/followers.css" rel="stylesheet">
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
			<li class="menu-active"><a href="followers.php">Friends</a></li>
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
			<div id='feed'>
				<div id='parteFeed'>
					<div id="titleFeed">
						<p style="text-align: center;padding-top: 4%;font-size: 30px;font-weight: bold;color: black;">Actividade</p>
					</div>
					<div id="feedContainer">
						<?php

						$postsQuery = "select s.idUtilizador, s.idStore, s.data, p.category, p.brand, p.color from
						(select id,category, brand, color, utility
						 from productsd
						 UNION
						 select id, name, brand, color, utility
						 from productsu)
						 p, storage s, followers f where p.id = s.idStore and f.idSeguido= s.idUtilizador and f.idSeguidor='$name' and estado_seguir='confirmado'
						 ORDER BY s.data DESC;";

						$getPosts = mysqli_query($conn, $postsQuery);

						if(mysqli_num_rows($getPosts)>0) {
							while  ($row = mysqli_fetch_array($getPosts)) {

								$userA = $row[0];
								$idProd = $row[1];
								$data = $row[2];
								$category = $row[3];
								$brand = $row[4];
								$color = $row[5];

								echo "<div class='thePub'>
									<div class='imgThePub'>
										<div class='imgimgPub'>
											<img src='productsImage/$idProd.jpg'>
										</div>
									</div>
									<div class='infoProdThePub'>
										<p style='margin: 0;font-size: 34px;color: white;padding-top: 3%;font-weight: bold;'>$category</p>
										<p style='margin: 0;color: white;font-weight: 400;'>$idProd</p>
										<p style='margin: 0;color: white;font-weight: 400;'>Marca: $brand</p>
										<p style='margin: 0;color: white;font-weight: 400;padding-bottom: 7%;'>Cor: $color</p>
										<i class='fas fa-star' id='$idProd' style='font-size: 25px;color: white;cursor:pointer;'></i>
									</div>
									<div class='infoPersonThePub' id='infPers_$idProd'>
										<div class='infoPersonThePubText'>
											<p style='margin:0;text-align: center;padding-top: 7%;font-weight: 100;color:white;'>Adicionado por:</p>
										</div>
										<div class='infoPersonTheImg'>
											<div class='backImgPerson'>
												<img src='userImages/$userA.jpg'>
											</div>
										</div>
										<div class='infoPersonThePubUsername'>
											<p style='margin:0;text-align: center;font-size: 17px;font-weight: 600;color: white;'>$userA</p>
										</div>
										<div class='infoPersonThePubData'>
											<p style='margin:0;text-align: center;font-size: 14px;padding-top: 1%;color: white;'>$data</p>
										</div>
									</div>
									<div class='addWish' id='wishPers_$idProd'>
										<form action='phpScripts/storeScriptDesigner.php' method='post' enctype='multipart/form-data' style='width:100%;height:100%;'>
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
                                                        $value = $idProd . "," . $idWish;
                                                        echo "<button type='submit' class='ButtonOption' name='addWishD' value='$value'>Wishlist $nameWish</button>";
                                                    }
                                                }

                                            echo "</div>
                                        </form>
									</div>
								</div>";
							}
						}
						?>

					</div>
				</div>
			</div>
			<div id='chatFollowers'>
				<div id='parte2options'>
					<div id='chat'>
						<a href='chatroom.php' style="width:100%;height:100%">
							<div class='parteLeftOption'>
								<img src='img/chat.png' style="width: 80%;margin-top: 7%;">
							</div>
							<div id='parteRightOption'>
								<p style='text-align: center;font-size: 20px;font-weight: 100;margin-right: 16%;padding-top: 17%;'>Chat<p>
							</div>
						</a>
					</div>
					<div id='addPeople'>
						<a href='#' style="width:100%;height:100%" id="myBtn">
							<div class='parteLeftOption'>
								<img src='img/add-user.png' style="width: 80%;margin-top: 7%;">
							</div>
							<div id='parteRightOption'>
								<p style='text-align: center;font-size: 18px;font-weight: 100;margin-right: 16%;padding-top:12%;'>Seguir amigos<p>
							</div>
						</a>
					</div>
				</div>
				<div id='parteFollowers'>
					<div id='followersTitle'>
						<div class='optionFollowers'>
							<p class='accc' id='seguidores' style="text-align: right;margin: 0;padding-top: 20%;font-weight: 100;color:black;cursor:pointer;">Seguidores</p>
						</div>
						<div class='optionFollowers'>
							<p id='aseguir' style="text-align: center;margin: 0;padding-top: 20%;font-weight: 100;color:black;cursor:pointer;">A seguir</p>
						</div>
						<div class='optionFollowers'>
							<p id='requests' style="text-align: left;margin: 0;padding-top: 20%;font-weight: 100;color:black;cursor:pointer;">Pedidos</p>
						</div>
					</div>
					<div id='followersContainer1'>
						<?php
								$pendenteQuery = "select f.idSeguidor, u.firstName, u.lastName FROM followers f, users u WHERE f.idSeguidor = u.username and idSeguido='$name' and estado_seguir='confirmado'";
								$getPendente = mysqli_query($conn, $pendenteQuery);

								if(mysqli_num_rows($getPendente)>0) {
									while($row = mysqli_fetch_array($getPendente)){
										$nameSeguidor = $row[0];
										$firstName = $row[1];
										$lastName = $row[2];
										echo"<div class='person'>
											<div class='imgPerson'>
												<div class='imgInside'>
													<img src='userImages/$nameSeguidor.jpg'>
												</div>
											</div>
											<div class='textPerson'>
												<p style='margin: 0;font-size: 20px;font-weight: 100;padding-top: 11%;'>$nameSeguidor</p>
												<p style='margin: 0;font-size: 11px;'>$firstName $lastName</p>
											</div>
											<div class='buttonPerson'>
											</div>
										</div>";
									}
								}
						?>
					</div>
					<div id='followersContainer2'>
						<?php
							$pendenteQuery = "select f.idSeguido, u.firstName, u.lastName FROM followers f, users u WHERE f.idSeguido = u.username and idSeguidor='$name'  and estado_seguir='confirmado'";
							$getPendente = mysqli_query($conn, $pendenteQuery);

							if(mysqli_num_rows($getPendente)>0) {
								while($row = mysqli_fetch_array($getPendente)){
									$nameSeguidor = $row[0];
									$firstName = $row[1];
									$lastName = $row[2];
									echo"<div class='person'>
										<div class='imgPerson'>
											<div class='imgInside'>
												<img src='userImages/$nameSeguidor.jpg'>
											</div>
										</div>
										<div class='textPerson'>
											<p style='margin: 0;font-size: 20px;font-weight: 100;padding-top: 11%;'>$nameSeguidor</p>
											<p style='margin: 0;font-size: 11px;'>$firstName $lastName</p>
										</div>
										<div class='buttonPerson'>
											<form style='width:100%;height:100%' action='phpScripts/followersScript.php' method='post' enctype='multipart/form-data'>
												<button name='unfollow' class='unfollow' value='$nameSeguidor'>
													<img style='width: 75%;margin-top: 9%;padding-left: 0%;margin-left: 9%;' src='img/unfollow.png'>
												</button>
											</form>
										</div>
									</div>";
								}
							}
						?>
					</div>
					<div id='followersContainer3'>
						<?php
						$pendenteQuery = "select f.idSeguidor, u.firstName, u.lastName FROM followers f, users u WHERE f.idSeguidor = u.username and idSeguido='$name'and estado_seguir='pendente'";
						$getPendente = mysqli_query($conn, $pendenteQuery);

						if(mysqli_num_rows($getPendente)>0) {
							while($row = mysqli_fetch_array($getPendente)){
								$nameSeguidor = $row[0];
								$firstName = $row[1];
								$lastName = $row[2];
								echo "<div class='person'>
									<div class='imgPerson'>
										<div class='imgInside'>
											<img src='userImages/$nameSeguidor.jpg'>
										</div>
									</div>
									<div class='textPerson'>
										<p style='margin: 0;font-size: 20px;font-weight: 100;padding-top: 11%;'>$nameSeguidor</p>
										<p style='margin: 0;font-size: 11px;'>$firstName $lastName</p>
									</div>
									<div class='buttonPerson'>
										<form style='width:100%;height:100%' action='phpScripts/followersScript.php' method='post' enctype='multipart/form-data'>
											<button name='confirm' class='confirmPerson' value='$nameSeguidor'>
												<img src='img/check.png'>
											</button>
											<button name='reject' class='cancelPerson' value='$nameSeguidor'>
												<img src='img/decline.png'>
											</button>
										</form>
									</div>
								</div>";
							}
						}
						?>
					</div>
				</div>
			</div>
		</div>
		<div id="myModal" class="modal">

		<!-- Modal content -->
			<div class="modal-content">
				<span class="close" style="width: 3%;margin-left: 95%;">&times;</span>
				<div id="cont">
					<div id="imgCool">
						<img src="img/friends.jpg">
					</div>
					<div id='parteAdd'>
						<div id='parteAddFollowerTitle'>
							<p style="margin: 0;font-size: 24px;font-weight: 100;padding-top: 9%;">Seguir pessoas</p>
						</div>
						<div id='parteAddFollowerCont'>
							<form style='width:100%;height:100%;'  action="phpScripts/followersScript.php" method="post" enctype="multipart/form-data">
								<div class="search-box">
									<input name='person' type="text" autocomplete="off" placeholder="Procurar pessoa..." />
									<div class="result"></div>
								</div>

								<button type='submit' name='addFollower' style="width: 60%;height: 30%;margin-left: 20%;margin-top: 25%;background-color: transparent;border: 2px solid black;">Enviar Pedido</button>
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
	<script type="text/javascript" src="js/aaa2.js"></script>
	<script type="text/javascript">
	$(document).ready(function(){
		$('.search-box input[type="text"]').on("keyup input", function(){
			/* Get input value on change */
			var inputVal = $(this).val();
			var resultDropdown = $(this).siblings(".result");
			if(inputVal.length){
				$.get("phpScripts/followersScript.php", {term: inputVal}).done(function(data){
					// Display the returned data in browser
					resultDropdown.html(data);
				});
			} else{
				resultDropdown.empty();
			}
		});

		// Set search input value on click of result item
		$(document).on("click", ".result p", function(){
			$(this).parents(".search-box").find('input[type="text"]').val($(this).text());
			$(this).parent(".result").empty();
		});

		$("#seguidores").click(function(){
			$('#followersContainer1').css("display", "block");
			$('#followersContainer2').css("display", "none");
			$('#followersContainer3').css("display", "none");
			$('#seguidores').addClass("accc");
			$('#aseguir').removeClass("accc");
			$('#requests').removeClass("accc");
		});

		$("#aseguir").click(function(){
			$('#followersContainer2').css("display", "block");
			$('#followersContainer1').css("display", "none");
			$('#followersContainer3').css("display", "none");
			$('#seguidores').removeClass("accc");
			$('#aseguir').addClass("accc");
			$('#requests').removeClass("accc");
		});

		$("#requests").click(function(){
			$('#followersContainer3').css("display", "block");
			$('#followersContainer1').css("display", "none");
			$('#followersContainer2').css("display", "none");
			$('#seguidores').removeClass("accc");
			$('#aseguir').removeClass("accc");
			$('#requests').addClass("accc");
		});


	});
	</script>

	</body>
</html>
