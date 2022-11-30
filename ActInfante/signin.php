<?php
$is_invalid = false;
    if($_SERVER["REQUEST_METHOD"]==="POST"){
    
    $mysqli = require __DIR__ . "/connection.php";
    $sql =sprintf("select * from tbl_user
                            where email ='%s'",
                            $mysqli->real_escape_string($_POST["email"]));
    
    $result = $mysqli->query($sql);

    $user = $result -> fetch_assoc();


    if($user){
    if(password_verify($_POST["password"], $user["password_hash"])){
        
        session_start();

        session_regenerate_id();

        $_SESSION["user_id"] = $user["id"];

        header("Location: index.php");
        exit;
    }
}
    $is_invalid = true;
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


    <title>Sign In</title>
</head>

<body style="background-image: url('img/bg-main.jpg');">
    <section id="login">
        <header class="masthead">
            <div class="container">
                <div class="row">
                    <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
                        <div class="card border-0 shadow rounded-3">
                            <div class="card-body p-4 p-sm-5">
                                <h5 class="card-title text-center mb-5 fw-light fs-5">Sign In</h5>
                                <?php if($is_invalid): ?>
                                <em>Invalid Credentials</em>
                                <?php endif; ?>
                                <form method="post">
                                    <div class="form-floating mb-3" method="post">
                                        <input type="email" class="form-control" id="floatingInput"
                                            placeholder="name@example.com" name="email"
                                            value="<?= htmlspecialchars($_POST["email"] ?? "") ?>">
                                        <label for="floatingInput">Email address</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="password" class="form-control" id="floatingPassword"
                                            placeholder="Password" name="password">
                                        <label for="floatingPassword">Password</label>
                                    </div>

                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="checkbox" value=""
                                            id="rememberPasswordCheck">
                                        <label class="form-check-label" for="rememberPasswordCheck">
                                            Remember password
                                        </label>
                                    </div>
                                    <div class="d-grid">
                                        <button class="btn btn-signin btn-primary btn-login text-uppercase fw-bold"
                                            type="submit">Sign
                                            in</button>
                                    </div>
                                    <hr class="my-4">
                                    <h6 class="text-center form-label">Don't have an account?</h6>
                                    <div class="d-grid">
                                        <button onclick="location.href='signup.html'"
                                            class="btn btn-signup btn-primary btn-login text-uppercase fw-bold"
                                            type="button">Sign Up</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </header>
    </section>
</body>
<script src="js/bootstrap.bundle.min.js"></script>

</html>