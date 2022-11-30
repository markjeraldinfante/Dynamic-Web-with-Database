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


    <title>Accounts</title>
</head>

<body>

    <?php require 'components/navbar.inc.php'; ?>
    <header class="masthead">
        <div class="container">
            <div class="row">
                <div class=" mx-auto">
                    <div class="card border-0 shadow rounded-3">
                        <div class="card-body p-4 p-sm-5">
                            <h5 class="card-title text-center mb-5 fw-light fs-5">Accounts</h5>
                            <?php include 'components/message.inc.php'; ?>

                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Email</th>
                                        <th>Gender</th>
                                        <th>Account Type</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = "SELECT * FROM tbl_user";
                                    $result = $mysqli->query($sql);

                                    if (mysqli_num_rows($result) > 0) {
                                        foreach ($result as $account) {
                                    ?>
                                            <tr>
                                                <td>
                                                    <?= $account['id']; ?>
                                                </td>
                                                <td>
                                                    <?= $account['first_name']; ?>
                                                </td>
                                                <td>
                                                    <?= $account['last_name']; ?>
                                                </td>
                                                <td>
                                                    <?= $account['email']; ?>
                                                </td>
                                                <td>
                                                    <?= $account['gender']; ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    if ($account['account_type'] == 1) {
                                                    ?>
                                                        Admin
                                                    <?php
                                                    } else {
                                                    ?>
                                                        User
                                                    <?php
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <a href="accounts-view.php?id=<?= $account['id']; ?>" class="btn btn-info btn-sm">View</a>
                                                    <a href="accounts-edit.php?id=<?= $account['id']; ?>" class="btn btn-success btn-sm">Edit</a>

                                                    <a href="delete-account.php?id=<?= $account['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are You Sure ?')">Delete</a>





                                                </td>
                                            </tr>



                                    <?php
                                        }
                                    } else {
                                        echo "<h5> No Users Record Found </h5>";
                                    }

                                    ?>

                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>



    </header>





</body>
<script src="js/bootstrap.bundle.min.js"></script>

</html>