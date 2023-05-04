<?php
    include_once '../config/connection_db.php';
    include_once '../models/User.php';
    include_once '../config/functions.php';

    $profilePicture = $_FILES['profile-picture'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cPassword = $_POST['cpassword'];
    $newUser = new User($username, $email, $password, $cPassword);

    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];

    if (in_array($profilePicture['type'], $allowedTypes)) {
        $profilePicturePath = "../resources/imgs/user-profiles/{$profilePicture['name']}";
        move_uploaded_file($profilePicture['tmp_name'], $profilePicturePath);
    } 
    
    else {
        createCookie("error", "La imagen de perfil debe ser en formato JPG, PNG o GIF", "../views/register.php");
    }

    if(!empty($_POST['username']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['cpassword'])) {
        $getEmail = $connection->query("SELECT * FROM users WHERE email = '$email'");
        if ($getEmail->fetch_all()) {
            createCookie("error", "El correo ya está registrado", "../views/register.php");
        }

        if($newUser->getPassword() !== $newUser->getCPassword()) {
            createCookie("error", "Las contraseñas no coinciden", "../views/register.php");
        }
        
        else {
            $query_insert = "INSERT INTO users (username, email, password, cpassword, profile_picture) VALUES ('$username', '$email', '$password', '$cPassword', '$profilePicturePath')";
            if (mysqli_query($connection, $query_insert)) {
                header("Location: ../views/login.php");
            } 
            
            else {
                createCookie("error", "No se pudo insertar el usuario en la base de datos", "../views/register.php");
            }
            mysqli_close($connection);
        }
    }
?>