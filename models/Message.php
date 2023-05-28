<?php
    class Message {
        private $id;
        private $conversationId;
        private $senderId;
        private $message;
        private $sentAt;
        
        public function __construct($id, $conversationId, $senderId, $message, $sentAt) {
            $this->id = $id;
            $this->conversationId = $conversationId;
            $this->senderId = $senderId;
            $this->message = $message;
            $this->sentAt = $sentAt;
        }
        
        public function getId() {
            return $this->id;
        }
        
        public function getConversationId() {
            return $this->conversationId;
        }
        
        public function getSenderId() {
            return $this->senderId;
        }
        
        public function getMessage() {
            return $this->message;
        }
        
        public function getSentAt() {
            return $this->sentAt;
        }
        
        public static function getMessages($connection, $conversationId) {
            // Query para obtener los mensajes de una conversación
            $query = "SELECT * FROM messages WHERE conversation_id = $conversationId ORDER BY sent_at ASC";
            $result = $connection->query($query);
            
            $messages = array();
            if ($result && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $message = new Message($row['id'], $row['conversation_id'], $row['sender_id'], $row['message'], $row['sent_at']);
                    $messages[] = $message;
                }
            }
            
            return $messages;
        }

        public function saveMessage($connection) {
            // Obtiene la fecha y hora actual en formato MySQL
            $sentAt = date('Y-m-d H:i:s');
        
            // Query para guardar el mensaje en la base de datos
            $query = "INSERT INTO messages (conversation_id, sender_id, message, sent_at) VALUES ($this->conversationId, $this->senderId, '$this->message', '$sentAt')";
            $connection->query($query);
        }      
    }
?>