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
<body>
    <main>
        <section class="container">
            <div class="grid-columns">
                <div>
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
                ?>

                <div>
                    <label for="Email">Email</label>
                    <input type="email" value="<?php echo $user->getEmail(); ?>" readonly>
                    
                    <form action="../controllers/UpdateProfileController.php" method="post" enctype="multipart/form-data">
                        <label for="username">Username:</label>
                        <input type="text" name="username" value="<?php echo $user->getUsername(); ?>">
    
                        <label for="password">New Password:</label>
                        <input type="password" name="password">
    
                        <label for="cpassword">Confirm New Password:</label>
                        <input type="password" name="cpassword">
    
                        <label for="new-photo">New Profile Photo:</label>
                        <input type="file" name="new-photo">
                    
                        <button type="submit">Update Profile</button>
                    </form>
                </div>
            </div>
        </section>
    </main>
</body>
</html>