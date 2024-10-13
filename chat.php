<?php
require 'db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $receiver_id = $_POST['receiver_id'];
    $message = $_POST['message'];

    $stmt = $pdo->prepare("INSERT INTO messages (sender_id, receiver_id, message) VALUES (?, ?, ?)");
    $stmt->execute([$user_id, $receiver_id, $message]);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Chat</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <style>
        body { font-family: Arial, sans-serif; }
        .chat-box { width: 300px; height: 400px; overflow-y: scroll; border: 1px solid #ccc; margin-bottom: 10px; }
    </style>
</head>
<body>
    <div class="chat-box" id="chat-box"></div>

    <form method="POST">
        <input type="text" name="receiver_id" placeholder="Alıcı ID" required><br>
        <textarea name="message" placeholder="Mesaj yaz..." required></textarea><br>
        <button type="submit">Göndər</button>
    </form>

    <script>
        function loadMessages() {
            $.ajax({
                url: 'load_messages.php',
                method: 'GET',
                success: function(data) {
                    $('#chat-box').html(data);
                }
            });
        }

        setInterval(loadMessages, 60000);  // Hər 1 dəqiqədən bir mesajları yenilə
        loadMessages();  // Səhifə yüklənərkən dərhal mesajları yüklə
    </script>
</body>
</html>
