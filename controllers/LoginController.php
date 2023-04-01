<?php
    include_once '../config/connection_db.php';
    include_once '../models/User.php';
    session_start();

    if (isset($_POST['submit'])) {
        if(!empty($_POST['username']) && !empty($_POST['password'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $getUsername = $connection->query('SELECT * FROM `users` WHERE email = "'.$email.'"');
            
            if($getUsername->fetch_all()){
                $getUser = $connection->query('SELECT * FROM `users` WHERE email = "'.$email.'" AND password = "'.$password.'"');

                if($getUser->fetch_all()) {
                    $User = new User($username, $email, $password, $cPassword);
                    $_SESSION['email'] = $User->getEmail();
    
                    header("Location: ../views/main.php");
                }

                else {
                    setcookie("error", "El correo o contraseña no son correctos", time() + 3600, "/");
                    header("Location: ../views/login.php");
                }
            }

            else {
                setcookie("error", "El usuario no existe", time() + 3600, "/");
                header("Location: ../views/login.php");
            }            
        }
    }
    
    mysqli_close($connection);
?>