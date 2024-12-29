<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $date = $_POST['date'];
    $image = $_FILES['image']['name'];
    move_uploaded_file($_FILES['image']['tmp_name'], "uploads/" . $image);

    $sql = "INSERT INTO events (title, description, date, image) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$title, $description, $date, $image]);

    header('Location: dashboard.php');
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Event</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <form method="POST" enctype="multipart/form-data">
        <h2>Add Event</h2>
        <input type="text" name="title" placeholder="Title" required>
        <textarea name="description" placeholder="Description" required></textarea>
        <input type="date" name="date" required>
        <input type="file" name="image" required>
        <button type="submit">Add Event</button>
    </form>
</body>
</html>
