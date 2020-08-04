<?php
	session_start();
	include "phpScripts/accessBD.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>OverLab - Chatroom</title>
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
  <link href="css/chatroom.css" rel="stylesheet">
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
			<div id='followers'>
                <div id='followersTitle'>
                    <p style="margin: 0;text-align: center;font-size: 25px;padding-top: 9%;color: black;font-weight: 700;">Pessoas</p>
                </div>
                <div id='followersContainer'>
					<?php
					$fQuery = "select idSeguidor FROM followers  WHERE idSeguido='$name' and estado_seguir='confirmado' ";
					$getF = mysqli_query($conn, $fQuery);

					if(mysqli_num_rows($getF)>0) {
						while($row = mysqli_fetch_array($getF)){
							$nameFollow = $row[0];

							$foQuery  ="select f.idSeguido, u.firstName, u.lastName FROM followers f, users u WHERE f.idSeguido = u.username and idSeguidor='$name'  and idSeguido='$nameFollow' and estado_seguir='confirmado'";
							$getFF = mysqli_query($conn, $foQuery);

							if(mysqli_num_rows($getFF)>0) {
								echo "
									<a class='thePerson' href='chatroom.php?name=$nameFollow'>
									<div class='imgPerson'>
										<div class='backImg'>
											<img src='userImages/$nameFollow.jpg'>
										</div>
									</div>
									<div class='textPerson'>
										<p style='font-size: 25px;font-weight: 100;padding-top: 29%;padding-left: 12%;float:left;'>$nameFollow</p>
									</div>
								</a>";
							}
						}
					}
					?>
                </div>
            </div>
            <div id='chats'>
                <div id='chatsTitle'>
                    <p style="margin: 0;text-align: center;font-size: 25px;padding-top: 2.5%;color: black;font-weight: 700;">ChatRoom</p>
                </div>
                <div id='chatContainer'>
                    <div id='messagesChat'>
						<div class='rowMessage'>
							<?php
								if (isset($_GET['name'])){
									$id_send = $_GET['name'];
									$messagesQuery = "select * from chat where id_send='$name' and id_receive='$id_send' UNION select * from chat where id_send='$id_send' and id_receive='$name' ORDER BY data DESC";
									$getMessages = mysqli_query($conn, $messagesQuery);

									if(mysqli_num_rows($getMessages)>0) {
										while  ($row = mysqli_fetch_array($getMessages)) {
											$id1 = $row[0];
											$message = $row[2];
											$data = $row[3];
											if ($id1 == $name){
												echo"<div class='theMessage'>
												<div class='theMessageTitle'>
													<p style='margin: 0;font-size: 13px;padding-left: 2%;color: white;'>$id1</p>
												</div>
												<div class='theMessageContainer'>
													<p style='margin: 0;color: white;padding-left: 2%;'>$message</p>
												</div>
												<div class='theMessageDate'>
													<p style='margin: 0;float: right;color: white;font-size: 12px;padding-right: 2%;'>$data</p>
												</div>
											</div>";
											}
											else{
												echo"<div class='theMessage' style='background-color:rgba(192, 192, 192, 0.5);'>
												<div class='theMessageTitle'>
													<p style='margin: 0;font-size: 13px;padding-left: 2%;color: white;'>$id1</p>
												</div>
												<div class='theMessageContainer'>
													<p style='margin: 0;color: white;padding-left: 2%;'>$message</p>
												</div>
												<div class='theMessageDate'>
													<p style='margin: 0;float: right;color: white;font-size: 12px;padding-right: 2%;'>$data</p>
												</div>
											</div>";
											}
										}
									}
								}
								else{
									echo "";
								}



							?>
						</div>

                    </div>
                    <div id='sendMessage'>
						<form action='phpScripts/chatroomScript.php' method='post' enctype='multipart/form-data' style='width:100%;height:100%;'>
							<?php
							if (isset($_GET['name'])){
								echo "<input name='message' class='form-control'type='text' style='height: 60%;width: 80%;margin-top: 2%;float: left;margin-left: 2%;'><button name='sendMessage' value='$id_send' type='submit' style='width: 14%;height: 60%;margin-top: 2%;margin-left: 2%;border: 3px solid black;background-color: transparent;'>Enviar</button>";
							}
							else{
								echo "<input name='message' class='form-control'type='text' style='height: 60%;width: 80%;margin-top: 2%;float: left;margin-left: 2%;' disabled><button name='sendMessage' type='submit' style='width: 14%;height: 60%;margin-top: 2%;margin-left: 2%;border: 3px solid black;background-color: transparent;' disabled>Enviar</button>";
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


	</body>
</html>
