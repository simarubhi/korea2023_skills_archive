<?php

session_start();
include_once './db.php';

$stmt = $conn->prepare('SELECT nickname FROM users WHERE id != (?)');
$stmt->bind_param('i', $_SESSION['id']);
$stmt->execute();
$result = $stmt->get_result();
$stmt->close();

$nicknames = [];

while ($row = $result->fetch_assoc()) {
    $nicknames[] = $row['nickname'];
}

header('Content-Type: application/json');

echo json_encode($nicknames);