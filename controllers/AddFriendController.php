<?php
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

        // Agregar como amigo
        $added = Friend::addFriend($connection, $userId, $friendId);

        if ($added) {
            // Amigo agregado correctamente
            echo "Friend added successfully";
            header("Location: ../views/main.php");
        } 
        
        else {
            // Error al agregar amigo
            echo "Error adding friend";
            header("Location: ../views/main.php");
        }
    }
?>