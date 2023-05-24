<?php
    include_once '../config/connection_db.php';
    include_once '../models/Conversation.php';
    include_once '../models/Message.php';
    include_once '../models/User.php';  // Agrega la inclusión de User.php si aún no está incluido

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
        echo "<p>" . $message->getMessage() . "</p>";
    }
?>