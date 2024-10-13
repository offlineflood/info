<?php
require 'db.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        header('Location: chat.php');
        exit;
    } else {
        echo "Yanlış istifadəçi adı və ya şifrə.";
    }
}
?>
<form method="POST">
    <input type="text" name="username" placeholder="İstifadəçi adı" required><br>
    <input type="password" name="password" placeholder="Şifrə" required><br>
    <button type="submit">Giriş</button>
</form>
