<?php session_start();

if (isset($_SESSION["user_id"])) {
    $mysqli = require __DIR__ . "/connection.php";

    $sql = "SELECT * FROM tbl_user where id ={$_SESSION["user_id"]}";
    ;

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

<body>
<?php require 'components/navbar.inc.php'; ?>
    <section>
        <header class="masthead">
            <div class="container">
                <div class="row">
                    <div class="col-sm-9 col-md-7 col-lg-5 mx-auto ">
                        <div class="card border-0 shadow rounded-3" >
                            <div class="card-body p-4 p-sm-5">
                                <h5 class="card-title text-center mb-5 fw-light fs-5">View Account</h5>
                                <?php

                                if (isset($_GET['id'])) {
                                    $mysqli = require __DIR__ . "/connection.php";
                                    $account = mysqli_real_escape_string($mysqli, $_GET['id']);



                                    $sql = "SELECT * FROM tbl_user where id = '$account'";

                                    $result = $mysqli->query($sql);

                                    if (mysqli_num_rows($result) > 0) {
                                        $account = mysqli_fetch_array($result);
                                    }
                                }
                                ?>
                                <p>
                                <table class="table table-responsive">
                                    <tr>
                                        <th>Full Name:</th>
                                        <td>
                                            <?= htmlspecialchars($account["first_name"]) ?>
                                                <?= htmlspecialchars($account["last_name"]) ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Gender:</th>
                                        <td style="text-transform: capitalize;">
                                            <?= htmlspecialchars($account["gender"]) ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Birth Date:</th>
                                        <td>
                                            <?= htmlspecialchars($account["birth_date"]) ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Email Address:</th>
                                        <td>
                                            <?= htmlspecialchars($account["email"]) ?>
                                        </td>
                                    </tr>

                                </table>
                                <a href="accounts.php" class="btn d-flex justify-content-centers"
                                    style="text-align: center ;">Back</a>
                                </p>

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