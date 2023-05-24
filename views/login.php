<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>InstaChat - Inicio Sesión</title>
        <link rel="stylesheet" href="../resources/css/style.css">
    </head>
    <body id="RegLog">
        <div class="container">
            <section class="grid-columns">
                <form action="../controllers/LoginController.php" method="POST">
                    <?php
                        //Verificar si existe la cookie con el mensaje de error
                        if(isset($_COOKIE['error'])) {
                            echo '<p class="error-message">' . $_COOKIE['error'] . '</p>';
                            //Borrar la cookie
                            setcookie("error", "", time() - 3600, "/");
                        }
                        if(isset($_COOKIE['success'])) {
                            echo '<p class="success-message">' . $_COOKIE['success'] . '</p>';
                            //Borrar la cookie
                            setcookie("success", "", time() - 3600, "/");
                        }
                    ?>

                    <label for="email">Correo electrónico:</label>
                    <input type="email" id="email" name="email" placeholder="ejemplo@gmail.com" required /><br />

                    <label for="password">Contraseña:</label>
                    <input type="password" id="password" name="password" placeholder="Contraseña" required /><br />

                    <input type="submit" value="Iniciar Sesión" name="submit" />
                </form>

                <img src="../resources/imgs/login.img.jpg" alt="Persona haciendo Login en una red social" width="100%">
            </section>
        </div>    
    </body>
</html>