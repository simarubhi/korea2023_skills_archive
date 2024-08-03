<?php

session_start();
include_once './db.php';

$stmt = $conn->prepare('SELECT users.nickname, chats.message FROM chats JOIN users ON users.id = chats.user_id ORDER BY sent');
$stmt->execute();
$result = $stmt->get_result();
$stmt->close();

$chats = [];

while ($row = $result->fetch_assoc()) {
    $chats[] = [
        'nickname' => $row['nickname'],
        'message' => $row['message'],
    ];
}

header('Content-Type: application/json');
echo json_encode($chats);