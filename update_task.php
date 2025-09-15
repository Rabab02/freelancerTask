<?php
session_start();
include("connect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_SESSION['email'])) {
        http_response_code(401);
        echo "Unauthorized";
        exit;
    }

    $email = $_SESSION['email'];
    $task_id = intval($_POST['task_id']);
    $title = $_POST['taskTitle'];
    $details = $_POST['taskDetails'];
    $status = $_POST['taskStatus'];

    $stmt = $conn->prepare("UPDATE tasks SET task_title = ?, task_details = ?, task_status = ? WHERE id = ? AND task_owner = ?");
    $stmt->bind_param("sssis", $title, $details, $status, $task_id, $email);

    if ($stmt->execute()) {
        echo "Task updated successfully.";
    } else {
        http_response_code(500);
        echo "Failed to update task.";
    }
}
?>
