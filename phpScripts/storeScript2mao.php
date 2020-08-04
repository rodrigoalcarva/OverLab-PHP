<?php
  session_start();
  include "accessBD.php";
  $conn = mysqli_connect("127.0.0.1","user4","whitenoise","grupo4");
  require "../phpScripts/fpdf.php";
  $name = $_SESSION['username'];

  // CESTO

  if (isset($_POST['personSell'])){
    $idPro = $_POST['idProductSell'];
    $idPer = $_POST['personSell'];


    $addCestoQuery = " insert into cesto VALUES ('$name','$idPro','$idPer',1)";

    $checkAddCesto = mysqli_multi_query($conn, $addCestoQuery);

    if(!$checkAddCesto)
        die("Error, insert query failed:" . $addCestoQuery);

    //header("Location: ../product2mao.php?refProduct=$idPro");


  }

  if (isset($_POST['deleteCesto'])) {
    $idaaaa = $_POST['deleteCesto'];

    $deleteCestoQuery = "delete from cesto where idUsername='$name' and idProduct='$idaaaa'";
    $checkdeleteProducts = mysqli_query($conn, $deleteCestoQuery);

    if(!$checkdeleteProducts)
      die("Error, insert query failed:" . $deleteCestoQuery);

    header("Location: ../store2mao.php");
  }






  //PROCESSO COMPRA

  if(isset($_POST['iniProcesso'])){
    $existQuery = "select * from pedidos2mao where idUsername = '$name' and estado_pedido='em_aberto'";
    $checkExist = mysqli_query($conn, $existQuery);
    if(mysqli_num_rows($checkExist)>0) {
      $deleteExistQuery = "delete from pedidos2mao where idUsername = '$name'";
      $checkDeleteExist = mysqli_multi_query($conn, $deleteExistQuery);
    }
    $iniciarQuery = "insert into pedidos2mao VALUES(NULL,'$name','em_aberto','-')";

    if ($conn -> query($iniciarQuery) === TRUE){
      $id = $conn->insert_id;
      header("Location: ../processoCompra.php?pedido=$id");
    }
  }

  if(isset($_POST["contPag"])){
    $idPedido = $_POST["contPag"];
    $morada = $_POST["morada"];
    $zip = $_POST["codigoPostal"];
    $local = $_POST["local"];
    $addressQuery = "insert into dados_envio VALUES ('$idPedido','$morada','$zip','$local')";
    $checkAddress = mysqli_query($conn, $addressQuery);

    header("Location: ../processoPagamento.php?pedido=$idPedido");

  }


  // Compra com Cartão
if(isset($_POST["confirmarCompraCartoes"])){


    $idPedido = $_POST["confirmarCompraMB"];
    $metodo = $_POST['metodo'];
    $entidade = $_POST["entidade"];
    $referencia = $_POST["referencia"];
    $totalPrice = $_POST["precoTotal"];

    $addPaymentQuery = "insert into pagamento values ($idPedido,'$metodo','$cardNumber','$titular','$month','$year','$hashed_cvc','','','$totalPrice')";
    $checkPayment = mysqli_query($conn, $addPaymentQuery);


    if(!$checkPayment)
      die("Error, insert query failed:" . $addPaymentQuery);

    $productsCesto = "select * from cesto where idUsername='$name'";
    $getProducts = mysqli_query($conn, $productsCesto);

    if(!$getProducts)
      die("Error, insert query failed:" . $productsCesto);

    while  ($row = mysqli_fetch_array($getProducts)) {
      $idProd = $row[1];
      $personSell = $row[2];
      $addRemoveProductQuery = "insert into products_pedido values ('$idPedido','$idProd','$personSell','a_processar')";

    $checkPayment = mysqli_query($conn, $addRemoveProductQuery);

    if(!$checkPayment)
      die("Error, insert query failed:" . $addRemoveProductQuery);

  }

  $productsCesto = "select * from cesto where idUsername='$name'";
  $getProducts = mysqli_query($conn, $productsCesto);

  if(!$getProducts)
    die("Error, insert query failed:" . $productsCesto);

  date_default_timezone_set('Europe/Lisbon');
  $dateA = date('m/d/Y h:i:s a', time());
  while  ($row = mysqli_fetch_array($getProducts)) {
    $idProd = $row[1];
    $personSell = $row[2];
    $addRemoveProductQuery = "insert into storage values ('$name','$idProd','$dateA')";

    $checkPayment = mysqli_query($conn, $addRemoveProductQuery);

    if(!$checkPayment)
      die("Error, insert query failed:" . $addRemoveProductQuery);

  }

  date_default_timezone_set('Europe/Lisbon');
  $dateA = date('m/d/Y h:i:s a', time());
  $updateEstadoQuery = "update pedidos2mao set estado_pedido='fechado', data='$dateA' where idPedido='$idPedido'";
  $checkUpdate = mysqli_query($conn, $updateEstadoQuery);

  if(!$checkUpdate)
    die("Error, insert query failed:" . $updateEstadoQuery);

  $productsCesto = "select * from cesto where idUsername='$name'";
  $getProducts = mysqli_query($conn, $productsCesto);

  if(!$getProducts)
    die("Error, insert query failed:" . $productsCesto);

  while  ($row = mysqli_fetch_array($getProducts)) {
    $idPersonBuy = $row[0];
    $idProd = $row[1];
    $personSell = $row[2];
    $quant = $row[3];


    $dadosEnvioQuery ="select * from dados_envio where idPedido='$idPedido'";
    $getDados = mysqli_query($conn, $dadosEnvioQuery);

    $row = mysqli_fetch_array($getDados);
    $morada = $row[1];
    $codigoP = $row[2];
    $local = $row[3];

    $prdddQuery = "select * from venda2mao where idProduct='$idProd'";
    $getPrd = mysqli_query($conn, $prdddQuery);

    $rowPd = mysqli_fetch_array($getPrd);

    $prrr = $rowPd[3];
    $tamm = $rowPd[2];
    $titw = $rowPd[4];

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
    $pdf -> Cell(38,10,"$titw",1,0,'C');
    $pdf -> Cell(38,10,"$tamm",1,0,'C');
    $pdf -> Cell(38,10,"$quant",1,0,'C');
    $pdf -> Cell(38,10,"$prrr",1,1,'C');
    $pdf -> Ln(10);
    $pdf->Cell(190,10,"Total: $prrr €;",1,1,'L');

    $filename="../pdfPedidosVendas/pedido".$idPedido."_".$personSell ."_".$idProd .".pdf";
    $pdf -> Output($filename,'F');

  }





  $dadosEnvioQuery ="select * from dados_envio where idPedido='$idPedido'";
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
  $pdf -> Cell(31,10,'Vendedor',1,0,'C');
  $pdf -> Cell(31,10,'Descrição',1,0,'C');
  $pdf -> Cell(31,10,'Tamanho',1,0,'C');
  $pdf -> Cell(31,10,'Quantidade',1,0,'C');
  $pdf -> Cell(31,10,'Preço',1,1,'C');
  $pdf -> SetFont('Arial','',12);


  $productsCestooo = "select * from cesto where idUsername='$name'";
  $getProductsss = mysqli_query($conn, $productsCestooo);
  $sumAAA = 0;

  while ($rowP = mysqli_fetch_array($getProductsss)) {
    $iddd = $rowP[1];
    $idddSto = $rowP[2];
    $quannn = $rowP[3];

    $productCestoo = "select * from venda2mao where idProduct='$iddd'";
    $getProductss = mysqli_query($conn, $productCestoo);

    $rowPs = mysqli_fetch_array($getProductss);

    $cattt = $rowPs[4];
    $tammm = $rowPs[2];
    $preee = $rowPs[3];

    $pdf -> Cell(31,10,"$iddd",1,0,'C');
    $pdf -> Cell(31,10,"$idddSto",1,0,'C');
    $pdf -> Cell(31,10,"$cattt",1,0,'C');
    $pdf -> Cell(31,10,"$tammm",1,0,'C');
    $pdf -> Cell(31,10,"$quannn",1,0,'C');
    $pdf -> Cell(31,10,"$preee",1,1,'C');

    $sumAAA = $sumAAA + $preee;
  }

  $taxa = floatval($sumAAA) * 0.1;
  $sumAAA = floatval($sumAAA) + floatval($taxa);


  $pdf -> Ln(10);
  $pdf->Cell(190,10,"Total: $sumAAA €;",1,1,'L');

  $filename="../pdfPedidosCompras/pedido".$idPedido.".pdf";
  $pdf -> Output($filename,'F');


  $productsCesto = "select * from cesto where idUsername='$name'";
  $getProducts = mysqli_query($conn, $productsCesto);

  if(!$getProducts)
    die("Error, insert query failed:" . $productsCesto);

  while  ($row = mysqli_fetch_array($getProducts)) {
    $idProd = $row[1];
    $personSell = $row[2];
    $addRemoveProductQuery = "delete from storage where idUtilizador='$personSell' and idStore='$idProd'";

    $checkPayment = mysqli_query($conn, $addRemoveProductQuery);

    if(!$checkPayment)
      die("Error, insert query failed:" . $addRemoveProductQuery);

  }

  $productsCesto = "select * from cesto where idUsername='$name'";
  $getProducts = mysqli_query($conn, $productsCesto);

  if(!$getProducts)
    die("Error, insert query failed:" . $productsCesto);

  while  ($row = mysqli_fetch_array($getProducts)) {
    $idProd = $row[1];
    $personSell = $row[2];
    $addRemoveProductQuery = "delete from venda2mao where idUsername ='$personSell' and idProduct='$idProd'";

    $checkPayment = mysqli_query($conn, $addRemoveProductQuery);

    if(!$checkPayment)
      die("Error, insert query failed:" . $addRemoveProductQuery);

  }

  $deleteCestoQuery = "delete from cesto where idUsername='$name'";
  $checkdeleteProducts = mysqli_query($conn, $deleteCestoQuery);

  if(!$checkdeleteProducts)
    die("Error, insert query failed:" . $deleteCestoQuery);


  header("Location: ../processoConfirm.php?pedido=$idPedido");
}







  // Compra com MB
  if(isset($_POST["confirmarCompraMB"])){


      $idPedido = $_POST["confirmarCompraMB"];
      $metodo = $_POST['metodo'];
      $entidade = $_POST["entidade"];
      $referencia = $_POST["referencia"];
      $totalPrice = $_POST["precoTotal"];

      $addPaymentQuery = "insert into pagamento values ($idPedido,'$metodo','','','','','','$entidade','$referencia','$totalPrice')";
      $checkPayment = mysqli_query($conn, $addPaymentQuery);


      if(!$checkPayment)
        die("Error, insert query failed:" . $addPaymentQuery);

      $productsCesto = "select * from cesto where idUsername='$name'";
      $getProducts = mysqli_query($conn, $productsCesto);

      if(!$getProducts)
        die("Error, insert query failed:" . $productsCesto);

      while  ($row = mysqli_fetch_array($getProducts)) {
        $idProd = $row[1];
        $personSell = $row[2];
        $addRemoveProductQuery = "insert into products_pedido values ('$idPedido','$idProd','$personSell','a_processar')";

      $checkPayment = mysqli_query($conn, $addRemoveProductQuery);

      if(!$checkPayment)
        die("Error, insert query failed:" . $addRemoveProductQuery);

    }

    $productsCesto = "select * from cesto where idUsername='$name'";
    $getProducts = mysqli_query($conn, $productsCesto);

    if(!$getProducts)
      die("Error, insert query failed:" . $productsCesto);

    date_default_timezone_set('Europe/Lisbon');
    $dateA = date('m/d/Y h:i:s a', time());
    while  ($row = mysqli_fetch_array($getProducts)) {
      $idProd = $row[1];
      $personSell = $row[2];
      $addRemoveProductQuery = "insert into storage values ('$name','$idProd','$dateA')";

      $checkPayment = mysqli_query($conn, $addRemoveProductQuery);

      if(!$checkPayment)
        die("Error, insert query failed:" . $addRemoveProductQuery);

    }

    date_default_timezone_set('Europe/Lisbon');
    $dateA = date('m/d/Y h:i:s a', time());
    $updateEstadoQuery = "update pedidos2mao set estado_pedido='fechado', data='$dateA' where idPedido='$idPedido'";
    $checkUpdate = mysqli_query($conn, $updateEstadoQuery);

    if(!$checkUpdate)
      die("Error, insert query failed:" . $updateEstadoQuery);

    $productsCesto = "select * from cesto where idUsername='$name'";
    $getProducts = mysqli_query($conn, $productsCesto);

    if(!$getProducts)
      die("Error, insert query failed:" . $productsCesto);

    while  ($row = mysqli_fetch_array($getProducts)) {
      $idPersonBuy = $row[0];
      $idProd = $row[1];
      $personSell = $row[2];
      $quant = $row[3];


      $dadosEnvioQuery ="select * from dados_envio where idPedido='$idPedido'";
      $getDados = mysqli_query($conn, $dadosEnvioQuery);

      $row = mysqli_fetch_array($getDados);
      $morada = $row[1];
      $codigoP = $row[2];
      $local = $row[3];

      $prdddQuery = "select * from venda2mao where idProduct='$idProd'";
      $getPrd = mysqli_query($conn, $prdddQuery);

      $rowPd = mysqli_fetch_array($getPrd);

      $prrr = $rowPd[3];
      $tamm = $rowPd[2];
      $titw = $rowPd[4];

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
      $pdf-> Cell(100,10,"Entidade: $entidade ;",0,1,'L');
      $pdf-> Cell(100,10,"Referência: $referencia ;",0,1,'L');
      $pdf -> Ln(30);
      $pdf -> SetFont('Arial','B',12);
      $pdf -> Cell(38,10,'Referência',1,0,'C');
      $pdf -> Cell(38,10,'Descrição',1,0,'C');
      $pdf -> Cell(38,10,'Tamanho',1,0,'C');
      $pdf -> Cell(38,10,'Quantidade',1,0,'C');
      $pdf -> Cell(38,10,'Preço',1,1,'C');
      $pdf -> SetFont('Arial','',12);
      $pdf -> Cell(38,10,"$idProd",1,0,'C');
      $pdf -> Cell(38,10,"$titw",1,0,'C');
      $pdf -> Cell(38,10,"$tamm",1,0,'C');
      $pdf -> Cell(38,10,"$quant",1,0,'C');
      $pdf -> Cell(38,10,"$prrr",1,1,'C');
      $pdf -> Ln(10);
      $pdf->Cell(190,10,"Total: $prrr €;",1,1,'L');

      $filename="../pdfPedidosVendas/pedido".$idPedido."_".$personSell ."_".$idProd .".pdf";
      $pdf -> Output($filename,'F');

    }





    $dadosEnvioQuery ="select * from dados_envio where idPedido='$idPedido'";
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
    $pdf -> SetFont('Arial','B',10);
    $pdf->Cell(100,10,"Consumidor: $idPersonBuy ;",0,0,'L');
    $pdf->Cell(80,10,"Morada: $morada, $codigoP, $local",0,1,'L');
    $pdf->Cell(120,10,"Data: $dateA ;",0,0,'L');
    $pdf->Cell(120,10,"Metodo de pagamento: $metodo ;",0,1,'L');
    $pdf -> SetFont('Arial','B',12);
    $pdf -> Cell(31,10,'Referência',1,0,'C');
    $pdf -> Cell(31,10,'Vendedor',1,0,'C');
    $pdf -> Cell(31,10,'Descrição',1,0,'C');
    $pdf -> Cell(31,10,'Tamanho',1,0,'C');
    $pdf -> Cell(31,10,'Quantidade',1,0,'C');
    $pdf -> Cell(31,10,'Preço',1,1,'C');
    $pdf -> SetFont('Arial','',12);


    $productsCestooo = "select * from cesto where idUsername='$name'";
    $getProductsss = mysqli_query($conn, $productsCestooo);
    $sumAAA = 0;

    while ($rowP = mysqli_fetch_array($getProductsss)) {
      $iddd = $rowP[1];
      $idddSto = $rowP[2];
      $quannn = $rowP[3];

      $productCestoo = "select * from venda2mao where idProduct='$iddd'";
      $getProductss = mysqli_query($conn, $productCestoo);

      $rowPs = mysqli_fetch_array($getProductss);

      $cattt = $rowPs[4];
      $tammm = $rowPs[2];
      $preee = $rowPs[3];

      $pdf -> Cell(31,10,"$iddd",1,0,'C');
      $pdf -> Cell(31,10,"$idddSto",1,0,'C');
      $pdf -> Cell(31,10,"$cattt",1,0,'C');
      $pdf -> Cell(31,10,"$tammm",1,0,'C');
      $pdf -> Cell(31,10,"$quannn",1,0,'C');
      $pdf -> Cell(31,10,"$preee",1,1,'C');

      $sumAAA = $sumAAA + $preee;
    }

    $taxa = floatval($sumAAA) * 0.1;
    $sumAAA = floatval($sumAAA) + floatval($taxa);


    $pdf -> Ln(10);
    $pdf->Cell(190,10,"Total: $sumAAA €;",1,1,'L');

    $filename="../pdfPedidosCompras/pedido".$idPedido.".pdf";
    $pdf -> Output($filename,'F');


    $productsCesto = "select * from cesto where idUsername='$name'";
    $getProducts = mysqli_query($conn, $productsCesto);

    if(!$getProducts)
      die("Error, insert query failed:" . $productsCesto);

    while  ($row = mysqli_fetch_array($getProducts)) {
      $idProd = $row[1];
      $personSell = $row[2];
      $addRemoveProductQuery = "delete from storage where idUtilizador='$personSell' and idStore='$idProd'";

      $checkPayment = mysqli_query($conn, $addRemoveProductQuery);

      if(!$checkPayment)
        die("Error, insert query failed:" . $addRemoveProductQuery);

    }

    $productsCesto = "select * from cesto where idUsername='$name'";
    $getProducts = mysqli_query($conn, $productsCesto);

    if(!$getProducts)
      die("Error, insert query failed:" . $productsCesto);

    while  ($row = mysqli_fetch_array($getProducts)) {
      $idProd = $row[1];
      $personSell = $row[2];
      $addRemoveProductQuery = "delete from venda2mao where idUsername ='$personSell' and idProduct='$idProd'";

      $checkPayment = mysqli_query($conn, $addRemoveProductQuery);

      if(!$checkPayment)
        die("Error, insert query failed:" . $addRemoveProductQuery);

    }

    $deleteCestoQuery = "delete from cesto where idUsername='$name'";
    $checkdeleteProducts = mysqli_query($conn, $deleteCestoQuery);

    if(!$checkdeleteProducts)
      die("Error, insert query failed:" . $deleteCestoQuery);


    header("Location: ../processoConfirm.php?pedido=$idPedido");
  }








    // Compra com Paypal
    if(isset($_POST["confirmarCompraPaypal"])){


        $idPedido = $_POST["confirmarCompraMB"];
        $metodo = $_POST['metodo'];
        $entidade = $_POST["entidade"];
        $referencia = $_POST["referencia"];
        $totalPrice = $_POST["precoTotal"];

        $addPaymentQuery = "insert into pagamento values ($idPedido,'$metodo','','','','','','','','$totalPrice')";
        $checkPayment = mysqli_query($conn, $addPaymentQuery);


        if(!$checkPayment)
          die("Error, insert query failed:" . $addPaymentQuery);

        $productsCesto = "select * from cesto where idUsername='$name'";
        $getProducts = mysqli_query($conn, $productsCesto);

        if(!$getProducts)
          die("Error, insert query failed:" . $productsCesto);

        while  ($row = mysqli_fetch_array($getProducts)) {
          $idProd = $row[1];
          $personSell = $row[2];
          $addRemoveProductQuery = "insert into products_pedido values ('$idPedido','$idProd','$personSell','a_processar')";

        $checkPayment = mysqli_query($conn, $addRemoveProductQuery);

        if(!$checkPayment)
          die("Error, insert query failed:" . $addRemoveProductQuery);

      }

      $productsCesto = "select * from cesto where idUsername='$name'";
      $getProducts = mysqli_query($conn, $productsCesto);

      if(!$getProducts)
        die("Error, insert query failed:" . $productsCesto);

      date_default_timezone_set('Europe/Lisbon');
      $dateA = date('m/d/Y h:i:s a', time());
      while  ($row = mysqli_fetch_array($getProducts)) {
        $idProd = $row[1];
        $personSell = $row[2];
        $addRemoveProductQuery = "insert into storage values ('$name','$idProd','$dateA')";

        $checkPayment = mysqli_query($conn, $addRemoveProductQuery);

        if(!$checkPayment)
          die("Error, insert query failed:" . $addRemoveProductQuery);

      }

      date_default_timezone_set('Europe/Lisbon');
      $dateA = date('m/d/Y h:i:s a', time());
      $updateEstadoQuery = "update pedidos2mao set estado_pedido='fechado', data='$dateA' where idPedido='$idPedido'";
      $checkUpdate = mysqli_query($conn, $updateEstadoQuery);

      if(!$checkUpdate)
        die("Error, insert query failed:" . $updateEstadoQuery);

      $productsCesto = "select * from cesto where idUsername='$name'";
      $getProducts = mysqli_query($conn, $productsCesto);

      if(!$getProducts)
        die("Error, insert query failed:" . $productsCesto);

      while  ($row = mysqli_fetch_array($getProducts)) {
        $idPersonBuy = $row[0];
        $idProd = $row[1];
        $personSell = $row[2];
        $quant = $row[3];


        $dadosEnvioQuery ="select * from dados_envio where idPedido='$idPedido'";
        $getDados = mysqli_query($conn, $dadosEnvioQuery);

        $row = mysqli_fetch_array($getDados);
        $morada = $row[1];
        $codigoP = $row[2];
        $local = $row[3];

        $prdddQuery = "select * from venda2mao where idProduct='$idProd'";
        $getPrd = mysqli_query($conn, $prdddQuery);

        $rowPd = mysqli_fetch_array($getPrd);

        $prrr = $rowPd[3];
        $tamm = $rowPd[2];
        $titw = $rowPd[4];

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
        $pdf -> Cell(38,10,"$titw",1,0,'C');
        $pdf -> Cell(38,10,"$tamm",1,0,'C');
        $pdf -> Cell(38,10,"$quant",1,0,'C');
        $pdf -> Cell(38,10,"$prrr",1,1,'C');
        $pdf -> Ln(10);
        $pdf->Cell(190,10,"Total: $prrr €;",1,1,'L');

        $filename="../pdfPedidosVendas/pedido".$idPedido."_".$personSell ."_".$idProd .".pdf";
        $pdf -> Output($filename,'F');

      }





      $dadosEnvioQuery ="select * from dados_envio where idPedido='$idPedido'";
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
      $pdf -> SetFont('Arial','B',10);
      $pdf->Cell(100,10,"Consumidor: $idPersonBuy ;",0,0,'L');
      $pdf->Cell(80,10,"Morada: $morada, $codigoP, $local",0,1,'L');
      $pdf->Cell(120,10,"Data: $dateA ;",0,0,'L');
      $pdf->Cell(120,10,"Metodo de pagamento: $metodo ;",0,1,'L');
      $pdf -> SetFont('Arial','B',12);
      $pdf -> Cell(31,10,'Referência',1,0,'C');
      $pdf -> Cell(31,10,'Vendedor',1,0,'C');
      $pdf -> Cell(31,10,'Descrição',1,0,'C');
      $pdf -> Cell(31,10,'Tamanho',1,0,'C');
      $pdf -> Cell(31,10,'Quantidade',1,0,'C');
      $pdf -> Cell(31,10,'Preço',1,1,'C');
      $pdf -> SetFont('Arial','',12);


      $productsCestooo = "select * from cesto where idUsername='$name'";
      $getProductsss = mysqli_query($conn, $productsCestooo);
      $sumAAA = 0;

      while ($rowP = mysqli_fetch_array($getProductsss)) {
        $iddd = $rowP[1];
        $idddSto = $rowP[2];
        $quannn = $rowP[3];

        $productCestoo = "select * from venda2mao where idProduct='$iddd'";
        $getProductss = mysqli_query($conn, $productCestoo);

        $rowPs = mysqli_fetch_array($getProductss);

        $cattt = $rowPs[4];
        $tammm = $rowPs[2];
        $preee = $rowPs[3];

        $pdf -> Cell(31,10,"$iddd",1,0,'C');
        $pdf -> Cell(31,10,"$idddSto",1,0,'C');
        $pdf -> Cell(31,10,"$cattt",1,0,'C');
        $pdf -> Cell(31,10,"$tammm",1,0,'C');
        $pdf -> Cell(31,10,"$quannn",1,0,'C');
        $pdf -> Cell(31,10,"$preee",1,1,'C');

        $sumAAA = $sumAAA + $preee;
      }

      $taxa = floatval($sumAAA) * 0.1;
      $sumAAA = floatval($sumAAA) + floatval($taxa);


      $pdf -> Ln(10);
      $pdf->Cell(190,10,"Total: $sumAAA €;",1,1,'L');

      $filename="../pdfPedidosCompras/pedido".$idPedido.".pdf";
      $pdf -> Output($filename,'F');


      $productsCesto = "select * from cesto where idUsername='$name'";
      $getProducts = mysqli_query($conn, $productsCesto);

      if(!$getProducts)
        die("Error, insert query failed:" . $productsCesto);

      while  ($row = mysqli_fetch_array($getProducts)) {
        $idProd = $row[1];
        $personSell = $row[2];
        $addRemoveProductQuery = "delete from storage where idUtilizador='$personSell' and idStore='$idProd'";

        $checkPayment = mysqli_query($conn, $addRemoveProductQuery);

        if(!$checkPayment)
          die("Error, insert query failed:" . $addRemoveProductQuery);

      }

      $productsCesto = "select * from cesto where idUsername='$name'";
      $getProducts = mysqli_query($conn, $productsCesto);

      if(!$getProducts)
        die("Error, insert query failed:" . $productsCesto);

      while  ($row = mysqli_fetch_array($getProducts)) {
        $idProd = $row[1];
        $personSell = $row[2];
        $addRemoveProductQuery = "delete from venda2mao where idUsername ='$personSell' and idProduct='$idProd'";

        $checkPayment = mysqli_query($conn, $addRemoveProductQuery);

        if(!$checkPayment)
          die("Error, insert query failed:" . $addRemoveProductQuery);

      }

      $deleteCestoQuery = "delete from cesto where idUsername='$name'";
      $checkdeleteProducts = mysqli_query($conn, $deleteCestoQuery);

      if(!$checkdeleteProducts)
        die("Error, insert query failed:" . $deleteCestoQuery);


      header("Location: ../processoConfirm.php?pedido=$idPedido");
    }










































































  // ADD WISHLIST
  if (isset($_POST["addWish"])) {
    $value = $_POST["addWish"];
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

    header('Location: ../store2mao.php');

  }

  // MY STORE 2 MAO

  // Adicionar venda de produto
  if (isset($_POST["adicionar"])) {
    $titulo = $_POST["titulo"];
    $descricao = $_POST["descricao"];
    $tamanho = $_POST["tamanho"];
    $preco = $_POST["preco"];
    $district = $_POST["district"];
    $concelho = $_POST["concelho"];
    $idPeca = $_POST['adicionar'];
    $loc = $concelho . ", " . $district;

    $addSaleQuery = " insert into venda2mao VALUES ('$name','$idPeca','$tamanho','$preco','$titulo','$descricao','$loc',0)";

    $checkAddSale = mysqli_multi_query($conn, $addSaleQuery);

    if(!$checkAddSale)
        die("Error, insert query failed:" . $addSaleQuery);

    header('Location: ../mystore2mao.php');

  }

  // Editar produto

  if (isset($_POST["editar"])) {
    $titulo = $_POST["titulo"];
    $descricao = $_POST["descricao"];
    $tamanho = $_POST["tamanho"];
    $preco = $_POST["preco"];
    $district = $_POST["district"];
    $concelho = $_POST["concelho"];
    $idPeca = $_POST['editar'];
    $loc = $concelho . ", " . $district;

    $updateSaleQuery = " update venda2mao set tamanho='$tamanho', preco='$preco', titulo='$titulo', descricao='$descricao', localizacao='$loc' where idUsername='$name' and idProduct='$idPeca'";

    $checkUpdateSale = mysqli_multi_query($conn, $updateSaleQuery);

    if(!$checkUpdateSale)
        die("Error, insert query failed:" . $updateSaleQuery);

    header('Location: ../mystore2mao.php');
  }

  // Eliminar produto
  if (isset($_POST["eliminar"])){

      $idProd  = $_POST["eliminar"];

      $deleteProdQuery = "delete from venda2mao where idUsername='$name' and idProduct='$idProd'";
      $checkDelete = mysqli_multi_query($conn, $deleteProdQuery);

    if(!$checkDelete)
        die("Error, insert query failed:" . $deleteProdQuery);

    header('Location: ../mystore2mao.php');
  }


  // Enviar Produto
  if (isset($_POST["updateEnvio"])){
    $myArray = explode(',', $_POST["updateEnvio"]);
    $idPed = $myArray[0];
    $idPro = $myArray[1];

    $updateEnviaQuery = " update products_pedido set estado_entrega='entregue' where idPedido='$idPed' and idProduct='$idPro'";

    $checkUpdateEnvia = mysqli_multi_query($conn, $updateEnviaQuery);

    if(!$checkUpdateEnvia)
        die("Error, insert query failed:" . $updateEnviaQuery);

    header('Location: ../mystore2mao.php');
  }
?>
