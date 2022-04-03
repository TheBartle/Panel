<?php
session_start();

if ((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany'] == true))
{
    header('Location: app');
    exit();
}

?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <title>Logowanie do Panelu</title>
    <link rel="stylesheet" href="assets/css/login.css">
</head>
<body>
<main>
    <div class="container" id="container">

        <div class="card">
            <div class="card-body">
                <h4 class="card-title text-center mb-4 mt-1">Logowanie do panelu</h4>
                <hr>
<!--                <p class="text-success text-center">Error message</p>   dodać php error-->
                <form id="form" method="POST" action="app/login.php">
                    <div class="form-group">
                        <div class="input-group">
                            <input name="username" id="username" class="form-control" placeholder="Nazwa użytkownika" type="text" required="required" minlength="3">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <input name="password" id="password" class="form-control" placeholder="Hasło" type="password" required="required" minlength="6">
                        </div>
                    </div>
                    <div class="form-group">
                        <button id="submit" type="submit" class="btn btn-primary btn-block">Zaloguj</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
<script src="assets/js/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(() => {
        $('#username').val("");
        $('#password').val("");

        $("#form").submit(function() {
            let userPut = $("#username")
            let user = userPut.val()
            userPut.val(btoa(user))

            let passPut = $("#password")
            let pass = passPut.val()
            passPut.val(btoa(pass))
        })
    })
</script>
</body>
</html>