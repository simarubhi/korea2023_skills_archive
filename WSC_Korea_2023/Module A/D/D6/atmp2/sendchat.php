<?php

session_start();
include_once './db.php';

$stmt = $conn->prepare('INSERT INTO chats (message, user_id) VALUES (?, ?)');
$stmt->bind_param('si', $_POST['message'], $_SESSION['id']);
$stmt->execute();
$stmt->close();