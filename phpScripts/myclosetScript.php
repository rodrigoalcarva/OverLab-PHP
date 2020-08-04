<?php
  session_start();
  include "accessBD.php";

  $user = $_SESSION["username"];

  $userQuery ="select gender from users where username = '$user'";
  $checkUser = mysqli_query($conn, $userQuery);

  $row = mysqli_fetch_array($checkUser);

  $gender = $row[0];
  // Adicionar Peça Manual
    if (isset($_POST["adicionar"])) {
        $name = $_POST["name"];
        $brand = $_POST["brand"];
        $color = $_POST["color"];
        $utility = $_POST["utility"];

        $productQuery="select * from productsu WHERE name='$name' AND brand='$brand' AND color='$color' AND utility='$utility' AND gender='$gender'";
        $checkProduct = mysqli_query($conn, $productQuery);

        if(mysqli_num_rows($checkProduct)>0) {
            while  ($row = mysqli_fetch_array($checkProduct)) {
                $id = $row['id'];
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
                date_default_timezone_set('Europe/Lisbon');
                $dateA = date('m/d/Y h:i:s a', time());
                $uploadQuery = "insert INTO storage
                                VALUES ('$user','$id','$dateA')";

                $upload = mysqli_multi_query($conn, $uploadQuery);

                if(!$upload)
                    die("Error, insert query failed:" . $uploadQuery);
            }

        }
        else{
            $number = rand(0,100000);

            $id = "REF" . $number;

            $idQuery="select id from productsu WHERE id='$id'";
            $checkId = mysqli_query($conn, $idQuery);

            if(mysqli_num_rows($checkId)>0) {
                $_SESSION['messageReceived'] = "O registo deu erro, tente novamente";
                header('Location: ../mycloset.php');
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
                date_default_timezone_set('Europe/Lisbon');
                $dateA = date('m/d/Y h:i:s a', time());
                $uploadQuery = "insert INTO productsu
                                    VALUES ('$id','$name', '$brand', '$color', '$utility', '$gender', '$userUpload');
                                    insert INTO storage
                                    VALUES ('$user','$id','$dateA')";

                $upload = mysqli_multi_query($conn, $uploadQuery);

                if(!$upload)
                    die("Error, insert query failed:" . $uploadQuery);
            }
        }
    }

    // Adicionar Peça Auto
    if (isset($_POST["adicionar1"])) {
        $ref = $_POST["referencia"];

        $prodQuery="select id from productsu WHERE id='$ref'";
        $checkProd = mysqli_query($conn, $prodQuery);

        if (mysqli_num_rows($checkProd)>0){
            $prodUserQuery="select * FROM storage WHERE idUtilizador='$user' AND idStore='$ref'";
            $checkProdUser = mysqli_query($conn, $prodUserQuery);
            if (mysqli_num_rows($checkProdUser)>0){
                $_SESSION['messageReceived'] = "Esse produto já se encontra no seu armário";
                header('Location: ../mycloset.php');
            }
            else{
                date_default_timezone_set('Europe/Lisbon');
                $dateA = date('m/d/Y h:i:s a', time());
                $addQuery = " insert INTO storage
                                 VALUES ('$user','$ref','$dateA')";

                $add = mysqli_multi_query($conn, $addQuery);

                if(!$add)
                    die("Error, insert query failed:" . $addQuery);
            }

        }
        else{
            $_SESSION['messageReceived'] = "Esse produto não existe na nossa Database";
            header('Location: ../mycloset.php');
        }


    }

    // Apagar Peça
    if (isset($_POST["delete"])) {
        $ref = $_POST["delete"];
        $deleteQuery = " delete FROM storage WHERE idUtilizador='$user' AND idStore='$ref'";

        $delete = mysqli_multi_query($conn, $deleteQuery);
        if(!$delete)
                    die("Error, insert query failed:" . $deleteQuery);

    }


    // Adicionar Looks
    if (isset($_POST["adicionarLook3"])) {
        $name1 = $_POST['nameLook1'];
        $type1 = $_POST['typeLook1'];
        $variable1 = $_POST['value1_3'];
        $variable2 = $_POST['value2_3'];
        $variable3 = $_POST['value3_3'];

        $addLookQuery3 = " insert into looks values (NULL,'$user','$name1','$type1','$variable1','$variable2','$variable3','','','')";

        $addLook3 = mysqli_query($conn, $addLookQuery3);

        if(!$addLook3)
            die("Error, insert query failed:" . $addLookQuery3);
    }

    if (isset($_POST["adicionarLook4"])) {
        $name2 = $_POST['nameLook2'];
        $type2 = $_POST['typeLook2'];
        $variable1 = $_POST['value1_4'];
        $variable2 = $_POST['value2_4'];
        $variable3 = $_POST['value3_4'];
        $variable4 = $_POST['value4_4'];

        $addLookQuery4 = " insert into looks values (NULL,'$user','$name2','$typ2','$variable1','$variable2','$variable3','$variable4','','')";

        $addLook4 = mysqli_query($conn, $addLookQuery4);

        if(!$addLook4)
            die("Error, insert query failed:" . $addLookQuery4);
    }

    if (isset($_POST["adicionarLook5"])) {
        $name3 = $_POST['nameLook3'];
        $type3 = $_POST['typeLook3'];
        $variable1 = $_POST['value1_5'];
        $variable2 = $_POST['value2_5'];
        $variable3 = $_POST['value3_5'];
        $variable4 = $_POST['value4_5'];
        $variable5 = $_POST['value5_5'];

        $addLookQuery5 = " insert innto looks values (NULL,'$user','$name3','$type3','$variable1','$variable2','$variable3','$variable4','$variable5','')";

        $addLook5 = mysqli_query($conn, $addLookQuery5);

        if(!$addLook5)
            die("Error, insert query failed:" . $addLookQuery5);
    }

    if (isset($_POST["adicionarLook6"])) {
        $name4 = $_POST['nameLook4'];
        $type4 = $_POST['typeLook4'];
        $variable1 = $_POST['value1_6'];
        $variable2 = $_POST['value2_6'];
        $variable3 = $_POST['value3_6'];
        $variable4 = $_POST['value4_6'];
        $variable5 = $_POST['value5_6'];
        $variable6 = $_POST['value6_6'];

        $addLookQuery6 = " insert into looks values (NULL,'$user','$name4','$type4','$variable1','$variable2','$variable3','$variable4','$variable5','$variable6')";

        $addLook6 = mysqli_query($conn, $addLookQuery6);

        if(!$addLook6)
            die("Error, insert query failed:" . $addLookQuery6);
    }



    mysqli_close($conn);
    header('Location: ../mycloset.php');

?>
