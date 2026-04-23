<?php
session_start();
include "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST['username'];
    $password = $_POST['password']; // fixed name

    // 🛡️ Prepared statement
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows == 1) {

        $user = $result->fetch_assoc();

        // 🔐 Verify hashed password
        if (password_verify($password, $user['password'])) {

            $_SESSION['username'] = $user['username'];

            header("Location: dashboard.php");
            exit();

        } else {
            echo "<h2>Login Failed ❌</h2>";
            echo "Invalid username or password";
        }

    } else {
        echo "<h2>Login Failed ❌</h2>";
        echo "Invalid username or password";
    }
}
?>
