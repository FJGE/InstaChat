<?php
    include_once '../config/connection_db.php';
    include_once '../models/User.php';
    include_once '../models/Friend.php';

    if (isset($_GET['search'])) {
        $search = $_GET['search'];
        $users = User::searchUsers($connection, $search);
    }
?>

<?php
    session_start();

    if (!isset($_SESSION['email'])) {
        header("Location: ../index.php");
        exit;
    }

    $email = $_SESSION['email'];

    if (isset($_GET['search'])) {
        $search = $_GET['search'];
        $users = User::searchUsers($connection, $search);
    }

    if (isset($_GET['addFriend'])) {
        $friendId = $_GET['addFriend'];
        $userId = $_SESSION['userId'];
        Friend::addFriend($connection, $userId, $friendId);
        header("Location: main.php");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>InstaChat - Search Users</title>
    <link rel="stylesheet" href="../resources/css/style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="container">
        <div class="user-list">
            <?php
            if (isset($users)) {
                echo "<div>";
                echo "<p>Usuarios encontrados:</p><br>";
                foreach ($users as $user) {
                    $friendId = $user->getId();
                    echo "<a href='./AddFriendController.php?friendId=$friendId' class='card friend-card'>";
                    echo "<div class='smallAvatar'><img src='" . $user->getProfilePhoto() . "'></div>";
                    echo "<p>" . $user->getUsername() . "</p>";
                    echo "</a>";
                }
                echo "</div>";
            }
            ?>
        </div>
    </div>
</body>
</html>