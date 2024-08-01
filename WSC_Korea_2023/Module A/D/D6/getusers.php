<?php

session_start();
include_once './db.php';

$nickname = isset($_SESSION['nickname']) ? $_SESSION['nickname'] : '';

$stmt = $conn->prepare('SELECT nickname FROM users WHERE nickname != ?');
$stmt->bind_param('s', $nickname);
$stmt->execute();
$result = $stmt->get_result();
$stmt->close();

$nicknames = [];

while ($row = $result->fetch_assoc()) {
    $nicknames[] = $row['nickname'];
}

header('Content-Type: application/json');
echo json_encode($nicknames);