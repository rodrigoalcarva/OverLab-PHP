<?php
  session_start();
  include "accessBD.php";

  $user = $_SESSION["username"];

  // Adicionar Peça Manual
    if (isset($_POST["adicionar1"])) {
        $name = $_POST["name"];
        $category = $_POST["category"];
        $descricao = $_POST["descricao"];
        $color = $_POST["color"];
        $utility = $_POST["utility"];
        $gender =  $_POST["gender"];
        $price = $_POST["price"];

        if(empty($_POST["stockXS"])){
            $stockXS = 0;
        }
        else{
            $stockXS = $_POST["stockXS"];
        }

        if(empty($_POST["stockS"])){
            $stockS = 0;
        }
        else{
            $stockS = $_POST["stockS"];
        }

        if(empty($_POST["stockM"])){
            $stockM = 0;
        }
        else{
            $stockM = $_POST["stockM"];
        }

        if(empty($_POST["stockL"])){
            $stockL = 0;
        }
        else{
            $stockL = $_POST["stockL"];
        }

        if(empty($_POST["stockXL"])){
            $stockXL = 0;
        }
        else{
            $stockXL = $_POST["stockXL"];
        }

        $label = array("XS", "S", "M","L","XL");
        $values = array($stockXS,$stockS,$stockM,$stockL,$stockXL);
        
        $number = rand(0,100000); 

        $id = "DEF" . $number;

        $idQuery="select id from productsd WHERE id='$id'";
        $checkId = mysqli_query($conn, $idQuery);

        if(mysqli_num_rows($checkId)>0) {
            $_SESSION['messageReceived'] = "O registo deu erro, tente novamente";
            header('Location: ../myproducts.php');
        }
        
        $uploadOk = True;
        $userUpload = NULL;
        if ($_FILES['avatar']['size'] != 0) {
            //upload image
            $target_dir = "../productsImage/";
            $extension = explode(".", $_FILES["avatar"]["name"]);
            $target_file = $target_dir . $id . "." . end($extension);
            $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
            $userUpload = "sim";
        
            if (!move_uploaded_file($_FILES["avatar"]["tmp_name"], $target_file)) {
                $uploadOk = False;
                $_SESSION['messageReceived'] = "Houve um erro a dar upload do ficheiro";
            }
        }
        //Check password iguais ja resgistado FALTA METER EM JS NO CLIENT
        if ($uploadOk) {
            $uploadQuery = "insert into productsd values ('$id','$name', '$category', '$user','$descricao' ,'$color', '$utility', '$gender', $price ,0, '$userUpload');";
        
            $upload = mysqli_multi_query($conn, $uploadQuery);
        
            if(!$upload)
                die("Error, insert query failed:" . $uploadQuery);

            for($i = 0; $i<count($label); $i++) {
                $tam = $label[$i];
                $quant = $values[$i];
                $sql="insert into stocksstores values('$id', '$tam',$quant)";
                $result = mysqli_query($conn, $sql);
                if (!$result) {
                    die('Invalid query: ' . $sql);
                }
            }

            header('Location: ../myproducts.php');
        }
    }

    if (isset($_POST["adicionar2"])) {
        $name = $_POST["name"];
        $category = $_POST["category"];
        $color = $_POST["color"];
        $descricao = $_POST["descricao"];
        $utility = $_POST["utility"];
        $gender =  $_POST["gender"];
        $stock = $_POST["stock"];
        $price = $_POST["price"];

        if(empty($_POST["stock32"])){
            $stock32 = 0;
        }
        else{
            $stock32 = $_POST["stock32"];
        }

        if(empty($_POST["stock34"])){
            $stock34 = 0;
        }
        else{
            $stock34 = $_POST["stock34"];
        }

        if(empty($_POST["stock36"])){
            $stock36 = 0;
        }
        else{
            $stock36 = $_POST["stock36"];
        }

        if(empty($_POST["stock38"])){
            $stock38 = 0;
        }
        else{
            $stock38 = $_POST["stock38"];
        }

        if(empty($_POST["stock40"])){
            $stock40 = 0;
        }
        else{
            $stock40 = $_POST["stock40"];
        }

        if(empty($_POST["stock42"])){
            $stock42 = 0;
        }
        else{
            $stock42 = $_POST["stock42"];
        }

        if(empty($_POST["stock44"])){
            $stock44 = 0;
        }
        else{
            $stock44 = $_POST["stock44"];
        }

        if(empty($_POST["stock46"])){
            $stock46 = 0;
        }
        else{
            $stock46 = $_POST["stock46"];
        }

        if(empty($_POST["stock48"])){
            $stock48 = 0;
        }
        else{
            $stock48 = $_POST["stock48"];
        }

        if(empty($_POST["stock50"])){
            $stock50 = 0;
        }
        else{
            $stock50 = $_POST["stock50"];
        }

        $label = array("32", "34", "36","38","40","42", "44", "46","48","50");
        $values = array($stock32,$stock34,$stock36,$stock38,$stock40,$stock42,$stock44,$stock46,$stock48,$stock50);

        $number = rand(0,100000); 

            $id = "DEF" . $number;

            $idQuery="select id from productsd WHERE id='$id'";
            $checkId = mysqli_query($conn, $idQuery);

            if(mysqli_num_rows($checkId)>0) {
                $_SESSION['messageReceived'] = "O registo deu erro, tente novamente";
                header('Location: ../myproducts.php');
            }
        
            $uploadOk = True;
            $userUpload = NULL;
            if ($_FILES['avatar']['size'] != 0) {
                //upload image
                $target_dir = "../productsImage/";
                $extension = explode(".", $_FILES["avatar"]["name"]);
                $target_file = $target_dir . $id . "." . end($extension);
                $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
                $userUpload = "sim";
        
                if (!move_uploaded_file($_FILES["avatar"]["tmp_name"], $target_file)) {
                    $uploadOk = False;
                    $_SESSION['messageReceived'] = "Houve um erro a dar upload do ficheiro";
                }
            }
            //Check password iguais ja resgistado FALTA METER EM JS NO CLIENT
            if ($uploadOk) {
                $uploadQuery = "insert into productsd values ('$id','$name', '$category', '$user','$descricao' , '$color', '$utility', '$gender', $price ,0, '$userUpload');";
        
                $upload = mysqli_multi_query($conn, $uploadQuery);

                for($i = 0; $i<count($label); $i++) {
                    $tam = $label[$i];
                    $quant = $values[$i];
                    $sql="insert into stocksstores values('$id', '$tam',$quant)";
                    $result = mysqli_query($conn, $sql);
                    if (!$result) {
                        die('Invalid query: ' . $sql);
                    }
                }
        
                if(!$upload)
                    die("Error, insert query failed:" . $uploadQuery);

                header('Location: ../myproducts.php');
            }
    }

    if (isset($_POST["adicionar3"])) {
        $name = $_POST["name"];
        $category = $_POST["category"];
        $color = $_POST["color"];
        $descricao = $_POST["descricao"];
        $utility = $_POST["utility"];
        $gender =  $_POST["gender"];
        $stock = $_POST["stock"];
        $price = $_POST["price"];


        if(empty($_POST["stock34"])){
            $stock34 = 0;
        }
        else{
            $stock34 = $_POST["stock34"];
        }
        
        if(empty($_POST["stock35"])){
            $stock35 = 0;
        }
        else{
            $stock35 = $_POST["stock35"];
        }

        if(empty($_POST["stock36"])){
            $stock36 = 0;
        }
        else{
            $stock36 = $_POST["stock36"];
        }
        
        
        if(empty($_POST["stock37"])){
            $stock37 = 0;
        }
        else{
            $stock37 = $_POST["stock37"];
        }

        if(empty($_POST["stock38"])){
            $stock38 = 0;
        }
        else{
            $stock38 = $_POST["stock38"];
        }

        
        if(empty($_POST["stock39"])){
            $stock39 = 0;
        }
        else{
            $stock39 = $_POST["stock39"];
        }

        if(empty($_POST["stock40"])){
            $stock40 = 0;
        }
        else{
            $stock40 = $_POST["stock40"];
        }

        if(empty($_POST["stock41"])){
            $stock41 = 0;
        }
        else{
            $stock41 = $_POST["stock41"];
        }

        if(empty($_POST["stock42"])){
            $stock42 = 0;
        }
        else{
            $stock42 = $_POST["stock42"];
        }

        if(empty($_POST["stock43"])){
            $stock43 = 0;
        }
        else{
            $stock43 = $_POST["stock43"];
        }

        if(empty($_POST["stock44"])){
            $stock44 = 0;
        }
        else{
            $stock44 = $_POST["stock44"];
        }
        
        if(empty($_POST["stock45"])){
            $stock45 = 0;
        }
        else{
            $stock45 = $_POST["stock45"];
        }

        if(empty($_POST["stock46"])){
            $stock46 = 0;
        }
        else{
            $stock46 = $_POST["stock46"];
        }

        if(empty($_POST["stock47"])){
            $stock47 = 0;
        }
        else{
            $stock47 = $_POST["stock47"];
        }

        $label = array("34", "35", "36","37","38","39", "40", "41","42","43","44","45","46","47");
        $values = array($stock34,$stock35,$stock36,$stock37,$stock38,$stock39,$stock40,$stock41,$stock42,$stock43,$stock44,$stock45,$stock46,$stock47);

        $number = rand(0,100000); 

            $id = "DEF" . $number;

            $idQuery="select id from productsd WHERE id='$id'";
            $checkId = mysqli_query($conn, $idQuery);

            if(mysqli_num_rows($checkId)>0) {
                $_SESSION['messageReceived'] = "O registo deu erro, tente novamente";
                header('Location: ../myproducts.php');
            }
        
            $uploadOk = True;
            $userUpload = NULL;
            if ($_FILES['avatar']['size'] != 0) {
                //upload image
                $target_dir = "../productsImage/";
                $extension = explode(".", $_FILES["avatar"]["name"]);
                $target_file = $target_dir . $id . "." . end($extension);
                $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
                $userUpload = "sim";
        
                if (!move_uploaded_file($_FILES["avatar"]["tmp_name"], $target_file)) {
                    $uploadOk = False;
                    $_SESSION['messageReceived'] = "Houve um erro a dar upload do ficheiro";
                }
            }
            //Check password iguais ja resgistado FALTA METER EM JS NO CLIENT
            if ($uploadOk) {
                $uploadQuery = "insert into productsd values ('$id','$name', '$category', '$user','$descricao' , '$color', '$utility', '$gender', $price ,0, '$userUpload');";
        
                $upload = mysqli_multi_query($conn, $uploadQuery);
        
                if(!$upload)
                    die("Error, insert query failed:" . $uploadQuery);

                for($i = 0; $i<count($label); $i++) {
                        $tam = $label[$i];
                        $quant = $values[$i];
                        $sql="insert into stocksstores values('$id', '$tam',$quant)";
                        $result = mysqli_query($conn, $sql);
                        if (!$result) {
                            die('Invalid query: ' . $sql);
                        }
                }

                header('Location: ../myproducts.php');
            }
    }

    if (isset($_POST["adicionar4"])) {
        $name = $_POST["name"];
        $category = $_POST["category"];
        $color = $_POST["color"];
        $descricao = $_POST["descricao"];
        $utility = $_POST["utility"];
        $gender =  $_POST["gender"];
        $stock = $_POST["stock"];
        $price = $_POST["price"];

        if(empty($_POST["stockUnico"])){
            $stockUnico = 0;
        }
        else{
            $stockUnico = $_POST["stockUnico"];
        }
        

        $number = rand(0,100000); 

            $id = "DEF" . $number;

            $idQuery="select id from productsd WHERE id='$id'";
            $checkId = mysqli_query($conn, $idQuery);

            if(mysqli_num_rows($checkId)>0) {
                $_SESSION['messageReceived'] = "O registo deu erro, tente novamente";
                header('Location: ../myproducts.php');
            }
        
            $uploadOk = True;
            $userUpload = NULL;
            if ($_FILES['avatar']['size'] != 0) {
                //upload image
                $target_dir = "../productsImage/";
                $extension = explode(".", $_FILES["avatar"]["name"]);
                $target_file = $target_dir . $id . "." . end($extension);
                $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
                $userUpload = "sim";
        
                if (!move_uploaded_file($_FILES["avatar"]["tmp_name"], $target_file)) {
                    $uploadOk = False;
                    $_SESSION['messageReceived'] = "Houve um erro a dar upload do ficheiro";
                }
            }
            //Check password iguais ja resgistado FALTA METER EM JS NO CLIENT
            if ($uploadOk) {
                $uploadQuery = "insert into productsd values ('$id','$name', '$category', '$user','$descricao' , '$color', '$utility', '$gender', $price ,0, '$userUpload');";
        
                $upload = mysqli_multi_query($conn, $uploadQuery);
        
                if(!$upload)
                    die("Error, insert query failed:" . $uploadQuery);

                $sql="insert into stocksstores values('$id', 'U',$stockUnico)";
                $result = mysqli_query($conn, $sql);
                if (!$result) {
                    die('Invalid query: ' . $sql);
                }

                header('Location: ../myproducts.php');
            }
    }

    if (isset($_POST["editCategory1"])){
        $xs = $_POST['XS'];
        $s = $_POST['S'];
        $m = $_POST['M'];
        $l = $_POST['L'];
        $xl = $_POST['XL'];

        $updateQuery = "update stocksstores set quantidade= $xs where tamanho='XS';
                        update stocksstores set quantidade= $s where tamanho='S';
                        update stocksstores set quantidade= $m where tamanho='M';
                        update stocksstores set quantidade= $l where tamanho='L';
                        update stocksstores set quantidade= $xl where tamanho='XL';";
        
        $checkUpdate = mysqli_multi_query($conn, $updateQuery);

        if(!$checkUpdate)
                    die("Error, insert query failed:" . $updateQuery);
        
        header('Location: ../myproducts.php');
    }

    if (isset($_POST["editCategory2"])){
        $_32 = $_POST['32'];
        $_34 = $_POST['34'];
        $_36 = $_POST['36'];
        $_38 = $_POST['38'];
        $_40 = $_POST['40'];
        $_42 = $_POST['42'];
        $_44 = $_POST['44'];
        $_46 = $_POST['46'];
        $_48 = $_POST['48'];
        $_50 = $_POST['50'];

        $updateQuery = "update stocksstores set quantidade= $_32 where tamanho='32';
                        update stocksstores set quantidade= $_34 where tamanho='34';
                        update stocksstores set quantidade= $_36 where tamanho='36';
                        update stocksstores set quantidade= $_38 where tamanho='38';
                        update stocksstores set quantidade= $_40 where tamanho='40';
                        update stocksstores set quantidade= $_42 where tamanho='42';
                        update stocksstores set quantidade= $_44 where tamanho='44';
                        update stocksstores set quantidade= $_46 where tamanho='46';
                        update stocksstores set quantidade= $_48 where tamanho='48';
                        update stocksstores set quantidade= $_50 where tamanho='50';";
        
        $checkUpdate = mysqli_multi_query($conn, $updateQuery);

        if(!$checkUpdate)
                    die("Error, insert query failed:" . $updateQuery);
        
        header('Location: ../myproducts.php');
    }

    if (isset($_POST["editCategory3"])){
        $_34 = $_POST['34'];
        $_35 = $_POST['35'];
        $_36 = $_POST['36'];
        $_37 = $_POST['37'];
        $_38 = $_POST['38'];
        $_39 = $_POST['39'];
        $_40 = $_POST['40'];
        $_41 = $_POST['41'];
        $_42 = $_POST['42'];
        $_43 = $_POST['43'];
        $_44 = $_POST['44'];
        $_45 = $_POST['45'];
        $_46 = $_POST['46'];
        $_47 = $_POST['47'];

        $updateQuery = "update stocksstores set quantidade= $_34 where tamanho='34';
                        update stocksstores set quantidade= $_35 where tamanho='35';
                        update stocksstores set quantidade= $_36 where tamanho='36';
                        update stocksstores set quantidade= $_37 where tamanho='37';
                        update stocksstores set quantidade= $_38 where tamanho='38';
                        update stocksstores set quantidade= $_39 where tamanho='39';
                        update stocksstores set quantidade= $_40 where tamanho='40';
                        update stocksstores set quantidade= $_41 where tamanho='41';
                        update stocksstores set quantidade= $_42 where tamanho='42';
                        update stocksstores set quantidade= $_43 where tamanho='43';
                        update stocksstores set quantidade= $_44 where tamanho='44';
                        update stocksstores set quantidade= $_45 where tamanho='45';
                        update stocksstores set quantidade= $_46 where tamanho='46';
                        update stocksstores set quantidade= $_47 where tamanho='47';";
        
        $checkUpdate = mysqli_multi_query($conn, $updateQuery);

        if(!$checkUpdate)
                    die("Error, insert query failed:" . $updateQuery);
        
        header('Location: ../myproducts.php');
    }

    if (isset($_POST["editCategory4"])){
        $tam = $_POST['U'];


        $updateQuery = "update stocksstores set quantidade= $tam where tamanho='U'";
        
        $checkUpdate = mysqli_query($conn, $updateQuery);

        if(!$checkUpdate)
                    die("Error, insert query failed:" . $updateQuery);
        
        header('Location: ../myproducts.php');
    }
    
?>