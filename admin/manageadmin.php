<?php
include_once 'include/navbar.php';
?>
<div class="container my-5">
    <h1>Manage Admins</h1>
    <div class="row col-md-12 my-3 text-center">
        <strong>
            <?php
            if (isset($_SESSION['add'])) {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }
            if (isset($_SESSION['delete'])) {
                echo $_SESSION['delete'];
                unset($_SESSION['delete']);
            }
            if (isset($_SESSION['update'])) {
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }
            if (isset($_SESSION['update'])) {
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }
            if (isset($_SESSION['user_not_found'])) {
                echo $_SESSION['user_not_found'];
                unset($_SESSION['user_not_found']);
            }
            if (isset($_SESSION['change_pwd'])) {
                echo $_SESSION['change_pwd'];
                unset($_SESSION['change_pwd']);
            }
            ?>
        </strong>
    </div>
    <div class="row col-md-2 my-3">
        <a href="addadmin.php" class="btn btn-primary">Add Admin</a>
    </div>
    <table class="table text-center">
        <thead>
            <tr>
                <th scope="col">Serial No.</th>
                <th scope="col">Full Name</th>
                <th scope="col">Username</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT * FROM admin";
            $res = mysqli_query($conn, $sql);
            if ($res == TRUE) {
                $count = mysqli_num_rows($res);
                $sn = 1;
                if ($count > 0) {
                    while ($rows = mysqli_fetch_assoc($res)) {
                        $id = $rows['id'];
                        $full_name = $rows['full_name'];
                        $username = $rows['username'];
            ?>
                        <tr>
                            <th scope="row"><?php echo $sn++; ?></th>
                            <td><?php echo $full_name; ?></td>
                            <td><?php echo $username; ?></td>
                            <td>
                                <a href="<?php echo SITEURL; ?>/admin/changepassword.php?id=<?php echo $id; ?>" class="btn btn-primary btn-sm">Change Password</a>
                                <a href="<?php echo SITEURL; ?>/admin/updateadmin.php?id=<?php echo $id; ?>" class="btn btn-success btn-sm">Update Info</a>
                                <a href="<?php echo SITEURL; ?>/admin/deleteadmin.php?id=<?php echo $id; ?>" class="btn btn-danger btn-sm">Remove Admin</a>
                            </td>
                        </tr>
            <?php
                    }
                } else {
                }
            }
            ?>
        </tbody>
    </table>
</div>
<?php
include 'include/footer.php';
?>