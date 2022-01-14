<?php
include_once 'include/navbar.php';
?>
<div class="container my-3">
    <h1 class="text-center">Add Admin</h1>
    <div class="row col-md-12 my-3 text-center">
        <strong>
            <?php
            if (isset($_SESSION['add'])) {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }
            ?>
        </strong>
    </div>
    <div class="d-flex align-items-center justify-content-center my-5">
        <form class="col-md-5 border p-5 bg-light" action="" method="POST">
            <div class="mb-3">
                <label for="full_name" class="form-label">Full Name</label>
                <input type="text" name="full_name" class="form-control" id="full_name">
            </div>
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" name="username" class="form-control" id="username">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="password">
            </div>

            <input type="submit" name="submit" class="btn btn-primary" value="Add Admin">
        </form>
    </div>
</div>

<?php
if (isset($_POST['submit'])) {
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $sql = "INSERT INTO admin SET full_name = '$full_name', username = '$username', password = '$password'";

    $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));

    if ($res == TRUE) {
        $_SESSION['add'] = "Admin added successfully!";
        header("location:" . SITEURL . '/admin/manageadmin.php');
    } else {
        $_SESSION['add'] = "There was an error!";
        header("location:" . SITEURL . '/admin/addadmin.php');
    }
}
?>
<?php
include 'include/footer.php';
?>