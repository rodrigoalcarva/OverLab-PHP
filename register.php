<?php
	session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>TriEscape</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="keywords">
  <meta content="" name="description">
  <link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet">

  <link href="vendor/icofont/icofont.min.css" rel="stylesheet">

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

  <!-- Main Stylesheet File -->
  <link href="css/style.css" rel="stylesheet">
  <link href="css/register.css" rel="stylesheet">
  <script src="https://kit.fontawesome.com/a81368914c.js"></script>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

</head>

<body>
    <?php
		if (isset($_SESSION["messageReceived"])) {
			echo "<script>alert('". $_SESSION["messageReceived"] ."');</script>";
			unset($_SESSION["messageReceived"]);
		}
	?>

  <!--==========================
  Header
  ============================-->
  <header id="header">
    <div id="logo">
        <img style="margin-left: 43%;" src="img/logo.png">
    </div>
  </header><!-- #header -->

  <!--==========================
    Hero Section
  ============================-->
  <section id="hero">
    <div class="hero-container">
        <div id="container">
            <div id="image">
                <img src="img/fashion.jfif">
            </div>
            <div id="register">
                <div id="regTitle">
                    <h1 >Registo</h1>
                    <ul class="nav-menu" style="margin-top:2%; margin-left:3%;"> 
			            <li id="li1" class="menu-active"><a href="#"><i class="icofont-user"></i> User</a></li>
			            <li id="li2"><a href="#"><i class="icofont-grocery"></i> Store</a></li>
                    </ul>
                </div>
                <div id="regisForm">
                    <form id="registerForm" class="Active" action="<?=htmlspecialchars(stripslashes(trim("phpScripts/registerScript.php")));?>" method="post" enctype="multipart/form-data">
                        <div class="info">
                            <div class="input-div one" id="div1">
                                <div class="i">
                                    <i class="fas fa-user"></i>
                                </div>
                                <div>
                                    <h5>Username</h5>
                                    <input class="input" name="username" type="text" required>
                                </div>
                            </div>
                            <div class="input-div two">
                                <div class="i">
                                    <i class="fas fa-at"></i>
                                </div>
                                <div>
                                    <h5>Email</h5>
                                    <input class="input" name="email" type="email" required>
                                </div>
                            </div>
                            <div class="input-div three">
                                <div class="i">
                                    <i class="fas fa-lock"></i>
                                </div>
                                <div>
                                    <h5>Password</h5>
                                    <input class="input" name="password" type="password" required>
                                </div>
                            </div>
                            <div class="input-div four">
                                <div class="i">
                                    <i class="fas fa-lock"></i>
                                </div>
                                <div>
                                    <h5>Confirme Password</h5>
                                    <input class="input" name="passwordConfirm" type="password" required>
                                </div>
                            </div>
                            <div class="input-div five">
                                <div class="i">
                                    <i class="far fa-question-circle"></i>
                                </div>
                                <div>
                                    <select class="form-control" name="question" id="questionSelect" required>
										<option selected disabled>Escolher uma Pergunta...</option>
										<option value="1animal">Qual é o nome do seu 1º animal de estimação ?</option>
										<option value="localNascimento">Qual é o local de nascimento da sua mãe ?</option>
										<option value="escolaPrimaria">Qual é o nome da sua escola primária ?</option>
										<option value="desportoFavorito">Qual é o seu desporto favorito?</option>
                                    </select>
                                </div>
                            </div>
                            <div class="input-div six">
                                <div class="i">
                                    <i class="far fa-keyboard"></i>
                                </div>
                                <div>
                                    <h5>Resposta</h5>
                                    <input class="input" name="resposta" type="text" required>
                                </div>
                            </div>
                        </div>
                        <div class="info1">
                            <div class="input-div one" id="div1">
                                <div class="i">
                                    <i class="fas fa-male"></i>
                                </div>
                                <div>
                                    <h5>Nome Próprio</h5>
                                    <input class="input" name="firstName" type="text" required>
                                </div>
                            </div>
                            <div class="input-div two">
                                <div class="i">
                                    <i class="fas fa-male"></i>
                                </div>
                                <div>
                                    <h5>Apelido</h5>
                                    <input class="input" name="lastName" type="text" required>
                                </div>
                            </div>
                            <div class="input-div seven">
                                <div class="i">
                                    <i class="fas fa-calendar-day"></i>
                                </div>
                                <div>
                                    <h5>Data de Nascimento</h5>
                                    <input placeholder="" class="input" type="text" onfocus="(this.type='date')" onblur="(this.type='text')" name="birthday" required>
                                </div>
                            </div>
                            <div class="input-div four">
                                <div class="i">
                                    <i class="fas fa-globe-europe"></i>
                                </div>
                                <div>
                                    <h5>País</h5>
                                    <input class="input" name="country" type="text" required>
                                </div>
                            </div>
                            <div class="input-div five">
                                <div class="i">
                                    <i class="fas fa-users"></i>
                                </div>
                                <div>
                                    <select class="form-control" name="gender" id="questionSelect" required>
										<option selected disabled>Genero</option>
										<option value="M">Masculino</option>
										<option value="F">Feminino</option>
                                    </select>
                                </div>
                            </div>
                            <div class="input-div nine">
                                <div class="i">
                                    <i class="fas fa-camera"></i>
                                </div>
                                <div>
                                    <input id="file" type="file" accept=".jpg" name="avatar">
                                </div>
                            </div>
                        </div>
                        <div id="buttonSubmit">
                            <input type="submit" class="btn" name="registerLa" value="Registar">
                        </div>
                    </form>
                    <form id="registerForm1" action="<?=htmlspecialchars(stripslashes(trim("phpScripts/registerScriptStore.php")));?>" method="post" enctype="multipart/form-data">
                        <div class="info">
                            <div class="input-div one" id="div1">
                                <div class="i">
                                    <i class="fas fa-user"></i>
                                </div>
                                <div>
                                    <h5>StoreName</h5>
                                    <input class="input" name="storename" type="text" required>
                                </div>
                            </div>
                            <div class="input-div two">
                                <div class="i">
                                    <i class="fas fa-at"></i>
                                </div>
                                <div>
                                    <h5>Email</h5>
                                    <input class="input" name="email" type="email" required>
                                </div>
                            </div>
                            <div class="input-div three">
                                <div class="i">
                                    <i class="fas fa-lock"></i>
                                </div>
                                <div>
                                    <h5>Password</h5>
                                    <input class="input" name="password" type="password" required>
                                </div>
                            </div>
                            <div class="input-div four">
                                <div class="i">
                                    <i class="fas fa-lock"></i>
                                </div>
                                <div>
                                    <h5>Confirme Password</h5>
                                    <input class="input" name="passwordConfirm" type="password" required>
                                </div>
                            </div>
                            <div class="input-div five">
                                <div class="i">
                                    <i class="far fa-question-circle"></i>
                                </div>
                                <div>
                                    <select class="form-control" name="question" id="questionSelect" required>
										<option selected disabled>Escolher uma Pergunta...</option>
										<option value="1animal">Qual é o nome do seu 1º animal de estimação ?</option>
										<option value="localNascimento">Qual é o local de nascimento da sua mãe ?</option>
										<option value="escolaPrimaria">Qual é o nome da sua escola primária ?</option>
										<option value="desportoFavorito">Qual é o seu desporto favorito?</option>
                                    </select>
                                </div>
                            </div>
                            <div class="input-div six">
                                <div class="i">
                                    <i class="far fa-keyboard"></i>
                                </div>
                                <div>
                                    <h5>Resposta</h5>
                                    <input class="input" name="resposta" type="text" required>
                                </div>
                            </div>
                        </div>
                        <div class="info1">
                            <div class="input-div one" id="div1">
                                <div class="i">
                                    <i class="fas fa-male"></i>
                                </div>
                                <div>
                                    <h5>Nome Loja</h5>
                                    <input class="input" name="nameStore" type="text" required>
                                </div>
                            </div>
                            <div class="input-div two">
                                <div class="i">
                                    <i class="fas fa-ad"></i>
                                </div>
                                <div>
                                    <h5>Slogan</h5>
                                    <input class="input" name="slogan" type="text" required>
                                </div>
                            </div>
                            <div class="input-div seven">
                                <div class="i">
                                    <i class="fas fa-calendar-day"></i>
                                </div>
                                <div>
                                    <h5>Data de Criação</h5>
                                    <input placeholder="" class="input" type="text" onfocus="(this.type='date')" onblur="(this.type='text')" name="birthday" required>
                                </div>
                            </div>
                            <div class="input-div four">
                                <div class="i">
                                    <i class="fas fa-globe-europe"></i>
                                </div>
                                <div>
                                    <h5>País</h5>
                                    <input class="input" name="country" type="text" required>
                                </div>
                            </div>
                            <div class="input-div nine" style="margin-top: 3%;">
                                <div class="i">
                                    <i class="fas fa-camera"></i>
                                </div>
                                <div>
                                    <input id="file" type="file" accept=".jpg" name="avatar">
                                </div>
                            </div>
                        </div>
                        <div id="buttonSubmit">
                            <input type="submit" class="btn" name="register" value="Registar">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
  </section><!-- #hero -->

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
