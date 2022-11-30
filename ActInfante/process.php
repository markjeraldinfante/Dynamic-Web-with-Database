<?php

session_start();

if (empty($_POST["first_name"])) {
    $_SESSION['message'] = "First Name is required";
    CheckActivity();
}
if (empty($_POST["last_name"])) {
    $_SESSION['message'] = "Last Name is required";
    CheckActivity();
}
if (empty($_POST["gender"])) {
    $_SESSION['message'] = "Please choose a Gender";
    CheckActivity();
}
if (empty($_POST["birth_date"])) {
    $_SESSION['message'] = "Please enter a valid Birthdate";
    CheckActivity();
}
if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
    $_SESSION['message'] = "Enter a valid Email Address";
    CheckActivity();
}
if (strlen($_POST["password"]) < 8) {
    $_SESSION['message'] = "Password must contain at least 8 Characters!";
    CheckActivity();
}
if (!preg_match("/[a-z]/i", $_POST["password"])) {
    $_SESSION['message'] = "Password must contain at least one letter!";
    CheckActivity();
}
if (!preg_match("/[0-9]/", $_POST["password"])) {
    $_SESSION['message'] = "Password must contain at least one number!";
    CheckActivity();
}
if ($_POST["password"] !== $_POST["password_confirmation"]) {
    $_SESSION['message'] = "Password must match!";
    CheckActivity();
}

function CheckActivity()
{
    if (isset($_POST['update_account'])) {
        $account = $_GET['account'];
        header("Location: accounts-edit.php?id=" . $account);
        exit(0);
    }elseif (isset($_POST['add_account'])) {
        header("Location: signup.html");
        exit(0);
    }
}

if (isset($_POST["is_admin"])) {
    $account_type = 1;
} else {
    $account_type = 0;
}

$password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);

$mysqli = require __DIR__ . "/connection.php";



if (isset($_POST['update_account'])) {
    $account = $_GET['account'];
    $sql = "UPDATE tbl_user SET first_name = ?,last_name = ?,gender = ?,birth_date = ?,email = ?,password_hash = ?,account_type = ? 
    WHERE id = '$account'";
}
if (isset($_POST['add_account'])) {
    $sql = "INSERT INTO tbl_user (first_name,last_name,gender,birth_date,email,password_hash,account_type) values (?,?,?,?,?,?,?)";
}





$stmt = $mysqli->stmt_init();

if (!$stmt->prepare($sql)) {
    die("SQL error:" . $mysqli->error);
}



print_r($_POST);
var_dump($password_hash);

$stmt->bind_param(
    "sssssss",
    $_POST["first_name"],
    $_POST["last_name"],
    $_POST["gender"],
    $_POST["birth_date"],
    $_POST["email"],
    $password_hash,
    $account_type,
);

$success = $stmt->execute();

if (isset($_POST['update_account'])) {
    echo "Update Successful";
    if ($success) {

        $_SESSION['message'] = "Account Updated Successfully!";
    } else {

        $_SESSION['message'] = "Account Updated Successfully!";
    }
    header("Location: accounts.php");
    exit(0);
}
if (isset($_POST['add_account'])) {

    $_SESSION['message'] = "Account Updated Successfully!";
    header("Location: signup-success.html");
}
