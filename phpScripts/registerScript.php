<?php
  session_start();
  include "accessBD.php";

  //Register
  if (isset($_POST["registerLa"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $hashed_password = sha1($password);
    $email = $_POST["email"];
    $question = $_POST["question"];
    $answer = $_POST["resposta"];
    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $gender = $_POST["gender"];
    $birthday = $_POST["birthday"];
    $country = $_POST["country"];
    //Check user ja resgistado
    $usernameQuery="select storename from stores WHERE storeName='$username' union select username from users WHERE username='$username'";
    $checkUsername = mysqli_query($conn, $usernameQuery);

    if(mysqli_num_rows($checkUsername)>0) {
      $_SESSION['messageReceived'] = "Nome de utilizador $username já existe. Tente outro nome!";
      header('Location: ../register.php');
    }
  
    else {
      //Check email ja resgistado
      $emailQuery="select * from users WHERE email='$email'";
      $checkEmail = mysqli_query($conn, $emailQuery);

      if(mysqli_num_rows($checkEmail)>0) {
        $_SESSION['messageReceived'] = "Email $email já se encontra registado. Tente outro email!";
        header('Location: ../register.php');
      }

      else {
        $uploadOk = True;
        $userUpload = NULL;
        if ($_FILES['avatar']['size'] != 0) {
          //upload image
          $target_dir = "../userImages/";
          $extension = explode(".", $_FILES["avatar"]["name"]);
          $target_file = $target_dir . $username . "." . end($extension);
          $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
          $userUpload = "sim";

          if (!move_uploaded_file($_FILES["avatar"]["tmp_name"], $target_file)) {
            $uploadOk = False;
            $_SESSION['messageReceived'] = "Houve um erro a dar upload do ficheiro";
            header('Location: ../register.php');
          }
        }

        //Check password iguais ja resgistado FALTA METER EM JS NO CLIENT
        if ($password == $_POST["passwordConfirm"] && $uploadOk) {


          $registerQuery = "insert INTO users VALUES ('$username', '$hashed_password', '$email', '$firstName', '$lastName', '$gender', '$birthday', '$country','$question','$answer','Free','$userUpload')";

          $register = mysqli_query($conn, $registerQuery);

          if(!$register)
            die("Error, insert query failed:" . $registerQuery);
            header('Location: ../register.php');
          }

        else {
          $_SESSION['messageReceived'] = "Passwords não compativeis";
          header('Location: ../register.php');
        }
      }

    }
  }

  mysqli_close($conn);
  header('Location: ../index.php');

  ?>