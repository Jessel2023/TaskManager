<?php
session_start();
require_once('config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if all required fields are set
    if (isset($_POST['id']) && isset($_POST['title']) && isset($_POST['description']) && isset($_POST['priority']) && isset($_POST['date'])) {
        // Sanitize inputs
        $id = $_POST['id'];
        $title = $_POST['title'];
        $description = $_POST['description'];
        $priority = $_POST['priority'];
        $due_date = $_POST['date'];

        // Prepare the SQL query with a WHERE clause to update the record with a specific task ID
        $query = "UPDATE task SET title = '$title', description = '$description', priority = '$priority', due_date = '$due_date' WHERE id = '$id'";
        $result = mysqli_query($con, $query);

        if ($result) {
            $_SESSION['status'] = "Task Successfully Updated!";
            $_SESSION['status_code'] = "success";
            header("Location: http://localhost/Taskmanager/index.php"); // Redirect to index page after successful update
            exit();
        } else {
            $_SESSION['status'] = "Error updating task record";
            $_SESSION['status_code'] = "error";
            header("Location: http://localhost/Taskmanager/updateTask.php"); // Redirect back to the update page with an error message
            exit();
        }
    } else {
        $_SESSION['status'] = "One or more required fields are not set";
        $_SESSION['status_code'] = "error";
        header("Location: http://localhost/Taskmanager/updateTask.php"); // Redirect back to the update page with an error message
        exit();
    }
} else {
    $_SESSION['status'] = "Invalid request method";
    $_SESSION['status_code'] = "error";
    header("Location: http://localhost/Taskmanager/updateTask.php"); // Redirect back to the update page with an error message
    exit();
}
?>
