<?php
    $host = "localhost";
    $user = "root";
    $password = "";
    $dbname = "instachat";

    $connection = mysqli_connect($host, $user, $password, $dbname);


    if (!$connection) {
        die("Error de conexión: " . mysqli_connect_error());
    }

    mysqli_set_charset($connection, "utf8");
?>