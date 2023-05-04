<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>InstaChat - Registro</title>
        <link rel="stylesheet" href="../resources/css/style.css">
    </head>
    <body id="RegLog">
        <?php
        //Verificar si existe la cookie con el mensaje de error
        if(isset($_COOKIE['error'])) {
            echo '<p class="error-message">' . $_COOKIE['error'] . '</p>';
            //Borrar la cookie
            setcookie("error", "", time() - 3600, "/");
        }
        ?>

        <div class="container">
            <section class="grid-columns">
                <form action="../controllers/RegisterController.php" method="POST">
                    <label for="profile-picture">Foto de perfil:</label>
                    <input type="file" id="profile-picture" name="profile-picture">

                    <label for="username">Nombre de usuario:</label>
                    <input type="text" id="username" name="username" required /><br />
        
                    <label for="email">Correo electrónico:</label>
                    <input type="email" id="email" name="email" required /><br />
        
                    <label for="password">Contraseña:</label>
                    <input type="password" id="password" name="password" required /><br />
        
                    <label for="cpassword">Confirmar contraseña:</label>
                    <input type="password" id="cpassword" name="cpassword" required /><br />
        
                    <input type="submit" value="Registrarse" name="submit" />
                </form>
            </section>
        </div>
    </body>
</html>