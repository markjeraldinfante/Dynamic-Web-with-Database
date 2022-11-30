<?php session_start();

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


    <title>Edit Account</title>
</head>

<body>
    <?php require 'components/navbar.inc.php'; ?>
    <section id="edit">
        <header class="masthead">
            <div class="container">
                <div class="row">
                    <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
                        <div class="card border-0 shadow rounded-3 my-5">
                            <div class="card-body p-4 p-sm-5">
                                <h5 class="card-title text-center mb-5 fw-light fs-5">Edit Account</h5>
                                <?php include 'components/message.inc.php'; ?>
                                <?php

                                if (isset($_GET['id'])) {
                                    $mysqli = require __DIR__ . "/connection.php";
                                    $account = mysqli_real_escape_string($mysqli, $_GET['id']);



                                    $sql = "SELECT * FROM tbl_user where id = '$account'";

                                    $result = $mysqli->query($sql);

                                    if (mysqli_num_rows($result) > 0) {
                                        $account = mysqli_fetch_array($result);
                                ?>
                                        <form action="process.php?account=<?= $account['id']; ?>" method="post" novalidate>
                                            <div class="d-flex ">
                                                <div class="flex-fill form-floating mb-3 firstcol">
                                                    <input type="text" class="form-control" id="floatingInput" placeholder="First Name" name="first_name" value="<?= $account['first_name']; ?>">
                                                    <label for="floatingInput">First Name</label>
                                                </div>
                                                <div class="flex-fill form-floating mb-3">
                                                    <input type="text" class="form-control" id="floatingInput" placeholder="Last Name" name="last_name" value="<?= $account['last_name']; ?>">
                                                    <label for="floatingInput">Last Name</label>
                                                </div>

                                            </div>
                                            <div class="d-flex ">
                                                <div class="flex-fill form-floating mb-3 firstcol">

                                                    <select class="form-control" id="floatingInput" name="gender" id="gender" name="gender" value="<?= $account['gender']; ?>">

                                                        <option value="male">Male</option>
                                                        <option value="female">Female</option>
                                                        <option value="rather not say">Rather not say</option>
                                                    </select>
                                                    <label for="floatingInput">Gender</label>
                                                </div>
                                                <div class="flex-fill form-floating date mb-3">
                                                    <input type="date" class="form-control" id="floatingInput" placeholder="March 4, 2000" name="birth_date" value="<?= $account['birth_date']; ?>">
                                                    <label for="floatingInput">Birth Date</label>
                                                </div>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name="email" value="<?= $account['email']; ?>">
                                                <label for="floatingInput">Email address</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="password">
                                                <label for="floatingPassword">Password</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="password_confirmation">
                                                <label for="floatingPassword">Confirm Password</label>
                                            </div>

                                            <div class="form-check mb-3 d-flex justify-content-center">
                                                <input class="form-check-input firstcol" type="checkbox" name="is_admin" id="account_type">
                                                <label class="form-check-label" for="account_type">
                                                    Admin Account
                                                </label>
                                            </div>

                                            <div class="d-grid">
                                                <button class="btn btn-signup btn-primary btn-login text-uppercase fw-bold" type="submit" name="update_account">Update Account</button>
                                            </div>

                                        </form>
                                <?php
                                    } else {
                                        echo "<h4> No such ID found </h4>";
                                    }
                                }

                                ?>


                            </div>

                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </header>

    </section>

</body>
<script src="js/bootstrap.bundle.min.js"></script>

</html>