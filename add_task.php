<?php

session_start(); 
include "connect.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['taskTitle'];
    $details = $_POST['taskDetails'];
    $email = $_SESSION['email'];

    $imgPath = '';
    if (isset($_FILES['taskImage']) && $_FILES['taskImage']['error'] == 0) {
        $imgName = time() . '_' . basename($_FILES['taskImage']['name']);
        $targetPath = 'img/' . $imgName;
        
        if (move_uploaded_file($_FILES['taskImage']['tmp_name'], $targetPath)) {
            $imgPath = $targetPath;
        }
      }

    $query = "INSERT INTO tasks (task_owner, task_title, task_details, task_status, task_img)
              VALUES (?, ?, ?, 'not-started', ?)";
              
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "ssss", $email, $title, $details, $imgPath);
    mysqli_stmt_execute($stmt);

    header("Location: mainPage.php");
    exit();
}
?>
