<?php session_start(); ?>
<?php
require_once('tm_backend/config.php');
include('assets/header.php');

$query = "select * from tasks";
$result = mysqli_query($con, $query);
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Task Management Center</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/style.css">
    
</head>
<body>
<section class="vh-auto">
    <div class="container"><br><br>
        <div class="row row-cols-1 row-cols-md-5 row-cols-lg-3 g-4">
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <div class="col">
                    <div class="card h-100 bg-success-subtle">
                        <div class="card-body bg-info-subtle">
                            <h5 class="card-title">Title: <?php echo $row['title'] ?></h5>
                            <p class="card-text">Description: <?php echo $row['description'] ?></p>
                            <ul class="list-group list-group-flush">
                            <li class="list-group-item <?php echo ($row['priority'] == 'Low') ? 'bg-warning text-white' : (($row['priority'] == 'Medium') ? 'bg-info text-white' : 'bg-danger text-white') ?>">
                                Priority: <?php echo $row['priority'] ?>
                            </li>
                                <li class="list-group-item bg-warning-subtle">Due Date: <?php echo $row['due_date'] ?></li>
                            </ul>
                        </div>
                        <div class="card-footer text-end">
                        <a href="updateTask.php?id=<?php echo $row['id']; ?>" class="btn btn-success btn-sm">Edit</a>
                            <form action="tm_backend/deleteTask.php" method="post" class="d-inline">
                                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirmDelete()">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
        <div class="text-center mt-4">
            <a href="addTask.php" class="btn btnpri btn-lg btn-success text-white">Add Task</a>
        </div>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
    function confirmDelete() {
        return confirm("Are you sure you want to delete this task?");
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
</body><br>
<?php include('assets/footer.php'); ?>
</html>
