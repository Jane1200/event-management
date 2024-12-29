<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$sql = "SELECT * FROM events";
$stmt = $conn->query($sql);
$events = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Event Management Dashboard</h1>
    <a href="add_event.php" class="button">Add Event</a>
    <table>
        <tr>
            <th>Title</th>
            <th>Description</th>
            <th>Date</th>
            <th>Image</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($events as $event): ?>
        <tr>
            <td><?= htmlspecialchars($event['title']) ?></td>
            <td><?= htmlspecialchars($event['description']) ?></td>
            <td><?= htmlspecialchars($event['date']) ?></td>
            <td><img src="uploads/<?= htmlspecialchars($event['image']) ?>" width="100"></td>
            <td>
                <a href="edit_event.php?id=<?= $event['id'] ?>">Edit</a>
                <a href="delete_event.php?id=<?= $event['id'] ?>">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
    <div class="logout">
        <a href="logout.php" class="button">Logout</a>
    </div>
</body>
</html>
