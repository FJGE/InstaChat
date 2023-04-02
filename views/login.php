<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>InstaChat - Registro</title>
        <link rel="stylesheet" href="../resources/css/style.css">
    </head>
    <body>
        <?php
            //Verificar si existe la cookie con el mensaje de error
            if(isset($_COOKIE['error'])) {
                echo '<p class="error-message">' . $_COOKIE['error'] . '</p>';
                //Borrar la cookie
                setcookie("error", "", time() - 3600, "/");
            }
        ?>

        <form action="../controllers/LoginController.php" method="POST">
            <label for="email">Correo electrónico:</label>
            <input type="email" id="email" name="email" required /><br />

            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" required /><br />

            <input type="submit" value="Iniciar Sesión" name="submit" />
        </form>
    </body>
</html>