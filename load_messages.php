<?php
require 'db.php';
session_start();

$user_id = $_SESSION['user_id'];
$stmt = $pdo->prepare("
    SELECT * FROM messages 
    WHERE receiver_id = ? AND TIMESTAMPDIFF(SECOND, sent_at, NOW()) >= 60 
    ORDER BY sent_at DESC
");
$stmt->execute([$user_id]);
$messages = $stmt->fetchAll();

foreach ($messages as $msg) {
    echo "<p><b>{$msg['sender_id']}:</b> {$msg['message']} <i>{$msg['sent_at']}</i></p>";
}
?>
