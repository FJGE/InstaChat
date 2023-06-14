<?php
    ob_start();
    include_once '../config/connection_db.php';
    include_once '../models/Friend.php';
    include_once '../models/User.php';

    session_start();

    if (!isset($_SESSION['email'])) {
        header("Location: ../index.php");
        exit;
    }

    $email = $_SESSION['email'];
    $user = User::getUserData($connection, $email);

    if (isset($_GET['friendId'])) {
        $friendId = $_GET['friendId'];
        $userId = $user->getId();

        // Verificar si el usuario ya es tu amigo
        $friendData = Friend::getFriendData($connection, $userId);
        $isFriend = false;
        foreach ($friendData as $friend) {
            if ($friend['id'] == $friendId) {
                $isFriend = true;
                break;
            }
        }

        if ($isFriend) {
            // El usuario ya es tu amigo
            echo "El usuario ya es tu amigo";
            header("refresh:5;url=../views/main.php");
            exit;
        } else {
            // Agregar como amigo
            $added = Friend::addFriend($connection, $userId, $friendId);

            if ($added) {
                // Amigo agregado correctamente
                echo "Amigo agregado exitosamente";
                header("refresh:5;url=../views/main.php");
                exit;
            } else {
                // Error al agregar amigo
                echo "Error al agregar amigo";
                header("refresh:5;url=../views/main.php");
                exit;
            }
        }
    }
    ob_end_flush();
?>