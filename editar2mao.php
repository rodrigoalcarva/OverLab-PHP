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

        if (isset($_GET['sale'])){
            $id = $_GET['sale'];
        }
        else{
            header("Location: mystore2mao.php");
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
			<li ><a href="store.php">Store</a></li>
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
                    <div class='optionStore' style="width:30%">
                        <a href='#' style='text-align:left;color:#666666;'><p style="padding-top: 6%;font-size: 17px;margin-left: 15%;">Adicionar peça de roupa para venda</p></a>
                    </div>
                    <div class='optionCategory'>

                    </div>
                    <div class='optionCarrinho'>

                    </div>
                    <div class='optionSearch' id="click">

                    </div>

                </div>


                <div id="rest">
                    <?php
                        $user = $_SESSION["username"];

                        $productsQuery = "select p.category, v.tamanho, v.preco, v.titulo, v.descricao, v.localizacao from (select id,category, brand, color, utility from productsd UNION select id, name, brand, color, utility from productsu) p, venda2mao v where p.id = v.idProduct and v.idUsername='$user' AND v.idProduct='$id'";

                        $getProducts = mysqli_query($conn,$productsQuery);

                        if (!$getProducts)
                            die("Error, select query failed:" . $productsQuery);

                        $row = mysqli_fetch_array($getProducts);

                        $tipo = $row[0];
                        $title = $row[3];
                        $description = $row[4];
                        $tamanho = $row[1];
                        $preco = $row[2];
                        $loc = $row[5];



                    ?>
                    <form style="width:100%;height:100%;" action="<?=htmlspecialchars(stripslashes(trim("phpScripts/storeScript2mao.php")));?>" method="post" enctype="multipart/form-data">
                        <div id='formEsq'>
                            <div id='formSaleTitle'>
                                <div class="form-group" style="width: 90%;margin-left: 5%; margin-top: 2%;">
                                    <label for="exampleInputEmail1">Titulo</label>
                                    <?php echo "<input type='text' class='form-control' name='titulo' value='$title' placeholder='$title' maxlength='20' required>"; ?>
                                    <small id="emailHelp" class="form-text text-muted">Máximo de 20 caracteres.</small>
                                </div>
                            </div>
                            <div id='formSaleDescription'>
                                <div class="form-group" style="width: 90%;margin-left: 5%;margin-top: 2%;">
                                    <label for="exampleFormControlTextarea1">Descrição</label>
                                    <?php echo "<textarea class='form-control' name='descricao' id='exampleFormControlTextarea1' value='$description' placeholder='$description' style='resize:none;' rows='3' data-maxtext='9000' required>$description</textarea>"; ?>
                                    <small id="emailHelp" class="form-text text-muted">Máximo de 9000 caracteres.</small>
                                </div>
                            </div>
                            <div id='formSaleOthers'>
                                <div class="form-group" style="width: 90%; margin-left: 5%;margin-top: 2%;">
                                    <label for="exampleFormControlSelect1">Tamanho</label>
                                    <select class="form-control" id="exampleFormControlSelect1" name='tamanho' required>
                                    <?php
                                        if ($tipo == 'Tshirt' or $tipo =='Top' or $tipo =='Polo' or $tipo =='Camisa' or $tipo =='Vestido' or $tipo =='Macacão' or $tipo =='Casaco' or $tipo =='Blusão' or $tipo =='Camisola' or $tipo =='Malha' or $tipo =='Blazer' or $tipo =='Sweatshirt' or $tipo =='Sobretudo' or $tipo == 'Fato de Banho'){
                                            if ($tamanho == 'xs'){
                                                echo " <option style='display:none'>Escolher</option>
                                                <option value='xs' selected>XS</option>
                                                <option value='s'>S</option>
                                                <option value='m'>M</option>
                                                <option value='l'>L</option>
                                                <option value='xl'>XL</option>
                                                <option value='xxl'>XXL</option>";
                                            }
                                            elseif ($tamanho == 's'){
                                                echo " <option style='display:none'>Escolher</option>
                                                <option value='xs'>XS</option>
                                                <option value='s' selected>S</option>
                                                <option value='m'>M</option>
                                                <option value='l'>L</option>
                                                <option value='xl'>XL</option>
                                                <option value='xxl'>XXL</option>";
                                            }
                                            elseif ($tamanho == 'm'){
                                                echo " <option style='display:none'>Escolher</option>
                                                <option value='xs'>XS</option>
                                                <option value='s' >S</option>
                                                <option value='m' selected>M</option>
                                                <option value='l'>L</option>
                                                <option value='xl'>XL</option>
                                                <option value='xxl'>XXL</option>";
                                            }
                                            elseif ($tamanho == 'l'){
                                                echo " <option style='display:none'>Escolher</option>
                                                <option value='xs'>XS</option>
                                                <option value='s' >S</option>
                                                <option value='m'>M</option>
                                                <option value='l' selected>L</option>
                                                <option value='xl'>XL</option>
                                                <option value='xxl'>XXL</option>";
                                            }
                                            elseif ($tamanho == 'xl'){
                                                echo " <option style='display:none'>Escolher</option>
                                                <option value='xs'>XS</option>
                                                <option value='s' >S</option>
                                                <option value='m'>M</option>
                                                <option value='l' >L</option>
                                                <option value='xl' selected>XL</option>
                                                <option value='xxl'>XXL</option>";
                                            }
                                            else{
                                                echo " <option style='display:none'>Escolher</option>
                                                <option value='xs'>XS</option>
                                                <option value='s' >S</option>
                                                <option value='m'>M</option>
                                                <option value='l' >L</option>
                                                <option value='xl' >XL</option>
                                                <option value='xxl' selected>XXL</option>";
                                            }
                                        }
                                        else if ($tipo == 'Calças' or $tipo == 'Jeans' or $tipo == "Calções" or $tipo == 'Saia'){
                                            if ($tamanho == '32'){
                                                echo " <option style='display:none'>Escolher</option>
                                                <option value='32' selected>32</option>
                                                <option value='34'>34</option>
                                                <option value='36'>36</option>
                                                <option value='38'>38</option>
                                                <option value='40'>40</option>
                                                <option value='42'>42</option>
                                                <option value='44'>44</option>
                                                <option value='46'>46</option>
                                                <option value='48'>48</option>
                                                <option value='50'>50</option>";
                                            }
                                            elseif ($tamanho == '34'){
                                                echo " <option style='display:none'>Escolher</option>
                                                <option value='32' >32</option>
                                                <option value='34' selected>34</option>
                                                <option value='36'>36</option>
                                                <option value='38'>38</option>
                                                <option value='40'>40</option>
                                                <option value='42'>42</option>
                                                <option value='44'>44</option>
                                                <option value='46'>46</option>
                                                <option value='48'>48</option>
                                                <option value='50'>50</option>";
                                            }
                                            elseif ($tamanho == '36'){
                                                echo " <option style='display:none'>Escolher</option>
                                                <option value='32' >32</option>
                                                <option value='34' >34</option>
                                                <option value='36' selected>36</option>
                                                <option value='38'>38</option>
                                                <option value='40'>40</option>
                                                <option value='42'>42</option>
                                                <option value='44'>44</option>
                                                <option value='46'>46</option>
                                                <option value='48'>48</option>
                                                <option value='50'>50</option>";
                                            }
                                            elseif ($tamanho == '38'){
                                                echo " <option style='display:none'>Escolher</option>
                                                <option value='32' >32</option>
                                                <option value='34' >34</option>
                                                <option value='36' >36</option>
                                                <option value='38' selected>38</option>
                                                <option value='40'>40</option>
                                                <option value='42'>42</option>
                                                <option value='44'>44</option>
                                                <option value='46'>46</option>
                                                <option value='48'>48</option>
                                                <option value='50'>50</option>";
                                            }
                                            elseif ($tamanho == '40'){
                                                echo " <option style='display:none'>Escolher</option>
                                                <option value='32' >32</option>
                                                <option value='34' >34</option>
                                                <option value='36' >36</option>
                                                <option value='38' >38</option>
                                                <option value='40' selected>40</option>
                                                <option value='42'>42</option>
                                                <option value='44'>44</option>
                                                <option value='46'>46</option>
                                                <option value='48'>48</option>
                                                <option value='50'>50</option>";
                                            }
                                            elseif ($tamanho == '42'){
                                                echo " <option style='display:none'>Escolher</option>
                                                <option value='32' >32</option>
                                                <option value='34' >34</option>
                                                <option value='36' >36</option>
                                                <option value='38' >38</option>
                                                <option value='40' >40</option>
                                                <option value='42' selected>42</option>
                                                <option value='44'>44</option>
                                                <option value='46'>46</option>
                                                <option value='48'>48</option>
                                                <option value='50'>50</option>";
                                            }
                                            elseif ($tamanho == '44'){
                                                echo " <option style='display:none'>Escolher</option>
                                                <option value='32' >32</option>
                                                <option value='34' >34</option>
                                                <option value='36' >36</option>
                                                <option value='38' >38</option>
                                                <option value='40' >40</option>
                                                <option value='42' >42</option>
                                                <option value='44' selected>44</option>
                                                <option value='46'>46</option>
                                                <option value='48'>48</option>
                                                <option value='50'>50</option>";
                                            }
                                            elseif ($tamanho == '46'){
                                                echo " <option style='display:none'>Escolher</option>
                                                <option value='32' >32</option>
                                                <option value='34' >34</option>
                                                <option value='36' >36</option>
                                                <option value='38' >38</option>
                                                <option value='40' >40</option>
                                                <option value='42' >42</option>
                                                <option value='44' >44</option>
                                                <option value='46' selected>46</option>
                                                <option value='48'>48</option>
                                                <option value='50'>50</option>";
                                            }
                                            elseif ($tamanho == '48'){
                                                echo " <option style='display:none'>Escolher</option>
                                                <option value='32' >32</option>
                                                <option value='34' >34</option>
                                                <option value='36' >36</option>
                                                <option value='38' >38</option>
                                                <option value='40' >40</option>
                                                <option value='42' >42</option>
                                                <option value='44' >44</option>
                                                <option value='46' >46</option>
                                                <option value='48' selected>48</option>
                                                <option value='50'>50</option>";
                                            }
                                            else{
                                                echo " <option style='display:none'>Escolher</option>
                                                <option value='32' >32</option>
                                                <option value='34' >34</option>
                                                <option value='36' >36</option>
                                                <option value='38' >38</option>
                                                <option value='40' >40</option>
                                                <option value='42' >42</option>
                                                <option value='44' >44</option>
                                                <option value='46' >46</option>
                                                <option value='48' >48</option>
                                                <option value='50' selected>50</option>";
                                            }
                                        }
                                        else if ($tipo == 'Ténis' or $tipo == 'Sapatos Social' or $tipo == 'Botas' or $tipo == 'Sandálias' or $tipo == 'Chinelos' ){
                                            if ($tamanho == '35'){
                                                echo "
                                                    <option style='display:none'>Escolher</option>
                                                    <option value='35' selected>35</option>
                                                    <option value='36'>36</option>
                                                    <option value='37'>37</option>
                                                    <option value='38'>38</option>
                                                    <option value='39'>39</option>
                                                    <option value='40'>40</option>
                                                    <option value='41'>41</option>
                                                    <option value='42'>42</option>
                                                    <option value='43'>43</option>
                                                    <option value='44'>44</option>
                                                    <option value='45'>45</option>
                                                    <option value='46'>46</option>
                                                    <option value='47'>47</option>
                                                ";
                                            }
                                            elseif ($tamanho == '36'){
                                                echo "
                                                    <option style='display:none'>Escolher</option>
                                                    <option value='35' >35</option>
                                                    <option value='36' selected>36</option>
                                                    <option value='37'>37</option>
                                                    <option value='38'>38</option>
                                                    <option value='39'>39</option>
                                                    <option value='40'>40</option>
                                                    <option value='41'>41</option>
                                                    <option value='42'>42</option>
                                                    <option value='43'>43</option>
                                                    <option value='44'>44</option>
                                                    <option value='45'>45</option>
                                                    <option value='46'>46</option>
                                                    <option value='47'>47</option>
                                                ";
                                            }
                                            elseif ($tamanho == '37'){
                                                echo "
                                                    <option style='display:none'>Escolher</option>
                                                    <option value='35' >35</option>
                                                    <option value='36' >36</option>
                                                    <option value='37' selected>37</option>
                                                    <option value='38'>38</option>
                                                    <option value='39'>39</option>
                                                    <option value='40'>40</option>
                                                    <option value='41'>41</option>
                                                    <option value='42'>42</option>
                                                    <option value='43'>43</option>
                                                    <option value='44'>44</option>
                                                    <option value='45'>45</option>
                                                    <option value='46'>46</option>
                                                    <option value='47'>47</option>
                                                ";
                                            }
                                            elseif ($tamanho == '38'){
                                                echo "
                                                    <option style='display:none'>Escolher</option>
                                                    <option value='35' >35</option>
                                                    <option value='36' >36</option>
                                                    <option value='37' >37</option>
                                                    <option value='38' selected>38</option>
                                                    <option value='39'>39</option>
                                                    <option value='40'>40</option>
                                                    <option value='41'>41</option>
                                                    <option value='42'>42</option>
                                                    <option value='43'>43</option>
                                                    <option value='44'>44</option>
                                                    <option value='45'>45</option>
                                                    <option value='46'>46</option>
                                                    <option value='47'>47</option>
                                                ";
                                            }
                                            elseif ($tamanho == '39'){
                                                echo "
                                                    <option style='display:none'>Escolher</option>
                                                    <option value='35' >35</option>
                                                    <option value='36' >36</option>
                                                    <option value='37' >37</option>
                                                    <option value='38' >38</option>
                                                    <option value='39' selected>39</option>
                                                    <option value='40'>40</option>
                                                    <option value='41'>41</option>
                                                    <option value='42'>42</option>
                                                    <option value='43'>43</option>
                                                    <option value='44'>44</option>
                                                    <option value='45'>45</option>
                                                    <option value='46'>46</option>
                                                    <option value='47'>47</option>
                                                ";
                                            }
                                            elseif ($tamanho == '40'){
                                                echo "
                                                    <option style='display:none'>Escolher</option>
                                                    <option value='35' >35</option>
                                                    <option value='36' >36</option>
                                                    <option value='37' >37</option>
                                                    <option value='38' >38</option>
                                                    <option value='39' >39</option>
                                                    <option value='40' selected>40</option>
                                                    <option value='41'>41</option>
                                                    <option value='42'>42</option>
                                                    <option value='43'>43</option>
                                                    <option value='44'>44</option>
                                                    <option value='45'>45</option>
                                                    <option value='46'>46</option>
                                                    <option value='47'>47</option>
                                                ";
                                            }
                                            elseif ($tamanho == '41'){
                                                echo "
                                                    <option style='display:none'>Escolher</option>
                                                    <option value='35' >35</option>
                                                    <option value='36' >36</option>
                                                    <option value='37' >37</option>
                                                    <option value='38' >38</option>
                                                    <option value='39' >39</option>
                                                    <option value='40' >40</option>
                                                    <option value='41' selected>41</option>
                                                    <option value='42'>42</option>
                                                    <option value='43'>43</option>
                                                    <option value='44'>44</option>
                                                    <option value='45'>45</option>
                                                    <option value='46'>46</option>
                                                    <option value='47'>47</option>
                                                ";
                                            }
                                            elseif ($tamanho == '42'){
                                                echo "
                                                    <option style='display:none'>Escolher</option>
                                                    <option value='35' >35</option>
                                                    <option value='36' >36</option>
                                                    <option value='37' >37</option>
                                                    <option value='38' >38</option>
                                                    <option value='39' >39</option>
                                                    <option value='40' >40</option>
                                                    <option value='41' >41</option>
                                                    <option value='42' selected>42</option>
                                                    <option value='43'>43</option>
                                                    <option value='44'>44</option>
                                                    <option value='45'>45</option>
                                                    <option value='46'>46</option>
                                                    <option value='47'>47</option>
                                                ";
                                            }
                                            elseif ($tamanho == '43'){
                                                echo "
                                                    <option style='display:none'>Escolher</option>
                                                    <option value='35' >35</option>
                                                    <option value='36' >36</option>
                                                    <option value='37' >37</option>
                                                    <option value='38' >38</option>
                                                    <option value='39' >39</option>
                                                    <option value='40' >40</option>
                                                    <option value='41' >41</option>
                                                    <option value='42' >42</option>
                                                    <option value='43' selected>43</option>
                                                    <option value='44'>44</option>
                                                    <option value='45'>45</option>
                                                    <option value='46'>46</option>
                                                    <option value='47'>47</option>
                                                ";
                                            }
                                            elseif ($tamanho == '44'){
                                                echo "
                                                    <option style='display:none'>Escolher</option>
                                                    <option value='35' >35</option>
                                                    <option value='36' >36</option>
                                                    <option value='37' >37</option>
                                                    <option value='38' >38</option>
                                                    <option value='39' >39</option>
                                                    <option value='40' >40</option>
                                                    <option value='41' >41</option>
                                                    <option value='42' >42</option>
                                                    <option value='43' >43</option>
                                                    <option value='44' selected>44</option>
                                                    <option value='45'>45</option>
                                                    <option value='46'>46</option>
                                                    <option value='47'>47</option>
                                                ";
                                            }
                                            elseif ($tamanho == '45'){
                                                echo "
                                                    <option style='display:none'>Escolher</option>
                                                    <option value='35' >35</option>
                                                    <option value='36' >36</option>
                                                    <option value='37' >37</option>
                                                    <option value='38' >38</option>
                                                    <option value='39' >39</option>
                                                    <option value='40' >40</option>
                                                    <option value='41' >41</option>
                                                    <option value='42' >42</option>
                                                    <option value='43' >43</option>
                                                    <option value='44' >44</option>
                                                    <option value='45' selected>45</option>
                                                    <option value='46'>46</option>
                                                    <option value='47'>47</option>
                                                ";
                                            }
                                            elseif ($tamanho == '46'){
                                                echo "
                                                    <option style='display:none'>Escolher</option>
                                                    <option value='35' >35</option>
                                                    <option value='36' >36</option>
                                                    <option value='37' >37</option>
                                                    <option value='38' >38</option>
                                                    <option value='39' >39</option>
                                                    <option value='40' >40</option>
                                                    <option value='41' >41</option>
                                                    <option value='42' >42</option>
                                                    <option value='43' >43</option>
                                                    <option value='44' >44</option>
                                                    <option value='45' >45</option>
                                                    <option value='46' selected>46</option>
                                                    <option value='47'>47</option>
                                                ";
                                            }
                                            else{
                                                echo "
                                                    <option style='display:none'>Escolher</option>
                                                    <option value='35' >35</option>
                                                    <option value='36' >36</option>
                                                    <option value='37' >37</option>
                                                    <option value='38' >38</option>
                                                    <option value='39' >39</option>
                                                    <option value='40' >40</option>
                                                    <option value='41' >41</option>
                                                    <option value='42' >42</option>
                                                    <option value='43' >43</option>
                                                    <option value='44' >44</option>
                                                    <option value='45' >45</option>
                                                    <option value='46' >46</option>
                                                    <option value='47' selected>47</option>
                                                ";
                                            }

                                        }
                                        else {
                                            echo "<option selected value='Tamanho Unico'>Tamanho Único</option>";
                                        }

                                    ?>

                                    </select>
                                </div>
                                <div class="form-group" style="width: 90%;margin-left: 5%;">
                                    <label for="exampleInputEmail1">Preço</label>
                                    <?php echo "<input type='number' name='preco' placeholder='$preco' value='$preco' class='form-control' id='floatNumberField' step='0.01' required>"; ?>
                                </div>
                                <div class="form-row" style="width: 92%; margin-left: 4%;">
                                    <div class="form-group col-md-6">
                                        <label for="inputCity">Distrito</label>
                                        <select class="form-control" name="district" id="districtSelect" required>
											<option selected disabled>Escolher um distrito...</option>
											<option value="Açores">Açores</option>
											<option value="Aveiro">Aveiro</option>
											<option value="Beja">Beja</option>
											<option value="Braga">Braga</option>
											<option value="Braganca">Bragança</option>
											<option value="Castelo Branco">Castelo Branco</option>
											<option value="Coimbra">Coimbra</option>
											<option value="Évora">Évora</option>
											<option value="Faro">Faro</option>
											<option value="Guarda">Guarda</option>
											<option value="Leiria">Leiria</option>
											<option value="Lisboa">Lisboa</option>
											<option value="Madeira">Madeira</option>
											<option value="Portalegre">Portalegre</option>
											<option value="Porto">Porto</option>
											<option value="Santarém">Santarem</option>
											<option value="Setúbal">Setúbal</option>
											<option value="Viana do Castelo">Viana do Castelo</option>
											<option value="Vila Real">Vila Real</option>
											<option value="Viseu">Viseu</option>
										</select>
                                    </div>
                                    <div class="form-group col-md-6">
                                    <label id="labelCons">Concelho:</label>
										<select class="form-control" name="concelho" id="conselhoSelect" required>

										</select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id='imgDir'>
                            <div id='divInfoProduc'>
                                <div id='divInfoProducImg'>
                                <?php

                                    echo "<img src='productsImage/$id.jpg'>"
                                ?>
                                </div>
                                <div id='divInfoProducRef'>
                                <?php
                                    echo "<p style='text-align: center;font-size: 23px;font-weight: 800;padding-top: 8px;'>$id</p>"
                                ?>
                                </div>

                            </div>
                            <div id='divProducSubmit'>
                                <div id="theSubmit">
                                    <?php
                                        echo "<button  type='submit' class='btn' name='editar' value='$id' style='width: 30%;margin-top: 3%;float: right;margin-right: 10%;'>Editar</button>";
                                    ?>
                                </div>
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
    <script type="text/javascript" src="js/concelhos.js"></script>
	<script>
        $(document).ready(function(){

            $('#opt').click(function() {
                $('#opt').addClass("actact");
                $('#opt1').removeClass("actact");
                $("#myProductsSale").css('display','block');
                $("#mySales").css('display','none');
            });

            $('#opt1').click(function() {
                $('#opt1').addClass("actact");
                $('#opt').removeClass("actact");
                $("#mySales").css('display','block');
                $("#myProductsSale").css('display','none');
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
    <script type="text/javascript">
    $(document).ready(function () {
        $("#floatNumberField").change(function() {
            $(this).val(parseFloat($(this).val()).toFixed(2));
        });
    });
</script>
	</body>
</html>
