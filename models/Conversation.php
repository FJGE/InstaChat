<?php
    class Conversation {
        private $id;
        private $user1Id;
        private $user2Id;

        public function __construct($id, $user1Id, $user2Id) {
            $this->id = $id;
            $this->user1Id = $user1Id;
            $this->user2Id = $user2Id;
        }

        public function getId() {
            return $this->id;
        }

        public function getUser1Id() {
            return $this->user1Id;
        }

        public function getUser2Id() {
            return $this->user2Id;
        }

        public static function getConversation($connection, $user1Id, $user2Id) {
            // Query para obtener la conversación entre dos usuarios
            $query = "SELECT * FROM conversations WHERE (user1_id = $user1Id AND user2_id = $user2Id) OR (user1_id = $user2Id AND user2_id = $user1Id)";
            $result = $connection->query($query);
        
            // Obtener los datos de la conversación
            if ($result && $result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $conversation = new Conversation($row['id'], $row['user1_id'], $row['user2_id']);
                return $conversation;
            } else {
                // Si no se encuentra la conversación, se llama a la función para crearla
                return self::createConversation($connection, $user1Id, $user2Id);
            }
        }
        
        public static function createConversation($connection, $user1Id, $user2Id) {
            // Query para crear una nueva conversación
            $query = "INSERT INTO conversations (user1_id, user2_id) VALUES ($user1Id, $user2Id)";
            $connection->query($query);
            $conversationId = $connection->insert_id;
            $conversation = new Conversation($conversationId, $user1Id, $user2Id);
            return $conversation;
        }
    }
?>