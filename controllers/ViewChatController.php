<?php
    include_once '../config/connection_db.php';
    include_once '../models/Conversation.php';
    include_once '../models/Message.php';
    include_once '../models/User.php';

    $friendId = $_GET['friendId'];  // Obtener el ID del amigo con el que se está abriendo el chat

    // Obtener los datos del usuario
    session_start();
    $email = $_SESSION['email'];
    $user = User::getUserData($connection, $email);

    // Obtener los mensajes de la conversación entre el usuario y el amigo
    $conversation = Conversation::getConversation($connection, $user->getId(), $friendId);
    $messages = Message::getMessages($connection, $conversation->getId());

    // Mostrar los mensajes en el contenedor del chat de amigo
    foreach ($messages as $message) {
        $senderId = $message->getSenderId();
        $additionalClass = ($senderId == $user->getId()) ? 'sent' : 'received';  // Agregar la clase 'sent' si el mensaje fue enviado por el usuario actual, de lo contrario, agregar la clase 'received'
        $additionalClassDate = ($senderId == $user->getId()) ? 'sentDate' : 'receivedDate';
        echo "<p class='$additionalClass'>" . $message->getMessage() . "</p>";
        echo "<p class='$additionalClassDate'><small>". $message->getSentAt() ."</small></p>";
    }
?>