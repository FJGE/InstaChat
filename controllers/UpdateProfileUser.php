<?php
    include_once '../config/connection_db.php';
    include_once '../models/User.php';
    include_once '../config/functions.php';
    session_start();

    $email = $_SESSION['email'];

    $profilePicture = $_FILES['profile-picture'];
    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];

    // Obtener los datos actuales del usuario a través del correo electrónico
    $obtainUser = $connection->query('SELECT * FROM `users` WHERE `email` = "' . $email . '"');
    if($userData = $obtainUser->fetch_all(MYSQLI_ASSOC)) {
        $user = new User($userData[0]['username'], $userData[0]['email'], $userData[0]['password'], $userData[0]['cpassword'], $userData[0]['profile_picture']);
    }

    // Actualizar los campos
    if (isset($_POST['username'])) {
        $user->setUsername($_POST['username']);
    }

    if (isset($_POST['password'])) {
        $user->setPassword($_POST['password']);
    }

    if (isset($_POST['cpassword'])) {
        $user->setCPassword($_POST['cpassword']);
    }

    if (isset($_FILES['profile_photo'])) {
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];

        if (in_array($profilePicture['type'], $allowedTypes)) {
            $profilePicturePath = "../resources/imgs/user-profiles/{$profilePicture['name']}";
            move_uploaded_file($profilePicture['tmp_name'], $profilePicturePath);
            $profilePhoto = $profilePicture['name'];
        }
    }

    // Guardar los cambios en la base de datos
    $username = $user->getUsername();
    $password = $user->getPassword();
    $cpassword = $user->getCPassword();
    $profilePhoto = isset($profilePhoto) ? $profilePhoto : $user->getProfilePhoto();

    $updateQuery = "UPDATE `users` SET `username` = '$username', `password` = '$password', `cpassword` = '$cpassword', `profile_picture` = '$profilePhoto' WHERE `email` = '$email'";
    $updateResult = $connection->query($updateQuery);

    // Redirigir a la página de perfil
    header('Location: ../views/profile.php');
    exit();
?>