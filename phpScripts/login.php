<?php
  session_start();
  $conn = mysqli_connect("127.0.0.1","root","","pdsiseg");




  //Login
  if (isset($_POST["login"])) {
    $name = $_POST["username"];
    $password = $_POST["password"];


    $usernameQuery="select * from users WHERE username='$name'";
    $checkUsername = mysqli_query($conn, $usernameQuery);

    if(mysqli_num_rows($checkUsername)==0) {
      $storenameQuery="select * from stores WHERE storename='$name'";
      $checkStorename = mysqli_query($conn, $storenameQuery);

      if(mysqli_num_rows($checkStorename)==0) {
        $_SESSION['messageReceived'] = "Nome de utilizador $name não se encontra registado";
        header('Location: ../index.php');
      }

      else {
    	  $passwordQuery = "select * from stores Where storename = '$name'";

    	  $passwordLogin = mysqli_query($conn, $passwordQuery);

        $row = mysqli_fetch_array($passwordLogin);

        $hashed_password = sha1($password);

        if ($hashed_password == $row["password"]) {
          $_SESSION['username'] = $name;
          header('Location: ../myproducts.php');
        }

        else {
          $_SESSION['messageReceived'] = 'Password nao corresponde';
          header('Location: ../index.php');
        }
      }
    }

    else {
    	$passwordQuery = "select * from users Where username = '$name'";

    	$passwordLogin = mysqli_query($conn, $passwordQuery);

      $row = mysqli_fetch_array($passwordLogin);

      $hashed_password = sha1($password);

      if ($hashed_password == $row["password"]) {
         $_SESSION['username'] = $name;
         header('Location: ../mycloset.php');
      }

      else {
        $_SESSION['messageReceived'] = 'Password nao corresponde';
        header('Location: ../index.php');
    	}
    }
  }

  mysqli_close($conn);
?>
