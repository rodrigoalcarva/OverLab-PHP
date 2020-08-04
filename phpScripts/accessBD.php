<?php
$dbhost = "127.0.0.1";
$dbuser = "root";
$dbpass = "";
$dbname = "pdsiseg";
$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

  if (mysqli_connect_error()) {
    die("Database connection failed:".mysqli_connect_error());
  }
?>
