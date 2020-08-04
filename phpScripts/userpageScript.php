<?php
  session_start();
  include "accessBD.php";
  $user = $_SESSION["username"];

  //Register
  if (isset($_POST["save"])) {
    if ($_POST["email"] != ""){
        $email = $_POST['email'];
    }
    else{
        $email = 0;
    }

    if ($_POST["password"] != ""){
        $password = $_POST["password"];
        $hashed_password = sha1($password);
    }
    else{
        $hashed_password = 0;
    }

    if ($_POST["gender"] != ""){
        $gender = $_POST['gender'];
    }
    else{
        $gender = 0;
    }

    $teste1 = empty($email);
    $teste2 = empty($hashed_password);
    $teste3 = empty($gender);
    //$_SESSION['messageReceived'] = "teste1 =$teste1 , teste2 = $teste2, teste3 = $teste3";

    if (empty($email)!=1 && empty($hashed_password)==1 && empty($gender)==1){
        $updateStatusQuery = "update users SET email = '$email' WHERE username='$user'";

        $updateStatus = mysqli_query($conn, $updateStatusQuery);

        if(!$updateStatus)
            die("Error, update query failed:" . $updateStatusQuery);

    }
    else if (empty($hashed_password)!=1 && empty($email)==1 && empty($gender)==1){
        $updateStatusQuery = "update users SET password = '$hashed_password' WHERE username='$user'";

        $updateStatus = mysqli_query($conn, $updateStatusQuery);

        if(!$updateStatus)
            die("Error, update query failed:" . $updateStatusQuery);

    }
    else if ((empty($gender)!=1) && empty($email)==1 && empty($hashed_password)==1){
        $_SESSION['messageReceived'] = "teste1 =$teste1 , teste2 = $teste2, teste3 = $teste3";

        $updateStatusQuery = "update users SET gender = '$gender' WHERE username='$user'";

        $updateStatus = mysqli_query($conn, $updateStatusQuery);

        if(!$updateStatus)
            die("Error, update query failed:" . $updateStatusQuery);
    }


    else if (empty($email)!=1 && empty($hashed_password)!=1 && empty($gender)==1){

        $updateStatusQuery = "update users SET email = '$email', password = '$hashed_password' WHERE username='$user'";

        $updateStatus = mysqli_query($conn, $updateStatusQuery);

        if(!$updateStatus)
            die("Error, update query failed:" . $updateStatusQuery);

    }
    else if (empty($email)!=1 && empty($gender)!=1 && empty($hashed_password)==1){
        $updateStatusQuery = "update users SET email = '$email', gender = '$gender' WHERE username='$user'";

        $updateStatus = mysqli_query($conn, $updateStatusQuery);

        if(!$updateStatus)
            die("Error, update query failed:" . $updateStatusQuery);


    }
    else if (empty($hashed_password)!=1 && empty($gender)!=1 && empty($email)==1){
        $updateStatusQuery = "update users SET password = '$hashed_password', gender = '$gender' WHERE username='$user'";

        $updateStatus = mysqli_query($conn, $updateStatusQuery);

        if(!$updateStatus)
            die("Error, update query failed:" . $updateStatusQuery);

    }
    else if (empty($email)!=1 && empty($hashed_password)!=1 && empty($gender) !=1){
        $updateStatusQuery = "update users SET email='$email', password = '$hashed_password', gender = '$gender' WHERE username='$user'";

        $updateStatus = mysqli_query($conn, $updateStatusQuery);

        if(!$updateStatus)
            die("Error, update query failed:" . $updateStatusQuery);
    }
    else{
        header('Location: ../userpage.php');
    }

    header('Location: ../userpage.php');
  }



  if (isset($_POST["saveStr"])) {
    if ($_POST["email"] != ""){
        $email = $_POST['email'];
    }
    else{
        $email = 0;
    }

    if ($_POST["password"] != ""){
        $password = $_POST["password"];
        $hashed_password = sha1($password);
    }
    else{
        $hashed_password = 0;
    }

    if ($_POST["slogan"] != ""){
        $slogan = $_POST['slogan'];
    }
    else{
        $slogan = 0;
    }

    $teste1 = empty($email);
    $teste2 = empty($hashed_password);
    $teste3 = empty($slogan);
    //$_SESSION['messageReceived'] = "teste1 =$teste1 , teste2 = $teste2, teste3 = $teste3";

    if (empty($email)!=1 && empty($hashed_password)==1 && empty($slogan)==1){
        $updateStatusQuery = "update stores SET email = '$email' WHERE storename ='$user'";

        $updateStatus = mysqli_query($conn, $updateStatusQuery);

        if(!$updateStatus)
            die("Error, update query failed:" . $updateStatusQuery);

    }
    else if (empty($hashed_password)!=1 && empty($email)==1 && empty($slogan)==1){
        $updateStatusQuery = "update stores SET password = '$hashed_password' WHERE storename='$user'";

        $updateStatus = mysqli_query($conn, $updateStatusQuery);

        if(!$updateStatus)
            die("Error, update query failed:" . $updateStatusQuery);

    }
    else if ((empty($slogan)!=1) && empty($email)==1 && empty($hashed_password)==1){

        $updateStatusQuery = "update stores SET slogan = '$slogan' WHERE storename='$user'";

        $updateStatus = mysqli_query($conn, $updateStatusQuery);

        if(!$updateStatus)
            die("Error, update query failed:" . $updateStatusQuery);
    }


    else if (empty($email)!=1 && empty($hashed_password)!=1 && empty($slogan)==1){

        $updateStatusQuery = "update stores SET email = '$email', password = '$hashed_password' WHERE storename='$user'";

        $updateStatus = mysqli_query($conn, $updateStatusQuery);

        if(!$updateStatus)
            die("Error, update query failed:" . $updateStatusQuery);

    }
    else if (empty($email)!=1 && empty($slogan)!=1 && empty($hashed_password)==1){
        $updateStatusQuery = "update stores SET email = '$email', slogan = '$slogan' WHERE storename='$user'";

        $updateStatus = mysqli_query($conn, $updateStatusQuery);

        if(!$updateStatus)
            die("Error, update query failed:" . $updateStatusQuery);


    }
    else if (empty($hashed_password)!=1 && empty($slogan)!=1 && empty($email)==1){
        $updateStatusQuery = "update stores SET password = '$hashed_password', slogan = '$slogan' WHERE storename='$user'";

        $updateStatus = mysqli_query($conn, $updateStatusQuery);

        if(!$updateStatus)
            die("Error, update query failed:" . $updateStatusQuery);

    }
    else if (empty($email)!=1 && empty($hashed_password)!=1 && empty($slogan) !=1){
        $updateStatusQuery = "update stores SET email='$email', password = '$hashed_password', slogan = '$slogan' WHERE storename='$user'";

        $updateStatus = mysqli_query($conn, $updateStatusQuery);

        if(!$updateStatus)
            die("Error, update query failed:" . $updateStatusQuery);
    }
    else{
        header('Location: ../storepage.php');
    }

    header('Location: ../storepage.php');
  }







  if(isset($_POST['overlabPremiumUserPP'])){
    $metodo= $_POST["metodo"];
    $preco = $_POST["price"];
    $month = date('m');
    $year = date("Y");
    date_default_timezone_set('Europe/Lisbon');
    $data = date('m/d/Y h:i:s a', time());

    $updatePremiumQuery = "update users set typeAccount='Premium' where username='$user'";
    $checkUpdatePremium = mysqli_query($conn, $updatePremiumQuery);

    if(!$checkUpdatePremium)
        die("Error, update query failed:" . $updatePremiumQuery);

    $insertSubQuery = "insert into subscriptionusers values (NULL,'$user','$metodo','','','','','$month','$year','$preco','$data')";

    if ($conn -> query($insertSubQuery) === TRUE){
        $idSub = $conn->insert_id;
    }

    require "../phpScripts/fpdf.php";

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
    $pdf->Cell(100,10,"Fatura #$idSub",0,1,'L');
    $pdf -> Ln(5);
    $pdf -> SetFont('Arial','B',10);
    $pdf->Cell(120,10,"Consumidor: $user ;",0,0,'L');
    $pdf->Cell(100,10,"Assinatura Premium",0,1,'L');
    $pdf->Cell(120,10,"Data: $data ;",0,0,'L');
    $pdf->Cell(100,10,"Mes: $month | Ano: $year ;",0,1,'L');
    $pdf->Cell(120,10,"Metodo de pagamento: $metodo ;",0,1,'L');
    $pdf -> Ln(10);
    $pdf->Cell(180,10,"Preço: $preco €;",1,1,'L');

    $filename ="../pdfSubsUsers/sub".$idSub."_".$month."_"."$year"."_".$user.".pdf";

    $pdf -> Output($filename,'F');

    header('Location: ../userpagePremium.php');

}

  if(isset($_POST['overlabPremiumUserCC'])){

    $metodo= $_POST["metodo"];
    $preco = $_POST["price"];
    $cardNumber = $_POST["cc"];
    $cardMes = $_POST["mes"];
    $cardAno = $_POST["ano"];
    $cardCvc = $_POST["cvc"];
    $month = date('m');
    $year = date("Y");
    date_default_timezone_set('Europe/Lisbon');
    $data = date('m/d/Y h:i:s a', time());

    $updatePremiumQuery = "update users set typeAccount='Premium' where username='$user'";
    $checkUpdatePremium = mysqli_query($conn, $updatePremiumQuery);

    if(!$checkUpdatePremium)
        die("Error, update query failed:" . $updatePremiumQuery);

    $insertSubQuery = "insert into subscriptionusers values (NULL,'$user','$metodo','$cardNumber','$cardMes','$cardAno','$cardCvc','$month','$year','$preco','$data')";

    if ($conn -> query($insertSubQuery) === TRUE){
        $idSub = $conn->insert_id;
    }

    require "../phpScripts/fpdf.php";

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
    $pdf->Cell(100,10,"Fatura #$idSub",0,1,'L');
    $pdf -> Ln(5);
    $pdf -> SetFont('Arial','B',10);
    $pdf->Cell(120,10,"Consumidor: $user ;",0,0,'L');
    $pdf->Cell(100,10,"Assinatura Premium",0,1,'L');
    $pdf->Cell(120,10,"Data: $data ;",0,0,'L');
    $pdf->Cell(100,10,"Mes: $month | Ano: $year ;",0,1,'L');
    $pdf->Cell(120,10,"Metodo de pagamento: $metodo ;",0,1,'L');
    $pdf->Cell(120,10,"Número do Cartão: $cardNumber ;",0,1,'L');
    $pdf -> Ln(10);
    $pdf->Cell(180,10,"Preço: $preco €;",1,1,'L');

    $filename ="../pdfSubsUsers/sub".$idSub."_".$month."_"."$year"."_".$user.".pdf";

    $pdf -> Output($filename,'F');

    header('Location: ../userpagePremium.php');
  }


  if(isset($_POST["overlabFreeUser"])){
      $updateFreeQuery = "update users set typeAccount='Free' where username='$user'";
      $checkUpdateFree = mysqli_query($conn, $updateFreeQuery);

      if(!$checkUpdateFree)
          die("Error, update query failed:" . $updateFreeQuery);

      header('Location: ../userpagePremium.php');
  }





  if(isset($_POST['overlabPremiumStorePP'])){

    $metodo= $_POST["metodo"];
    $preco = $_POST["price"];
    $month = date('m');
    $year = date("Y");
    date_default_timezone_set('Europe/Lisbon');
    $data = date('m/d/Y h:i:s a', time());

    $updatePremiumQuery = "update stores set plano='Premium' where storename='$user'";
    $checkUpdatePremium = mysqli_query($conn, $updatePremiumQuery);

    if(!$checkUpdatePremium)
        die("Error, update query failed:" . $updatePremiumQuery);

    $insertSubQuery = "insert into subscriptionstores values (NULL,'$user','$metodo','','','','','$month','$year','$preco','$data')";

    if ($conn -> query($insertSubQuery) === TRUE){
        $idSub = $conn->insert_id;
    }

    require "../phpScripts/fpdf.php";

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
    $pdf->Cell(100,10,"Fatura #$idSub",0,1,'L');
    $pdf -> Ln(5);
    $pdf -> SetFont('Arial','B',10);
    $pdf->Cell(120,10,"Consumidor: $user ;",0,0,'L');
    $pdf->Cell(100,10,"Assinatura Premium",0,1,'L');
    $pdf->Cell(120,10,"Data: $data ;",0,0,'L');
    $pdf->Cell(100,10,"Mes: $month | Ano: $year ;",0,1,'L');
    $pdf->Cell(120,10,"Metodo de pagamento: $metodo ;",0,1,'L');
    $pdf -> Ln(10);
    $pdf->Cell(180,10,"Preço: $preco €;",1,1,'L');

    $filename="../pdfSubsStores/sub".$idSub."_".$month."_"."$year"."_".$user.".pdf";

    $pdf -> Output($filename,'F');

    header('Location: ../storepagePremium.php');

}


  if(isset($_POST['overlabPremiumStoreCC'])){

      $metodo= $_POST["metodo"];
      $preco = $_POST["price"];
      $cardNumber = $_POST["cc"];
      $cardMes = $_POST["mes"];
      $cardAno = $_POST["ano"];
      $cardCvc = $_POST["cvc"];
      $month = date('m');
      $year = date("Y");
      date_default_timezone_set('Europe/Lisbon');
      $data = date('m/d/Y h:i:s a', time());

      $updatePremiumQuery = "update stores set plano='Premium' where storename='$user'";
      $checkUpdatePremium = mysqli_query($conn, $updatePremiumQuery);

      if(!$checkUpdatePremium)
          die("Error, update query failed:" . $updatePremiumQuery);

      $insertSubQuery = "insert into subscriptionstores values (NULL,'$user','$metodo','$cardNumber','$cardMes','$cardAno','$cardCvc','$month','$year','$preco','$data')";

      if ($conn -> query($insertSubQuery) === TRUE){
          $idSub = $conn->insert_id;
      }

      require "../phpScripts/fpdf.php";

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
      $pdf->Cell(100,10,"Fatura #$idSub",0,1,'L');
      $pdf -> Ln(5);
      $pdf -> SetFont('Arial','B',10);
      $pdf->Cell(120,10,"Consumidor: $user ;",0,0,'L');
      $pdf->Cell(100,10,"Assinatura Premium",0,1,'L');
      $pdf->Cell(120,10,"Data: $data ;",0,0,'L');
      $pdf->Cell(100,10,"Mes: $month | Ano: $year ;",0,1,'L');
      $pdf->Cell(120,10,"Metodo de pagamento: $metodo ;",0,1,'L');
      $pdf->Cell(120,10,"Número do Cartão: $cardNumber ;",0,1,'L');
      $pdf -> Ln(10);
      $pdf->Cell(180,10,"Preço: $preco €;",1,1,'L');

      $filename="../pdfSubsStores/sub".$idSub."_".$month."_"."$year"."_".$user.".pdf";

      $pdf -> Output($filename,'F');

      header('Location: ../storepagePremium.php');
  }

  if(isset($_POST["overlabFreeStore"])){
      $updateFreeQuery = "update stores set plano='Free' where storename='$user'";
      $checkUpdateFree = mysqli_query($conn, $updateFreeQuery);

      if(!$checkUpdateFree)
          die("Error, update query failed:" . $updateFreeQuery);

      header('Location: ../storepagePremium.php');
  }

  mysqli_close($conn);


  ?>
