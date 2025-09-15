<?php
session_start();
include("connect.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['task_id'])) {
    $task_id = intval($_POST['task_id']);
    $email = $_SESSION['email'];

    $query = "DELETE FROM tasks WHERE id = ? AND task_owner = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("is", $task_id, $email);

    if ($stmt->execute()) {
        // Optionally, delete image file from server here if needed
        header("Location: mainPage.php"); // Replace with your actual file name
        exit;
    } else {
        echo "Failed to delete task.";
    }
}
?>
