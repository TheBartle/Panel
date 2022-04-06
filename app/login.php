<?php
if ((!isset($_POST['login'])) || (!isset($_POST['password'])))
{
    header('Location: ../');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    require_once "./helpers/database.php";

    $login = htmlentities(base64_decode($_POST['login']), ENT_QUOTES, "UTF-8");
    $password = htmlentities(base64_decode($_POST['password']), ENT_QUOTES, "UTF-8");


    try {
        session_start();
        $conn = new mysqli($db_host, $db_login, $db_password, $db_name);

        if ($conn -> connect_errno) {
            die("Błąd połączenia z bazą: ". $conn -> connect_errno);
            exit();
        }

        $sql = "SELECT users.id, users.login, users.password, users.name FROM users WHERE users.login = '$login'";
        $result = $conn -> query($sql);
        if ($result -> num_rows > 0) {
            $row = $result -> fetch_assoc();

            if (password_verify($password, $row["password"])) {
                echo "Hasło się zgadza z użytkownikiem w bazie";

                $_SESSION['logged'] = true;

                $_SESSION['uid'] = $row['id'];
                $_SESSION['uname'] = $row['name'];

                header('Location: ./');
            } else {
                $_SESSION['error_password'] = "<strong>Błędne</strong> hasło";
                header('Location: ../');
                exit();
            }
        } else {
            $_SESSION['error_login'] = "<strong>Błędny</strong> login";
            header('Location: ./');
            exit();
        }



    } catch (Exception $e) {
        echo "Error: ".$e;
    }

    $conn -> close();
}
    