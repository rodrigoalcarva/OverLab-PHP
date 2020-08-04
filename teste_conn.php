<?php
$lig = mysqli_connect("127.0.0.1","user4","whitenoise","grupo4");

$res=mysqli_query($lig,"select * from users");

$row = mysqli_fetch_row($res);

echo $row[0];



?>

