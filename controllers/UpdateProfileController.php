<?php
    include_once '../config/connection_db.php';
    include_once '../models/User.php';
    include_once '../config/functions.php';
    session_start();

    $email = $_SESSION['email'];

    $profilePicture = $_FILES['new-photo'];
    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];

    // Obtener los datos actuales del usuario a través del correo electrónico
    $obtainUser = $connection->query('SELECT * FROM `users` WHERE `email` = "' . $email . '"');
    if($userData = $obtainUser->fetch_all(MYSQLI_ASSOC)) {
        $user = new User($userData[0]['username'], $userData[0]['email'], $userData[0]['password'], $userData[0]['cpassword'], $userData[0]['profile_picture']);
    }

    // Actualizar los campos
    if (isset($_POST['username']) && $_POST['username'] != $user->getUsername()) {
        $user->setUsername($_POST['username']);
    }

    if (isset($_POST['password']) && $_POST['password'] != '') {
        $user->setPassword($_POST['password']);
    } 
    
    else {
        $user->setPassword($user->getPassword());
    }
    
    if (isset($_POST['cpassword']) && $_POST['cpassword'] != $user->getCPassword()) {
        $user->setCPassword($_POST['cpassword']);
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
        $profilePicture = $user->getprofilePhoto();
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