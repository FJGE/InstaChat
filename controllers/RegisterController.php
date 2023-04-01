<?php
    include_once '../config/connection_db.php';
    include_once '../models/User.php';

    if (isset($_POST['submit'])) {
        if(!empty($_POST['username']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['cpassword'])) {
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $cPassword = $_POST['cpassword'];

            $newUser = new User($username, $email, $password, $cPassword);

            // Verificar si el correo ya existe
            $getEmail = $connection->query("SELECT * FROM users WHERE email = '$email'");
            if ($getEmail->fetch_all()) {
                setcookie("error", "El correo ya está registrado", time() + 3600, "/");
                header("Location: ../views/register.php");
                exit;
            }

            //Verificar si la constraseña y el confirmar contraseña son iguales
            if($newUser->getPassword() !== $newUser->getCPassword()) {
                //Mostrar error de contraseña no coincidente
                setcookie("error", "Las contraseñas no coinciden", time() + 3600, "/");
                header("Location: ../views/register.php");
            }

            else {
                $query_insert = "INSERT INTO users (username, email, password, cpassword) VALUES ('$username', '$email', '$password', '$cPassword')";

                if (mysqli_query($connection, $query_insert)) {
                    header("Location: ../views/main.php");
                }

                mysqli_close($connection);
            }
        }
    }
?>