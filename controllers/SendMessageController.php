<?php
    include_once '../config/connection_db.php';
    include_once '../models/Message.php';
    include_once '../models/Conversation.php';
    session_start();
    
    
    
    // Obtén los datos del formulario de envío de mensajes
    $friendId = $_POST['friendId'];
    $message = $_POST['message'];
    
    // Obtén el ID del usuario actual
    $email = $_SESSION['email'];
    $user = User::getUserData($connection, $email);
    $userId = $user->getId();
    
    //Obtener el ID de la conversación
    $conversation = Conversation::getConversation($connection, $userId, $friendId);
    $conversationId = $conversation->getId();

    echo "<script>console.log('ID de la conversación: $conversationId');</script>";


    // Crea una nueva instancia de Message y guarda el mensaje en la base de datos
    $newMessage = new Message(null, $conversationId, $userId, $message, null);
    $newMessage->saveMessage($connection);
?>