<?php
session_start();
include('config.php');
// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Extract form data
    $title = $_POST['title'];
    $description = $_POST['description'];
    $priority = $_POST['priority'];
    $dueDate = $_POST['date'];

    echo "Title: " . $title . "<br>";
    echo "Description: " . $description . "<br>";
    echo "Priority: " . $priority . "<br>";
    echo "Due Date: " . $dueDate . "<br>";

    // Check if the connection is successful
    $query = "INSERT INTO `task`(`title`, `description`, `priority`, `due_date`) VALUES ('$title','$description','$priority','$dueDate')";
    $query_result = mysqli_query($con, $query);

    if($query_result){
        $_SESSION['status'] = "Task Successfuly Added!";
        $_SESSION['status_code'] = "success";
        header("Location: http://localhost/Taskmanager/index.php");
        exit();
    }
}
?>
