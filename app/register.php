<?php
require_once "helpers/database.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && (isset($_POST['name']) && (isset($_POST['login']) && isset($_POST['password']) && isset($_POST['password2'])))) {

    $debug = true;

    session_start();
    $all_good = true;

    //LOGIN VALIDATION
    $login = $_POST['login'];

    if ((strlen($login) < 3) || (strlen($login) > 20)) {
        $all_good = false;
        $_SESSION['error_login'] = "Login musi posiadać od 3 do 20 znaków";
    }

    if (!ctype_alnum($login)) {
        $all_good = false;
        $_SESSION['error_login'] = "Login może składać się <strong>tylko</strong> z liter i cyfr (bez polskich znaków)";
    }

    //NAME VALIDATION
    $name =htmlentities($_POST['name']);

    if ((strlen($name) < 3) || (strlen($name) > 20)) {
        $all_good = false;
        $_SESSION['error_name'] = "Imie musi posiadać od 3 do 20 znaków";
    }

    //PASSWORD VALIDATION
    $password = htmlentities($_POST['password']);
    $password2 = htmlentities($_POST['password2']);

    $uppercase = preg_match('@[A-Z]@', $password);
    $lowercase = preg_match('@[a-z]@', $password);
    $number    = preg_match('@[0-9]@', $password);
    $specialChars = preg_match('/[\'^£$%&\/*()}!{@#~?><>,|=_+¬-]/', $password);

    if (strlen($password) < 8 || strlen($password2) > 32 || !$uppercase || !$lowercase || !$number || !$specialChars) {
        $all_good = false;
        $_SESSION['error_password'] = "Hasło musi posiadać od 8 do 32 znaków oraz zawierać przynajmniej jedną dużą literę, jeden numerek i jeden znak specjalny. (#,_,@,&,*)";
    }

    if (strpos($password, $login)) {
        $all_good = false;
        $_SESSION['error_password'] = "Hasło <strong>nie</strong> może być podobne do loginu";
    }

    if (strpos($password, $name)) {
        $all_good = false;
        $_SESSION['error_password'] = "Hasło <strong>nie</strong> może być podobne do nazwy użytkownika";
    }

    if ($password != $password2) {
        $all_good = false;
        $_SESSION['error_password'] = "Hasła <strong>muszą</strong> być identyczne";
    }
    echo "ALL GOOD:".$all_good;

    if($all_good) {
        try {
            $conn = mysqli_connect($db_host, $db_login, $db_password, $db_name);
            if($conn == true) {
                if (mysqli_num_rows($result = mysqli_query($conn, "SELECT users.name FROM users WHERE `login` = \"{$name}\"; ")) > 0) {
                    echo "Taki user istnieje";
                    $_SESSION['error_userExists'] = "Użytkownik istnieje";
                } else {
                    $password = password_hash($password, PASSWORD_BCRYPT);
                    if ($result = mysqli_query($conn, "INSERT INTO users (name, login, password) VALUES (\"{$name}\", \"{$login}\", \"{$password}\");")) {
                        mysqli_close($conn);
                        //Przenieś do strony udana resjestracja i przejdź do strony logowania
                    } else {
                        echo "Error " . mysqli_error($conn);
                    }
                }
            }
        } catch (Exception $e) {
            if ($debug) {
                echo "<span style=\"color: red;\"> {$e} </span>";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Formularz rejestracji</title>
    <?php include "templates/css.php"?>
    <link rel="stylesheet" href="../assets/css/forms.css">
</head>

<body>
<section class="sform">
    <div class="form-container">
        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>">
            <h2 class="text-center"><strong>Utwórz konto</strong></h2>

            <div class="mb-3"><input class="form-control" type="text" name="name" placeholder="Imie" required="required" minlength="3" maxlength="20"/></div>
            <?php if (isset($_SESSION['error_name'])) {
                echo "<div class=\"mb-3 text-danger\"><p>{$_SESSION['error_name']}</p></div>";
                unset($_SESSION['error_name']);
            }?>

            <div class="mb-3"><input class="form-control" type="text" name="login" placeholder="Login" required="required" minlength="3" maxlength="20"/></div>
            <?php if (isset($_SESSION['error_login'])) {
                echo "<div class=\"mb-3 text-danger\"><p>{$_SESSION['error_login']}</p></div>";
                unset($_SESSION['error_login']);
            }?>

            <div class="mb-3"><input class="form-control" type="password" name="password" placeholder="Hasło" required="required" minlength="8" maxlength="32"></div>
            <?php if (isset($_SESSION['error_password'])) {
                echo "<div class=\"mb-3 text-danger\"><p>{$_SESSION['error_password']}</p></div>";
                unset($_SESSION['error_password']);
            }?>

            <div class="mb-3"><input class="form-control" type="password" name="password2" placeholder="Powtórz hasło" required="required" minlength="8" maxlength="32"></div>
            <div class="mb-3"><button class="btn btn-primary d-block w-100" type="submit">Zatwierdź</button></div>
        </form>
    </div>
</section>

<?php include "templates/footer.php"?>
</body>
</html>