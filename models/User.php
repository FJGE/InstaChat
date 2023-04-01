<?php
    class User
    {
        private $username;
        private $email;
        private $password;
        private $cPassword;

        function __construct($username, $email, $password, $cPassword) {
            $this->username = $username;
            $this->email = $email;
            $this->password = $password;
            $this->cPassword = $cPassword;
        }
    
        public function getUsername() {
            return $this->username;
        }

        public function getEmail() {
            return $this->email;
        }

        public function getPassword() {
            return $this->password;
        }

        public function getCPassword() {
            return $this->cPassword;
        }

        public function setUsername($username) {
            $this->username = $username;
        }

        public function setEmail($email) {
            $this->email = $email;
        }

        public function setPassword($password) {
            $this->password = $password;
        }

        public function setCPassword($cPassword) {
            $this->cPassword = $cPassword;
        }
    }
?>