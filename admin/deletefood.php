<?php

include '../config/constants.php';

if (isset($_GET['id']) AND isset($_GET['image_name'])) {
    $id = $_GET['id'];
    $image_name = $_GET['image_name'];
    if ($image_name != "") {
        $path = "../images/food/" . $image_name;
        $remove = unlink($path);
        if ($remove == FALSE) {
            $_SESSION['remove'] = "Failed to remove food image!";
            header('location:' . SITEURL . '/admin/managefood.php');
            die();
        }
    }
    $sql = "DELETE FROM food WHERE id = $id";
    $res = mysqli_query($conn, $sql);
    if ($res == TRUE) {
        $_SESSION['delete'] = "Food removed successfully!";
        header('location:' . SITEURL . '/admin/managefood.php');
    } else {
        $_SESSION['delete'] = "Failed to remove food!";
        header('location:' . SITEURL . '/admin/managefood.php');
    }
} else {
    header('location:' . SITEURL . '/admin/managefood.php');
}
?>