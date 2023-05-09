<?php
    include_once 'connection_db.php';

    function createCookie($name, $message, $destination) {
        setcookie($name, $message, time() + 3600, "/");
        header($destination);
    } 
?>