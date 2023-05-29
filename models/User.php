<?php
    class User
    {
        private $id;
        private $username;
        private $email;
        private $password;
        private $cPassword;
        private $profilePhoto;

        function __construct($id, $username, $email, $password, $cPassword, $profilePhoto) {
            $this->id = $id;
            $this->username = $username;
            $this->email = $email;
            $this->password = $password;
            $this->cPassword = $cPassword;
            $this->profilePhoto = $profilePhoto;
        }
    
        public function getId() {
            return $this->id;
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

        public function setPassword($password) {
            $this->password = $password;
        }

        public function setCPassword($cPassword) {
            $this->cPassword = $cPassword;
        }

        public function setProfilePhoto($profilePhoto) {
            $this->profilePhoto = $profilePhoto;
        }

        public static function getUserData($connection, $email) {
            $obtainUser = $connection->query('SELECT id, username, email, password, cpassword, profile_picture FROM `users` WHERE `email` = "' . $email . '"');
            if($userData = $obtainUser->fetch_all(MYSQLI_ASSOC)) {
                $user = new User($userData[0]['id'], $userData[0]['username'], $userData[0]['email'], $userData[0]['password'], $userData[0]['cpassword'], $userData[0]['profile_picture']);
                return $user;
            }
        }
    }
?>