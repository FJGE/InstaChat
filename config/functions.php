<?php
    include_once 'connection_db.php';
    include_once '../models/User.php';

    function createCookie($name, $message, $destination) {
        setcookie($name, $message, time() + 3600, "/");
        header($destination);
    }

    function ViewProfile($connection, $email, $class) {
        $obtainUser = $connection->query('SELECT * FROM `users` WHERE `email` = "' . $email . '"');

        if($userData = $obtainUser->fetch_all(MYSQLI_ASSOC)) {
            $user = new User($userData[0]['username'], $userData[0]['email'], $userData[0]['password'], $userData[0]['cpassword'], $userData[0]['profile_picture']);

            $photo = $user->getProfilePhoto();
            
            echo "<div class='$class'>";
            echo "<img src=\"$photo\">";
            echo "</div>";
            echo '<h3>'.$user->getUsername().'</h3>';
        }
    }
?>