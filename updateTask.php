<?php
session_start();
require_once('tm_backend/config.php');
include('assets/header.php');

if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($con, $_GET['id']);
    
    $query = "SELECT * FROM tasks WHERE id = $id";
    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) == 0) {
        echo "Task not found";
        exit();
    }

    $row = mysqli_fetch_assoc($result);
} else {
    echo "Task ID is missing";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/style.css">
    <title>Update Task</title>
</head>
<body><br>
    <h1 class="text-center">Update Task</h1>
    <form action="tm_backend/update_Task.php?id=<?php echo $row['id']; ?>" method="POST" class="form text-white p-3 justify-content-center align-items-center mx-auto m-5 w-50">
        <div class="form-outline flex-fill mb-3">
            <label class="form-label" for="form3Example4cd">Task Title</label>
            <input type="text" id="form3Example4cd" class="form-control" name="title" value="<?php echo $row['title']; ?>" />
        </div>
        <div class="form-outline flex-fill mb-3">
            <label class="form-label" for="form3Example4cd">Description</label>
            <input type="text" id="form3Example4cd" class="form-control" name="description" value="<?php echo $row['description']; ?>" />
        </div>
        <div class="form-group mb-3">
            <label for="priority">Priority Level:</label>
            <select name="priority" id="priority" class="form-control">
                <option value="Low" <?php echo $row['priority'] === 'Low' ? 'selected' : ''; ?>>Low</option>
                <option value="Medium" <?php echo $row['priority'] === 'Medium' ? 'selected' : ''; ?>>Medium</option>
                <option value="High" <?php echo $row['priority'] === 'High' ? 'selected' : ''; ?>>High</option>
            </select>
        </div>
        <div class="form-group mb-3">
            <label for="due_date">Due Date</label>
            <input type="date" class="form-control" id="due_date" name="date" value="<?php echo $row['due_date']; ?>">
        </div>
        <div class= "text-end">
        <button type="submit" class="btn btnpri btn-primary btn-sm">Update</button>
        <button class="btn btn-danger btn-sm">
            <a href="index.php" style="color: white; text-decoration: none;">Cancel</a>
        </button>
        </div>

    </form>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <?php
    if (isset($_SESSION['status']) && $_SESSION['status_code'] != '') {
        ?>
        <script>
            swal({
                title: "<?php echo $_SESSION['status']; ?>",
                icon: "<?php echo $_SESSION['status_code']; ?>",
            });
        </script>
    <?php
    unset($_SESSION['status']);
    unset($_SESSION['status_code']);
}
?>
<?php include('assets/footer.php'); ?>

</body>
</html>
