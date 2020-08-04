<?php
  session_start();
  include "accessBD.php";
  require "../phpScripts/fpdf.php";
  $name = $_SESSION['username'];


  if (isset($_POST["addWishD"])) {
    $value = $_POST["addWishD"];
    $array = (explode(",",$value));
    $prod = $array[0];
    $idWish = $array[1];

    $prodWishQuery = "select * FROM products_wishlist where idWishlist ='$idWish' and idProduct='$prod'";
	$checkProdWish = mysqli_query($conn, $prodWishQuery);

    if(!$checkProdWish)
	    die("Error, select query failed:" . $prodWishQuery);

    if(mysqli_num_rows($checkProdWish)>0) {
        $_SESSION['messageReceived'] = "Esse produto já se encontra nessa wishlist";
    }
    else{
        $addWishQuery = " insert into products_wishlist VALUES ('$idWish', '$prod')";

        $checkAddWish = mysqli_multi_query($conn, $addWishQuery);

        if(!$checkAddWish)
            die("Error, insert query failed:" . $addWishQuery);
    }

    $brandQuery = "select brand from productsd where id='$prod'";
    $getBrand = mysqli_multi_query($conn, $brandQuery);

    if(!$getBrand)
            die("Error, insert query failed:" . $brandQuery);

    $row = mysqli_fetch_array($getBrand);
    $brand = $row[0];

    header("Location: ../wishlist.php");

  }

  // Cesto
  if (isset($_POST['a'])){
    $idBrand = $_POST['a'];
    $idProduct = $_POST['b'];
    $tam = $_POST['c'];

    $pecaQuery = "select * from cestodesigners where idUsername='$name' and idStore='$idBrand' and tamanho='$tam'";

    $checkPeca = mysqli_query($conn, $pecaQuery);

    if(mysqli_num_rows($checkPeca)>0) {
        $addCestoQuery = " update cestodesigners set quant = quant + 1 where idUsername='$name' and idStore='$idBrand' and tamanho='$tam' ";

        $checkAddCesto = mysqli_query($conn, $addCestoQuery);

        if(!$checkAddCesto)
            die("Error, insert query failed:" . $addCestoQuery);
    }
    else{
      $addCestoQuery = "insert into cestodesigners VALUES ('$name','$idProduct','$idBrand','$tam',1)";

      $checkAddCesto = mysqli_query($conn, $addCestoQuery);

      if(!$checkAddCesto)
        die("Error, insert query failed:" . $addCestoQuery);
    }

    //header("Location: ../product2mao.php?refProduct=$idPro");
  }

  if (isset($_POST['deleteCesto'])) {
    $aa = $_POST['deleteCesto'];

    $array = explode(",", $aa);
    $idaaaa = $array[0];
    $tamaaaa = $array[1];

    $oprodCestoQuery = "select * from cestodesigners where idUsername='$name' and idProduct='$idaaaa' and tamanho='$tamaaaa'";
    $getOprodCesto = mysqli_query($conn, $oprodCestoQuery);

    if(!$getOprodCesto)
      die("Error, insert query failed:" . $oprodCestoQuery);

    $rowQua = mysqli_fetch_array($getOprodCesto);
    $t = $rowQua[4];
    if($t > 1) {
      $updateCestoQuery = "update cestodesigners set quant = quant - 1 where idUsername='$name' and idProduct='$idaaaa' and tamanho='$tamaaaa'";
      $checkupdateProducts = mysqli_query($conn, $updateCestoQuery);

      if(!$checkupdateProducts)
        die("Error, insert query failed:" . $updateCestoQuery);
    }
    else{
      $deleteCestoQuery = "delete from cestodesigners where idUsername='$name' and idProduct='$idaaaa' and tamanho='$tamaaaa'";
      $checkdeleteProducts = mysqli_query($conn, $deleteCestoQuery);

      if(!$checkdeleteProducts)
        die("Error, insert query failed:" . $deleteCestoQuery);
    }

    header("Location: ../storeDesigners.php");
  }






  if(isset($_POST['iniProcesso'])){
    $existQuery = "select * from pedidosdesigners where idUsername = '$name' and estado_pedido='em_aberto'";
    $checkExist = mysqli_query($conn, $existQuery);
    if(mysqli_num_rows($checkExist)>0) {
      $deleteExistQuery = "delete from pedidosdesigners where idUsername = '$name'";
      $checkDeleteExist = mysqli_multi_query($conn, $deleteExistQuery);
    }
    $iniciarQuery = "insert into pedidosdesigners VALUES(NULL,'$name','em_aberto','-')";

    if ($conn -> query($iniciarQuery) === TRUE){
      $id = $conn->insert_id;
      header("Location: ../processoCompra1.php?pedido=$id");
    }
  }

  if(isset($_POST["contPag"])){
    $idPedido = $_POST["contPag"];
    $morada = $_POST["morada"];
    $zip = $_POST["codigoPostal"];
    $local = $_POST["local"];
    $addressQuery = "insert into dados_enviodesigners VALUES ('$idPedido','$morada','$zip','$local')";
    $checkAddress = mysqli_query($conn, $addressQuery);

    header("Location: ../processoPagamento1.php?pedido=$idPedido");

  }




  // Compra com cartoes
  if(isset($_POST["confirmarCompraCartoes"])){

    $idPedido = $_POST["confirmarCompraCartoes"];
    $metodo = $_POST['metodo'];
    $cardNumber = $_POST['numeroCartao'];
    $titular = $_POST["titular"];
    $month = $_POST["expirationMonth"];
    $year = $_POST["expirationYear"];
    $cvc = $_POST["cvc"];
    $hashed_cvc = sha1($cvc);
    $totalPrice = $_POST["precoTotal"];

    $addPaymentQuery = "insert into pagamentodesigners values ($idPedido,'$metodo','$cardNumber','$titular','$month','$year','$hashed_cvc','','','$totalPrice')";
    $checkPayment = mysqli_query($conn, $addPaymentQuery);

    if(!$checkPayment)
        die("Error, insert query failed:" . $addPaymentQuery);

    $productsCesto = "select * from cestodesigners where idUsername='$name'";
    $getProducts = mysqli_query($conn, $productsCesto);

    if(!$getProducts)
      die("Error, insert query failed:" . $productsCesto);

    while  ($row = mysqli_fetch_array($getProducts)) {

      $idProd = $row[1];
      $brand = $row[2];
      $tam = $row[3];
      $quant = $row[4];

      for ($i = 0; $i < $quant; $i++) {
        $addRemoveProductQuery = "insert into products_pedidodesigners values ('$idPedido','$idProd','$brand','$tam', 'a_processar')";

        $checkPayment = mysqli_query($conn, $addRemoveProductQuery);

        if(!$checkPayment)
          die("Error, insert query failed:" . $addRemoveProductQuery);
      }
    }

    $productsCesto = "select * from cestodesigners where idUsername='$name'";
    $getProducts = mysqli_query($conn, $productsCesto);

    if(!$getProducts)
      die("Error, insert query failed:" . $productsCesto);

    date_default_timezone_set('Europe/Lisbon');
    $dateA = date('m/d/Y h:i:s a', time());
    while  ($row = mysqli_fetch_array($getProducts)) {
      $idProd = $row[1];
      $brand = $row[2];
      $tam = $row[3];
      $quant = $row[4];

      for ($i = 0; $i < $quant; $i++) {
        $addRemoveProductQuery = "insert into storage values ('$name','$idProd','$dateA')";

        $checkPayment = mysqli_query($conn, $addRemoveProductQuery);

        if(!$checkPayment)
          die("Error, insert query failed:" . $addRemoveProductQuery);
      }
    }

    $productsCesto = "select * from cestodesigners where idUsername='$name'";
    $getProducts = mysqli_query($conn, $productsCesto);

    if(!$getProducts)
      die("Error, insert query failed:" . $productsCesto);

    while  ($row = mysqli_fetch_array($getProducts)) {
      $idProd = $row[1];
      $brand = $row[2];
      $tam = $row[3];
      $quant = $row[4];

      for ($i = 0; $i < $quant; $i++) {
        $updateProductQuery = "update stocksstores set quantidade = quantidade - 1 where idProduct='$idProd' and tamanho='$tam'";

        $checkPayment = mysqli_query($conn, $updateProductQuery);

        if(!$checkPayment)
          die("Error, insert query failed:" . $updateProductQuery);
      }
    }


    date_default_timezone_set('Europe/Lisbon');
    $dateA = date('m/d/Y h:i:s a', time());
    $updateEstadoQuery = "update pedidosdesigners set estado_pedido='fechado', data='$dateA' where idPedido='$idPedido'";
    $checkUpdate = mysqli_query($conn, $updateEstadoQuery);

    if(!$checkUpdate)
      die("Error, insert query failed:" . $updateEstadoQuery);

    $productsCesto = "select * from cestodesigners where idUsername='$name'";
    $getProducts = mysqli_query($conn, $productsCesto);

    if(!$getProducts)
      die("Error, insert query failed:" . $productsCesto);

    while  ($row = mysqli_fetch_array($getProducts)) {
      $idPersonBuy = $row[0];
      $idProd = $row[1];
      $personSell = $row[2];
      $tama = $row[3];
      $quann = $row[4];

      $dadosEnvioQuery ="select * from dados_enviodesigners where idPedido='$idPedido'";
      $getDados = mysqli_query($conn, $dadosEnvioQuery);

      $row = mysqli_fetch_array($getDados);
      $morada = $row[1];
      $codigoP = $row[2];
      $local = $row[3];

      $infoPedQuery ="select category, preco from productsd where id='$idProd'";
      $getInfoPed = mysqli_query($conn, $infoPedQuery);

      $rowI = mysqli_fetch_array($getInfoPed);
      $cat = $rowI[0];
      $prec = $rowI[1];

      $pdf = new FPDF();

      $pdf -> AddPage();

      $pdf -> SetFont('Arial','B',11);
      $pdf -> Image('../img/logo.png',10,10,-300);
      $pdf -> SetFont('Arial','',6);
      $pdf -> Ln(60);
      $pdf->Cell(100,5,"Overlab,Lda",0,1,'L');
      $pdf->Cell(100,5,"NIF:258525290/Cap.Social:249.398,95 €",0,1,'L');
      $pdf->Cell(100,5,"Rua do Quelhas 6, 1200-781 Lisboa",0,1,'L');
      $pdf -> SetFont('Arial','B',30);
      $pdf -> Ln(10);
      $pdf->Cell(100,10,"Fatura #$idPedido",0,1,'L');
      $pdf -> Ln(5);
      $pdf -> SetFont('Arial','',10);
      $pdf-> Cell(80,10,"Consumidor: $idPersonBuy ;",0,0,'L');
      $pdf-> Cell(100,10,"Morada: $morada, $codigoP, $local",0,1,'L');
      $pdf-> Cell(80,10,"Data: $dateA ;",0,0,'L');
      $pdf-> Cell(100,10,"Metodo de pagamento: $metodo ;",0,1,'L');
      $pdf -> Ln(30);
      $pdf -> SetFont('Arial','B',12);
      $pdf -> Cell(38,10,'Referência',1,0,'C');
      $pdf -> Cell(38,10,'Descrição',1,0,'C');
      $pdf -> Cell(38,10,'Tamanho',1,0,'C');
      $pdf -> Cell(38,10,'Quantidade',1,0,'C');
      $pdf -> Cell(38,10,'Preço',1,1,'C');
      $pdf -> SetFont('Arial','',12);
      $pdf -> Cell(38,10,"$idProd",1,0,'C');
      $pdf -> Cell(38,10,"$cat",1,0,'C');
      $pdf -> Cell(38,10,"$tama",1,0,'C');
      $pdf -> Cell(38,10,"$quann",1,0,'C');
      $pdf -> Cell(38,10,"$prec €",1,1,'C');
      $pdf -> Ln(10);
      $pdf->Cell(190,10,"Total: $prec €;",1,1,'L');

      $filename="../pdfPedidosVendasDesigners/pedido".$idPedido."_".$personSell ."_".$idProd .".pdf";
      $pdf -> Output($filename,'F');

    }



    $dadosEnvioQuery ="select * from dados_enviodesigners where idPedido='$idPedido'";
    $getDados = mysqli_query($conn, $dadosEnvioQuery);


    $row = mysqli_fetch_array($getDados);
    $morada = $row[1];
    $codigoP = $row[2];
    $local = $row[3];

    $pdf = new FPDF();

    $pdf -> AddPage();

    $pdf -> SetFont('Arial','B',11);
    $pdf -> Image('../img/logo.png',10,10,-300);
    $pdf -> SetFont('Arial','',6);
    $pdf -> Ln(60);
    $pdf->Cell(100,5,"Overlab,Lda",0,1,'L');
    $pdf->Cell(100,5,"NIF:258525290/Cap.Social:249.398,95 €",0,1,'L');
    $pdf->Cell(100,5,"Rua do Quelhas 6, 1200-781 Lisboa",0,1,'L');
    $pdf -> SetFont('Arial','B',30);
    $pdf -> Ln(10);
    $pdf->Cell(100,10,"Fatura #$idPedido",0,1,'L');
    $pdf -> Ln(5);
    $pdf -> SetFont('Arial','',10);
    $pdf-> Cell(80,10,"Consumidor: $idPersonBuy ;",0,0,'L');
    $pdf-> Cell(100,10,"Morada: $morada, $codigoP, $local",0,1,'L');
    $pdf-> Cell(80,10,"Data: $dateA ;",0,0,'L');
    $pdf-> Cell(100,10,"Metodo de pagamento: $metodo ;",0,1,'L');
    $pdf -> Ln(30);
    $pdf -> SetFont('Arial','B',12);
    $pdf -> Cell(31,10,'Referência',1,0,'C');
    $pdf -> Cell(31,10,'Descrição',1,0,'C');
    $pdf -> Cell(31,10,'Marca',1,0,'C');
    $pdf -> Cell(31,10,'Tamanho',1,0,'C');
    $pdf -> Cell(31,10,'Quantidade',1,0,'C');
    $pdf -> Cell(31,10,'Preço',1,1,'C');
    $pdf -> SetFont('Arial','',12);

    $productsssQuery = "select c.idProduct, c.idStore, c.tamanho, c.quant, p.category, p.preco from cestodesigners c, productsd p where c.idProduct = p.id and c.idUsername='$name'";
    $getProductsss = mysqli_query($conn, $productsssQuery);
    $sumAAA = 0;
    while ($rowPPP = mysqli_fetch_array($getProductsss)) {
      $iddd = $rowPPP[0];
      $idddSto = $rowPPP[1];
      $tammm = $rowPPP[2];
      $quannn = $rowPPP[3];
      $cattt = $rowPPP[4];
      $preee = $rowPPP[5];

      $pdf -> Cell(31,10,"$iddd",1,0,'C');
      $pdf -> Cell(31,10,"$cattt",1,0,'C');
      $pdf -> Cell(31,10,"$idddSto",1,0,'C');
      $pdf -> Cell(31,10,"$tammm",1,0,'C');
      $pdf -> Cell(31,10,"$quannn",1,0,'C');
      $pdf -> Cell(31,10,"$preee €",1,1,'C');

      $sumAAA = $sumAAA + $preee;
    }
    $taxa = floatval($sumAAA) * 0.1;
    $sumAAA = floatval($sumAAA) + floatval($taxa);

    $pdf -> Ln(10);
    $pdf->Cell(190,10,"Total: $sumAAA €;",1,1,'L');

    $filename="../pdfPedidosCompras/pedido".$idPedido."_designers.pdf";
    $pdf -> Output($filename,'F');


    $deleteCestoQuery = "delete from cestodesigners where idUsername='$name'";
    $checkdeleteProducts = mysqli_query($conn, $deleteCestoQuery);

    if(!$checkdeleteProducts)
      die("Error, insert query failed:" . $deleteCestoQuery);



    header("Location: ../processoConfirm1.php?pedido=$idPedido");
      }










  // Compra com MB
  if(isset($_POST["confirmarCompraMB"])){

    $idPedido = $_POST["confirmarCompraMB"];
    $metodo = $_POST['metodo'];
    $entidade = $_POST["entidade"];
    $referencia = $_POST["referencia"];
    $totalPrice = $_POST["precoTotal"];

    $addPaymentQuery = "insert into pagamentodesigners values ($idPedido,'$metodo','','','','','','$entidade','$referencia','$totalPrice')";
    $checkPayment = mysqli_query($conn, $addPaymentQuery);

    if(!$checkPayment)
      die("Error, insert query failed:" . $addPaymentQuery);

      $productsCesto = "select * from cestodesigners where idUsername='$name'";
      $getProducts = mysqli_query($conn, $productsCesto);

      if(!$getProducts)
        die("Error, insert query failed:" . $productsCesto);

      while  ($row = mysqli_fetch_array($getProducts)) {

        $idProd = $row[1];
        $brand = $row[2];
        $tam = $row[3];
        $quant = $row[4];

        for ($i = 0; $i < $quant; $i++) {
          $addRemoveProductQuery = "insert into products_pedidodesigners values ('$idPedido','$idProd','$brand','$tam', 'a_processar')";

          $checkPayment = mysqli_query($conn, $addRemoveProductQuery);

          if(!$checkPayment)
            die("Error, insert query failed:" . $addRemoveProductQuery);
        }
      }

      $productsCesto = "select * from cestodesigners where idUsername='$name'";
      $getProducts = mysqli_query($conn, $productsCesto);

      if(!$getProducts)
        die("Error, insert query failed:" . $productsCesto);

      date_default_timezone_set('Europe/Lisbon');
      $dateA = date('m/d/Y h:i:s a', time());
      while  ($row = mysqli_fetch_array($getProducts)) {
        $idProd = $row[1];
        $brand = $row[2];
        $tam = $row[3];
        $quant = $row[4];

        for ($i = 0; $i < $quant; $i++) {
          $addRemoveProductQuery = "insert into storage values ('$name','$idProd','$dateA')";

          $checkPayment = mysqli_query($conn, $addRemoveProductQuery);

          if(!$checkPayment)
            die("Error, insert query failed:" . $addRemoveProductQuery);
        }
      }

      $productsCesto = "select * from cestodesigners where idUsername='$name'";
      $getProducts = mysqli_query($conn, $productsCesto);

      if(!$getProducts)
        die("Error, insert query failed:" . $productsCesto);

      while  ($row = mysqli_fetch_array($getProducts)) {
        $idProd = $row[1];
        $brand = $row[2];
        $tam = $row[3];
        $quant = $row[4];

        for ($i = 0; $i < $quant; $i++) {
          $updateProductQuery = "update stocksstores set quantidade = quantidade - 1 where idProduct='$idProd' and tamanho='$tam'";

          $checkPayment = mysqli_query($conn, $updateProductQuery);

          if(!$checkPayment)
            die("Error, insert query failed:" . $updateProductQuery);
        }
      }


      date_default_timezone_set('Europe/Lisbon');
      $dateA = date('m/d/Y h:i:s a', time());
      $updateEstadoQuery = "update pedidosdesigners set estado_pedido='fechado', data='$dateA' where idPedido='$idPedido'";
      $checkUpdate = mysqli_query($conn, $updateEstadoQuery);

      if(!$checkUpdate)
        die("Error, insert query failed:" . $updateEstadoQuery);

      $productsCesto = "select * from cestodesigners where idUsername='$name'";
      $getProducts = mysqli_query($conn, $productsCesto);

      if(!$getProducts)
        die("Error, insert query failed:" . $productsCesto);

      while  ($row = mysqli_fetch_array($getProducts)) {
        $idPersonBuy = $row[0];
        $idProd = $row[1];
        $personSell = $row[2];
        $tama = $row[3];
        $quann = $row[4];

        $dadosEnvioQuery ="select * from dados_enviodesigners where idPedido='$idPedido'";
        $getDados = mysqli_query($conn, $dadosEnvioQuery);

        $row = mysqli_fetch_array($getDados);
        $morada = $row[1];
        $codigoP = $row[2];
        $local = $row[3];

        $infoPedQuery ="select category, preco from productsd where id='$idProd'";
        $getInfoPed = mysqli_query($conn, $infoPedQuery);

        $rowI = mysqli_fetch_array($getInfoPed);
        $cat = $rowI[0];
        $prec = $rowI[1];

        $pdf = new FPDF();

        $pdf -> AddPage();

        $pdf -> SetFont('Arial','B',11);
        $pdf -> Image('../img/logo.png',10,10,-300);
        $pdf -> SetFont('Arial','',6);
        $pdf -> Ln(60);
        $pdf->Cell(100,5,"Overlab,Lda",0,1,'L');
        $pdf->Cell(100,5,"NIF:258525290/Cap.Social:249.398,95 €",0,1,'L');
        $pdf->Cell(100,5,"Rua do Quelhas 6, 1200-781 Lisboa",0,1,'L');
        $pdf -> SetFont('Arial','B',30);
        $pdf -> Ln(10);
        $pdf->Cell(100,10,"Fatura #$idPedido",0,1,'L');
        $pdf -> Ln(5);
        $pdf -> SetFont('Arial','',10);
        $pdf-> Cell(80,10,"Consumidor: $idPersonBuy ;",0,0,'L');
        $pdf-> Cell(100,10,"Morada: $morada, $codigoP, $local",0,1,'L');
        $pdf-> Cell(80,10,"Data: $dateA ;",0,0,'L');
        $pdf-> Cell(100,10,"Metodo de pagamento: $metodo ;",0,1,'L');
        $pdf -> Ln(30);
        $pdf -> SetFont('Arial','B',12);
        $pdf -> Cell(38,10,'Referência',1,0,'C');
        $pdf -> Cell(38,10,'Descrição',1,0,'C');
        $pdf -> Cell(38,10,'Tamanho',1,0,'C');
        $pdf -> Cell(38,10,'Quantidade',1,0,'C');
        $pdf -> Cell(38,10,'Preço',1,1,'C');
        $pdf -> SetFont('Arial','',12);
        $pdf -> Cell(38,10,"$idProd",1,0,'C');
        $pdf -> Cell(38,10,"$cat",1,0,'C');
        $pdf -> Cell(38,10,"$tama",1,0,'C');
        $pdf -> Cell(38,10,"$quann",1,0,'C');
        $pdf -> Cell(38,10,"$prec €",1,1,'C');
        $pdf -> Ln(10);
        $pdf->Cell(190,10,"Total: $prec €;",1,1,'L');

        $filename="../pdfPedidosVendasDesigners/pedido".$idPedido."_".$personSell ."_".$idProd .".pdf";
        $pdf -> Output($filename,'F');

      }



      $dadosEnvioQuery ="select * from dados_enviodesigners where idPedido='$idPedido'";
      $getDados = mysqli_query($conn, $dadosEnvioQuery);


      $row = mysqli_fetch_array($getDados);
      $morada = $row[1];
      $codigoP = $row[2];
      $local = $row[3];

      $pdf = new FPDF();

      $pdf -> AddPage();

      $pdf -> SetFont('Arial','B',11);
      $pdf -> Image('../img/logo.png',10,10,-300);
      $pdf -> SetFont('Arial','',6);
      $pdf -> Ln(60);
      $pdf->Cell(100,5,"Overlab,Lda",0,1,'L');
      $pdf->Cell(100,5,"NIF:258525290/Cap.Social:249.398,95 €",0,1,'L');
      $pdf->Cell(100,5,"Rua do Quelhas 6, 1200-781 Lisboa",0,1,'L');
      $pdf -> SetFont('Arial','B',30);
      $pdf -> Ln(10);
      $pdf->Cell(100,10,"Fatura #$idPedido",0,1,'L');
      $pdf -> Ln(5);
      $pdf -> SetFont('Arial','',10);
      $pdf-> Cell(80,10,"Consumidor: $idPersonBuy ;",0,0,'L');
      $pdf-> Cell(100,10,"Morada: $morada, $codigoP, $local",0,1,'L');
      $pdf-> Cell(80,10,"Data: $dateA ;",0,0,'L');
      $pdf-> Cell(100,10,"Metodo de pagamento: $metodo ;",0,1,'L');
      $pdf -> Ln(30);
      $pdf -> SetFont('Arial','B',12);
      $pdf -> Cell(31,10,'Referência',1,0,'C');
      $pdf -> Cell(31,10,'Descrição',1,0,'C');
      $pdf -> Cell(31,10,'Marca',1,0,'C');
      $pdf -> Cell(31,10,'Tamanho',1,0,'C');
      $pdf -> Cell(31,10,'Quantidade',1,0,'C');
      $pdf -> Cell(31,10,'Preço',1,1,'C');
      $pdf -> SetFont('Arial','',12);

      $productsssQuery = "select c.idProduct, c.idStore, c.tamanho, c.quant, p.category, p.preco from cestodesigners c, productsd p where c.idProduct = p.id and c.idUsername='$name'";
      $getProductsss = mysqli_query($conn, $productsssQuery);
      $sumAAA = 0;
      while ($rowPPP = mysqli_fetch_array($getProductsss)) {
        $iddd = $rowPPP[0];
        $idddSto = $rowPPP[1];
        $tammm = $rowPPP[2];
        $quannn = $rowPPP[3];
        $cattt = $rowPPP[4];
        $preee = $rowPPP[5];

        $pdf -> Cell(31,10,"$iddd",1,0,'C');
        $pdf -> Cell(31,10,"$cattt",1,0,'C');
        $pdf -> Cell(31,10,"$idddSto",1,0,'C');
        $pdf -> Cell(31,10,"$tammm",1,0,'C');
        $pdf -> Cell(31,10,"$quannn",1,0,'C');
        $pdf -> Cell(31,10,"$preee €",1,1,'C');

        $sumAAA = $sumAAA + $preee;
      }
      $taxa = floatval($sumAAA) * 0.1;
      $sumAAA = floatval($sumAAA) + floatval($taxa);

      $pdf -> Ln(10);
      $pdf->Cell(190,10,"Total: $sumAAA €;",1,1,'L');

      $filename="../pdfPedidosCompras/pedido".$idPedido."_designers.pdf";
      $pdf -> Output($filename,'F');


      $deleteCestoQuery = "delete from cestodesigners where idUsername='$name'";
      $checkdeleteProducts = mysqli_query($conn, $deleteCestoQuery);

      if(!$checkdeleteProducts)
        die("Error, insert query failed:" . $deleteCestoQuery);



      header("Location: ../processoConfirm1.php?pedido=$idPedido");
  }






  // Compra com Paypal
  if(isset($_POST["confirmarCompraPaypal"])){

    $idPedido = $_POST["confirmarCompraPaypal"];
    $metodo = $_POST['metodo'];
    $totalPrice = $_POST["precoTotal"];

    $addPaymentQuery = "insert into pagamentodesigners values ($idPedido,'$metodo','','','','','','','','$totalPrice')";
    $checkPayment = mysqli_query($conn, $addPaymentQuery);

    if(!$checkPayment)
      die("Error, insert query failed:" . $addPaymentQuery);

    $productsCesto = "select * from cestodesigners where idUsername='$name'";
    $getProducts = mysqli_query($conn, $productsCesto);

    if(!$getProducts)
      die("Error, insert query failed:" . $productsCesto);

    while  ($row = mysqli_fetch_array($getProducts)) {

      $idProd = $row[1];
      $brand = $row[2];
      $tam = $row[3];
      $quant = $row[4];

      for ($i = 0; $i < $quant; $i++) {
        $addRemoveProductQuery = "insert into products_pedidodesigners values ('$idPedido','$idProd','$brand','$tam', 'a_processar')";

        $checkPayment = mysqli_query($conn, $addRemoveProductQuery);

        if(!$checkPayment)
          die("Error, insert query failed:" . $addRemoveProductQuery);
      }
    }

    $productsCesto = "select * from cestodesigners where idUsername='$name'";
    $getProducts = mysqli_query($conn, $productsCesto);

    if(!$getProducts)
      die("Error, insert query failed:" . $productsCesto);

    date_default_timezone_set('Europe/Lisbon');
    $dateA = date('m/d/Y h:i:s a', time());
    while  ($row = mysqli_fetch_array($getProducts)) {
      $idProd = $row[1];
      $brand = $row[2];
      $tam = $row[3];
      $quant = $row[4];

      for ($i = 0; $i < $quant; $i++) {
        $addRemoveProductQuery = "insert into storage values ('$name','$idProd','$dateA')";

        $checkPayment = mysqli_query($conn, $addRemoveProductQuery);

        if(!$checkPayment)
          die("Error, insert query failed:" . $addRemoveProductQuery);
      }
    }

    $productsCesto = "select * from cestodesigners where idUsername='$name'";
    $getProducts = mysqli_query($conn, $productsCesto);

    if(!$getProducts)
      die("Error, insert query failed:" . $productsCesto);

    while  ($row = mysqli_fetch_array($getProducts)) {
      $idProd = $row[1];
      $brand = $row[2];
      $tam = $row[3];
      $quant = $row[4];

      for ($i = 0; $i < $quant; $i++) {
        $updateProductQuery = "update stocksstores set quantidade = quantidade - 1 where idProduct='$idProd' and tamanho='$tam'";

        $checkPayment = mysqli_query($conn, $updateProductQuery);

        if(!$checkPayment)
          die("Error, insert query failed:" . $updateProductQuery);
      }
    }


    date_default_timezone_set('Europe/Lisbon');
    $dateA = date('m/d/Y h:i:s a', time());
    $updateEstadoQuery = "update pedidosdesigners set estado_pedido='fechado', data='$dateA' where idPedido='$idPedido'";
    $checkUpdate = mysqli_query($conn, $updateEstadoQuery);

    if(!$checkUpdate)
      die("Error, insert query failed:" . $updateEstadoQuery);

    $productsCesto = "select * from cestodesigners where idUsername='$name'";
    $getProducts = mysqli_query($conn, $productsCesto);

    if(!$getProducts)
      die("Error, insert query failed:" . $productsCesto);

    while  ($row = mysqli_fetch_array($getProducts)) {
      $idPersonBuy = $row[0];
      $idProd = $row[1];
      $personSell = $row[2];
      $tama = $row[3];
      $quann = $row[4];

      $dadosEnvioQuery ="select * from dados_enviodesigners where idPedido='$idPedido'";
      $getDados = mysqli_query($conn, $dadosEnvioQuery);

      $row = mysqli_fetch_array($getDados);
      $morada = $row[1];
      $codigoP = $row[2];
      $local = $row[3];

      $infoPedQuery ="select category, preco from productsd where id='$idProd'";
      $getInfoPed = mysqli_query($conn, $infoPedQuery);

      $rowI = mysqli_fetch_array($getInfoPed);
      $cat = $rowI[0];
      $prec = $rowI[1];

      $pdf = new FPDF();

      $pdf -> AddPage();

      $pdf -> SetFont('Arial','B',11);
      $pdf -> Image('../img/logo.png',10,10,-300);
      $pdf -> SetFont('Arial','',6);
      $pdf -> Ln(60);
      $pdf->Cell(100,5,"Overlab,Lda",0,1,'L');
      $pdf->Cell(100,5,"NIF:258525290/Cap.Social:249.398,95 €",0,1,'L');
      $pdf->Cell(100,5,"Rua do Quelhas 6, 1200-781 Lisboa",0,1,'L');
      $pdf -> SetFont('Arial','B',30);
      $pdf -> Ln(10);
      $pdf->Cell(100,10,"Fatura #$idPedido",0,1,'L');
      $pdf -> Ln(5);
      $pdf -> SetFont('Arial','',10);
      $pdf-> Cell(80,10,"Consumidor: $idPersonBuy ;",0,0,'L');
      $pdf-> Cell(100,10,"Morada: $morada, $codigoP, $local",0,1,'L');
      $pdf-> Cell(80,10,"Data: $dateA ;",0,0,'L');
      $pdf-> Cell(100,10,"Metodo de pagamento: $metodo ;",0,1,'L');
      $pdf -> Ln(30);
      $pdf -> SetFont('Arial','B',12);
      $pdf -> Cell(38,10,'Referência',1,0,'C');
      $pdf -> Cell(38,10,'Descrição',1,0,'C');
      $pdf -> Cell(38,10,'Tamanho',1,0,'C');
      $pdf -> Cell(38,10,'Quantidade',1,0,'C');
      $pdf -> Cell(38,10,'Preço',1,1,'C');
      $pdf -> SetFont('Arial','',12);
      $pdf -> Cell(38,10,"$idProd",1,0,'C');
      $pdf -> Cell(38,10,"$cat",1,0,'C');
      $pdf -> Cell(38,10,"$tama",1,0,'C');
      $pdf -> Cell(38,10,"$quann",1,0,'C');
      $pdf -> Cell(38,10,"$prec €",1,1,'C');
      $pdf -> Ln(10);
      $pdf->Cell(190,10,"Total: $prec €;",1,1,'L');

      $filename="../pdfPedidosVendasDesigners/pedido".$idPedido."_".$personSell ."_".$idProd .".pdf";
      $pdf -> Output($filename,'F');

    }



    $dadosEnvioQuery ="select * from dados_enviodesigners where idPedido='$idPedido'";
    $getDados = mysqli_query($conn, $dadosEnvioQuery);


    $row = mysqli_fetch_array($getDados);
    $morada = $row[1];
    $codigoP = $row[2];
    $local = $row[3];

    $pdf = new FPDF();

    $pdf -> AddPage();

    $pdf -> SetFont('Arial','B',11);
    $pdf -> Image('../img/logo.png',10,10,-300);
    $pdf -> SetFont('Arial','',6);
    $pdf -> Ln(60);
    $pdf->Cell(100,5,"Overlab,Lda",0,1,'L');
    $pdf->Cell(100,5,"NIF:258525290/Cap.Social:249.398,95 €",0,1,'L');
    $pdf->Cell(100,5,"Rua do Quelhas 6, 1200-781 Lisboa",0,1,'L');
    $pdf -> SetFont('Arial','B',30);
    $pdf -> Ln(10);
    $pdf->Cell(100,10,"Fatura #$idPedido",0,1,'L');
    $pdf -> Ln(5);
    $pdf -> SetFont('Arial','',10);
    $pdf-> Cell(80,10,"Consumidor: $idPersonBuy ;",0,0,'L');
    $pdf-> Cell(100,10,"Morada: $morada, $codigoP, $local",0,1,'L');
    $pdf-> Cell(80,10,"Data: $dateA ;",0,0,'L');
    $pdf-> Cell(100,10,"Metodo de pagamento: $metodo ;",0,1,'L');
    $pdf -> Ln(30);
    $pdf -> SetFont('Arial','B',12);
    $pdf -> Cell(31,10,'Referência',1,0,'C');
    $pdf -> Cell(31,10,'Descrição',1,0,'C');
    $pdf -> Cell(31,10,'Marca',1,0,'C');
    $pdf -> Cell(31,10,'Tamanho',1,0,'C');
    $pdf -> Cell(31,10,'Quantidade',1,0,'C');
    $pdf -> Cell(31,10,'Preço',1,1,'C');
    $pdf -> SetFont('Arial','',12);

    $productsssQuery = "select c.idProduct, c.idStore, c.tamanho, c.quant, p.category, p.preco from cestodesigners c, productsd p where c.idProduct = p.id and c.idUsername='$name'";
    $getProductsss = mysqli_query($conn, $productsssQuery);
    $sumAAA = 0;
    while ($rowPPP = mysqli_fetch_array($getProductsss)) {
      $iddd = $rowPPP[0];
      $idddSto = $rowPPP[1];
      $tammm = $rowPPP[2];
      $quannn = $rowPPP[3];
      $cattt = $rowPPP[4];
      $preee = $rowPPP[5];

      $pdf -> Cell(31,10,"$iddd",1,0,'C');
      $pdf -> Cell(31,10,"$cattt",1,0,'C');
      $pdf -> Cell(31,10,"$idddSto",1,0,'C');
      $pdf -> Cell(31,10,"$tammm",1,0,'C');
      $pdf -> Cell(31,10,"$quannn",1,0,'C');
      $pdf -> Cell(31,10,"$preee €",1,1,'C');

      $sumAAA = $sumAAA + $preee;
    }
    $taxa = floatval($sumAAA) * 0.1;
    $sumAAA = floatval($sumAAA) + floatval($taxa);

    $pdf -> Ln(10);
    $pdf->Cell(190,10,"Total: $sumAAA €;",1,1,'L');

    $filename="../pdfPedidosCompras/pedido".$idPedido."_designers.pdf";
    $pdf -> Output($filename,'F');


    $deleteCestoQuery = "delete from cestodesigners where idUsername='$name'";
    $checkdeleteProducts = mysqli_query($conn, $deleteCestoQuery);

    if(!$checkdeleteProducts)
      die("Error, insert query failed:" . $deleteCestoQuery);



    header("Location: ../processoConfirm1.php?pedido=$idPedido");
  }







// Envio encomenda - UPDATE
if(isset($_POST["updateEnvio"])){
  $val = $_POST["updateEnvio"];
  $array = explode(",",$val);
  $idPedido = $array[0];
  $loja = $array[1];

  $updateEstadoQuery = "update products_pedidodesigners set estado_entrega='a_entregar' where idPedido='$idPedido' and idSell='$loja'";
  $checkUpdate = mysqli_query($conn, $updateEstadoQuery);

  if(!$checkUpdate)
    die("Error, insert query failed:" . $updateEstadoQuery);

  header("Location: ../store1.php");
}



?>
