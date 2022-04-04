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
    <title>Logowanie do Panelu</title>
    <?php include "app/templates/css.php"?>
    <link rel="stylesheet" href="assets/css/forms.css">
</head>
<body>
<main>
    <section class="sform" id="container">

        <div class="form-container">
            <form method="post">
                <h2 class="text-center"><strong>Logowanie do panelu</strong></h2>
                <div class="mb-3"><input class="form-control" type="text" name="login" placeholder="Login" required="required" minlength="3" maxlength="24"/></div>
                <div class="mb-3"><input class="form-control" type="password" name="password" placeholder="Hasło" required="required" minlength="8"></div>
                <div class="mb-3"><button class="btn btn-primary d-block w-100" type="submit">Zaloguj się</button></div>
            </form>
        </div>

    </section>
</main>

<?php include "app/templates/footer.php"?>


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