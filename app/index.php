<?php
    session_start();
    if (!isset($_SESSION['logged']))
    {
        header("Location: ../");
        exit();
    }
?>
<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Panel</title>
    <?php include "templates/css.php" ?>
</head>

<body>
<main>
    <div class="container">
        <h1 class="display-3">Dzień dobry <?php echo $_SESSION['uname'] ?>!</h1>
        <a href="logout.php">Wyloguj się</a>
    </div>

    <form>
        <input type="date" class="form-control">
    </form>
</main>

<?php include "templates/footer.php" ?>
</body>
</html>