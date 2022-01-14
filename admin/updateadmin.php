<?php
include_once 'include/navbar.php';
?>
<div class="container my-5">
    <h1 class="text-center">Update Admin Info</h1>

    <div class="d-flex align-items-center justify-content-center my-3">
        <?php
        $id = $_GET['id'];

        $sql = "SELECT * FROM admin WHERE id = $id";
        $res = mysqli_query($conn, $sql);

        if ($res == TRUE) {
            $count = mysqli_num_rows($res);
            if ($count == 1) {
                $row = mysqli_fetch_assoc($res);
                $full_name = $row['full_name'];
                $username = $row['username'];
            } else {
                header("location:" . SITEURL . '/admin/manageadmin.php');
            }
        }
        ?>
        <form class="col-md-5 border p-5 bg-light" action="" method="POST">
            <div class="mb-3">
                <label for="full_name" class="form-label">Full Name</label>
                <input type="text" name="full_name" class="form-control" id="full_name" value="<?php echo $full_name; ?>">
            </div>
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" name="username" class="form-control" id="username" value="<?php echo $username; ?>">
            </div>
            <input type="hidden" name="id" class="btn btn-primary" value="<?php echo $id; ?>">
            <input type="submit" name="submit" class="btn btn-primary" value="Update Info">
        </form>
    </div>
</div>
<?php
if (isset($_POST['submit'])) {
    $id = ($_POST['id']);
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];

    $sql = "UPDATE admin SET full_name = '$full_name', username = '$username' WHERE id = $id";
    $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));

    if ($res == TRUE) {
        $_SESSION['update'] = "Admin updated successfully!";
        header("location:" . SITEURL . '/admin/manageadmin.php');
    } else {
        $_SESSION['update'] = "There was an error!";
        header("location:" . SITEURL . '/admin/addadmin.php');
    }
}
?>
<?php
include 'include/footer.php';
?>