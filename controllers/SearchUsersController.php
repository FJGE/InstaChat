<?php
    include_once '../config/connection_db.php';
    include_once '../models/User.php';
    include_once '../models/Friend.php';

    if (isset($_GET['search'])) {
        $search = $_GET['search'];
        $users = User::searchUsers($connection, $search);
    }

    include_once '../views/search-users.php';
?>