<?php
	// Establecer la conexión a la base de datos
	require_once './config/connection_db.php';

	// Crear la tabla "users"
	$sql = "CREATE TABLE users (
	        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	        username VARCHAR(30) NOT NULL,
	        email VARCHAR(50) UNIQUE NOT NULL,
	        password VARCHAR(255) NOT NULL,
	        cpassword VARCHAR(255) NOT NULL
	       )";

	if (mysqli_query($connection, $sql)) {
	  echo "La tabla 'users' se creó correctamente. <br>";
	}
	
	else {
	  echo "Error al crear la tabla 'users': " . mysqli_error($connection) . "<br>";
	}

	// Crear la tabla "posts"
	$sql = "CREATE TABLE posts (
	        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	        content VARCHAR(255) NOT NULL,
	        image_url VARCHAR(255),
	        date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	        user_id INT(6) UNSIGNED,
	        FOREIGN KEY (user_id) REFERENCES users(id)
	      )";

	if (mysqli_query($connection, $sql)) {
	  echo "La tabla 'posts' se creó correctamente. <br>";
	}
	
	else {
	  echo "Error al crear la tabla 'posts': " . mysqli_error($connection) . "<br>";
	}

	// Crear la tabla "friends"
	$sql = "CREATE TABLE friends (
	        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	        user_1 INT(6) UNSIGNED,
	        user_2 INT(6) UNSIGNED,
	        FOREIGN KEY (user_1) REFERENCES users(id),
	        FOREIGN KEY (user_2) REFERENCES users(id)
	      )";

	if (mysqli_query($connection, $sql)) {
	  echo "La tabla 'friends' se creó correctamente. <br>";
	}
	
	else {
	  echo "Error al crear la tabla 'friends': " . mysqli_error($connection) . "<br>";
	}

	// Cerrar la conexión a la base de datos
	mysqli_close($connection);
?>