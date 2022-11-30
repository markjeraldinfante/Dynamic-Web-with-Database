<?php
if (isset($_GET['id'])) {
    $mysqli = require __DIR__ . "/connection.php";
    $account = mysqli_real_escape_string($mysqli, $_GET['id']);


    $sql = "DELETE FROM tbl_user WHERE id = '$account'";
    $result = $mysqli->query($sql);

    $sql = "ALTER TABLE tbl_user AUTO_INCREMENT = 1;";
    $result = $mysqli->query($sql);

    echo "Account Deleted";
    session_start();
    if($result)
    {
        $_SESSION['message'] = "Account Deleted Successfully";
    }
    else
    {
        $_SESSION['message'] = "Account Deletion Failed";
    }
    
    header("Location: accounts.php");
    exit(0);
}
?>