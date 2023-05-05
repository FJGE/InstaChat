<?php 
    include_once '../config/connection_db.php';
    include_once '../models/User.php';
    include_once '../config/functions.php';
    session_start();
    $email = $_SESSION['email'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>InstaChat - Home</title>
    <link rel="stylesheet" href="../resources/css/style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@48,400,0,0" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

    <main class="grid-columns">
        <div>
            <?php
                //Mostrar el usuario que ha iniciado sesión
                if(isset($email)) {
                    ViewProfile($connection, $email, $class = "smallAvatar");
                }
            ?>

            <a href="./profile.php">Ver perfil</a>
    </main>

    <script src="../resources/js/searchUsers.js"></script>
</body>
</html>