<?php 
    include_once '../config/connection_db.php';
    include_once '../models/User.php';
    include_once '../config/functions.php';
    session_start();
    $email = $_SESSION['email'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>InstaChat - Home</title>
    <link rel="stylesheet" href="../resources/css/style.css">
</head>
<body>
    <main>
        <section class="container">
            <div class="grid-columns">
                <?php
                    //Mostrar el usuario que ha iniciado sesión
                    if(isset($email)) {
                        ViewProfile($connection, $email, $class = "profileAvatar");
                    }
                ?>
            </div>
    
            <?php
                $obtainUser = $connection->query('SELECT * FROM `users` WHERE `email` = "' . $email . '"');
    
                if($userData = $obtainUser->fetch_all(MYSQLI_ASSOC)) {
                    $user = new User($userData[0]['username'], $userData[0]['email'], $userData[0]['password'], $userData[0]['cpassword'], $userData[0]['profile_picture']);
                }
            ?>
    
            <div class="grid-columns">
                <label for="Email">Email</label>
                <input type="Email" value="<?php echo $user->getEmail(); ?>" readonly>
                
                <form action="../controllers/UpdateProfileUser.php" method="post" enctype="multipart/form-data">
                    <label for="username">Username:</label>
                    <input type="text" name="username" value="<?php echo $user->getUsername(); ?>">
                    
                    <label for="oldpassword">Contraseña Antigua:</label>
                    <input type="text" name="oldpassword" value="<?php echo $user->getPassword(); ?>" readonly>
    
                    <label for="password">New Password:</label>
                    <input type="password" name="password">
                    
                    <label for="cpassword">Confirm New Password:</label>
                    <input type="password" name="cpassword">
    
                    <label for="profile_photo">New Profile Photo:</label>
                    <input type="file" name="profile_photo">
                
                    <button type="submit">Update Profile</button>
                </form>
            </div>
        </section>
    </main>
</body>
</html>