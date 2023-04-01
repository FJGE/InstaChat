<?php
    class Post {
        private $id;
        private $content;
        private $image_url;
        private $date;
        private $user_id;
    
        public function __construct($id, $content, $image_url, $date, $user_id) {
            $this->id = $id;
            $this->content = $content;
            $this->image_url = $image_url;
            $this->date = $date;
            $this->user_id = $user_id;
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