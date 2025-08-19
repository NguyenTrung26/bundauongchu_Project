<?php
// Kết nối DB
$pdo = new PDO("mysql:host=localhost;dbname=bundau;charset=utf8", "root", "");

// Giả sử user_id = 1
$user_id = 1;

$stmt = $pdo->prepare("SELECT role, message FROM chat_messages WHERE user_id = ? ORDER BY id ASC");
$stmt->execute([$user_id]);

$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($rows);
