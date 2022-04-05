<?php
session_start();
if (!isset($_SESSION['registered'])) {
    header('Location: register.php');
}
?>

<!doctype html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Rejestracja udana</title>
    <?php include "app/templates/css.php" ?>
</head>
<body>
<main>
    <style>
        .center {
            position: absolute;
            top: 50%;
            transform: translate(0, -50%);
            padding: 10px;
        }
    </style>
    <div class="center text-center">
        <h1 class="display-3">Rejestracja udana</h1>
        <p>Zaloguj się</p>
    </div>
</main>
<?php include "app/templates/footer.php" ?>
<script>
    setTimeout(function () {
        window.location.href= './';

    },5000);
</script>
</body>
</html>
<?php header( "refresh:6;url=./" );?>
