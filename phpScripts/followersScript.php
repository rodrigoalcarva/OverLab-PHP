<?php

session_start();
include "accessBD.php";

$name = $_SESSION['username'];

if(isset($_REQUEST["term"])){
    // Prepare a select statement
    $sql = "select * FROM users WHERE username LIKE ? and username NOT like '$name'";
    
    if($stmt = mysqli_prepare($conn, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "s", $param_term);
        
        // Set parameters
        $param_term = $_REQUEST["term"] . '%';
        
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
            
            // Check number of rows in the result set
            if(mysqli_num_rows($result) > 0){
                // Fetch result rows as an associative array
                while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                    echo "<p>" . $row["username"] . "</p>";
                }
            } else{
                echo "<p>No matches found</p>";
            }
        } else{
            echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
        }
    }
     
    // Close statement
    mysqli_stmt_close($stmt);
}

if (isset($_POST["addFollower"])){
    $nameFollow = $_POST["person"];

    $followQuery ="select * from followers where idSeguidor='$name' and idSeguido='$nameFollow'";
    $checkFollow = mysqli_query($conn, $followQuery);

    if(mysqli_num_rows($checkFollow)>0) {
        $_SESSION['messageReceived'] = "Já segue essa pessoa";
    }
    else{

        $addFollowQuery = " insert into followers VALUES ('$name','$nameFollow','pendente')";

        $checkAddFollow = mysqli_multi_query($conn, $addFollowQuery);

        if(!$checkAddFollow)
            die("Error, insert query failed:" . $addFollowQuery);
    }

    header('Location: ../followers.php');

}
 
if (isset($_POST["confirm"])){
    $idSeguidor = $_POST["confirm"];
    $updateFollowQuery = "update followers SET estado_seguir='confirmado' WHERE idSeguidor='$idSeguidor' and idSeguido='$name'";

    $checkUpdateFollow = mysqli_multi_query($conn, $updateFollowQuery);

    if(!$checkUpdateFollow)
        die("Error, insert query failed:" . $updateFollowQuery);

    header('Location: ../followers.php');

}

if (isset($_POST["reject"])){
    $idSeguidor = $_POST["reject"];
    $deleteFollowQuery = "delete FROM followers WHERE idSeguidor='$idSeguidor' and idSeguido='$name'";

    $checkDeleteFollow = mysqli_multi_query($conn, $deleteFollowQuery);

    if(!$checkDeleteFollow)
        die("Error, insert query failed:" . $deleteFollowQuery);

    header('Location: ../followers.php');

}

if (isset($_POST["unfollow"])){
    $idSeguido = $_POST["unfollow"];
    $deleteFollowQuery = "delete FROM followers WHERE idSeguidor='$name' and idSeguido='$idSeguido'";

    $checkDeleteFollow = mysqli_multi_query($conn, $deleteFollowQuery);

    if(!$checkDeleteFollow)
        die("Error, insert query failed:" . $deleteFollowQuery);

    header('Location: ../followers.php');
}






// close connection
mysqli_close($conn);
?>