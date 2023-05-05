<?php 
    include_once '../config/connection_db.php';
    include_once '../models/User.php';
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
                //Mostrar nombre del usuario que ha iniciado sesión
                if(isset($email)) {
                    $obtainUser = $connection->query('SELECT * FROM `users` WHERE `email` = "' . $email . '"');

                    if($userData = $obtainUser->fetch_all(MYSQLI_ASSOC)) {
                        $user = new User($userData[0]['username'], $userData[0]['email'], $userData[0]['password'], $userData[0]['cpassword'], $userData[0]['profile_picture']);

                        $photo = $user->getProfilePhoto();

                        echo "<img src=\"$photo\">";
                        echo '<h3>'.$user->getUsername().'</h3>';
                    }
                }
            ?>
    </main>

    <script src="../resources/js/searchUsers.js"></script>
</body>
</html>