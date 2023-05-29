<?php 
    include_once '../config/connection_db.php';
    include_once '../models/User.php';

    session_start();
    $email = $_SESSION['email'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>InstaChat - Perfil</title>
    <link rel="stylesheet" href="../resources/css/style.css">
</head>
<body id="profile">
    <main>
        <section class="container">
            <div class="grid-columns">
                <div class="avatar">
                    <?php
                        //Mostrar el usuario que ha iniciado sesión
                        if(isset($email)) {
                            $user = User::getUserData($connection, $email);

                            $photo = $user->getProfilePhoto();
                
                            echo "<div class='profileAvatar'>";
                            echo "<img src=\"$photo\">";
                            echo "</div>";
                            echo '<h3>'.$user->getUsername().'</h3>';
                        }
                    ?>

                    <a href="./main.php">Volver a Inicio</a>
                </div>
    
                <?php
                    $obtainUser = $connection->query('SELECT * FROM `users` WHERE `email` = "' . $email . '"');
                    
                    if($userData = $obtainUser->fetch_all(MYSQLI_ASSOC)) {
                        $user = new User($userData[0]['id'], $userData[0]['username'], $userData[0]['email'], $userData[0]['password'], $userData[0]['cpassword'], $userData[0]['profile_picture']);
                    }

                    if (isset($_COOKIE['error'])) {
                        $error = $_COOKIE['error'];
                        setcookie('error', '', time() - 3600, '/'); // Eliminar la cookie
                    }
                ?>

                <div>
                    <?php if (isset($error)) : ?>
                        <div class="error-message"><?php echo $error; ?></div>
                    <?php endif; ?>
                
                    <label for="Email">Correo Electronico</label>
                    <input type="email" value="<?php echo $user->getEmail(); ?>" readonly>
                    
                    <form action="../controllers/UpdateProfileController.php" method="post" enctype="multipart/form-data">
                        <label for="username">Nombre de Usuario:</label>
                        <input type="text" name="username" value="<?php echo $user->getUsername(); ?>">
    
                        <label for="password">Nueva Contraseña:</label>
                        <input type="password" name="password" min="8" max="16">
    
                        <label for="cpassword">Confirmación nueva contraseña:</label>
                        <input type="password" name="cpassword" min="8" max="16">
    
                        <label for="new-photo">Nueva foto de perfil:</label>
                        <input type="file" name="new-photo">
                    
                        <button type="submit">Actualizar perfil</button>
                    </form>
                </div>
            </div>
        </section>
    </main>
</body>
</html>