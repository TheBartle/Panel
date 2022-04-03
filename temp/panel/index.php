<?php
session_start();

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: ../");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 14px sans-serif; text-align: center; }
    </style>
</head>
<body>
<h1 class="my-5">MORDO, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Witaj w saginie.</h1>
<p>
    <a href="createDB.php" class="btn btn-success mr-3">MORDO UTWURZ SOBIE BAZUNIE</a>
    <a href="reset-password.php" class="btn btn-warning">M_o_r_d_o zresetuj hasło</a>
    <a href="logout.php" class="btn btn-danger ml-3">Wyloguj się</a>
</p>
</body>
</html>