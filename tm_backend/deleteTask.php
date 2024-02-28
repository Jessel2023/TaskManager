<?php
session_start();
require_once('config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['id'])) {
        $id = $_POST['id'];

        $query = "DELETE FROM tasks WHERE id = '$id'";
        $result = mysqli_query($con, $query);

        if ($result) {
            $_SESSION['status'] = "Task Successfully Deleted!";
            $_SESSION['status_code'] = "success";
        } else {
            $_SESSION['status'] = "Error deleting task: " . mysqli_error($con);
            $_SESSION['status_code'] = "error";
        }
    } else {
        $_SESSION['status'] = "Task ID not provided";
        $_SESSION['status_code'] = "error";
    }
} else {
    $_SESSION['status'] = "Invalid request method";
    $_SESSION['status_code'] = "error";
}

header("Location: http://localhost/Taskmanager/index.php");
exit();
?>
