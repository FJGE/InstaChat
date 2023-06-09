<?php
    include_once '../config/connection_db.php';
    include_once '../config/functions.php';
    include_once '../models/User.php';
    session_start();

    $email = $_SESSION['email'];

    $profilePicture = $_FILES['new-photo'];
    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];

    // Obtener los datos actuales del usuario a través del correo electrónico
    $user = User::getUserData($connection, $email);

    // Actualizar los campos
    if (isset($_POST['username']) && $_POST['username'] != $user->getUsername()) {
        $user->setUsername($_POST['username']);
    }

    if (isset($_POST['password']) && $_POST['password'] != '' && $_POST['password'] != $user->getPassword()) {
        $user->setPassword($_POST['password']);
    }
    
    if (isset($_POST['cpassword']) && $_POST['cpassword'] != '' && $_POST['cpassword'] != $user->getCPassword()) {
        $user->setCPassword($_POST['cpassword']);
    }

    if ($_POST['password'] != $_POST['cpassword']) {
        // Las contraseñas no coinciden, mostrar un error
        $error = "Las contraseñas no coinciden";
        createCookie("error", $error, "Location: ../views/profile.php");
        exit();
    }

    if (isset($_FILES['new-photo']) && $_FILES['new-photo']['name'] != "") {
        if (in_array($profilePicture['type'], $allowedTypes)) {
            $profilePicturePath = "../resources/imgs/user-profiles/{$profilePicture['name']}";
            $user->setProfilePhoto($profilePicturePath);
            move_uploaded_file($profilePicture['tmp_name'], $profilePicturePath);
            $profilePicture = $profilePicturePath;
        }
    } 
    
    else {
        $profilePicture = $user->getProfilePhoto();
    }

    // Guardar los cambios en la base de datos
    $username = $user->getUsername();
    $password = $user->getPassword();
    $cpassword = $user->getCPassword();

    $updateQuery = "UPDATE `users` SET `username` = '$username', `password` = '$password', `cpassword` = '$cpassword', `profile_picture` = '$profilePicture' WHERE `email` = '$email'";
    $updateResult = $connection->query($updateQuery);

    // Redirigir a la página de perfil
    header('Location: ../views/profile.php');
    mysqli_close($connection);
    exit();
?>