<?php
session_start();
include "db.php";

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Validate ID
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Invalid request");
}

$id = intval($_GET['id']);

// Use prepared statement (SAFE)
$stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    header("Location: view.php");
    exit();
} else {
    echo "Error deleting record";
}
?>
