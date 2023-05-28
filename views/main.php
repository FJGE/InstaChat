<?php 
    include_once '../config/connection_db.php';
    include_once '../models/User.php';
    include_once '../models/Friend.php';
    include_once '../models/Conversation.php';
    include_once '../models/Message.php';
    include_once '../config/functions.php';
    session_start();
    $email = $_SESSION['email'];

    if (!isset($_SESSION['email'])) {
        header("Location: ../index.php");
        exit;
    }
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

            <!-- Botones para editar perfil y finalizar sesión -->
            <div>
                <a href="./profile.php" class="card edit-profile">
                    <div><span class="material-symbols-outlined">face_retouching_natural</span></div>
                    <div>Editar Perfil</div>
                </a>
                <a href="./logout.php" class="card logout">
                    <div><span class="material-symbols-outlined">logout</span></div>
                    <div><p>Cerrar sesión</p></div>
                </a>
            </div>
        </div>

        <!-- Mostrar chat cuando se hace click en un amigo -->
        <div id="chat-container">
            <div class="chat-messages">
                <?php
                    foreach ($messages as $message) {
                        echo "<p>" . $message->getMessage() . "</p>";
                    }
                ?>
            </div>
            <div class="chat-input">
                <input type="text" id="message-input" placeholder="Escribe un mensaje...">
                <button id="send-button" type="button">Enviar</button>
            </div>
        </div>

        <div class="friends">
            <!-- Buscar Usuarios -->
            <form method="GET" action="../controllers/SearchUsersController.php" enctype="multipart/form-data">
                <input type="text" name="search" placeholder="Buscar amigos...">
                <button type="submit">
                    <span class="material-symbols-outlined">search</span>
                </button>
            </form>

            <?php
                // Mostrar los amigos del usuario
                $friendData = Friend::getFriendData($connection, $user->getId());

                echo "<div>";
                echo "<p>Amigos: </p><br>";
                foreach ($friendData as $friend) {
                    $friendId = $friend['id'];
                
                    echo "<a href='chat.php?friendId=$friendId' class='card friend-card' id='$friendId' data-id='$friendId'>";
                    echo "<div class='smallAvatar'><img src='" . $friend['profile_picture'] . "'></div>";
                    echo "<p>".$friend['username']."</p>";
                    echo "</a>";
                }
                echo "</div>";
            ?>
        </div>
    </main>

    <script src="../resources/js/chat.js"></script>
    <script src="../resources/js/send-message.js"></script>
</body>
</html>