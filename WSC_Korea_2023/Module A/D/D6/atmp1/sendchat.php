<?php

session_start();
include_once './db.php';

$nickname = isset($_SESSION['nickname']) ? $_SESSION['nickname'] : '';
if (empty($nickname)) return;
$message = trim($_POST['message']);

$stmt = $conn->prepare('INSERT INTO chat (message, user_id) VALUES (?, (SELECT id FROM users WHERE nickname = ?))');
$stmt->bind_param('ss', $message, $nickname);
$stmt->execute();
$stmt->close();