<?php

include '../config/constants.php';

$id = $_GET['id'];

$sql = "DELETE FROM tbl_order WHERE id=$id";
$res = mysqli_query($conn, $sql);

if ($res == TRUE) {
    $_SESSION['delete'] = "Order removed successfully!";
    header('location:' . SITEURL . '/admin/manageorder.php');
} else {
    $_SESSION['delete'] = "Failed to remove order!";
    header('location:' . SITEURL . '/admin/manageorder.php');
}
