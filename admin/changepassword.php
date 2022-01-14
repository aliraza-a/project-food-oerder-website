<?php
include_once 'include/navbar.php';
?>
<div class="container my-5">
    <h1 class="text-center">Change Admin Password</h1>
    <div class="row col-md-12 my-3 text-center">
        <strong>
            <?php
            if (isset($_SESSION['pwd_not_match'])) {
                echo $_SESSION['pwd_not_match'];
                unset($_SESSION['pwd_not_match']);
            }
            ?>
    </div>
    <div class="d-flex align-items-center justify-content-center my-5">
        <?php
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
        }
        ?>
        <form class="col-md-5 border p-5 bg-light" action="" method="POST">
            <div class="mb-3">
                <label for="current_password" class="form-label">Current password</label>
                <input type="password" name="current_password" class="form-control" placeholder="Current password">
            </div>
            <div class="mb-3">
                <label for="new_password" class="form-label">New Password</label>
                <input type="password" name="new_password" class="form-control" placeholder="New password">
            </div>
            <div class="mb-3">
                <label for="confirm_password" class="form-label">Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control" placeholder="Confirm password">
            </div>
            <input type="hidden" name="id" class="btn btn-primary" value="<?php echo $id; ?>">
            <input type="submit" name="submit" class="btn btn-primary" value="Change Password">
        </form>
    </div>
</div>
<?php
if (isset($_POST['submit'])) {
    $id = ($_POST['id']);
    $current_password = md5($_POST['current_password']);
    $new_password = md5($_POST['new_password']);
    $confirm_password = md5($_POST['confirm_password']);

    $sql = "SELECT * FROM admin WHERE id = $id AND password = '$current_password'";
    $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));

    if ($res == TRUE) {
        $count = mysqli_num_rows($res);
        if ($count == 1) {
            if ($new_password = $confirm_password) {
                $sql2 = "UPDATE admin SET password = '$new_password' WHERE id = $id";
                $res2 = mysqli_query($conn, $sql2) or die(mysqli_error($conn));
                if ($res2 == TRUE) {
                    $_SESSION['change_pwd'] = "Password changed successfully!";
                    header("location:" . SITEURL . '/admin/manageadmin.php');
                } else {
                    $_SESSION['change_pwd'] = "Failed to change password!";
                    header("location:" . SITEURL . '/admin/manageadmin.php');
                }
            } else {
                $_SESSION['pwd_not_match'] = "Password doesn't match!";
                header("location:" . SITEURL . '/admin/changepassword.php');
            }
        } else {
            $_SESSION['user_not_found'] = "User does not exist!";
            header("location:" . SITEURL . '/admin/manageadmin.php');
        }
    }
}
?>
<?php
include 'include/footer.php';
?>