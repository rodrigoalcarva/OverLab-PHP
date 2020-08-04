<?php
  session_start();
  include "accessBD.php";

  $user = $_SESSION["username"];

  // Adicionar Peça Manual
    if (isset($_POST["criar"])) {
        $name = $_POST['name'];

        $createQuery = " insert INTO wishlists VALUES (NULL,'$user','$name')";

        $create = mysqli_multi_query($conn, $createQuery);

        if(!$create)
            die("Error, insert query failed:" . $createQuery);

    }

    if (isset($_POST["apagar"])) {
        $idWishlist = $_POST['apagar'];
        $deleteQuery = " delete FROM wishlists WHERE idWishlist='$idWishlist';
                        delete FROM products_wishlist WHERE idWishlist='$idWishlist'";

        $delete = mysqli_multi_query($conn, $deleteQuery);

        if(!$deleteQuery)
            die("Error, insert query failed:" . $deleteQuery);

    }

    if (isset($_POST["apagarProdWish"])) {
        $myArray = explode(',', $_POST["apagarProdWish"]);
        $idWish = $myArray[0];
        $idProd = $myArray[1];

        $deleteQuery = " delete FROM products_wishlist WHERE idWishlist='$idWish' and idProduct='$idProd'";

        $delete = mysqli_multi_query($conn, $deleteQuery);

        if(!$deleteQuery)
            die("Error, insert query failed:" . $deleteQuery);

    }

    mysqli_close($conn);
    header('Location: ../wishlist.php');

?>
