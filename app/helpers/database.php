<?php

    $db_host = "localhost";
    $db_name = "app";
    $db_login = "root";
    $db_password = "";

    $conn = mysqli_connect($db_host, $db_login, $db_password, $db_name);

    if($conn == false) {
        die("ERROR: Could not connect. ". mysqli_connect_error());
    }

