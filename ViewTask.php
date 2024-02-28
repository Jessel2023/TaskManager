<?php session_start(); ?>
<?php include("assets/header.php");
require_once('tm_backend/config.php');

$query = "select * from tasks";
$result = mysqli_query($con, $query);
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>

<section class="section vh-100"><br>
    <table class="table table-secondary table-striped bg-success justify-content-center mx-auto w-50 align-items-center text-center">
        <thead class="thead-dark">
        <tr>
            <th scope="col">Task ID</th>
            <th scope="col">Title</th>
            <th scope="col">Description</th>
            <th scope="col">Priority</th>
            <th scope="col">Due Date</th>
            <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?php echo $row['id'] ?></td>
                <td><?php echo $row['title'] ?></td>
                <td><?php echo $row['description'] ?></td>
                <td><?php echo $row['priority'] ?></td>
                <td><?php echo $row['due_date'] ?></td>
                <td>
                <a href="updateTask.php?id=<?php echo $row['id']; ?>" class="btn btn-success btn-sm">Edit</a>
                    <form action="tm_backend/deleteTask.php" method="post" class="d-inline">
                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirmDelete()">Delete</button>
                    </form>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
    <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
        <a href="addTask.php" class="btn btn-primary btn-lg">Add Task</a>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
    function confirmDelete() {
        return confirm("Are you sure you want to delete this student?");
    }
</script>

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
<?php include("./assets/footer.php") ?>
</body>
</html>
