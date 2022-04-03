<?php
    if ((!isset($_POST['username'])) || (!isset($_POST['password'])))
    {
        header('Location: ../');
        exit();
    }

    require_once "./helpers/database.php";

    $login = htmlentities(base64_decode($_POST['username']), ENT_QUOTES, "UTF-8");
    $password = htmlentities(base64_decode($_POST['password']), ENT_QUOTES, "UTF-8");


