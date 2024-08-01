<?php

$host = 'localhost';
$username = 'admin';
$password = '';
$database = 'korea_d6';

$conn = mysqli_connect($host, $username, $password, $database);

if (!$conn) {
    die('Connection failed' . mysqli_connect_error());
}

$table = $conn->query("SHOW TABLES LIKE 'users'");

if (!$table || $table->num_rows <= 0) {
    $conn->query('CREATE TABLE users(
        id INT AUTO_INCREMENT PRIMARY KEY,
        nickname varchar(255) NOT NULL UNIQUE
    )');
}

$chat = $conn->query("SHOW TABLES LIKE 'chat'");

if (!$chat || $chat->num_rows <= 0) {
    $conn->query('CREATE TABLE chat(
        id INT AUTO_INCREMENT PRIMARY KEY,
        message TEXT NOT NULL,
        sent TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
        user_id INT,
        FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
    )');
}
