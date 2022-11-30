<?php
session_start();

if (isset($_SESSION["user_id"])) {
    $mysqli = require __DIR__ . "/connection.php";

    $sql = "SELECT * FROM tbl_user where id ={$_SESSION["user_id"]}";;

    $result = $mysqli->query($sql);
    $user = $result->fetch_assoc();
}
?>





<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/boxicons.min.css">
    <link rel="stylesheet" href="css/style.css">


    <title>Home</title>
</head>

<body id="page-top">

    <?php require 'components/navbar.inc.php'; ?>

    <header class="masthead">
        <div class="container text-center">
            <div class="d-flex justify-content-center">
                <div class="col-md-10">
                    <h1 class="text-white display-4">Welcome</h1>
                    <p class="text-white"></p>

                    <?php
                    if (!isset($_SESSION["user_id"])) :
                    ?>
                        <a href="signup.html" class="btn btn-primary btn-brand">Join Us Now</a>
                    <?php
                    endif;
                    ?>
                </div>
            </div>
        </div>

    </header>







</body>
<script src="js/bootstrap.bundle.min.js"></script>

</html>