<?php
    class Post {
        private $id;
        private $user_id_1;
        private $user_id_2;
    
        public function __construct($id, $user_id_1, $user_id_2) {
            $this->id = $id;
            $this->user_id_1 = $user_id_1;
            $this->user_id_2 = $user_id_2;
        }
    
        public function __get($property) {
            if (property_exists($this, $property)) {
                return $this->$property;
            }
        }
    
        public function __set($property, $value) {
            if (property_exists($this, $property)) {
                $this->$property = $value;
            }
        }
    }
?>