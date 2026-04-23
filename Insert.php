<?php
include "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $fullname   = $_POST['fullname'];
    $username   = $_POST['username'];
    $department = $_POST['department'];
    $gender     = $_POST['gender'];
    $others     = $_POST['others'];
    $password   = $_POST['password']; // fixed name

    // Handle hobbies
    $hobbies = "";
    if (isset($_POST['hobbies'])) {
        $hobbies = implode(", ", $_POST['hobbies']);
    }

    // 🔐 Hash password (IMPORTANT)
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // 🛡️ Prepared statement (SAFE)
    $stmt = $conn->prepare("INSERT INTO users 
        (fullname, username, department, gender, hobbies, others, password) 
        VALUES (?, ?, ?, ?, ?, ?, ?)");

    $stmt->bind_param(
        "sssssss",
        $fullname,
        $username,
        $department,
        $gender,
        $hobbies,
        $others,
        $hashedPassword
    );

    if ($stmt->execute()) {
        echo "Registration successful ✔";
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>
