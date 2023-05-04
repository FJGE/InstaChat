<?php
    include_once '../config/connection_db.php';
    include_once '../models/User.php';

    // Consultar la base de datos con la cadena de búsqueda
    $search = $_POST['search'];
    $search_query = "SELECT username FROM users WHERE username LIKE '%$search%'";
    $search_result = $connection->query($search_query);
    $rows = $search_result->fetch_all(MYSQLI_ASSOC);

    $results = array();
    foreach ($rows as $row) {
        array_push($results, $row['username']);
    }

    echo json_encode($results);
?>