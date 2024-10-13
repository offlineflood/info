<?php
$host = 'localhost';
$dbname = 'chat_db';
$user = 'root';  // İstifadəçi adınızı daxil edin
$pass = 'root';      // Şifrənizi daxil edin

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Bağlantı xətası: " . $e->getMessage());
}
?>
