<?php
	session_start();
	include "phpScripts/accessBD.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>OverLab - Wishlist</title>
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
  <link href="css/wishlist.css" rel="stylesheet">
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
			<li class="menu-active"><a href="wishlist.php">Wishlist</a></li>
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
			<div id="container">
				<div class='theWishCreate' id="myBtn" data-toggle="modal" data-target="#myModal">
					<div class='wishContainer'>
						<div class="newWish">
							<p>+</p>
						</div>

					</div>
					<div class='wishTitle'>
						<p>Criar nova wishlist</p>
					</div>
				</div>
				<?php
					$user = $_SESSION["username"];
					$wishQuery = "select * FROM wishlists where idUser ='$user'";
					$getWish = mysqli_query($conn, $wishQuery);

					if(!$getWish)
						die("Error, select query failed:" . $wishQuery);

					if(mysqli_num_rows($getWish)>0) {
						while  ($row = mysqli_fetch_array($getWish)) {
							$idWishlist = $row[0];
							$idCrip= $idWishlist;

							echo "
							<a href='wishlistSel.php?val=$idCrip' style='width: 20%;height:55%;margin-top: 1%;float: left;margin-left: 4%;display: inline-block;'>
							<div class='theWish'>
							<div class='wishContainer'>
								<div class='theWishOne'>";
									$photoProdQuery = "select pw.idProduct FROM products_wishlist pw, wishlists w where w.idWishlist ='$idWishlist' and pw.idWishlist = w.idWishlist ";
									$getPhotoProd = mysqli_query($conn, $photoProdQuery);
									if(!$getPhotoProd)
										die("Error, select query failed:" . $photoProdQuery);

									if(mysqli_num_rows($getPhotoProd)>0) {
										for ($i = 0; $i < 4; $i++){

											while($row1 = mysqli_fetch_assoc($getPhotoProd)){
												$photo = $row1["idProduct"];

												echo "<div class='contWish'>
														<img src='productsImage/$photo.jpg'>
													</div>";
											}
										}
									}

								echo "</div>
							</div>
							<div class='wishTitle'>
								<div class='parteLeft'>
									<p style='margin-left:5%;'>Wishlist ".$row[2] ."</p>
								</div>
								<div class='parteRight'>
									<form  action='phpScripts/wishlistScript.php' method='post' enctype='multipart/form-data'>
										<button type='submit' name='apagar' style='background-color: transparent;border: 0px;margin-left: 20%; color:gray;' value='$idWishlist'><i class='fas fa-trash'></i></button>
									</form>
								</div>
							</div>
						</div>
						</a>" ;
						}
					}

				?>

			</div>
		</div>
	  </section>
	  <div id="myModal" class="modal fade" role="dialog">
		<div class="modal-dialog">

			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Criar Wishlist</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>

				</div>
				<div class="modal-body">
					<form id="registerForm" action="<?=htmlspecialchars(stripslashes(trim("phpScripts/wishlistScript.php")));?>" method="post" enctype="multipart/form-data">
						<div class="input-div one" id="div1">
                                <div class="i">
                                    <i class="fas fa-male"></i>
                                </div>
                                <div>
                                    <h5>Nome da wishlist</h5>
                                    <input class="input" name="name" type="text" required>
                                </div>
                        </div>

				</div>
				<div class="modal-footer">
					<button type="submit" name='criar' class="btn" >Criar</button>
				</div>
				</form>
			</div>

		</div>
		</div>
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
	<script type="text/javascript" src="js/aaa.js"></script>

	</body>
</html>
