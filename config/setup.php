<?php
	require_once 'connection_db.php';

	$sql = "
	CREATE DATABASE IF NOT EXISTS `instachat` DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci;
	USE `instachat`;

	DROP TABLE IF EXISTS `conversations`;
	CREATE TABLE `conversations` (
	  `id` int(11) NOT NULL,
	  `user1_id` int(11) NOT NULL,
	  `user2_id` int(11) NOT NULL
	) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

	DROP TABLE IF EXISTS `friends`;
	CREATE TABLE `friends` (
	  `id` int(11) NOT NULL,
	  `user_1` int(11) NOT NULL,
	  `user_2` int(11) NOT NULL
	) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

	DROP TABLE IF EXISTS `messages`;
	CREATE TABLE `messages` (
	  `id` int(11) NOT NULL,
	  `conversation_id` int(11) NOT NULL,
	  `sender_id` int(11) NOT NULL,
	  `message` text NOT NULL,
	  `sent_at` timestamp NOT NULL DEFAULT current_timestamp()
	) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

	DROP TABLE IF EXISTS `users`;
	CREATE TABLE `users` (
	  `id` int(11) NOT NULL,
	  `username` varchar(30) NOT NULL,
	  `email` varchar(50) NOT NULL,
	  `password` varchar(255) NOT NULL,
	  `cpassword` varchar(255) NOT NULL,
	  `profile_picture` varchar(255) DEFAULT NULL
	) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


	ALTER TABLE `conversations`
	  ADD PRIMARY KEY (`id`),
	  ADD KEY `user1_id` (`user1_id`),
	  ADD KEY `user2_id` (`user2_id`);

	ALTER TABLE `friends`
	  ADD PRIMARY KEY (`id`),
	  ADD KEY `user_1` (`user_1`),
	  ADD KEY `user_2` (`user_2`);

	ALTER TABLE `messages`
	  ADD PRIMARY KEY (`id`),
	  ADD KEY `conversation_id` (`conversation_id`),
	  ADD KEY `sender_id` (`sender_id`);

	ALTER TABLE `users`
	  ADD PRIMARY KEY (`id`);


	ALTER TABLE `conversations`
	  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

	ALTER TABLE `friends`
	  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

	ALTER TABLE `messages`
	  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

	ALTER TABLE `users`
	  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;


	ALTER TABLE `conversations`
	  ADD CONSTRAINT `conversations_ibfk_1` FOREIGN KEY (`user1_id`) REFERENCES `users` (`id`),
	  ADD CONSTRAINT `conversations_ibfk_2` FOREIGN KEY (`user2_id`) REFERENCES `users` (`id`);

	ALTER TABLE `friends`
	  ADD CONSTRAINT `friends_ibfk_1` FOREIGN KEY (`user_1`) REFERENCES `users` (`id`),
	  ADD CONSTRAINT `friends_ibfk_2` FOREIGN KEY (`user_2`) REFERENCES `users` (`id`);

	ALTER TABLE `messages`
	  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`conversation_id`) REFERENCES `conversations` (`id`),
	  ADD CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`);
	COMMIT;
	";

	// Ejecuta el código SQL
	if ($connection->multi_query($sql) === TRUE) {
	    echo "La estructura de la base de datos se creó con éxito.";
	} else {
	    echo "Error al crear la estructura de la base de datos: " . $connection->error;
	}

	// Cierra la conexión a la base de datos
	$connection->close();
?>