<?php
$host = "127.0.0.1";
$user = "root";
$password = "";
$database = "myapp";
$port = 3307;

$conn = new mysqli($host, $user, $password, $database, $port);

// Check connection
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

// Set charset (important for security & proper text handling)
$conn->set_charset("utf8mb4");
?>
