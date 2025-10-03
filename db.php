<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "database";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) die("Database Connection Failed: " . $conn->connect_error);

$conn->query("CREATE TABLE IF NOT EXISTS users14 (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('user','admin') DEFAULT 'user',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)");


$conn->query("CREATE TABLE IF NOT EXISTS events14 (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(100) NOT NULL,
    description TEXT,
    event_date DATE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)");


$adminCheck = $conn->query("SELECT * FROM users14 WHERE username='admin'");
if($adminCheck->num_rows===0){
    $adminPass = password_hash("admin123", PASSWORD_DEFAULT);
    $conn->query("INSERT INTO users14 (username, password, role) VALUES ('admin', '$adminPass', 'admin')");
}
?>
