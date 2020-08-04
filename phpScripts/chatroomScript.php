<?php

session_start();
include "accessBD.php";

$name = $_SESSION['username'];

if(isset($_POST["sendMessage"])){
    $message = $_POST['message'];
    $id_send = $_POST['sendMessage'];
    date_default_timezone_set('Europe/Lisbon');
    $dateA = date('m/d/Y h:i:s a', time());

    $addMessageQuery = "insert into chat values ('$name', '$id_send','$message','$dateA')";

    $addMessage = mysqli_query($conn, $addMessageQuery);

    if(!$addMessage)
        die("Error, insert query failed:" . $addMessageQuery);

    header("Location: ../chatroom.php?name=$id_send");
}

?>