<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    if ($stmt->execute([$username, $password])) {
        echo "Qeydiyyat uğurla tamamlandı. <a href='login.php'>Giriş</a>";
    } else {
        echo "Xəta: İstifadəçi adı artıq mövcuddur.";
    }
}
?>
<form method="POST">
    <input type="text" name="username" placeholder="İstifadəçi adı" required><br>
    <input type="password" name="password" placeholder="Şifrə" required><br>
    <button type="submit">Qeydiyyatdan keç</button>
</form>
