<?php
include 'db.php';

$id = $_GET['id'];
$sql = "DELETE FROM events WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->execute([$id]);

header('Location: dashboard.php');
exit();
?>
