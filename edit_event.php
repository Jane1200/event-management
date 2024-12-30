<?php
include 'db.php';

$id = $_GET['id'];
$sql = "SELECT * FROM events WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->execute([$id]);
$event = $stmt->fetch();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $date = $_POST['date'];
    $image = $event['image'];

    if (!empty($_FILES['image']['name'])) {
        $image = $_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], "uploads/" . $image);
    }

    $sql = "UPDATE events SET title = ?, description = ?, date = ?, image = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$title, $description, $date, $image, $id]);

    header('Location: dashboard.php');
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Event</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <form method="POST" enctype="multipart/form-data">
        <h2>Edit Event</h2>
        <input type="text" name="title" value="<?= htmlspecialchars($event['title']) ?>" required>
        <textarea name="description" required><?= htmlspecialchars($event['description']) ?></textarea>
        <input type="date" name="date" value="<?= htmlspecialchars($event['date']) ?>" required>
        <input type="file" name="image">
        <button type="submit">Update Event</button>
    </form>
</body>
</html>
