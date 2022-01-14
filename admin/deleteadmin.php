<?php

include '../config/constants.php';

$id = $_GET['id'];

$sql = "DELETE FROM admin WHERE id=$id";
$res = mysqli_query($conn, $sql);

if ($res == TRUE) {
    $_SESSION['delete'] = "Admin removed successfully!";
    header('location:' . SITEURL . '/admin/manageadmin.php');
} else {
    $_SESSION['delete'] = "Failed to remove admin!";
    header('location:' . SITEURL . '/admin/manageadmin.php');
}
