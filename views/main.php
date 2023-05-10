<?php 
    include_once '../config/connection_db.php';
    include_once '../models/User.php';
    include_once '../models/Friend.php';
    include_once '../models/Post.php';
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
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body id="mainPage">
    <main class="grid-columns">
        <div class="side-bar">
            <?php
                //Mostrar el usuario que ha iniciado sesión
                if(isset($email)) {
                    $user = User::getUserData($connection, $email);
                    $photo = $user->getProfilePhoto();
                
                    echo "<div class='card user-card'>";
                    echo "<div class='smallAvatar'><img src=\"$photo\"></div>";
                    echo '<p><b>'.$user->getUsername().'</b></p>';
                    echo "</div>";
                }
                
                else {
                    echo "<p>No has iniciado sesión.</p>";
                }
            ?>

            <div>
                <a href="./profile.php" class="card edit-profile">
                    <div>
                        <span class="material-symbols-outlined">face_retouching_natural</span>
                    </div>
                    <div>
                        Editar Perfil
                    </div>
                </a>
                <a href="./logout.php" class="card logout">
                    <div>
                        <span class="material-symbols-outlined">logout</span>
                    </div>
                    <div>
                        <p>Cerrar sesión</p>
                    </div>
                </a>
            </div>
        </div>

        <div class="chatting">

        </div>

        <div class="friends">
            <?php
                // Mostrar los amigos del usuario
                $friendData = Friend::getFriendData($connection, $user->getId());

                echo "<div>";
                echo "<p>Amigos: </p><br>";
                foreach ($friendData as $friend) {
                    echo "<div class='card friend-card'>"; 
                    echo "<div class='smallAvatar'><img src='" . $friend['profile_picture'] . "'></div>";
                    echo "<p>".$friend['username']."</p>";
                    echo "</div>";
                }
                echo "</div>";
            ?>
        </div>
    </main>
</body>
</html>