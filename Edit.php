<?php
session_start();
include "db.php";

// 🔒 Protect page
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// ✅ Validate ID
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Invalid ID");
}

$id = intval($_GET['id']);

// 🛡️ Fetch user safely
$stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows !== 1) {
    die("User not found");
}

$row = $result->fetch_assoc();

// 🔄 Handle update
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $fullname   = $_POST['fullname'];
    $username   = $_POST['username'];
    $department = $_POST['department'];

    $update = $conn->prepare("UPDATE users 
        SET fullname = ?, username = ?, department = ? 
        WHERE id = ?");

    $update->bind_param("sssi", $fullname, $username, $department, $id);

    if ($update->execute()) {
        header("Location: view.php");
        exit();
    } else {
        echo "Update failed ❌";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit User</title>
</head>
<body>

<form method="POST">

    <label>Full Name:</label><br>
    <input type="text" name="fullname" value="<?= htmlspecialchars($row['fullname']) ?>" required><br><br>

    <label>Username:</label><br>
    <input type="text" name="username" value="<?= htmlspecialchars($row['username']) ?>" required><br><br>

    <label>Department:</label><br>
    <input type="text" name="department" value="<?= htmlspecialchars($row['department']) ?>" required><br><br>

    <button type="submit">Update</button>
</form>

</body>
</html>
