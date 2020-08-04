<?php
  session_start();
  include "accessBD.php";
  $name = $_SESSION["username"];
  $deleteQuery = "delete from cesto where idUsername='$name'";
  $checkDelete = mysqli_multi_query($conn, $deleteQuery);

  unset($_SESSION);
  session_destroy();
  header('Location: ../index.php');
?>
