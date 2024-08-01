<?php

session_start();
include_once './db.php';

$nickname = isset($_SESSION['nickname']) ? $_SESSION['nickname'] : '';
if (empty($nickname)) return;

$stmt = $conn->prepare('SELECT chat.message, users.nickname FROM chat JOIN users ON users.id = chat.user_id ORDER BY chat.sent');
$stmt->execute();
$result = $stmt->get_result();
$stmt->close();

$messages = [];

while ($row = $result->fetch_assoc()) {
    $messages[] = [
        'nickname' => $row['nickname'],
        'message' => $row['message'],
    ];
}

header('Content-Type: application/json');
echo json_encode($messages);