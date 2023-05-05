<?php
    class User
    {
        private $username;
        private $email;
        private $password;
        private $cPassword;
        private $profilePhoto;

        function __construct($username, $email, $password, $cPassword, $profilePhoto) {
            $this->username = $username;
            $this->email = $email;
            $this->password = $password;
            $this->cPassword = $cPassword;
            $this->profilePhoto = $profilePhoto;
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

        public function getProfilePhoto() {
            return $this->profilePhoto;
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

        public function setProfilePhoto($profilePhoto) {
            $this->profilePhoto = $profilePhoto;
        }
    }
?>