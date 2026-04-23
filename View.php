<?php
session_start();
include "db.php";

// 🔒 Protect page
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$result = $conn->query("SELECT * FROM users");
?>

<h2>All Users</h2>

<table border="1" cellpadding="10">
    <tr>
        <th>ID</th>
        <th>Full Name</th>
        <th>Username</th>
        <th>Department</th>
        <th>Gender</th>
        <th>Hobbies</th>
        <th>Others</th>
        <th>Actions</th>
    </tr>

<?php while($row = $result->fetch_assoc()) { ?>
<tr>
    <td><?= $row['id'] ?></td>
    <td><?= htmlspecialchars($row['fullname']) ?></td>
    <td><?= htmlspecialchars($row['username']) ?></td>
    <td><?= htmlspecialchars($row['department']) ?></td>
    <td><?= htmlspecialchars($row['gender']) ?></td>
    <td><?= htmlspecialchars($row['hobbies']) ?></td>
    <td><?= htmlspecialchars($row['others']) ?></td>

    <td>
        <a href="edit.php?id=<?= $row['id'] ?>">Edit</a> |
        <a href="delete.php?id=<?= $row['id'] ?>"
           onclick="return confirm('Are you sure you want to delete this user?')">
           Delete
        </a>
    </td>
</tr>
<?php } ?>

</table>
