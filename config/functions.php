<?php
    function createCookie($name, $message, $destination) {
        setcookie($name, $message, time() + 3600, "/");
        header($destination);
    }
?>