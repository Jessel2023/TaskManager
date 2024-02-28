<?php
session_start();
require_once('config.php');

if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($con, $_GET['id']);
    
    $query = "SELECT * FROM tasks WHERE id = $id";
    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) == 0) {
        $_SESSION['status'] = 'Task not found';
        $_SESSION['status_code'] = 'error';
        header('Location: ../index.php');
        exit();
    }

    $row = mysqli_fetch_assoc($result);
} else {
    $_SESSION['status'] = 'Task ID is missing';
    $_SESSION['status_code'] = 'error';
    header('Location: ../index.php');
    exit();
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $priority = $_POST['priority'];
    $date = $_POST['date'];

    $update_query = "UPDATE tasks SET title='$title', description='$description', priority='$priority', due_date='$date' WHERE id=$id";
    if (mysqli_query($con, $update_query)) {
        $_SESSION['status'] = 'Task updated successfully';
        $_SESSION['status_code'] = 'success';
        header('Location: ../index.php');
        exit();
    } else {
        $_SESSION['status'] = 'Error updating task: ' . mysqli_error($con);
        $_SESSION['status_code'] = 'error';
        header('Location: ../index.php');
        exit();
    }
}
?>
