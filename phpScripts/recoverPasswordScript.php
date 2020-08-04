<?php
  session_start();
  include "accessBD.php";

  if(isset($_POST["recover"])){
    $user = $_POST["recover"];
    $token = $_POST["token"];
    $pass = sha1($_POST["password"]);
    $confirmPass = sha1($_POST["passwordConfirm"]);
    $_SESSION['messageReceived'] = "$token";
    if ($pass == $confirmPass){
        $updateQuery = "update users set password='$pass' where username='$user';
                        delete from reset_token where token='$token'";
        $checkUpdate = mysqli_multi_query($conn, $updateQuery);
        if(!$checkUpdate)
            die("Error, insert query failed:" . $updateQuery);

        $_SESSION['messageReceived'] = "$token";
        header('Location: ../index.php');
    }
    else{
        $_SESSION['messageReceived'] = "Passwords não compativeis";
    }
  }

?>