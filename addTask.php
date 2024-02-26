<?php session_start(); 
include('assets/header.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Task Manager</title>
</head>
<body>
    <section class="vh-100">
    <br>
    <h1 class="text-center">Add a Task</h1>
<form action="tm_backend/insertTask.php" method="POST">
    <div class= "text-white p-3 justify-content-center align-items-center mx-auto m-5 w-50 bg-success">
    <div class="form-outline flex-fill mb-0 ">
        <label class="form-label" for="form3Example4cd">Task Title</label>
        <input type="text" id="form3Example4cd" class="form-control text-dark" name="title" />
     </div>
     <div class="form-outline flex-fill mb-0">
        <label class="form-label" for="form3Example4cd">Description</label>
        <input type="text" id="form3Example4cd" class="form-control text-dark" style="height: 100px;" name="description" />
     </div>
     <div class="p-2">
    <label for="priority">Priority Level:</label>
    <select name="priority" id="priority">
        <option value="Low">Low</option>
        <option value="Medium">Medium</option>
        <option value="High">High</option>
    </select>
</div>
    <div class="form-group">
        <label for="dueDate">Due Date</label>
        <input type="date" class="form-control text-dark" id="dueDate" name="date">
    </div>
  <button type="submit" class="btn btn-primary mt-3">Submit</button>
  </div>
</form>
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
</section>
<?php include('assets/footer.php'); ?>
</body>
</html>