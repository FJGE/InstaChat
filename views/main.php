<?php 
    include_once '../config/connection_db.php';
    include_once '../models/User.php';
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>InstaChat - Home</title>
    <link rel="stylesheet" href="../resources/css/style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@48,400,0,0" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

    <main class="grid-columns">
        <div>
            <?php
            //Mostrar nombre del usuario que ha iniciado sesión
            if(isset($_SESSION['email'])) {
                $email = $_SESSION['email'];
                $getUser = $connection->query('SELECT * FROM `users` WHERE email = "'.$email.'"');
                $user = $getUser->fetch_assoc();
                $username = $user['username'];
                $userID = $user['id'];

                echo 'Bienvenido, '.$username;
            }

            //Mostrar nombre de los amigos del usuario
            echo "<br><br>Amigos:<br>";
            
            $getUserFriends = $connection->query("SELECT username FROM users INNER JOIN friends ON (users.ID = friends.user_2) WHERE friends.user_1 = $userID");
            $rows = $getUserFriends->fetch_all(MYSQLI_ASSOC);
            
            if(!empty($rows)) {
                foreach ($rows as $row) {
                    echo $row["username"] . "<br>";
                }
            }
            
            else {
                echo "No tienes amigos";
            }
            ?>
        </div>
        
        <div>
            <!-- Buscar usuarios -->
            <form id="searchForm" action="" method="POST">
                <input type="text" placeholder="Buscar usuarios" name="SearchFriends">
                <button type="submit" name="search"><span class="material-symbols-rounded">search</span></button>
            </form>

            <div id="results"></div>

            <?php
                // Procesar formulario de búsqueda
                if(isset($_POST['search'])) {
                    $search = $_POST['SearchFriends'];
                    $search_query = "SELECT username FROM users WHERE username LIKE '%$search%'";
                    $search_result = $connection->query($search_query);
                    $rows = $search_result->fetch_all(MYSQLI_ASSOC);

                    if(!empty($rows)) {
                        echo "<br><br>Resultados de búsqueda:<br>";
                        foreach ($rows as $row) {
                            echo $row["username"] . "<br>";
                        }
                    } 

                    else {
                        echo "No se encontraron resultados para '$search'";
                    }
                }
            ?>
        </div>
    </main>

    <script src="../resources/js/searchUsers.js"></script>
</body>
</html>