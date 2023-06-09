<?php
    class Friend {
        private $id;
        private $user_1;
        private $user_2;
    
        public function __construct($id, $user_1, $user_2) {
            $this->id = $id;
            $this->user_1 = $user_1;
            $this->user_2 = $user_2;
        }
    
        public function getRelationId() {
            return $this->id;
        }

        public function getUser_1() {
            return $this->user_1;
        }

        public function getUser_2() {
            return $this->user_2;
        }

        public static function getFriendData($connection, $user_id) {
            $obtainFriendsUser = $connection->query("SELECT users.id, users.username, users.profile_picture FROM friends INNER JOIN users ON friends.user_2 = users.id WHERE friends.user_1 = $user_id");

            $friendData = $obtainFriendsUser->fetch_all(MYSQLI_ASSOC);
            return $friendData;
        }

        public static function addFriend($connection, $user_1, $user_2) {
            $query = "INSERT INTO friends (user_1, user_2) VALUES ($user_1, $user_2)";
            $result = $connection->query($query);
    
            if ($result) {
                $connection->query("INSERT INTO friends (user_1, user_2) VALUES ($user_2, $user_1)");
                return true; // El amigo se agregó correctamente
            } 
            
            else {
                return false; // Hubo un error al agregar el amigo
            }
        }
    }
?>