<?php

include '../config/constants.php';

if (isset($_GET['id']) AND isset($_GET['image_name'])) {
    $id = $_GET['id'];
    $image_name = $_GET['image_name'];
    if ($image_name != "") {
        $path = "../images/category/" . $image_name;
        $remove = unlink($path);
        if ($remove == FALSE) {
            $_SESSION['remove'] = "Failed to remove category image!";
            header('location:' . SITEURL . '/admin/managecategory.php');
            die();
        }
    }
    $sql = "DELETE FROM catagory WHERE id = $id";
    $res = mysqli_query($conn, $sql);
    if ($res == TRUE) {
        $_SESSION['delete'] = "Category removed successfully!";
        header('location:' . SITEURL . '/admin/managecategory.php');
    } else {
        $_SESSION['delete'] = "Failed to remove category!";
        header('location:' . SITEURL . '/admin/managecategory.php');
    }
} else {
    header('location:' . SITEURL . '/admin/managecategory.php');
}
?>